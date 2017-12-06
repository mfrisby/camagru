<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="css/body.css">
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <link rel="stylesheet" type="text/css" href="css/rightBar.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/alert.css">
    </head>
<HEADER>
    <nav class="myNavbar">
        <a href="index.php">Home</a>
        <a href="galery.php">Galery</a>
        <?php
            if(isset($_SESSION['signup_success']))  {
                echo "<a href=\"logout.php\" id=\"bRight\">Sign out</a>";
                echo "<a href=\"profil.php\" id=\"bRight\">Profil</a>";
            }
        ?>
    </nav>
</HEADER>
<body>