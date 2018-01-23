<?php
   session_start();
   if (isset($_SESSION['id']) && isset($_POST['id'])){
       require_once '../config/database.php';
       $userid = $_SESSION['id'];
       $imgid = $_POST['id'];
       echo unlink("../" . $pic['img']);
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("DELETE FROM gallery WHERE id=:id AND userid=:userid");
        $req->execute(array(':id' => $imgid, ':userid' => $userid));
        $req->closeCursor();
   }
?>