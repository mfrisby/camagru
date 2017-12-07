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
    if (isset($_POST['email'])) {
        include("functions/email.php");
        resetPassword($_POST['email']);
    }
?>