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
        add_modal();
        echo "</table>";
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
        function add_modal() {
          $input = get_input_comment();
          $comments = get_comments();
          echo "<div class=\"modal\">
          <div class=\"modal-background\"></div>
          <div class=\"modal-card\">
            <header class=\"modal-card-head\">
              <p class=\"modal-card-title\">Comments</p>
              <button class=\"delete my-close\" aria-label=\"close\"></button>
            </header>
            <section class=\"modal-card-body\" id=\"toto\">
              $comments
              $comments
            </section>
            <footer class=\"modal-card-foot\">
            $input
            </footer>
          </div>
          </div>";
        }
        function get_input_comment() {
          return "<div class=\"field\">
          <label class=\"label\">Add comment</label>
          <div class=\"control\">
            <input class=\"newcomment\" type=\"text\" placeholder=\"Text input\">
            <input class=\"addcomment\" type=\"submit\">
            </div>
        </div>";
        }
        function get_comments() {
          $start = "<article class=\"message is-dark\">
          <div class=\"message-body\">";
          $end = "</div></article>";
          $msg = "Hello it was great lol thx!";
          $comments = $start.$msg.$end;
          return $comments;
        }
        include("parts/footer.html");
?>
<script src="js/gallery.js"></script>