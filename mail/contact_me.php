<?php

    require_once "PHPMailer/PHPMailerAutoload.php";

    if (isset($_POST['email'])) {

        $name = $_POST['name']; // required
        $email_from = $_POST['email']; // required
        $phone = $_POST['phone']; // not required
        $message = $_POST['message']; // required
        $error_message = "";

        $email_message = "Form details below.\n\n";

        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }

        $email_message .= "Name: " . clean_string($name) . "\n";
        $email_message .= "Email: " . clean_string($email_from) . "\n";
        $email_message .= "Phone: " . clean_string($phone) . "\n";
        $email_message .= "Message: " . clean_string($message) . "\n";

        // create email headers

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ibsduiuc@gmail.com';                 // SMTP username
        $mail->Password = 't4Not\'2dOgyR';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom($email_from);
        $mail->addAddress('rohan.poddar@gmail.com', 'Rohan Poddar');     // Add a recipient
        $mail->addAddress('shin92@illinois.edu', 'David Shin');     // Add a recipient
        $mail->addAddress('holtkam2@gmail.com', 'Jason Holtkamp');     // Add a recipient
        $mail->addReplyTo($email_from);

        $mail->Subject = "IBSD - NEW MESSAGE FROM WEBSITE";
        $mail->Body = $email_message;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
?>

