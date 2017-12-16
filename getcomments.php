<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];
    require_once 'config/database.php';
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $pdo->prepare("SELECT * FROM comment WHERE galleryid=:galleryid");
    $req->execute(array(':galleryid' => $id));
    $array = $req->fetchAll();
    $req->closeCursor();
    return ("lol");
}
?>