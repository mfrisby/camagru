<?php
include 'database.php';
require 'function/pdo.php';
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "DROP DATABASE `".$DB_NAME."`";
        $pdo->exec($req);
        echo "Database droped successfully\n";
    }
    catch (PDOException $e) {
        echo "ERROR DROPING DB: \n".$e->getMessage()."\n";
    }
?>