<?php
  class Page404 extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "404";
      $this->tags["content"] = jBlockFile("bundles/views/page404.html", []);
    }
  }
?>
