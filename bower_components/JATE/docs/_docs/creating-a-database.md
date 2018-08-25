---
title: "Creating a database"
permalink: /creating-a-database
excerpt: "Creating a database."
last_modified_at: 2018-03-19T16:28:04-05:00
toc: true
---

**Warning:** This example uses MYSQL, to use different databases modify the file `config/connection.json`, putting **only** the selected database engine to true.
{: .notice--warning}

**Warning:** This example uses PDO, be sure to have enabled the extension `extension=php_pdo_mysql.dll`.
{: .notice--warning}


We create a database of heros, for example:
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
Let's go to our project and look for the `projectHero/config/connection.json` file, set all connection values and make sure to enable connection setting `enable: true`.
```json
{
  "enable":    false,
  "user":      "",
  "password":  "",
  "database":  "",
  "server":    "",
  "engine": {
    "pdo":        true,
    "mysqli":     false,
    "postgresql": false
  }
}

```
**Success:** We launch the same page before, __if everything works correctly we will have to see it appear without errors__.
{: .notice--success}


The connection is made automatically from the `$this-> addConnection("config/connection.json");` line on the `bundles/models/Template.php` page.
