<div class="level">
        <div class="column">
            <table id="imgs">
                <tr><th><div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div></th></tr>
                <tr><th><div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div></th></tr>
                <tr><th><div id="trBeer"><a id="beer"><img src="images/beer.png"></img></a></div></th></tr>
            </table>
        </div>
        <div class="column">
             <form method="post" action="functions/submitfile.php" enctype="multipart/form-data" >
                <input type="file" name="myfile"/>
                </br>
                <input id="sendbutton" class="button is-link" type="submit" name="submit" value="Send" disabled/>
            </form>
            <canvas id="videoCanvas"></canvas>

            <input type="image" src="images/arrow_left.png" id="buttonLeft"></input>
            <input type="image" src="images/arrow_down.png" id="buttonDown"></input>
            <input type="image" src="images/arrow_up.png" id="buttonUp"></input>
            <input type="image" src="images/arrow_right.png" id="buttonRight"></input>

            <video style="width=400;height=400;" id="video" hidden></video>
            <button class="button is-link" id="startbutton" disabled>Shoot</button>
        </div>
        <div class="column">
            <table id="tmp"></table>
        </div>
</div>
<script src="js/picture.js"></script>