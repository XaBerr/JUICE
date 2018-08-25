---
title: "Js and css"
permalink: /js-and-css
excerpt: "Js and css."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

Suppose we want to color our heroes page with a css (works similar to js).
We create a `/projectHero/css` folder and inside we create our`Hero.css` file
```css
body {
  background-color: rgb(205,205,205);
}
```
Let's go to the page `Hero.php` and simply we include the file like this:
```php
<?php
  public function init() {
    parent::init();
    $this->addFiles([
      "css/Hero.css"
    ]);
    $this->addModules([
      new View(),
      new Insert()
    ]);
    $this->modules["View"]->init();
    $this->modules["Insert"]->init();
    $this->modules["Insert"]->listener();
    $this->tags["title"]  .= "Heros";
    $this->tags["content"] = $this->printPage();
  }
?>
```
You can include js and css files, this way, on both pages and modules.
