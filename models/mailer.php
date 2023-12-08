<?php

require '../vendor/autoload.php';


class MailerModel {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer\PHPMailer\PHPMailer();
    }

    public function sendMail($to, $subject, $body) {
        
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'garcia.veronica2410@gmail.com'; 
        $this->mailer->Password = 'lqverfegnelkunra'; 
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 587; 

        // Configuración del remitente y destinatario
        $this->mailer->setFrom('garcia.veronica2410@gmail.com', 'Vero'); 
        $this->mailer->addAddress($to);
        $this->mailer->addReplyTo('garcia.veronica2410@gmail.com', 'Vero');

        // Configuración del mensaje
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        // Envío del correo
        if ($this->mailer->send()) {
            echo 'El correo se envió correctamente.';
        } else {
            echo 'Error al enviar el correo: ' . $this->mailer->ErrorInfo;
        }
    }
}
?>
