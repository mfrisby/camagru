<?php
    require_once 'config/database.php';
    require_once 'email.php';

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST))
    {
        $errors = array();
        if (empty($_POST['username']) OR strlen($_POST['username']) < 3) {
            $errors['username'] = "username invalide.";
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = "Username already exist.";
            }
        }
        $username = $_POST['username'];
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email invalide.";
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);
            $email = $req->fetch();
            if ($email) {
                $errors['email'] = "Email already exist.";
            }
        }
        $email = strtolower($_POST['email']);        
        if (empty($_POST['password']) OR strlen($_POST['password']) < 3) {
            $errors['password'] = "Mot de passe invalide";
        }
        $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (!empty($errors)) {
            echo "<div class=\"alert\">";
            foreach ($errors as $error) {
                echo ($error) . "\n";
            }
            echo "</div>";
            return (-1);
        }
        try {
            $req = $pdo->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");
            $token = uniqid(rand(), true);
            echo $password;
            $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':token' => $token));
            sendVerifMail($email, $token, $pdo->lastInsertId());
        }
        catch (PDOException $e) {
            $_SESSION['error'] = "CREATE USER ERROR: ".$e->getMessage();
        }
        header("Location: index.php?msgsign");
}
?>