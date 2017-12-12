    </br>
    </br>
    </br>
        <div class="left">
            <table id="imgs">
                <tr>
                    <th><div id="trFire"><a id="fire"><img src="images/fire.png"></img></a></div></th>
                    <th><div id="trHat"><a id="hat"><img src="images/hat.png"></img></a></div></th>
                </tr>
            </table>
        </div>

        <div class="main">
            <h1>Welcome !</h1>
            </br>
            </br>
            </br>
            <form method="post" action="functions/submitfile.php" enctype="multipart/form-data" id="formfile">
                <input type="file" name="myfile"/>
                </br>
                <input class="button" type="submit" name="submit" value="Send"/>
            </form>
            </br>
            <video style="width=400;height=400;" id="video"></video>
            </br>
            <button class="button" id="startbutton" disabled>Shoot</button>
            <button class="button" id="savebutton">Save</button>
            </br>
        </div>
    <div class="right">
        <table id="tmp"></table>
    </div>
<script src="js/picture.js"></script>
