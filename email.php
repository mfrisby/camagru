<?php
    session_start();
    function sendVerifMail($email, $token, $userId) {
        try {
            $subject = "Camagru";
            $msg = "Afin de valider votre compte, merci de cliquer sur ce lien:\n\nhttp//localhost/camagru/confirm.php?id=$userId&token=$token";
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