---
title: "Insert page"
permalink: /insert-page
excerpt: "Insert page."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

To create the page we do the same as before, we add
```js
  ["/heros/insert", "Insert", []],
```
and
```html
<li class="nav-item">
  <a class="nav-link" href="heros/insert">insert</a>
</li>
```
and then we create the `bundles/models/Insert.php` file with the following code:
```php
<?php
  class Insert extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Insert";
      $this->tags["content"] = "<div>Hello world!</div>";
    }
  }
?>
```
Let's create this time a function to insert the heroes:
```php
<?php
  private function pageInsert() {
    jBlock();
    ?>
      <div class="col-6 offset-3">
        <h2>Insert</h2>
        <form action="" method="POST">
          <input type="hidden" name="insertHero">
          <div class="form-group">
            <label>hero name:</label>
            <input class="form-control" type="text" name="hero_name">
          </div>
          <div class="form-group">
            <label>name:</label>
            <input class="form-control" type="text" name="name"><br>
          </div>
          <div class="form-group">
            <label>surname:</label>
            <input class="form-control" type="text" name="surname"><br><br>
          </div>
          <input class="form-control" type="submit" value="Add">
        </form>
      </div>
    <?php
    return jBlockEnd();
  }
?>
```
and add it as before:
```php
<?php
  // $this->tags["content"] = "<div>Hello world!</div>";
  $this->tags["content"] = $this->pageInsert();
?>
```
Now we have the graphical interface but clicking the Add button will not do anything. Let's now create a function that manages the insertion.
```php
<?php
  private function insertFunction() {
    if(isset($_POST["insertHero"])) {
      $heroName   = $_POST["hero_name"];
      $name       = $_POST["name"];
      $surname    = $_POST["surname"];
      $this->queryInsert(
        "INSERT INTO hero
        (`hero_name`, `name`, `surname`)
        VALUES
        ('$heroName', '$name', '$surname')"
      );
      header('Location: view');
    }
  }
?>
```
Now let's add this feature to the constructor:
```php
<?php
  // $this->tags["content"] = "<div>Hello world!</div>";
  $this->insertFunction();
  $this->tags["content"] = $this->pageInsert();
?>
```

**Success:** We run the page to check that everything is done correctly.
{: .notice--success}

<figure>
	<a href="https://user-images.githubusercontent.com/16030020/38466616-6bcc69f8-3b2c-11e8-8d52-bb4f25b44668.png">
    <img src="https://user-images.githubusercontent.com/16030020/38466616-6bcc69f8-3b2c-11e8-8d52-bb4f25b44668.png">
  </a>
	<figcaption>
    Insert page
  </figcaption>
</figure>
