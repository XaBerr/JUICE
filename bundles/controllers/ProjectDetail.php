<?php
  class ProjectDetail extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Detail";
      $this->tags["content"]  = $this->makePage( $this->page["project"] );
    }
    public function makePage( $_project ) {
      return jBlockFile("bundles/views/projectDetail.twig", [
        "projectName" => $_project,
        "projects"    => Project::getDetail($_project),
        "config" => [
          "newTab"    => 'target ="_blank"',
          "dimension" => "3"
        ]
      ]);
    }
  }
?>
