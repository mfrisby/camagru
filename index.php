<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <?php
        if (isset($_GET['msglogout'])) {
            echo "<h2>You're not logged anymore.</h2>";
        }
        else if (isset($_GET['msglogerror'])) {
            echo "<h2>Login error, wrong password or username.</h2>";
        }
        else if (isset($_SESSION['signup_success']) AND isset($_SESSION['user']))  {
            include("html/body.php");
        }
        else if (isset($_GET['msglogverified'])) {
            echo "I send you a link by email.</br>Please validate your account.";
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