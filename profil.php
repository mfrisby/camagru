<?php 
    session_start();
    include("parts/header.php");
    include("parts/profil.html");
    include("parts/footer.html");
?>

<?php
    if (isset($_POST) AND isset($_POST['password']) AND isset($_SESSION['user'])) {
        require 'config/database.php';
        require 'functions/check_form.php';
        $password = $_POST['password'];
        $user = $_SESSION['user'];

        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (password_verify($password, $user['password']))
        {
            if (isset($_POST['valueP'])) {
                $p = check_password($_POST['valueP'], $pdo);
                if ($p != NULL) {
                    try {
                        $req = $pdo->prepare("UPDATE users SET password='{$p}' WHERE id=:id");
                        $req->execute(array(':id' => $user['id']));
                        $req->closeCursor();
                        $user = $_SESSION['user'];
                        update_session($user['id']);
                    }
                    catch (PDOException $e) {
                        echo(alert_form("password"));
                    }
                }
                else {
                    echo(alert_form("password"));
                }
            }
            else if (isset($_POST['valueU'])) {
                if (check_username($_POST['valueU'], $pdo) != NULL) {
                    try {
                        $req = $pdo->prepare("UPDATE users SET username='{$_POST['valueU']}' WHERE id=:id");
                        $req->execute(array(':id' => $user['id']));
                        $req->closeCursor();
                        $user = $_SESSION['user'];
                        update_session($user['id']);
                    }
                    catch (PDOException $e) {
                        echo(alert_form("username"));
                    }
                }
                else {
                    echo(alert_form("username"));
                }
            }
            else if (isset($_POST['valueE'])) {
                $e = check_email($_POST['valueE'], $pdo);
                if ($e != NULL) {
                    try {
                        $req = $pdo->prepare("UPDATE users SET email='{$e}' WHERE id=:id");
                        $req->execute(array(':id' => $user['id']));
                        $req->closeCursor();
                        $user = $_SESSION['user'];
                        update_session($user['id']);
                    }
                    catch (PDOException $e) {
                        echo(alert_form("email"));                    
                    }
                }
                else {
                    echo(alert_form("email"));
                }
            }

        }
        else {
            echo(alert_form("password"));
        }
    }
    function update_session($id) {
        require 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $req->execute(array('id' => $id));
        $req->closeCursor();
        $user = $req->fetch();
        $_SESSION['user'] = $user;
    }
?>