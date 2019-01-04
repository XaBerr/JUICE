<?php
class Template extends Html {
  public function init() {
    $this->tags = [
      "title"           => "JUICE - ",
      "brandImg"        => "",
      "metaDescription" => "Projects dashboard",
      "metaKeywords"    => "JUICE,PHP,JS,CSS",
      "metaAuthor"      => "XaBerr",
      "menu"            => "",
      "favicon"         => "img/brand/favicon.png"
    ];
    $this->template = "bundles/views/tradictional.twig";
    $this->addFilesRequired([
      "bower_components/bootstrap/dist/css/bootstrap.min.css",
      "bower_components/openSans/openSans.css",
      "bower_components/quicksand/quicksand.css",
      "bower_components/components-font-awesome/css/fontawesome-all.min.css",
      "css/template.min.css",
      "bower_components/jquery/dist/jquery.min.js",
      "bower_components/bootstrap/dist/js/bootstrap.min.js",
      "bower_components/bootstrap/dist/js/bootstrap.bundle.min.js",
      "bower_components/twemoji.min/index.js",
      "js/template.min.js",
      "https://fonts.googleapis.com/css?family=Roboto:100,300,400,700"
    ]);
  }
}
?>
