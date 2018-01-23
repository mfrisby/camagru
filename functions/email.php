<?php
    function sendVerifMail($email, $token, $userId) {
        try {
            $subject = "Camagru - Hello";
            $msg = "<H2>Camagru</h2><p>Afin de valider votre compte, merci de vous rendre sur ce lien:</br>localhost/camagru/confirm.php?id=$userId&token=$token</p>";
            $headers = "From: mfrisby@student.42.fr" . "\r\n" .
            "Reply-To: mfrisby@student.42.fr" . "\r\n" .
            "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
    function sendPassword($email, $password) {
        try {
            $subject = "Camagru - Password";
            $msg = "<H2>Camagru</h2><p>Your password has been reset.</p><p>Your new password is <strong> $password </strong></p>";
            $headers = "From: mfrisby@student.42.fr" . "\r\n" .
            "Reply-To: mfrisby@student.42.fr" . "\r\n" .
            "Content-Type: text/html; charset=\"iso-8859-1\"";
           
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
    function sendComment($email) {
        try {
            $subject = "Camagru - Comment";
            $msg = "<H2>Camagru</h2><p>One of your picture got a comment.</p><p> Hell yeah.</p>";
            $headers = "From: mfrisby@student.42.fr" . "\r\n" .
            "Reply-To: mfrisby@student.42.fr" . "\r\n" .
            "Content-Type: text/html; charset=\"iso-8859-1\"";
           
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
    ?>