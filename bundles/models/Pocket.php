<?php
  class Pocket {
    public static function drawFull( $_project ) {
      $project = Project::getDetail($_project);
      if (file_exists("projects/".$_project."/jate.php")) {
        // Jate
        $language = "border-jate";
        $icon = "icon-jate"; 
      } else if (file_exists("projects/".$_project."/angular.json")) {
        // Angular
        $language = "border-angular";
        $icon = "icon-angular"; 
      } else if (file_exists("projects/".$_project."/artisan")) {
        // Laravel
        $language = "border-laravel";
        $icon = "icon-laravel"; 
      } else if (file_exists("projects/".$_project."/symfony.lock")) {
        // Laravel
        $language = "border-symfony";
        $icon = "icon-symfony"; 
      } else {
        // General
        $language = "border-general";
        $icon = "icon-general"; 
      }
      return jBlockFile("bundles/views/pokets/projects.twig", [
        "project"   => $project[0],
        "language"  => $language,
        "icon"      => $icon
      ]);
    }
    public static function drawLite( $_project ) {
      return jBlockFile("bundles/views/pokets/projects.twig", [
        "project" => [
          "name" => $_project
        ]
      ]);
    }
  }
 ?>
