# Unidad Odontológica UNS

Proyecto académico desarrollado para organizar citas y coordinar la atención odontológica de la Universidad Nacional del Santa. Este repositorio conserva la aplicación web Laravel y una demo estática preparada para portfolio. El código se publica con permiso del autor del proyecto; el sitio de demostración **no gestiona citas ni datos clínicos reales** y no representa un servicio oficial actualmente operativo.

**Demo interactiva:** [unidad-odontologica-uns-demo.pages.dev](https://unidad-odontologica-uns-demo.pages.dev/)

## Qué incluye

- Aplicación Laravel 10 con vistas Blade para pacientes, dentistas y administración.
- Registro, inicio de sesión y gestión de citas, motivos, especialidades y usuarios.
- Datos de ejemplo sintéticos en los seeders. Las cuentas sembradas tienen contraseñas aleatorias y no ofrecen credenciales predeterminadas.
- [`portfolio-demo/dist`](portfolio-demo/dist): recorrido independiente, estático y sin backend. Sus datos ficticios viven solo en memoria del navegador.

La demo de Cloudflare Pages procede de `portfolio-demo/dist`. La aplicación Laravel **no** está desplegada públicamente.

> **Estado del backend:** Laravel 10 terminó su soporte de seguridad y el lockfile conserva dependencias con avisos de Composer. Esta versión se comparte para mostrar el trabajo académico y para ejecución local aislada; no debe desplegarse como servicio con usuarios o datos reales hasta actualizar el framework, revisar dependencias y repetir las pruebas.

## Ejecutar Laravel en un entorno local

Requisitos: PHP 8.1 o superior con extensiones de Laravel y PDO MySQL, Composer y MySQL. Node.js es opcional para compilar el pequeño punto de entrada Vite; las vistas existentes cargan los recursos ya incluidos en `public/dist`.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Crea una base de datos MySQL vacía llamada `unidad_odontologica` y ajusta en `.env` el usuario y contraseña locales. Después ejecuta:

```powershell
php artisan migrate --seed
php artisan serve
```

La migración del evento que marca citas vencidas como canceladas usa eventos de MySQL; el usuario de base de datos necesita permiso `EVENT` y el servidor debe tener activo su planificador de eventos. Las pruebas con SQLite omiten esa migración específica.

El registro público crea únicamente pacientes. Para probar el panel administrativo en tu instalación local, registra una cuenta con una contraseña propia y cambia **solo esa cuenta local** al rol administrador mediante `php artisan tinker`:

```php
App\Models\Usuario::where('correo', 'tu-correo@example.com')->update(['rol_id' => 1]);
```

No subas `.env`, bases de datos, logs, exportaciones ni información real de pacientes. Antes de usar esta aplicación con datos reales se requiere una revisión operativa adicional de seguridad, privacidad, copias de seguridad y despliegue.

## Verificaciones

Las pruebas usan SQLite en memoria y no se conectan a la base configurada en `.env`:

```powershell
php artisan test
composer validate --no-check-publish
npm.cmd run build
```

En otros sistemas puedes usar `npm run build`. El artefacto de Vite se genera en `public/build` y se ignora en Git.

## Demo de portfolio

Consulta [portfolio-demo/README.md](portfolio-demo/README.md) para ejecutarla y actualizar su despliegue en Cloudflare Pages. Es una representación de los flujos principales, separada de Laravel, con datos ficticios y sin solicitudes a una API.

## Publicación y derechos

El proyecto original se comparte como trabajo académico autorizado. Los datos de ejemplo son sintéticos y las imágenes de procedencia no documentada se sustituyeron por componentes CSS. El repositorio no declara una licencia de reutilización para terceros; las dependencias conservan sus licencias respectivas.
