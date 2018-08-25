<?php
  class Template extends Html {
    public function init() {
      $this->addConnection("config/connection.json");
      $this->addFilesRequired([
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
        "https://code.jquery.com/jquery-3.2.1.slim.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js",
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js",
        "css/template.css"
      ]);
      $this->template = "bundles/views/tradictional.jate";
      $this->tags = [
        "title"    => "JATE - ",
        "brand"    => "JATE",
        "brandImg" => "",
        "menu"     => $this->makeMenu(),
        "metaDescription" => "Beautiful description.",
        "metaKeywords"    => "JATE,PHP,JS,CSS",
        "metaAuthor"      => "XaBerr"
      ];
    }
    public function makeMenu() {
      jBlock();
      ?>
        <li class="nav-item">
          <a class="nav-link" href="Home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Page1">Page 1</a>
        </li>
      <?php
      $temp = jBlockEnd();
      return $temp;
    }
  }
?>
