<?php
  requireComponent("../Html/Html.php");
  class Angular extends Html {
    public function init() {
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
    }
    public function draw() {}
  }
?>
