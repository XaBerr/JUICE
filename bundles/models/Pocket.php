<?php
  class Pocket {
    public static function drawFull( $_project ) {
      $project = Project::getDetail($_project);
      return jBlockFile("bundles/views/pokets/projects.twig", [
        "project" => $project[0]
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
