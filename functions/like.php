<?php
    session_start();
    $msg = "";
    if (isset($_SESSION['id'])) {
        if (isset($_GET['img'])){
            $imgid = intval($_GET['img']);
            echo $imgid;
            $userid = intval($_SESSION['id']);
            try {
                require_once '../config/database.php';
                $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $req = $pdo->prepare("INSERT INTO like (userid, galleryid) VALUES (:userid, :galleryid)");
                $req->execute(array(':userid' => $userid, ":galleryid" => $imgid));
                $req->execute();
                $req->closeCursor();

                $msg = "m4";
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        else {
            $msg = "m3";
        }
    }
    else {
        $msg = "m1";
    }
  //header("Location: ../gallery.php?$msg");
?>