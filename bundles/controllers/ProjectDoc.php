<?php
  class ProjectDoc extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Doc";
      $this->tags["content"] = $this->makePage( $this->page["project"] );
    }
    public function makePage( $_project ) {
      $dir = getcwd();
      return jBlockFile("bundles/views/projectDoc.twig", [
        "data" => jBLockFile("projects/{$this->page["project"]}/README.md")
      ]);
    }
  }
?>
