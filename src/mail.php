<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include "../vendor/autoload.php";

    function sendMail($to,$subject,$body){
        include "./mailconfig.php";
        $mail = new PHPMailer(true); 

        try {
            $mail->SMTPDebug = 0;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com;';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = $from;                 
            $mail->Password   = $password;                                                    
            $mail->Port       = 587;  
        
            $mail->setFrom($from, $fromName);           
            $mail->addAddress($to);

            
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            //echo "Mail has been sent successfully!";
            return true;
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }     

?>