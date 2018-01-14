<div class="level">
        <div class="column" style="text-align: center;">
            <div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div>
                </br>
            <div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div>
                </br>
            <div id="trBeer"><a id="beer"><img src="images/beer.png"></img></a></div>
                </br>
            <div id="trGrumpy"><a id="grumpy"><img src="images/grumpy.png"></img></a></div>
                </br>
                <select id="mySelect">
                    <option selected disabled>Filters</option>
                    <option value="none">None</option>
                    <option value="grayscale">grayscale</option>
                    <option value="sepia">sepia</option>
                    <option value="invert">invert</option>
                    <option value="blur">blur</option>
                </select>
        </div>
        <div class="column" style="border:1px solid black;text-align: center;">
             <form enctype="multipart/form-data" >
                <input type="file" name="myfile" id="filepng" accept=".png, .jpeg, .bmp, .jpg" required/>
                </br>
            <button class="button is-link" id="sendbutton" disabled>Send</button>
            </form>

</br>
            <canvas style="border:1px solid black;" id="videoCanvas"></canvas>
</br>
            <input type="image" alt="left" src="images/left.png" id="buttonLeft"></input>
            <input type="image" alt="down" src="images/down.png" id="buttonDown"></input>
            <input type="image" alt="up" src="images/up.png" id="buttonUp"></input>
            <input type="image" alt="right" src="images/right.png" id="buttonRight"></input>

            <video style="width=400;height=400;" id="video" hidden></video>
</br>
            <button class="button is-link" id="startbutton" disabled>Shoot</button>
        </div>
        <div class="column" style="text-align: center;">
            <div id="table"></div>
        </div>
</div>
<script src="js/picture.js"></script>