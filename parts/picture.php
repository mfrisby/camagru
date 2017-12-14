<div class="level">
        <div class="column">
            <table id="imgs">
                <tr><div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div></tr>
                <tr><th><div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div></tr>
                <tr><th><div id="trBeer"><a id="beer"><img src="images/beer.png"></img></a></div></tr>
            </table>
        </div>
        <div class="column">
             <form method="post" action="functions/submitfile.php" enctype="multipart/form-data" >
                <input type="file" name="myfile"/>
                </br>
                <input class="button is-link" type="submit" name="submit" value="Send"/>
            </form>
            <video style="width=400;height=400;" id="video"></video>
            <button class="button is-link" id="startbutton" disabled>Shoot</button>
        </div>
        <div class="column">
            <table id="tmp"></table>
        </div>
</div>
<script src="js/picture.js"></script>