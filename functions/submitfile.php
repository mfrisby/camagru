<?php
    session_start();
    require_once '../config/database.php';

    $file = "";
    if (isset($_POST['img'])) {
        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $id = uniqid();
        $relative = "../gallery/" . $id . '.png';
        $file = "gallery/" .$id . '.png';
        $success = file_put_contents($relative, $data);
    }
    else if (isset($_FILES['myfile'])) {
        $id = uniqid();
        $relative = "../gallery/" . $id . '.jpg';
        $file = "gallery/" .$id . '.jpg';
        if(move_uploaded_file ($_FILES['myfile']['tmp_name'] , $relative ) == false) {
            $file = "";
        }
    }
    if ($file != "") {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $userid = htmlspecialchars($_SESSION['id']);
        $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
        $req->execute(array(':userid' => $userid, ':img' => $file));
        header("Location: ../index.php?fileupload");
    }
?>