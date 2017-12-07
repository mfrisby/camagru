<?php
include 'database.php';
require 'function/pdo.php';
    try {
        $pdo = connect_pdo();
        $req = "DROP DATABASE `".$DB_NAME."`";
        $pdo->exec($req);
        echo "Database droped successfully\n";
    }
    catch (PDOException $e) {
        echo "ERROR DROPING DB: \n".$e->getMessage()."\n";
    }
?>