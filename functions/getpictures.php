<?php
   session_start();
   if (isset($_SESSION['id'])){
       require_once '../config/database.php';
       $id = $_SESSION['id'];
       $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $req = $pdo->prepare("SELECT * FROM gallery WHERE userid=:userid");
       $req->execute(array(':userid' => $id));
       $array = $req->fetchAll();
       $req->closeCursor();
       foreach ($array as $elem) {
           echo $elem['img']." ";
       }
   }
?>