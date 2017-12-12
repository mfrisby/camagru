<?php 
    session_start();
    include("parts/header.php"); 
?>
<div class="centered">
    <?php
        require_once 'config/database.php';
        
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM gallery");
        $req->execute();
        $arrayimg = [];
        while ($data = $req->fetch()) {
            $img = $data['img'];
            echo "<img src=\"".$img."\"></img>";
        }
    ?>
</div>
<?php include("parts/footer.html"); ?>