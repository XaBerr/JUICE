<?php
  class Ajax extends Html {
    public function init() {
      switch ($_POST["action"]) {
        case 'drawFull':
          $project = json_decode($_POST["data"],true);
          $project = $project["project"];
          echo json_encode([
            "html" => Pocket::drawFull($project),
            "project" => $project
          ]);
        break;
        default: echo "null"; break;
      }
    }
    public function draw() {}
  }
 ?>
