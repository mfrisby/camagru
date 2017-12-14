<?php 
    session_start();
    include("parts/header.php");
    include("parts/profil.html");

    if (isset($_SESSION['username']) AND isset($_SESSION['email'])) {  
        echo "<div class=\"notification\">";
        echo "<h3 class=\"title\">username: " . $_SESSION['username'] . "<h3>";
        echo "<h3 class=\"title\">email: " . $_SESSION['email']."<h3>";
        echo "</div>";
    }
    echo "</div></section>";

    include("parts/footer.html");

    if (isset($_POST) AND isset($_POST['password'])) {
        require 'config/database.php';
        require 'functions/check_form.php';
        $password = $_POST['password'];
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (password_verify($password, $_SESSION['password']))
        {
            echo "ici";
            if (isset($_POST['valueP'])) {
                $p = check_password($_POST['valueP'], $pdo);
                if ($p != NULL) {
                    try {
                        $userid = $_SESSION['id'];
                        $req = $pdo->prepare("UPDATE users SET password='{$p}' WHERE id=:id");
                        $req->execute(array(':id' => $userid));
                        $req->closeCursor();
                        update_session($userid);
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
                        $userid = $_SESSION['id'];
                        $req = $pdo->prepare("UPDATE users SET username='{$_POST['valueU']}' WHERE id=:id");
                        $req->execute(array(':id' => $userid));
                        $req->closeCursor();
                        update_session($userid);
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
                        $userid = $_SESSION['id'];
                        $req = $pdo->prepare("UPDATE users SET email='{$e}' WHERE id=:id");
                        $req->execute(array(':id' => $userid));
                        $req->closeCursor();
                        update_session($userid);
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
        $user = $req->fetch();
        $req->closeCursor();
        if(isset($_SESSION['username'])) {
            $_SESSION['username'] = $user['username'];
        }
        if(isset($_SESSION['email'])) {
            $_SESSION['email'] = $user['email'];
        }
        if(isset($_SESSION['password'])) {
            $_SESSION['password'] = $user['password'];
        }   
        if(isset($_SESSION['id'])) {
            $_SESSION['id'] = $user['id'];
        }
        if(isset($_SESSION['token'])) {
            $_SESSION['token'] = $user['token'];
        }
        if(isset($_SESSION['verified'])) {
            $_SESSION['verified'] = $user['verified'];
        }
        
    }
?>