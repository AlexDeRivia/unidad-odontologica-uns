<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Usuario;
use Carbon\Carbon;
use Database\Seeders\EstadoSeeder;
use Database\Seeders\MotivoSeeder;
use Database\Seeders\RolSeeder;
use Database\Seeders\SexoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([RolSeeder::class, EstadoSeeder::class, SexoSeeder::class, MotivoSeeder::class]);
    }

    public function test_public_registration_cannot_assign_a_privileged_role_or_weak_password(): void
    {
        $details = [
            'correo' => 'nuevo@example.test',
            'contrasena' => 'UnaClaveSegura2026',
            'dni' => '00000101',
            'nombres' => 'Paciente',
            'apellidos' => 'Prueba',
            'fech_nac' => '1995-01-01',
            'direccion' => 'Dirección de prueba',
            'celular' => '000000101',
            'sexo_id' => 5,
            'rol_id' => 1,
            'usuario_id' => 999,
            'email_verified_at' => now()->toDateTimeString(),
        ];

        $this->post(route('register.store'), $details)->assertOk();

        $user = Usuario::where('correo', 'nuevo@example.test')->firstOrFail();
        $this->assertSame(3, (int) $user->rol_id);
        $this->assertNotSame(999, (int) $user->usuario_id);
        $this->assertNull($user->email_verified_at);
        $this->assertNotSame($details['contrasena'], $user->contrasena);

        $this->post(route('register.store'), [
            ...$details,
            'correo' => 'debil@example.test',
            'dni' => '00000102',
            'contrasena' => 'x',
        ])->assertSessionHasErrors('contrasena');

        $this->assertDatabaseMissing('usuarios', ['correo' => 'debil@example.test']);

        $this->post(route('register.store'), [
            ...$details,
            'correo' => 'predecible@example.test',
            'dni' => '00000103',
            'contrasena' => '12345678',
        ])->assertSessionHasErrors('contrasena');

        $this->assertDatabaseMissing('usuarios', ['correo' => 'predecible@example.test']);
    }

    public function test_patient_cannot_update_or_cancel_foreign_or_closed_appointments(): void
    {
        $patient = $this->user(101, 3);
        $otherPatient = $this->user(102, 3);
        $dentist = $this->user(103, 2);
        $foreign = $this->appointment($otherPatient, $dentist);
        $closed = $this->appointment($patient, $dentist, 2);

        $this->actingAs($patient, 'usuarios');

        foreach ([$foreign, $closed] as $appointment) {
            $this->put(route('paciente.citas.update', $appointment), [
                'dentista_id' => $dentist->usuario_id,
                'fecha' => $this->futureWeekday(),
                'hora' => '11:00:00',
                'motivo_id' => 1,
            ])->assertForbidden();

            $this->delete(route('paciente.citas.cancel', $appointment))->assertForbidden();
        }

        $this->assertSame(1, (int) $foreign->fresh()->estado_id);
        $this->assertSame(2, (int) $closed->fresh()->estado_id);

        $ownPending = $this->appointment($patient, $dentist);
        $newDate = $this->futureWeekday(3);
        $this->put(route('paciente.citas.update', $ownPending), [
            'dentista_id' => $dentist->usuario_id,
            'fecha' => $newDate,
            'hora' => '10:00:00',
            'motivo_id' => 1,
            'comentario' => 'Control legítimo',
        ])->assertRedirect(route('paciente.citas'));
        $this->assertSame($newDate, $ownPending->fresh()->fecha);

        $this->put(route('paciente.citas.update', $ownPending), [
            'dentista_id' => $dentist->usuario_id,
            'fecha' => $newDate,
            'hora' => '10:00:00',
            'motivo_id' => 1,
            'comentario' => 'Solo cambié el comentario',
        ])->assertRedirect(route('paciente.citas'))->assertSessionHasNoErrors();
        $this->assertSame('Solo cambié el comentario', $ownPending->fresh()->comentario);

        $this->delete(route('paciente.citas.cancel', $ownPending))
            ->assertRedirect(route('paciente.citas'));
        $this->assertSame(3, (int) $ownPending->fresh()->estado_id);
    }

    public function test_dentist_can_only_attend_own_pending_appointment_even_if_body_id_differs(): void
    {
        $patient = $this->user(111, 3);
        $dentist = $this->user(112, 2);
        $otherDentist = $this->user(113, 2);
        $foreign = $this->appointment($patient, $otherDentist);
        $closed = $this->appointment($patient, $dentist, 3);
        $ownPending = $this->appointment($patient, $dentist);

        $this->actingAs($dentist, 'usuarios');

        $this->post(route('dentista.citas.atender', $foreign), [
            'cita_id' => $foreign->cita_id,
            'comentario_dentista' => 'No autorizado',
        ])->assertForbidden();

        $this->post(route('dentista.citas.atender', $closed), [
            'comentario_dentista' => 'No autorizado',
        ])->assertForbidden();

        $this->post(route('dentista.citas.atender', $ownPending), [
            'cita_id' => $foreign->cita_id,
            'comentario_dentista' => 'Atención de prueba',
        ])->assertRedirect(route('dentista.citas'));

        $this->assertSame(1, (int) $foreign->fresh()->estado_id);
        $this->assertSame(3, (int) $closed->fresh()->estado_id);
        $this->assertSame(2, (int) $ownPending->fresh()->estado_id);
        $this->assertSame('Atención de prueba', $ownPending->fresh()->comentario_dentista);
    }

    public function test_login_limit_survives_a_session_reset(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('login.auth'), [
                'correo' => 'inexistente@example.test',
                'contrasena' => 'clave incorrecta',
            ])->assertRedirect();
            $this->flushSession();
        }

        $this->post(route('login.auth'), [
            'correo' => 'inexistente@example.test',
            'contrasena' => 'clave incorrecta',
        ])->assertSessionHasErrors('correo');

        $this->assertStringContainsString(
            'Demasiados intentos',
            session('errors')->first('correo')
        );
    }

    public function test_login_limits_password_spraying_across_many_addresses_from_one_ip(): void
    {
        for ($attempt = 0; $attempt < 10; $attempt++) {
            $this->post(route('login.auth'), [
                'correo' => "inexistente{$attempt}@example.test",
                'contrasena' => 'clave incorrecta',
            ])->assertRedirect();
            $this->flushSession();
        }

        $this->post(route('login.auth'), [
            'correo' => 'otro@example.test',
            'contrasena' => 'clave incorrecta',
        ])->assertSessionHasErrors('correo');

        $this->assertStringContainsString('Demasiados intentos', session('errors')->first('correo'));
    }

    public function test_admin_dashboard_keeps_dentist_names_as_javascript_data(): void
    {
        $admin = $this->user(121, 1);
        $patient = $this->user(122, 3);
        $dentist = $this->user(123, 2);
        $dentist->update(['nombres' => '</script><script>alert(1)</script>']);
        $this->appointment($patient, $dentist, 2);

        $response = $this->actingAs($admin, 'usuarios')->get(route('admin.home'));

        $response->assertOk();
        $response->assertDontSee('</script><script>alert(1)</script>', false);
    }

    private function user(int $number, int $role): Usuario
    {
        return Usuario::factory()->create([
            'correo' => "user{$number}@example.test",
            'dni' => sprintf('%08d', $number),
            'celular' => sprintf('%09d', $number),
            'sexo_id' => 5,
            'rol_id' => $role,
        ]);
    }

    private function appointment(Usuario $patient, Usuario $dentist, int $state = 1): Cita
    {
        return Cita::create([
            'paciente_id' => $patient->usuario_id,
            'dentista_id' => $dentist->usuario_id,
            'fecha' => $this->futureWeekday(),
            'hora' => '09:00:00',
            'motivo_id' => 1,
            'estado_id' => $state,
        ]);
    }

    private function futureWeekday(int $weeks = 2): string
    {
        return Carbon::now()->addWeeks($weeks)->next(Carbon::MONDAY)->toDateString();
    }
}
