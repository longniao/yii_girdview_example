<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Girdview Example</h1>
    <br>
</p>

The example contains the basic features of gridview widget.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


DATA & STRUCTURE
----------------

```
CREATE TABLE `supplier` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `code` char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `t_status` enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `supplier` VALUES (1,'Afghanistan','af','ok'),(2,'Åland','ax','ok'),(3,'Albania','al','ok'),(4,'Algeria','dz','ok'),(5,'American Samoa','as','ok'),(6,'Andorra','ad','ok'),(7,'Angola','ao','hold'),(8,'Anguilla','ai','ok'),(9,'Antarctica','aq','ok'),(10,'Antigua and Barbuda','ag','ok'),(11,'Argentina','ar','ok'),(12,'Armenia','am','ok'),(13,'Aruba','aw','ok'),(14,'Ascension Island','ac','hold'),(15,'Australia','au','ok'),(16,'Austria','at','ok'),(17,'Azerbaijan','az','ok'),(18,'Bahamas','bs','ok'),(19,'Bahrain','bh','ok'),(20,'Bangladesh','bd','ok'),(21,'Barbados','bb','ok'),(22,'Basque Country','eu','hold'),(23,'Belarus','by','ok'),(24,'Belgium','be','ok'),(25,'Belize','bz','ok'),(26,'Benin','bj','ok'),(27,'Bermuda','bm','ok'),(28,'Bhutan','bt','ok'),(29,'Bolivia','bo','ok'),(30,'Bonaire','bq','ok'),(31,'Bosnia and Herzegovina','ba','ok'),(32,'Botswana','bw','ok'),(33,'Bouvet Island','bv','ok'),(34,'Brazil','br','ok'),(35,'British Indian Ocean Territory','io','ok'),(36,'British Virgin Islands','vg','ok'),(37,'Brunei','bn','ok'),(38,'Bulgaria','bg','ok'),(39,'Burkina Faso','bf','ok'),(40,'Burma (officially: Myanmar)','mm','ok'),(41,'Burundi','bi','ok');
```

Here's the .SQL file for import: [**yii2basic.sql**](./docs/yii2basic.sql)



FEATURES
--------

1. A user can **filter** suppliers ...
    1. *(bonus) **id** - support:*
        1. *>10 - match all id greater than 10*
        2. *also support: <10, >=10, <=10* 
    2. name and code - support partial matching
    3. t_status - a dropdown including all and each status
2. A user can **multi-select** suppliers, and of course, will have a convenient way to **select all** suppliers on the current page.
3. If a user selects all rows, he will be prompted and have a way to select all filtered rows **across all pages** and cancel.
4. After having some rows selected, the user can click an "Export" button to download all selected rows as a CSV file. And of course, this should correctly handle the "select across all pages" situation.


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


INSTALLATION
-------

```
git clone git@github.com:longniao/yii_girdview_example.git

cd yii_girdview_example

composer install

php yii serve
```
