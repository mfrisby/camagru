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
        echo "<table class=\"gallerytableau\"><tr>";
        while ($data = $req->fetch()) {
            if ($i == 4)
            {
                $i = 0;
                echo "</tr><tr>";
            }
            $img = $data['img'];
            echo "<td><img src=\"".$img."\"></img>";
            add_comment();
            $i++;
        }
        echo "</table>";
        function add_comment() {
            echo "<input type=\"text\"></input><input type=\"submit\"></input></td>";
        }
    ?>
<?php include("parts/footer.html"); ?>