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
    public function CongratulationsByEmail(string $name, string $email, string $message)
    {
        $html = $this->renderWelcomeTemplate($name, $email, $message);
        $success = $this->sendEmail($email, 'Soporte', $html);
        return $success;
    }

    protected function renderWelcomeTemplate(string $name, string $email, string $password)
    {
        return $this->blade->render('emails.congratulations', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    protected function sendEmail(string $to, string $subject, string $html)
    {
        return $this->emailService->sendEmail($to, $subject, $html);
    }

};