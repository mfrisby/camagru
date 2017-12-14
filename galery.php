<?php 
    session_start();
    include("parts/header.php"); 
?>
    <?php
        require_once 'config/database.php';
        
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM gallery");
        $req->execute();
        $arrayimg = [];
        $i = 0;
        $index = 0;
        echo "<table class=\"gallerytableau\"><thead><tr>";
        while ($data = $req->fetch()) {
            $index++;
            if ($i == 5)
            {
                $i = 0;
                echo "</tr></thead><thead><tr>";
            }
            $img = $data['img'];
            echo "<th><a class=\"imgclick\" id=\"".$index."\"><img src=\"".$img."\"></a></img>";
            include("parts/comment.html");
            add_comment();
            $i++;
        }
        echo "</table>";
        function add_comment() {
            echo "<input type=\"text\"></input><input type=\"submit\"></input></th>";
        }
    ?>
<?php include("parts/footer.html"); ?>

<script src="js/gallery.js"></script>