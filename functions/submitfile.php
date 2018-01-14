<?php
    session_start();
    require_once '../config/database.php';

    $file = "";
    if (isset($_POST['img']) AND isset($_POST['png']) AND isset($_POST['pngx']) AND isset($_POST['pngy']) ) {
        if (!file_exists('../gallery')) {
            mkdir('../gallery', 0777, true);
        }
        $img = $_POST['img'];
        $png = "../".$_POST['png'];
        $x = $_POST['pngx'];
        $y = $_POST['pngy'];

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $id = uniqid();
        while (file_exists("../gallery/" . $id . '.png')){
            $id = uniqid();
        }
        $relative = "../gallery/" . $id . '.png';
        $file = "gallery/" .$id . '.png';
        $success = file_put_contents($relative, $data);

        $png = imagecreatefrompng($png);
        $img = imagecreatefrompng($relative);

        imagecopy($img, $png, $x, $y, 0,0, imagesx($png), imagesy($png));
        imagepng($img, $id.'.png');
        if (file_exists($id . '.png')) {
            unlink($id . '.png');
        }
        $img = imagepng($img, $relative);
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $userid = $_SESSION['id'];
        $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
        $req->execute(array(':userid' => $userid, ':img' => $file));
        return;
    }

?>