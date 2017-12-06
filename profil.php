<?php 
    session_start();
    include("html/header.php"); ?>
<div class="centered">
    <h2>Do you want to change something ?</h2>
    <a class="button" id="password">Password</a>
    <a class="button" id="username">Username</a>
    <a class="button" id="email">Email</a>

    <form id="passwordForm" style="display:none;" method="post" action="">
        <h1>Password</h1>
        <input name="value" type="password" placeholder="new password" required>
        <input name="password" type="password" placeholder="password" required>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>

    <form id="usernameForm" style="display:none;" method="post" action="">
        <h1>Username</h1>
        <input type="text" name="value" placeholder="new username" required/>
        <input type="password" name="password" placeholder="password" required/>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>     

    <form id="emailForm" style="display:none;" method="post" action="">
        <h1>Email</h1>
        <input type="text" name="value" placeholder="new email" required/>
        <input type="password" name="password" placeholder="password" required/>
        </br>
        </br>
        <input type="submit" class="button"></input>
    </form>
  
</div>
<script src="js/profil.js"></script>
<?php include("html/footer.html"); ?>