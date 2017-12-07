<?php
    session_start();
    require_once '../config/database.php';

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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