<?php
   session_start();
   if (isset($_SESSION['id'])){
       require_once '../config/database.php';
       $id = $_SESSION['id'];
       $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $req = $pdo->prepare("SELECT * FROM gallery WHERE userid=:userid");
       $req->execute(array(':userid' => $id));
       $pic = $req->fetch();
       $req->closeCursor();

       echo unlink("../" . $pic['img']);
       if ($_SESSION['id'] == $pic['userid']) {
            $req = $pdo->prepare("DELETE FROM gallery WHERE id=:id");
            $req->execute(array(':id' => $pic['id']));
       }
   }
?>