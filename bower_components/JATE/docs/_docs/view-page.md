---
title: "View page"
permalink: /view-page
excerpt: "View page."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

{% raw %}
We want to create a new page called __view__, it must show us the list of our heroes. The first step to do is go to `config/router.json` and add a new line inside the array pages:
```js
  ["/heros/view", "View", []],
```
Doing this we say to the JATE that when it receives the following url `/heroes/view`  it will be the class `View` to deal with the request. Now we have to create the class and we create it in this new page `bundles/models/View.php` and insert the following code:
```php
<?php
  class View extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "View";
      $this->tags["content"] = "<div>Hello world!</div>";
    }
  }
?>
```
We have the class and we set the routing, now we can access our page through:
http://localhost/projectHero/heros/view.
In order to be able to access it more conveniently we include in our template page, in the menu function the following entry:
```html
<li class="nav-item">
  <a class="nav-link" href="heros/view">view</a>
</li>
```
Now it will be a normal page where you can navigate from the menu. Let's continue by adding the hero list, to do this we add to our class the following display function:
```php
<?php
  private function pageView() {
    $heros = $this->queryFetch("SELECT * FROM hero");
    jBlock();
    ?>
      <div class="col-6 offset-3">
        <h2>View</h2>
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
  // $this->tags["content"] = "<div>Hello world!</div>";
  $this->tags["content"] = $this->pageView();
?>
```

**Success:** We run the page to check that everything is done correctly.
{: .notice--success}

<figure>
	<a href="https://user-images.githubusercontent.com/16030020/38466615-696d1c3e-3b2c-11e8-98fc-6ac742b22472.png">
    <img src="https://user-images.githubusercontent.com/16030020/38466615-696d1c3e-3b2c-11e8-98fc-6ac742b22472.png">
  </a>
	<figcaption>
    View page
  </figcaption>
</figure>
{% endraw %}
