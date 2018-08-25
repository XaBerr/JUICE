---
title: "jBlockFile"
permalink: /jblockfile
excerpt: "jBlockFile."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

Turn on output buffering.<br>
```java
void jBlockFile( String $_path, Array $_parameters )
```

## Parameters
* **$_path**: The path of the file you want to open.
* **$_parameters**: Is an array of content for pug and twig stuff.

## Return Values
Return a string of html.

## Examples
```php
<?php
$temp = jBlockFile("bundles/views/file1.twig"); // string with some html
?>
```
