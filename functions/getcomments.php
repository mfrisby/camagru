<?php
    session_start();
    if (isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
        require_once '../config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM comment WHERE galleryid=:galleryid");
        $req->execute(array(':galleryid' => $id));
        $array = $req->fetchAll();
        $req->closeCursor();
        foreach ($array as $elem) {
            $username = get_username($pdo, $elem['userid']);
            echo get_comments($elem['comment'], $username);
        }
        return ($array);
    }
    function get_comments($msg, $username) {
        $start = "<article class=\"message is-dark\"><div class=\"message-header\"><p>$username</p></div><div class=\"message-body\">";
        $end = "</div></article>";
        $comments = $start.$msg.$end;
        return $comments;
    }
    function get_username($pdo, $id) {
        $req = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $req->execute(array(':id' => $id));
        $user = $req->fetch();
        $req->closeCursor();
        if (!$user)
            return ("");
        return $user['username'];
    }
?>