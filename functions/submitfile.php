<?php
    session_start();
    require_once '../config/database.php';

    $file = "";
    if (isset($_POST['img']) AND isset($_POST['png']) ) {
        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $id = uniqid();
        $relative = "../gallery/" . $id . '.png';
        $file = "gallery/" .$id . '.png';
        $success = file_put_contents($relative, $data);

        //collage($_POST['img'], $_POST['png'], $_POST['x'], $_POST['y'])
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $userid = $_SESSION['id'];
        $req = $pdo->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
        $req->execute(array(':userid' => $userid, ':img' => $file));
        return;
    }
/* AND isset($_POST['pngx']) AND isset($_POST['pngy']) */
/*     function collage($img, $png, $x, $y) {
        {
            mkdir("lol");
            if (is_dir('../gallery') === FALSE)
                mkdir('../gallery');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $id = uniqid();
            while (file_exists('../gallery/'.$id.'.png') === TRUE){
                $id = uniqid();
            }
            file_put_contents('../gallery/'.$id.'.png', $data);
            $source = imagecreatefrompng('images/'.$png);
            $dest = imagecreatefrompng('../gallery/'.$id.'.png');
            $largeur_source = imagesx($source);
            $hauteur_source = imagesy($source);
            imagecopy($dest, $source, $x, $y, 0, 0, $largeur_source, $hauteur_source);
            imagepng($dest, '../gallery/'.$id.'.png');
            $path = '../gallery/'.$id;
    } */
?>