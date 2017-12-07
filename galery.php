<?php 
    session_start();
    include("html/header.php");
?>
<div class="centered">
    <?php
        require_once 'config/database.php';
        require 'functions/pdo.php';    
        
        $pdo = connect_pdo();
        $req = $pdo->prepare("SELECT * FROM gallery");
        $req->execute();
        $data = $req->fetch();
        if ($data <= 0) {
            echo 'La galerie est vide';
        }
        else {
            echo 'La galerie n\'est pas vide.';
        }
    ?>
</div>
<?php include("html/footer.html"); ?>