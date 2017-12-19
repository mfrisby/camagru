<?php
    session_start();
    require_once 'config/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $req->execute(array(':username' => $username));
        $user = $req->fetch();
        $req->closeCursor();

        if (!$user) {
            header("Location: index.php?msglogerror");
        }
        if (password_verify($password, $user['password'])){
            if ($user['verified'] == 'O') {
                $_SESSION['signup_success'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['token'] = $user['token'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['comment'] = $user['comment'];
                header("Location: index.php");
            }
            else {
                header("Location: index.php?msglogverified");
            }
        }
        else {
            header("Location: index.php?msglogerror");
        }
    }
    catch (PDOException $e) {
        echo "ERROR LOGIN" . $e->getMessage();
    }
?>