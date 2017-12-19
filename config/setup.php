<?php
    include 'database.php';
    //DATABASE
    try {
        $pdo = new PDO ($DB_DS, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "CREATE DATABASE camagru";
        $pdo->exec($req);
    }
    catch (PDOException $e) {
        echo "ERROR CREATING DB\n" . $e . "\n";
        
    }
    //USERS TABLE
    try {
        $pdo = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $req = "CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `token` VARCHAR(50) NOT NULL,
            `verified` VARCHAR(1) NOT NULL DEFAULT 'N',
            `comment` VARCHAR(1) NOT NULL DEFAULT 'O'
          )";
        $pdo->exec($req);
        echo "TABLE users created.";
    }
    catch (PDOException $e) {
        echo "ERROR CREATING DB\n" . $e . "\n";
    }
    //GALERY
    try {
        // Connect to DATABASE previously created
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "CREATE TABLE `gallery` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `img` VARCHAR(100) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id)
        )";
        $pdo->exec($req);
        echo "Table gallery created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
// CREATE TABLE LIKE
try {
        // Connect to DATABASE previously created
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "CREATE TABLE `like` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id),
          FOREIGN KEY (galleryid) REFERENCES gallery(id)
        )";
        $pdo->exec($req);
        echo "Table like created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
// CREATE TABLE COMMENT
try {
        // Connect to DATABASE previously created
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "CREATE TABLE `comment` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `comment` VARCHAR(255) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id),
          FOREIGN KEY (galleryid) REFERENCES gallery(id)
        )";
        $pdo->exec($req);
        echo "Table comment created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
?>