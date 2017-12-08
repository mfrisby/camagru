<?php
    function check_username($username, $pdo) {
        if (empty($username) OR strlen($username) < 3) {
            return (NULL);
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username=:username');
            $req->execute(array(':username' => $username));
            $user = $req->fetch();
            $req->closeCursor();
            if ($user) {
                return (NULL);
            }
        }
        return ($username);
    }
    function check_email($email, $pdo) {
        $email = strtolower($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return (NULL);
        }
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email=:email');
            $req->execute(array(':email' => $email));
            $result = $req->fetch();
            $req->closeCursor();
            if ($result) {
                return (NULL);
            }
        }
        return ($email);
    }
    function check_password($password) {
        if (empty($_POST['password']) OR (strlen($_POST['password'])) < 3) {
            return (NULL);
        }
        return password_hash($password, PASSWORD_DEFAULT);
    }
    function alert_form($string) {
        return "<div class=\"alert\">Something went wrong with your $string.</div>";
    }
?>