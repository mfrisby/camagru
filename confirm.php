<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <?php
        if (isset($_GET['token']) AND isset($_GET['id'])) {
            $token = $_GET['token'];
            $userid = $_GET['id'];
            if (check_token($userid, $token) == 1)
                echo "You're one of us now !";
            else {
                echo "Something went wrong.";
            }
        }
        else {
            echo "Something went wrong.";
        }
    ?>
</div>
<?php include("html/footer.html"); ?>

<?php
    function check_token($userid, $token) {
        require_once 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $reponse = $pdo->query("SELECT * FROM users WHERE id = $userid"); 
        $donnees = $reponse->fetch();
        if ($donnees['token'] == $token)
            return (1);
        return (0);
    }
?>