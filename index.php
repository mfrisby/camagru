<?php 
    session_start();
    include("parts/header.php"); ?>
    <?php   
        $home = "</br></br><a href=\"index.php\" class=\"button\">Back</a>";
        if (isset($_GET['msglogout'])) {
            echo "<h2 class=\"title\">You're not logged anymore.</h2>";
            echo $home;
        }
        else if (isset($_GET['msglogerror'])) {
            echo "<h2 class=\"title\">Login error, wrong password or username.</h2>";
            echo $home;
        }
        else if (isset($_GET['msglogverified'])) {
            echo "<h2 class=\"title\">I send you a link by email.</br>Please validate your account.</h2>";
            echo $home;
        }
        else if (isset($_SESSION['signup_success']))  {
            if (isset($_GET['fileupload'])) {
                $s = alert("Upload succeed", "is-success");
                echo $s;
            }
            if (isset($_GET['noupload'])) {
                echo (alert("Upload failed", "is-danger"));
            }
            include("parts/picture.php");
        }
        else {
            include("parts/forms.html");
            if(isset($_GET['msgsign'] ) ) {
                echo "<h2 class=\"title\">An email has been sent, please confirm your account and login.</h2>";
                echo $home;
            }
        }
        function alert($string, $type) {
            $s = "<section class=\"hero ".$type."\"><div class=\"hero-body container\">".$string."</div></section>";
            return $s;
        }
    ?>
<?php include("parts/footer.html"); ?>