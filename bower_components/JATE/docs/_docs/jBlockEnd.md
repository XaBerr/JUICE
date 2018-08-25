---
title: "jBlockEnd"
permalink: /jblockend
excerpt: "jBlockEnd."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

Get current buffer contents and delete current output buffer.<br>
```java
void jBlockEnd( String $_type, Array $_parameters )
```

## Parameters
* **$_type**: The type of the buffer contents, could be html, pug, jade, twig, md. Default is html.
* **$_parameters**: Is an array of content for pug and twig stuff. Default is an empty array.

## Return Values
Return a string of html.

## Examples
```php
<?php
jBlock();
?>
.content
<?php
$temp = jBlockEnd("pug"); // $temp === "<div class='content'></div>"
?>
```
