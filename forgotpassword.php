<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">

<form id="forgotten" method="post" action="">
        <input type="text" name="email" placeholder="email" required/>
        </br>
        </br>
        <input type="submit" class="button" value="Send me a new password!"></input>
    </form>
</div>
<?php include("html/footer.html"); ?>

<?php
    if (isset($_POST['email'])) {
        include("email.php");
        resetPassword($_POST['email']);
    }
?>