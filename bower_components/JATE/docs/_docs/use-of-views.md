---
title: "The use of views"
permalink: /use-of-views
excerpt: "The use of views."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

{% raw %}
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
<div>
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
{% endraw %}
