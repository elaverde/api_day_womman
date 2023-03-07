<?php
namespace App\Models;
use Jenssegers\Blade\Blade;
use App\Models\EmailService;

class EmailNotifications
{
    protected $blade;
    protected $emailService;
    public function __construct()
    {
        $path = realpath(__DIR__ . "/../../resourses/views");
        $this->blade = new Blade($path, __DIR__ . "/../../resourses/compiled");
        $this->emailService = new EmailService();
    }
    /**
     * Toma un nombre, correo electrónico y contraseña, presenta una plantilla de bienvenida y envía un
     * correo electrónico a la dirección de correo electrónico proporcionada.
     * 
     * @param string name El nombre del usuario
     * @param string email La dirección de correo electrónico del usuario
     * @param string message El mensaje que se enviará al usuario
     * 
     * @return El valor de retorno del método sendEmail().
     */
    public function CongratulationsByEmail(string $name, string $email, string $message1,string $message2, string $remitente)
    {
        $html = $this->renderWelcomeTemplate($name, $email, $message1, $message2, $remitente);
        $success = $this->sendEmail($email, 'Universidad de Cundinamarca - '.$remitente, $html);
        return $success;
    }

    protected function renderWelcomeTemplate(string $name, string $email, string $message1,string $message2, string $remitente)
    {
        return $this->blade->render('emails.congratulations', [
            'name' => $name,
            'msg1' => $message1,
            'msg2' => $message2,
            'remitente' => $remitente
        ]);
    }

    protected function sendEmail(string $to, string $subject, string $html)
    {
        return $this->emailService->sendEmail($to, $subject, $html);
    }

};