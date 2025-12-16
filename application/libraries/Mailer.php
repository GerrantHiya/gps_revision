<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'third_party/PHPMailer-PHPMailer-2128d99/src/Exception.php';
require APPPATH . 'third_party/PHPMailer-PHPMailer-2128d99/src/PHPMailer.php';
require APPPATH . 'third_party/PHPMailer-PHPMailer-2128d99/src/SMTP.php';

class Mailer
{
    function sendEmail($name_sender, $email_receiver, $subject, $message)
    {
        $email_sender = "system@lacak-logistik.projectdeck.online";
        $appPassword = "SukacitaSorga@777";
        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->Host = "smtp.hostinger.com";
        $mail->Username = $email_sender;
        $mail->Port = 465;
        $mail->Password = $appPassword;
        $mail->SMTPAuth = 1;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPDebug = 0;

        $mail->setFrom($email_sender, $name_sender);
        $mail->addAddress($email_receiver);
        $mail->isHTML(1);
        $mail->Subject = $subject;
        $mail->Body = $message;

        try {
            // Mencoba mengirim email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            // echo "SKRONL-ErrInf: {$mail->ErrorInfo}";
        }
    }
}
