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
?>