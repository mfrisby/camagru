<?php
    session_start();
    $msg = "";
    if (isset($_SESSION['id'])) {
        if (isset($_POST['text']) AND isset($_POST['imgid'])){
            $imgid = $_POST['imgid'];
            $text = $_POST['text'];
            $userid = $_SESSION['id'];
            try {
                require_once '../config/database.php';
                $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $req = $pdo->prepare("INSERT INTO comment (userid, galleryid, comment) VALUES (:userid, :galleryid, :comment)");
                $req->execute(array(':userid' => $userid, ":galleryid"=> $imgid, ":comment"=>$text));
                $req->closeCursor();
                $msg = "m2";

                $req = $pdo->prepare("SELECT * FROM users WHERE id=:id");
                $req->execute(array(':id' => $userid));
                $user = $req->fetch();
                $req->closeCursor();
                if ($user['comment'] == "O") {
                    require ("email.php");
                    sendComment($user['email']);
                }
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
    header("Location: ../gallery.php?$msg");
?>