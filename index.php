<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <?php
        if(isset($_SESSION['signup_success']))  {
            include("html/body.html");
        }
        else {
            include("html/forms.html");
            if(isset($_GET['msg'] ) )
            {
                echo "<h2>An email has been sent, please confirm your account and login.</h2>";
            }
        }
    ?>
</div>
<?php include("html/footer.html"); ?>