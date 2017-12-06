<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <?php
        if (isset($_GET['msglogout'])) {
            echo "<h2>You're not logged anymore.</h2>";
        }
        if (isset($_GET['msglogerror'])) {
            echo "<h2>Login error, wrong password or username.</h2>";
        }
        if (isset($_SESSION['signup_success']) AND isset($_SESSION['user']))  {
            $user = $_SESSION['user'];
            echo $user['username'];
            //include("html/body.php");
        }
        else {
            include("html/forms.html");
            if(isset($_GET['msgsign'] ) ) {
                echo "<h2>An email has been sent, please confirm your account and login.</h2>";
            }
        }
    ?>
</div>
<?php include("html/footer.html"); ?>