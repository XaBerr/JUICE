<?php
  class Themes extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Themes";
      $this->themes = $this->getThemes();
      $this->tags["content"] = $this->makePage();
      $this->addFiles($this->getThemeCss());
    }
    public function makePage() {
      return jBlockFile("bundles/views/themes.twig", [
        "themes" => $this->themes,
        "config" => [
          "newTab"    => 'target ="_blank"',
          "dimension" => "3"
        ]
      ]);
    }
    private function getThemeCss() {
      $css = [];
      foreach ($this->themes as $theme)
        $css[] = "css/themes/$theme.min.css";
      return $css;
    }
    private function getThemes() {
      $themes = [];
      $files  = subFolderFile("css/themes");
      foreach ($files as $file)
        if (strpos($file, '.sass') !== false)
          $themes[] = str_replace(".sass", "", $file);
      return $themes;
    }
  }
?>
