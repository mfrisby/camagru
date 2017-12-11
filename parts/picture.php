
<div class="rightBar">
    <table id="tmp"></table>
</div>
<div class="leftBar">
    <table id="imgs">
        <tr>none</tr>
        <tr><div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div></tr>
        <tr><div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div></tr>
    </table>
</div>
<h1>Welcome !</h1>
</br>
    <form method="post" action="functions/submitfile.php" enctype="multipart/form-data" id="formfile">
        <input type="file" name="myfile"/>
        </br>
        <input class="button" type="submit" name="submit" value="Send"/>
    </form>
    </br>
    <video style="width=400;height=400;" id="video"></video>
    </br>
    <button class="button" id="startbutton">Shoot</button>
    <button class="button" id="savebutton">Save</button>
    </br>
    <!-- <canvas id="canvas"></canvas> -->

<script src="js/picture.js"></script>