# Demo de portfolio · Unidad Odontológica UNS

Versión estática e interactiva del flujo de citas del proyecto académico. Está separada de la aplicación Laravel original y usa únicamente datos ficticios guardados en memoria durante la sesión del navegador.

## Probar localmente

Desde esta carpeta:

```powershell
python -m http.server 4173 --directory dist
```

Abrir `http://localhost:4173`. También se puede abrir `dist/index.html` directamente; el servidor local facilita probar los encabezados y rutas como se publicarían.

## Recorridos

- Paciente: reserva, reprogramación y cancelación de citas ficticias.
- Dentista: agenda de una profesional ficticia y registro de atención.
- Administración: resumen y filtro de citas por estado.
- «Reiniciar datos» restaura el escenario inicial; recargar la página también lo reinicia.

Esta demo no envía información a un servidor, no usa cuentas y no realiza reservas reales. El código fuente completo está en [GitHub](https://github.com/AlexDeRivia/unidad-odontologica-uns).

## Publicar en Cloudflare Pages

Directorio de salida: `portfolio-demo/dist`. No requiere comando de compilación ni variables de entorno. Puede publicarse con integración Git, carga directa desde el panel o `wrangler pages deploy portfolio-demo/dist --project-name <nombre>` una vez autenticada la cuenta. El archivo `_headers` define los encabezados de seguridad para Pages.

Demo pública: https://unidad-odontologica-uns-demo.pages.dev/

El proyecto se creó mediante carga directa. Para actualizarlo desde el panel de Cloudflare Pages, abre el proyecto, elige **Crear implementación**, selecciona **Producción** y carga un ZIP con el contenido de `dist` en la raíz. La carga directa no sincroniza automáticamente los cambios locales.
