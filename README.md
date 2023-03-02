# API para felicitar el Día de la Mujer

## Descripción

Esta API permite a los usuarios enviar felicitaciones por correo electrónico a las mujeres en su vida en el Día de la Mujer. El usuario proporcionará el correo electrónico del destinatario, el nombre del remitente, un mensaje personalizado y el asunto del correo electrónico. La API utilizará la biblioteca PHPMailer para enviar el correo electrónico.


## Endpoints

### 1. Enviar felicitación

#### Descripción

Envía un correo electrónico de felicitación a una mujer.

#### URL

POST /api/v1/send_contragulation

#### Respuestas


| Código HTTP                | Descripción                                            |
| ----------------------------- | --------------------------------------------------------- |
| `200 OK`                    | La felicitación se envió correctamente.               |
| `400 Bad Request`           | Uno o más parámetros no son válidos.                 |
| `500 Internal Server Error` | Se produjo un error interno al enviar la felicitación. |

# Script para ejecutar migraciones en Phinx

"migrate": "vendor/bin/phinx migrate -c config-phinx.php",
"create-migration": "vendor/bin/phinx create $1 -c config-phinx.php"

El script anterior define dos acciones para ejecutar en Phinx.

1. `migrate`: Ejecuta la migración de la base de datos según las definiciones en el archivo `config-phinx.php`.
2. `create-migration`: Crea una nueva migración en Phinx, donde `$1` representa el nombre de la migración. Deberás reemplazar `$1` con el nombre de la migración que deseas crear.

Al ejecutar cualquiera de estos comandos, Phinx seguirá las definiciones en el archivo `config-phinx.php` para actualizar o crear la base de datos.

# Para ejecutar las migraciones existentes

composer migrate

# Para crear una nueva migración

composer create-migration NombreDeTuMigracion
