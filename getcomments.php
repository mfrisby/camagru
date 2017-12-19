<?php
    session_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        require_once 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM comment WHERE galleryid=:galleryid");
        $req->execute(array(':galleryid' => $id));
        $array = $req->fetchAll();
        $req->closeCursor();
        foreach ($array as $elem) {
            echo get_comments($elem['comment']);
        }
        return ($array);
    }
    function get_comments($msg) {
        $start = "<article class=\"message is-dark\">
        <div class=\"message-body\">";
        $end = "</div></article>";
        $comments = $start.$msg.$end;
        return $comments;
      }
?>