<?php
    include('dbcon.php');
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $email_template_string = file_get_contents('email_template.html', true);
    // Fill email template with message and relevant banner image
    $processed_template = str_replace('100%', '100%%;', $email_template_string);
    $email_template = sprintf($processed_template,'Harry Lee02','https://www.google.com');
    // echo $email_template;

    $link = $auth->getEmailVerificationLink($email);

    function sendEmail($fromMail,$fromName,$toMail,$toName,$password,$template,$subject){
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        $email_template_string = file_get_contents($template, true);
        $processed_template = str_replace('100%', '100%%;', $email_template_string);
        $email_template = sprintf($processed_template,'Harry Lee02','https://www.google.com');

        try {
            //Server settings
            // $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        
        
            $mail->Username   = 'team.chessmate@gmail.com';
            $mail->Password   = 'jkpw wfzn yeld yeld';
        
            //Recipients
            $mail->setFrom('team.chessmate@gmail.com', 'ChessMate');
            $mail->addAddress('ngochieu0211.study@gmail.com','Harry Lee');     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Test verified email';
            $mail->Body    = $email_template;
        
            $mail->send();
            echo 'Message has been sent';
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>