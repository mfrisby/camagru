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
        }
    ?>
</div>
<?php include("html/footer.html"); ?>