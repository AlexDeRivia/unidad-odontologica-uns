<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        if (!$this->eventExists('actualizar_estado_citas')) {
            DB::unprepared(
                "CREATE EVENT actualizar_estado_citas
                ON SCHEDULE EVERY 1 DAY STARTS '2023-01-01 00:00:00'
                ON COMPLETION NOT PRESERVE ENABLE DO UPDATE citas
                SET estado_id = 3
                WHERE estado_id = 1 AND fecha < CURDATE();"
            );
        }
    }

    private function eventExists(string $eventName): bool
    {
        $result = DB::select("SHOW EVENTS LIKE '$eventName'");
        return !empty($result);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared("DROP EVENT IF EXISTS actualizar_estado_citas");
    }
};
