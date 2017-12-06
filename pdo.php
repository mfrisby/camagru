<?php
    function connect_pdo()
    {
        include 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($pdo);
    }
    function getData_pdo($pdo, $select, $from, $where)
    {
        include 'config/database.php';
        $reponse = $pdo->query("SELECT $select FROM $from WHERE $where"); 
        $data = $reponse->fetch();
        return ($data);
    }    
    function setData_pdo($pdo, $insert, $value)
    {
        include 'config/database.php';
        $reponse = $pdo->query("INSERT INTO $insert VALUES $value"); 
        return ($reponse);
    }
    function updateData_pdo($pdo, $table, $value, $where)
    {
        include 'config/database.php';
        $reponse = $pdo->query("UPDATE $table SET $value WHERE $where"); 
        return ($reponse);
    }
?>