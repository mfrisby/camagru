<?php
    session_start();
    function sendVerifMail($email, $token, $userId) {
        try {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: <mfrisby@student.42.fr>' . "\r\n";

            $subject =  'Camagru - Confirmation de votre compte';
            $msg = "Afin de valider votre compte, merci de cliquer sur ce lien:\n\nhttp//localhost/camagru/confirm.php?id=$userId&token=$token";
            mail($email, $subject, $msg, $headers);
        }
        catch (PDOException $e) {
            echo "SEND MAIL ERROR: ".$e->getMessage();
        }
    }
?>