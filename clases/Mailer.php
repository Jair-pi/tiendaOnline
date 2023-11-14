<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mailer{

    function enviarEmail($email, $asunto, $cuerpo){

        require_once './config/config.php';
        require './phpmailer/src/PHPMailer.php';
        require './phpmailer/src/SMTP.php';
        require './phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug =  SMTP::DEBUG_OFF; //SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = MAIL_PORT;


            $mail->setFrom('917lenin.8@gmail.com', 'TIENDA RC');

            $mail->addAddress($email);


            $mail->isHTML(true);                                  
            $mail->Subject = $asunto;

            $mail->Body    = utf8_decode($cuerpo);

            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            if($mail->send()){
                return true;
            }else{
                false;
            }

        } catch (Exception $e) {
            echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
            return false;
        }
    }

}