<?php
    session_start();
    require_once 'config/database.php';

    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $req = $pdo->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password");
        $userMail = strtolower($userMail);
        $password = hash("whirlpool", $password);
        $req->execute(array(':mail' => $userMail, ':password' => $password));
        
        $val = $req->fetch();
        if ($val == null) {
            $req->closeCursor();
            return (-1);
        }

        $query->closeCursor();
    }
    catch (PDOException $e) {
        echo "ERROR LOGIN" . $e->getMessage();
    }
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['signup_success'] = true;
    header("Location: index.php");
?>