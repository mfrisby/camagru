<?php
    require_once 'config/database.php';
    require_once 'functions/email.php';
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!empty($_POST))
    {
        $username = htmlspecialchars($_POST['username']);
        $email = strtolower(htmlspecialchars($_POST['email']));
        $password = htmlspecialchars($_POST['password']);
        $errors = array();
        if (empty($username) OR strlen($username) < 3) {
            $errors['username'] = "username invalide.";
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute(array($username));
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = "Username already exist.";
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email invalide.";
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute($email);
            $resp = $req->fetch();
            if ($resp) {
                $errors['email'] = "Email already exist.";
            }
        }
        //if 
        //echo 'Secure enough';
        if (empty($password) OR strlen($password) < 3) {
            $errors['password'] = "Mot de passe invalide";
        }
        else if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password) == 0) {
            $errors['password'] = "Mot de passe invalide";
        }
        $password =  password_hash($password, PASSWORD_DEFAULT);
        if (!empty($errors)) {
            echo "<div class=\"alert\">";
            foreach ($errors as $error) {
                echo ($error) . "\n";
            }
            header("Location: index.php?msgsignfailed");
        }
        else {
            try {
                $req = $pdo->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");
                $token = uniqid(rand(), true);
                $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':token' => $token));
                sendVerifMail($email, $token, $pdo->lastInsertId());
            }
            catch (PDOException $e) {
                $_SESSION['error'] = "CREATE USER ERROR: ".$e->getMessage();
                header("Location: index.php?msgsignfailed");
            }
            header("Location: index.php?msgsign");
        }
}