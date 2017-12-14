<?php
    session_start();
    
    require ("functions/email.php");
    if (isset($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            resetPassword($_POST['email']);
        }
        else {
            echo "<div class=\"alert\">Wrong email</div>";
        }
    }
    function resetPassword($email) {
        require 'config/database.php';
        try
        { 
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $password = randomPassword();
            $psd = password_hash($password, PASSWORD_DEFAULT);

            $req = $pdo->prepare("SELECT * FROM users WHERE email=:email");
            $req->execute(array('email' => $email));
            $user = $req->fetch();
            $req->closeCursor();
            if ($user) {
                $req = $pdo->prepare("UPDATE users SET password='{$psd}' WHERE email=:email");
                $req->execute(array('email' => $email));
                $req->closeCursor();
                sendPassword($email, $password);
                echo "<div class=\"alertgreen\">An email has been sent.</div>";
            }
            else {
                echo "<div class=\"alert\">This email does not exist.</div>";
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
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
    function update_session($email) {
        require 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $req->execute(array('email' => $email));
        $req->closeCursor();
        $user = $req->fetch();

        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['token'] = $user['token'];
        $_SESSION['verified'] = $user['verified'];
    }
?>