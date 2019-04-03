### A database wrapper to deal easily with your database
#### Usage
First create a config file with your database configuration in **Application root Folder (IMPORTANT)**
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
- Then Register your composer autoloader 
```php
   <?php
   // After registered your composer autoloader (e.g: require_one __DIR_."/../vendor/autoload.php"
   // Register your config files
   \OZA\Database\Config::instance()->register(__DIR__.'/../db.php');
   
```
   The config class is a **singleton** ([Design pattern](https://sourcemaking.com/design_patterns/singleton/php/1))  so you can register all config files you want and 
   access to them anywhere in your application.
   
   You can find its documentation here : 
   
#### Migrations
Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema. 
Migrations are typically paired with  schema builder to easily build your application's database schema. 
If you have ever had to tell a teammate to manually add a column to their local database schema, 
you've faced the problem that database migrations solve.
- How to create migrations

  * Open your terminal and run 
    
    ```bash
        php vendor/bin/database migration:create {name_of_migrations} --table={name_of_table_you_want_to_create}
    ```
    
   * For exampe if I want to create a users table for my application    
    ```bash
        php vendor/bin/database migration:create create_users_table --table=users
    ``` 
    This command will create a new migration file in the migrations folder that you specified in your config file
    ```php
    <?php
    
    use OZA\Database\Migrations\Interfaces\MigrationTableInterface;
    use OZA\Database\Migrations\Schema\Schema;
    use OZA\Database\Migrations\Table;
    
    class CreateTestUsersMigration implements MigrationTableInterface
    {
    
        /**
         * Create table
         *
         * @param Schema $schema
         * @return mixed
         */
        public function up(Schema $schema): void
        {
            $schema->create('users', function (Table $table) {
    
                $table->integer('id')->autoIncrement()->index();
    
                $table->timestamps();
            });
        }
    
        /**
         * Called when rollback
         *
         * @param Schema $schema
         * @return mixed
         */
        public function down(Schema $schema): void
        {
            $schema->drop('users');
        }
    }
    ```
    If you are familiar with Laravel, this file looks like as laravel migration with some little difference.
    I have worked with Laravel and I liked the way They make things simple. 
    
    `up` method is called when you want to create your table and `down` when you want to rollback.
    
    Inside `up` method in `schema->create` closure you can create all type of column you want . For example we gonna add 
    `name`, `email`, `password` columns in your table
    
     ```php
     <?php
     
     use OZA\Database\Migrations\Interfaces\MigrationTableInterface;
     use OZA\Database\Migrations\Schema\Schema;
     use OZA\Database\Migrations\Table;
     
     class CreateTestUsersMigration implements MigrationTableInterface
     {
     
         /**
          * Create table
          *
          * @param Schema $schema
          * @return mixed
          */
         public function up(Schema $schema): void
         {
             $schema->create('users', function (Table $table) {
     
                 $table->integer('id')->autoIncrement()->index();
                 $table->string('name')->index();
                 $table->string('email')->index()->unique();
                 $table->string('password');
                 $table->timestamps();
             });
         }
     
         /**
          * Called when rollback
          *
          * @param Schema $schema
          * @return mixed
          */
         public function down(Schema $schema): void
         {
             $schema->drop('users');
         }
     }
     ```   
      
