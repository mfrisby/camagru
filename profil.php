<?php 
    session_start();
    include("parts/header.php");
    include("parts/profil.html");
    include("parts/footer.html");
?>

<?php
    if (isset($_POST) AND isset($_POST['password']) AND isset($_SESSION['user'])) {
        $errors = array();
        $password = $_POST['password'];
        $user = $_SESSION['user'];

        require 'functions/check_form.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['valueP']) AND password_verify($password, $user['password'])) {
            $p = check_password($_POST['valueP'], $pdo);
            if ($p != NULL) {
                try {
                    $req = $pdo->prepare("UPDATE users SET password=$p WHERE id =:id");
                    $req->execute(array('id' => $user['id']));
                    $req->closeCursor();
                }
                catch (PDOException $e) {
                    echo(alert_form("password"));
                }
            }
            echo(alert_form("password"));
        }
        else if (isset($_POST['valueU']) AND password_verify($password, $user['password'])) {
            if (check_username($_POST['valueU'], $pdo) != NULL) {
                try {
                    $req = $pdo->prepare("UPDATE users SET username='{$_POST['valueU']}' WHERE id =:id");
                    $req->execute(array('id' => $user['id']));
                    $req->closeCursor();
                }
                catch (PDOException $e) {
                    echo(alert_form("username"));
                }
            }
            echo(alert_form("username"));
        }
        else if (isset($_POST['valueE']) AND password_verify($password, $user['password'])) {
            $e = check_email($_POST['valueE']);
            if ($e != NULL) {
                try {
                    $req = $pdo->prepare("UPDATE users SET email=$e WHERE id =:id");
                    $req->execute(array('id' => $user['id']));
                    $req->closeCursor();
                }
                catch (PDOException $e) {
                    echo(alert_form("email"));                    
                }
            }
            echo(alert_form("email"));
        }
    }
?>