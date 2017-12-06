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
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    function resetPassword($email) {
        require 'config/database.php';
        require 'pdo.php';
        try
        { 
            $pdo = connect_pdo();
            $password = randomPassword();
            $psd = password_hash($password, PASSWORD_DEFAULT);
            updateData_pdo($pdo, "users", "password=$psd", "email=$email" );
            if ($req == true) {
                sendPassword($email, $password);
            }
            else {
                echo "This email does not exist.";
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        } 
    }
?>