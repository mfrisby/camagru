<?php 
    session_start();
    include("parts/header.php"); ?>
<div class="centered">

<form id="forgotten" method="post" action="">
        <input type="text" name="email" placeholder="email" required/>
        </br>
        </br>
        <input type="submit" class="button" value="Send me a new password!"></input>
    </form>
</div>
<?php include("parts/footer.html"); ?>

<?php
    require ("functions/email.php");
    if (isset($_POST['email'])) {
        resetPassword($_POST['email']);
    }
    function resetPassword($email) {
        require 'config/database.php';
        try
        { 
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $password = randomPassword();
            $psd = password_hash($password, PASSWORD_DEFAULT);

            $req = $pdo->prepare("UPDATE users SET password='{$psd}' WHERE email=:email");
            $req->execute(array('email' => $email));
            $req->closeCursor();

            if ($req == true) {
                sendPassword($email, $password);
                update_session($email);
            }
            else {
                echo "This email does not exist.";
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
        $req = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $req->execute(array('email' => $email));
        $req->closeCursor();
        $user = $req->fetch();
        $_SESSION['user'] = $user;
    }
?>