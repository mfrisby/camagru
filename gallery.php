<?php 
    session_start();
    include("parts/header.php");
    
    require_once 'config/database.php';
    
  $connected = false;

    $index = 0;
    $page = 0;
    $maxpics = 10;

    if (isset($_SESSION['signup_success']))  {
      $connected = true;
    }
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      $index = $page * $maxpics;
    }
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $pdo->prepare("SELECT * FROM gallery");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    echo "<div id=\"gallerytableau\">";
    
    $len = count($data);
    $maxpages = $len / 10;
    while ($index < $len) {
      if ($maxpics == 0) {
        $maxpics = 10;
        break ;
      }
      $elem = $data[$index];
      $like = get_like($elem['id'], $pdo);
      add_card($elem['img'], $elem['id'], $like, $pdo, $elem['userid'], $connected);
      $index++;
      $maxpics--;
    }
    
    echo "</div>";
    
        function get_like($id, $pdo) {
          $like = 'like';
          $req = $pdo->prepare('SELECT * FROM `like` WHERE galleryid=:galleryid');
          $req->execute(array(':galleryid' => $id));
          $c = count($req->fetchAll());
          $req->closeCursor();
          return ($c);
        }
        function get_user($pdo, $id) {
          $req = $pdo->prepare('SELECT * FROM `users` WHERE id=:id');
          $req->execute(array(':id' => $id));
          $user = $req->fetch();
          $req->closeCursor();
          if ($user)
            return ($user['username']);
          return "John Smith";
        }
        function add_card($img, $id, $like, $pdo, $userid, $connected) {
          echo "<div class=\"card mycard\">
              <div class=\"card-image\" id=\"$id\">
                <figure class=\"image is-4by3\">
                  <img src=\"$img\">
                </figure>
                 </div>
              <div class=\"card-content\">
                <div class=\"media\">
                  <div class=\"media-content\">
                    <p class=\"title is-4\">";
                    echo get_user($pdo, $userid);
                    echo "</p>
                  </div>
                </div>
                <div class=\"content\">
                  <br>
                  <form class=\"field has-addons\" method=\"post\" action=\"functions/postcomments.php\">
                  <div class=\"control\">
                    <input name=\"imgid\" value=\"$id\" hidden>
                    <input name=\"text\" class=\"input\" type=\"text\" placeholder=\"Comment\">
                  </div>
                  <div class=\"control\">
                    <input type=\"submit\" value=\"Send\"";
                    if ($connected == false) {
                      echo "disabled ";
                    }
                    echo "class=\"button is-info\">
                  </div>
                </form>
                </div>
              </div>
              <footer class=\"card-footer\">
              </span>
              <span class=\"card-footer-item\">
              $like
              </span>
              <a class=\"card-footer-item\" method=\"post\" href=\"";
              if ($connected == true) {
               echo "functions/like.php?img=$id\"";
              }
              else {
                echo "#\" style=\"cursor: not-allowed;\"";
              }
              echo ">
                Like
              </a>
              </div>";
        }
?>

<div class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Comments</p>
      <button class="delete my-close" aria-label="close"></button>
    </header>
    <section class="modal-card-body" id="modalcontent"></section>
  </div>
</div>     

<nav class="pagination is-centered" role="navigation" aria-label="pagination">
  <ul class="pagination-list">
  <?php
  $i = 0;
  while ($i < $maxpages) {
    echo "<li>";
    echo "<a class=\"pagination-link\" href=\"http://localhost/camagru/gallery.php?page=$i\" aria-label=\"Page $i\" aria-current=\"page\">$i</a>";
    echo "</li>";
    $i++;
  }
  ?>
  </ul>
</nav>

<?php
  include("parts/footer.html");        
  function alert($string, $type) {
    $s = "<section class=\"hero ".$type."\"><div class=\"hero-body container\">".$string."</div></section>";
    return $s;
  }
?>

<script src="js/gallery.js"></script>