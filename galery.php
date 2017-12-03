<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <?php
        require_once 'config/database.php';

        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $reponse = $pdo->query('SELECT * FROM gallery'); 

        $donnees = $reponse->fetch();
        
        if ($donnees <= 0)
        {
            echo 'La table est vide';
        }
        else
        {
            echo 'La table n\'est pas vide.';
        }
    ?>
</div>
<?php include("html/footer.html"); ?>