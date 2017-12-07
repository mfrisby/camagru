<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <h2>Do you want to change something ?</h2>
    <a class="button" id="password">Password</a>
    <a class="button" id="username">Username</a>
    <a class="button" id="email">Email</a>

    <form id="passwordForm" style="display:none;" method="post" action="">
        <h1>Password</h1>
        <input name="valueP" type="password" placeholder="new password" required>
        <input name="password" type="password" placeholder="password" required>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>

    <form id="usernameForm" style="display:none;" method="post" action="">
        <h1>Username</h1>
        <input type="text" name="valueU" placeholder="new username" required/>
        <input type="password" name="password" placeholder="password" required/>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>     

    <form id="emailForm" style="display:none;" method="post" action="">
        <h1>Email</h1>
        <input type="text" name="valueE" placeholder="new email" required/>
        <input type="password" name="password" placeholder="password" required/>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>
  
</div>
<script src="js/profil.js"></script>
<?php include("html/footer.html"); ?>

<?php
    if (isset($_POST) AND isset($_POST['password']) AND isset($_SESSION['user'])) {
        $errors = array();
        $password = $_POST['password'];
        $user = $_SESSION['user'];

        require 'functions/check_form.php';
        require 'functions/pdo.php';
        $pdo = connect_pdo();
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