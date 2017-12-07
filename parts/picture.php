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
    <canvas id="canvas"></canvas>
    <!-- <img id="photo" alt="The screen capture will appear in this box.">-->
<script src="js/picture.js"></script>
