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
        require 'pdo.php';
        $pdo = connect_pdo();
        $req = $pdo->query("SELECT * FROM users WHERE id = $userid"); 
        $data = $req->fetch();
        $pdo->query("UPDATE users SET verified='O' WHERE id = $userid");
        $req->closeCursor();
        if ($data['token'] == $token)
            return (1);
        return (0);
    }
?>