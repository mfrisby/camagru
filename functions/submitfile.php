<?php
    session_start();
    require_once '../config/database.php';

    if (isset($_POST['img'])) {
        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $id = uniqid();
        $relative = "../gallery/" . $id . '.png';
        $file = "gallery/" .$id . '.png';
        $success = file_put_contents($relative, $data);
        print $success ? $relative : 'Unable to save the file.';
    }

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userid = $_SESSION['id'];
    $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
    $req->execute(array(':userid' => $userid, ':img' => $file));
?>