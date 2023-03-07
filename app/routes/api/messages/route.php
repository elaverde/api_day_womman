<?php
declare(strict_types=1);

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
return function (App $app) {
    $container = $app->getContainer();
    $app->group('/api/v1', function ()  use ($app,$container)  {
        /**
         * Endpoint para iniciar sesión
         *
         * Datos esperados:
         * - sender_full_name: string nombre del remitente del correo (obligatorio)
         * - recipient_full_name: string nombre del destinatario del correo (obligatorio)
         * - recipient_email: string correo del destinatario (obligatorio)
         * - mail_content: string contenido del correo (obligatorio)
         */
        $app->post('/send_contragulation', 'App\Controllers\api\SendController:store');

        /**
         * Endpoint para reenviar correos no enviados
         * 
         */
        $app->get('/retry_email', 'App\Controllers\api\SendController:retry_email');
        
    });

};