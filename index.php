<?php 
    session_start();
    include("parts/header.php"); ?>
    <?php   
        if (isset($_GET['msglogout'])) {
            echo (alert("You're not logged anymore.", "is-success"));
            include("parts/forms.html");
        }
        else if (isset($_GET['msglogerror'])) {
            echo (alert("Login error, wrong password or username.", "is-danger"));
            include("parts/forms.html");
        }
        else if (isset($_SESSION['verified']) AND $_SESSION['verified'] == 'N') {
            echo (alert("I send you a link by email. Please validate your account.", "is-warning"));
        }
        else if (isset($_SESSION['signup_success']))  {
            include("parts/picture.php");
        }
        else {
            if(isset($_GET['msgsign'])) {
                echo (alert("An email has been sent, please confirm your account and login.", "is-success"));
            }
            if(isset($_GET['msgsignfailed'])) {
                echo (alert("Something went wrong, try signup again.", "is-danger"));
            }
            include("parts/forms.html");            
        }
        function alert($string, $type) {
            $s = "<section class=\"hero ".$type."\"><div class=\"hero-body container\">".$string."</div></section>";
            return $s;
        }
    ?>
<?php include("parts/footer.html"); ?>