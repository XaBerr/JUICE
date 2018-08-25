---
title: "The use of models"
permalink: /use-of-models
excerpt: "The use of models."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

{% raw %}
Now we've accomplished the project by associating a feature page with a page, but for example we would like to have a single page that deals with insert and display heros. The concept of the models now comes into play. What we will do in this section is: we will create a hero page, transform the two pages _insert_ and _view_ into templates and recall them in the heroes page. As usual we create the heroes page.
This time make sure to put the following line above the voices `/heroes/*`:
```js
  ["/heros", "Heros", []],
```
and add it as before:
```html
<li class="nav-item">
  <a class="nav-link" href="heros">heros</a>
</li>
```
Here we remember to delete the items in the menu we will no longer need it. We create the `bundles/models/Heros.php` file with the following code:
```php
<?php
  class Heros extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Heros";
      $this->tags["content"] = "<div>Hello world!</div>";
    }
  }
?>
```
We continue to transform it into a model. Before I start I introduce an introduction to the models. Models are classes that extend `Html`. They have two main functions: _init_ is the function that actually serves as a constructor, it serves to initialize the class; _draw_ is the function that prints html.
We take the `bundles/views/View.php` file and move it to`bundles/models/View.php` and we modify `extends Template` in` extends Html`. We modify the init eliminating all that is not necessary:
```php
<?php
  public function init() {
    parent::init();
  }
?>
```
and we rename our private function `private function pageView()` in `public funcion draw()`. We add the new module created to the heros class and say to `$ this->tags["content"]` to display a new function:
```php
<?php
  $this->addModules([
    new View()
  ]);
  $this->modules["View"]->init();
  $this->tags["title"]  .= "Heros";
  $this->tags["content"] = $this->printPage();
?>
```
let's now create this function:
```php
<?php
  private function printPage() {
    jBlock();
    ?>
    <div>{{view|raw}}</div>
    <?php
    return jBlockEnd("twig", [
      "view" => $this->modules["View"]->draw()
    ]);
  }
?>
```

**Success:** Now running the page we check if everything works properly.
{: .notice--success}

The next step is to introduce the block to insert the heroes, as before we take the `bundles/views/Insert.php` file and move it to `bundles/models/Insert.php` to modify `extends Template` in `extends Html`. We modify the init eliminating all not necessary:
```php
<?php
  public function init() {
    parent::init();
  }
?>
```
We rename our private function `private function pageInsert()` in `public funcion draw ()` and we rename our function `private function insertFunction()` in `public funcion listener() `. We also remove `header ('Location: view');`, is not longer needed.
Now add this module to the hero class with 2 simple steps:
```php
<?php
  $this->addModules([
    new View(),
    new Insert()
  ]);
  $this->modules["View"]->init();
  $this->modules["Insert"]->init();
  $this->modules["Insert"]->listener();
  $this->tags["title"]  .= "Heros";
  $this->tags["content"] = $this->printPage();
?>
```
and
```php
<?php
  private function printPage() {
    jBlock();
    ?>
    <div>
      <div>{{insert|raw}}</div>
      <div>{{view|raw}}</div>
    </div>
    <?php
    return jBlockEnd("twig", [
      "view" => $this->modules["View"]->draw(),
      "insert" => $this->modules["Insert"]->draw()
    ]);
  }
?>
```

**Success:** Now you can check the page to see if everything works correctly.
{: .notice--success}

{% endraw %}
