<div class="level">
        <div class="column" style="text-align: center;">
            <div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div>
                </br>
            <div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div>
                </br>
            <div id="trBeer"><a id="beer"><img src="images/beer.png"></img></a></div>
                </br>
        </div>
        <div class="column" style="border:1px solid black;text-align: center;">
             <form enctype="multipart/form-data" >
                <input type="file" name="myfile" id="filepng" required/>
                </br>
            <button class="button is-link" id="sendbutton" disabled>Send</button>
            </form>

</br>
            <canvas style="border:1px solid black;" id="videoCanvas"></canvas>
</br>
            <input type="image" src="images/arrow_left.png" id="buttonLeft"></input>
            <input type="image" src="images/arrow_down.png" id="buttonDown"></input>
            <input type="image" src="images/arrow_up.png" id="buttonUp"></input>
            <input type="image" src="images/arrow_right.png" id="buttonRight"></input>

            <video style="width=400;height=400;" id="video" hidden></video>
</br>
            <button class="button is-link" id="startbutton" disabled>Shoot</button>
        </div>
        <div class="column" style="text-align: center;">
            <div id="table"></div>
        </div>
</div>
<script src="js/picture.js"></script>