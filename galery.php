<?php 
    session_start();
    include("parts/header.php"); 
        require_once 'config/database.php';
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $pdo->prepare("SELECT * FROM gallery");
        $req->execute();
        $i = 0;
        $index = 0;
        echo "<table id=\"gallerytableau\"><thead><tr>";
        while ($data = $req->fetch()) {
            $index++;
            if ($i == 5)
            {
                $i = 0;
                echo "</tr></thead><thead><tr>";
            }
            echo "<th id=\"".$data['id']."\">";
            add_card($data['img']);
            echo "</th>";
            $i++;
        }
        echo "</table>";
        add_modal();
        function add_modal() {
          echo "<div class=\"modal\">
              <div class=\"modal-background\"></div>
              <div class=\"modal-content\">
                <article class=\"message is-dark\">
                  <div class=\"message-header\">
                  <p>Comments</p>
                  </div>
                  <div class=\"message-body\">Hello</div>
                </article>
              </div>                
              <button class=\"modal-close is-large\" aria-label=\"close\"></button>                
              </div>";
        }
        function add_card($img) {
        echo "<div class=\"card\">
            <div class=\"card-image\">
              <figure class=\"image is-4by3\">
                <img src=\"$img\" alt=\"Placeholder image\">
              </figure>
            </div>
            <div class=\"card-content\">
              <div class=\"media\">
                <div class=\"media-left\">
                  <figure class=\"image is-48x48\">
                    <img src=\"$img\" alt=\"Placeholder image\">
                  </figure>
                </div>
                <div class=\"media-content\">
                  <p class=\"title is-4\">John Smith</p>
                  <p class=\"subtitle is-6\">@johnsmith</p>
                </div>
              </div>
              <div class=\"content\">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Phasellus nec iaculis mauris.
                <br>
                <time datetime=\"2016-1-1\">11:09 PM - 1 Jan 2016</time>
              </div>
            </div>
          </div>";
        }
        include("parts/footer.html");
?>
<script src="js/gallery.js"></script>