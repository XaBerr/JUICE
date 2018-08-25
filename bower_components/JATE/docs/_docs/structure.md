---
title: "Structure"
permalink: /structure
excerpt: "Jate structure."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

```
project
  └ bundles
    ├ controllers
    ├ models
    └ views
```
A page is made up of two parts.<br>
The __first__ is the page, the chassies, the structure that will match a file inside `bundles/controllers`. For example, the Login page will have a `Login.php` file that will contain a class that will handle the requests of the `http://mywebsite/login` page.<br>
The __second__ part will be the content of the page, for example, always for the login page, the input form that holds the two inputs: username and password. Clearly a page can contain more content.<br>
The content can be divided into two parts: the __graphical interface__ that is almost entirely made up of the html and the part of __php code__ that is used to customize it. The graphical interface will be contained in `bundles/views` while the part of the code will be contained in` bundles/models`.
