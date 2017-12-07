<?php
    session_start();
    require_once '../config/database.php';
    require 'pdo.php';

    $pdo = connect_pdo();
    $user = $_SESSION['user'];
    if (!empty($_FILE) AND isset($_FILE['myfile'])) {
            echo "file:" . $_FILE['myfile']['name'];
            $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
            $req->execute(array(':userid' => $user['id'], ':img' => $_FILE['myfile']));        
    }
    else {
        echo "ERROR!";
    }
?>