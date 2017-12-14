<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
        <title>Camagru</title>
    <head>
    <HEADER>
        <nav class="navbar is-link" role="navigation" aria-label="main navigation">
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="index.php">Home</a>
                    <a class="navbar-item" href="galery.php">Galery</a>
                </div>
                <div class="navbar-end">
                <?php
                    if(isset($_SESSION['signup_success']))  {
                        echo "<a class=\"navbar-item\" href=\"profil.php\" id=\"bRight\">Profil</a>";
                        echo "<a class=\"navbar-item\" href=\"logout.php\" id=\"bRight\">Sign out</a>";
                    }
                ?>
                </div>
            </div>
        </nav>
</HEADER>
<body>