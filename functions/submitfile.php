<?php
    session_start();
    require_once '../config/database.php';

    if (isset($_POST)) {
        echo "helloooooo";
        $image = imagecreatefromjpeg("http://images.websnapr.com/?size=size&key=Y64Q44QLt12u&url=http://google.com");
        $date = date("YMD-his");
        echo $date;
        imagejpeg($image, "../gallery/$date.jpg");
    }

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userid = $_SESSION['id'];
    if (!empty($_FILE) AND isset($_FILE['myfile'])) {
            echo "file:" . $_FILE['myfile']['name'];
            $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
            $req->execute(array(':userid' => $userid, ':img' => $_FILE['myfile']));        
    }
    else {
        echo "ERROR!";
    }
?>