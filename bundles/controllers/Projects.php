<?php
  class Projects extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Projects";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      $sites    = subFolderDir("projects");
      $dir      = getcwd();
      $projects = [];
      foreach ( $sites as $project )
        if(is_dir("$dir/projects/$project"))
            $projects[] = Pocket::drawLite($project);
      return jBlockFile("bundles/views/projects.twig", [
        "projects" => $projects,
        "config"   => [
          "newTab"    => 'target ="_blank"',
          "dimension" => "3"
        ]
      ]);
    }
  }
?>
