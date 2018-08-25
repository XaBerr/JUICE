---
title: "Version 0.2.6"
permalink: /version-0-2-6
excerpt: "Version 0.2.6."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

{% raw %}
## Index
  1. [Structure](#1-structure)
  2. [Download JATE](#2-download-jate)
  3. [Run first page](#3-run-first-page)
  4. [Creating a database database](#4-creating-a-database)
  5. [View page](#5-view-page)
  6. [Insert page](#6-insert-page)
  7. [The use of models](#7-the-use-of-models)
  8. [The use of views](#8-the-use-of-views)
  9. [Js and css](#9-js-and-css)

## 1 Structure
```
project
  └ bundles
    ├ controllers
    ├ models
    └ views
```
A page is made up of two parts.
The first is the page, the chassies, the structure that will match a file inside `bundles/controllers`. For example, the Login page will have a `Login.php` file that will contain a class that will handle the requests of the http://mywebsite/login page.
The second part will be the content of the page, for example, always for the login page, the input form that holds the two inputs: username and password. Clearly a page can contain more content. The content can be divided into two parts: the graphical interface that is almost entirely made up of the html and the part of php code that is used to customize it. The graphical interface will be contained in `bundles/views` while the part of the code will be contained in` bundles/models`.

## 2 Download JATE
Go to your php root, create a folder with the name of your project in this tutorial will be `projectHero` and download JATE as from [tutorial](https://github.com/XaBerr/JATE).

## 3 Run first page
Once you have downloaded JATE you come up with a folder in a similar situation to `/phpRoot/projectHero/.../JATE`, the path may change depending on the method you used to download JATE.
The next step is to enter in `JATE/examples/01essentials`, copy the contents of the folder and paste it into` /phpRoot/projectHero`. By doing this you have created the minimum necessary to run JATE. Now you can access the browser through your localhost such as http://localhost/projectHero/ and see the page.

## 4 Creating a database database
We create a database of hheros, for example:
```sql
CREATE DATABASE IF NOT EXISTS `db-hero`;
USE `db-hero`;

CREATE TABLE IF NOT EXISTS `hero` (
  `pk_hero` int(11) NOT NULL,
  `hero_name` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `surname` varchar(250) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

ALTER TABLE `hero`
  ADD PRIMARY KEY (`pk_hero`);

ALTER TABLE `hero`
  MODIFY `pk_hero` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

INSERT INTO `hero` (`pk_hero`, `hero_name`, `name`, `surname`) VALUES
(1, 'Superman', 'Clark', 'Kent'),
(2, 'Batman', 'Bruce', 'Wayne');
```
Let's go to our project and look for the `projectHero/config/connection.json` file, set all connection values and make sure to enable connection setting `enable: true`. Let's go to the `bundles/models/Template.php` page and add to the` Template` class the following function that will serve to connect:

```php
<?php
  public function makeConnection() {
    $jConfig = $this->parameters["app"];
    $connection = null;
    if( $jConfig != null && $jConfig->connection["enable"])
      $connection = new Connection(
        $jConfig->connection["server"],
        $jConfig->connection["database"],
        $jConfig->connection["user"],
        $jConfig->connection["password"],
        $jConfig->connection["engine"]
      );
    $this->addConnection("base", $connection);
  }
?>
```
Now we call this function in the template constructor so that each time a page is invoked, it will automatically connect. To do this we use the following code:
```php
<?php
  parent::__construct( $_parameters ); // under this line
  $this->makeConnection();
?>
```
We launch the same page before, __if everything works correctly we will have to see it appear without errors__.

## 5 View page
We want to create a new page called __view__, it must show us the list of our heroes. The first step to do is go to `config/router.json` and add a new line inside the array pages:
```js
  ["/heros/view", "View"],
```
Doing this we say to the JATE that when it receives the following url `/heroes/view`  it will be the class `View` to deal with the request. Now we have to create the class and we create it in this new page `bundles/models/View.php` and insert the following code:
```php
<?php
  class View extends Template {
    public function __construct( $_parameters ) {
      parent::__construct( $_parameters );
      $this->tags["title"]  .= "View";
      $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
    }
  }
?>
```
We have the class and we set the routing, now we can access our page through:
http://localhost/projectHero/heros/view.
In order to be able to access it more conveniently we include in our template page, in the menu function the following entry:
```html
<li>
  <a href="heros/view">view</a>
</li>
```
Now it will be a normal page where you can navigate from the menu. Let's continue by adding the hero list, to do this we add to our class the following display function:
```php
<?php
  private function pageView() {
    $heros = $this->queryFetch("SELECT * FROM hero");
    jBlock();
    ?>
      <div style='margin-top:70px;'>
        <table class="table">
          <tr>
            <th>hero</th>
            <th>name</th>
            <th>surname</th>
          </tr>
          {% for hero in heros %}
            <tr>
              <td>{{hero["hero_name"]}}</td>
              <td>{{hero["name"]}}</td>
              <td>{{hero["surname"]}}</td>
            </tr>
          {% endfor %}
        </table>
      </div>
    <?php
    return jBlockEnd("twig", ["heros" => $heros]);
  }
?>
```
This feature uses an engine called `twig` for those who prefer it can use another engine called `pug`, what it does is take what we write between two _jBlock_ and return it in the form of html string. To tell the class to print this html string we need to edit a line in the constructor function:
```php
<?php
  // $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
  $this->tags["content"] = $this->pageView();
?>
```
__We run the page to check that everything is done correctly__.

## 6 Insert page
To create the page we do the same as before, we add
```js
  ["/heros/insert", "Insert" ],
```
and
```html
<li>
  <a href="heros/insert">insert</a>
</li>
```
and then we create the `bundles/models/Insert.php` file with the following code:
```php
<?php
  class Insert extends Template {
    public function __construct( $_parameters ) {
      parent::__construct( $_parameters );
      $this->tags["title"]  .= "Insert";
      $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
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
      <div style='margin-top:70px;'>
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
          <input type="submit" value="Add">
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
  // $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
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
  // $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
  $this->insertFunction();
  $this->tags["content"] = $this->pageInsert();
?>
```

## 7 The use of models
Now we've accomplished the project by associating a feature page with a page, but for example we would like to have a single page that deals with insert and display heros. The concept of the models now comes into play. What we will do in this section is: we will create a hero page, transform the two pages _insert_ and _view_ into templates and recall them in the heroes page. As usual we create the heroes page.
This time make sure to put the following line above the voices `/heroes/*`:
```js
  ["/heros", "Heros" ],
```
and add it as before:
```html
<li>
  <a href="heros">heros</a>
</li>
```
Here we remember to delete the items in the menu we will no longer need it. We create the `bundles/models/Heros.php` file with the following code:
```php
<?php
  class Heros extends Template {
    public function __construct( $_parameters ) {
      parent::__construct( $_parameters );
      $this->tags["title"]  .= "Heros";
      $this->tags["content"] = "<div style='margin-top:70px;'>Hello world!</div>";
    }
  }
?>
```
We continue to transform it into a model. Before I start I introduce an introduction to the models. Models are classes that extend either the `Model` class or the `Query` class depend if they need or not to run the queries. They have three main functions: _\__construct_ which is the constructor and is the same for all classes in JATE; _init_ is the function that actually serves as a constructor, it serves to initialize the class; _draw_ is the function that prints html.
We take the `bundles/views/View.php` file and move it to`bundles/models/View.php` and we modify `extends Template` in` extends Query`. We modify the \_\_construct eliminating all that is not necessary:
```php
<?php
  public function __construct() {
    parent::__construct();
  }
?>
```
we add the init connection:
```php
<?php
  public function init( $_connession ) {
    $this->addConnection("base", $_connection);
  }
?>
```
and we rename our private function `private function pageView()` in `public funcion draw()`. We add the new module created to the heros class and say to `$ this->tags["content"]` to display a new function:
```php
<?php
  $this->addModules([
    new View()
  ]);
  $this->modules["View"]->init($this->currentConnection);
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
Now running the page we check if everything works properly.
The next step is to introduce the block to insert the heroes, as before we take the `bundles/views/Insert.php` file and move it to `bundles/models/Insert.php` to modify `extends Template` in `extends Query`. We modify the \_\_construct eliminating all not necessary:
```php
<?php
  public function __construct() {
    parent::__construct();
  }
?>
```
we add the init connection
```php
<?php
  public function init( $_connession ) {
    $this->addConnection("base", $_connection);
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
  $this->modules["View"]->init($this->currentConnection);
  $this->modules["Insert"]->init($this->currentConnection);
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
    <div style='margin-top:70px;'>
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
Now you can check the page to see if everything works correctly.

## 8 The use of views
In general, when we write the html code within our php we use the form:
```php
<?php
  private function printPage() {
    jBlock();
    ?>
    <div>{{insert|raw}}</div>
    <div>{{view|raw}}</div>
    <?php
    return jBlockEnd("twig", [
      "view" => $this->modules["View"]->draw(),
      "insert" => $this->modules["Insert"]->draw()
    ]);
  }
?>
```
Although this methodology is very quick and easy to visualize, in general this form is not recommended, it would be best to split the php from html, to do this we introduce the views. The passage is very simple, we take the content of what we are sampling and insert it into a `html` or` twig` file depending on the need:
__bundles/views/heros.twig__
```html
  <div style='margin-top:70px;'>
    <div>{{insert|raw}}</div>
    <div>{{view|raw}}</div>
  </div>
```
and then we change the function in
```php
<?php
  private function printPage() {
    return jBlockFile("bundles/views/heros.twig", [
      "view" => $this->modules["View"]->draw(),
      "insert" => $this->modules["Insert"]->draw()
    ]);
  }
?>
```
By doing this, it makes the content display independent.

## 9 Js and css
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
  public function __construct( $_parameters ) {
    parent::__construct( $_parameters );
    $this->addFiles([
      "css/Hero.css"
    ]);
    $this->addModules([
      new View(),
      new Insert()
    ]);
    $this->modules["View"]->init($this->currentConnection);
    $this->modules["Insert"]->init($this->currentConnection);
    $this->modules["Insert"]->listener();
    $this->tags["title"]  .= "Heros";
    $this->tags["content"] = $this->printPage();
  }
?>
```
You can include js and css files, this way, on both pages and modules.
{% endraw %}
