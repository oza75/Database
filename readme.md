### A database wrapper to deal easily with your database
#### Usage
First create a config file with your database configuration
- Example of config file
```php 
<?php
 
 return [
     'driver' => 'mysql',
     'name' => 'db_package',
     'host' => 'localhost:3306',
     "username" => "root",
     "password" => "",
     "migrations" => [
         "folder" => __DIR__ . '/../migrations/' // path of migrations folder ( #important )
     ]
 ];
```
- Then Register your composer autoloader and your config file
```php
   <?php
   // After registered your composer autoloader (e.g: require_one __DIR_."/../vendor/autoload.php"
   // Register your config files
   \OZA\Database\Config::instance()->register(__DIR__.'/../db.php');
   
```
#### Migrations
Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema. 

Migrations are typically paired with  schema builder to easily build your application's database schema. 

If you have ever had to tell a teammate to manually add a column to their local database schema, 

you've faced the problem that database migrations solve.

- How to create migrations

Open your terminal and run 
```bash
php vendor/bin/database migration {name_of_migrations} --table={name_of_table_you_want_to_create}
```