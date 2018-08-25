---
title: "01 Essential"
permalink: /01-essential
excerpt: "01 Essential."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

You can fine the example [here](https://github.com/XaBerr/JATE/tree/master/examples/01essential).
## Four simple steps (General Rule)
- All files outside `/config` `/bundles` and folders are system, you don't need to know how they work.<br>
The first file you need to know is `/config/router.json`. It contains a list of url and classes. When in the web site is called a page, in this list you can specify what will be the class to solve this call. The class must be created in `/bundles/controllers`.<br>
The first line of this list, point at 404 page.

- As a general rule bundles are divided as follows:
  - Controllers __->__ All pages that are rendered.
  - Models __->__ All the support classes used by controllers or other models.
  - Views __->__ All graphics interfaces that do not contain php.

- All pages that are created in the `/bundles/controllers` and `/bundles/models` folders are automatically included. If there is a file that has dependencies from another class, this dependence must be added manually with function `jRequire( "../relativePath");` at the beginning of that file.

- The `bundles/models/template` and `bundles/views/tradictional.html` usually do not need to be changed. The part that usually changes is the _makePage_ that can be found within the pages in `bundles/controllers/*.php`.

## Three simple steps (First Page)
- In the constructor you can add files like _css_ or _js_ with the following function `$this->addFilesRequired(["file1.css", "file2.js"]);`.
- In the constructor you can set the values of jtags `$this->tags["title"] = "home";`. You must use those basic but you can also add other.
- To add the part of html you can use `jBlock();` and `jBlockEnd();` as an example but it is recommended to keep the html part separate in `/bundles/views/` and incorporated by `jBlockFile("bundles/views/Page01.html");`.
