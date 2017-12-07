<?php
    function sendVerifMail($email, $token, $userId) {
        try {
            $subject = "Camagru - Hello";
            $msg = "Afin de valider votre compte, merci de cliquer sur ce lien:\n\nlocalhost/camagru/confirm.php?id=$userId&token=$token";
            $headers = "From: mowpy42@gmailcom" . "\r\n" .
            "Reply-To: mowpy42@gmailcom" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
           
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
    function sendPassword($email, $password) {
        try {
            $subject = "Camagru - Password";
            $msg = "You're password has been reset.</br>You're new password is $password";
            $headers = "From: mowpy42@gmailcom" . "\r\n" .
            "Reply-To: mowpy42@gmailcom" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
           
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
    ?>