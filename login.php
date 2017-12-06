<?php
    session_start();
    require_once 'config/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $req = $pdo->prepare("SELECT * FROM users WHERE username= :username");
        $req->execute(array(':username' => $username));
        $user = $req->fetch();

        if (!$user) {
            $req->closeCursor();
            header("Location: index.php?msglogerror");
        }
        if (password_verify($password, $user['password'])){
            $req->closeCursor();
            $_SESSION['signup_success'] = true;
            $_SESSION['user'] = $user;
            header("Location: index.php");
        }
        else {
            $req->closeCursor();
            header("Location: index.php?msglogerror");
        }
    }
    catch (PDOException $e) {
        echo "ERROR LOGIN" . $e->getMessage();
    }
?>