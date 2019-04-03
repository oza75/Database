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
      - See [Column types]()
      - See [Column Definitions]()
- when you're satisfy with yours migrations files, commit them to your database
   
  In your terminal
  ```bash
   php vendor/bin/database migrate
  ``` 
- If you want to rollback 
       
  In your terminal
  ```bash
   php vendor/bin/database migrate:rollback
  ``` 
  This will rollback the latest migrations you've committed

### ORM
The package comes also with a little ORM
    
To retrieve information in our table your use the QueryBuilder class or Query Facade

```php
    <?php
    $user = \OZA\Database\Facade\Query::table('users')->find(2);
```

There are a lot of methods(`where`, `orWhere`, `whereIn`, `orWhereIn`, `get`, `first`, `limit` etc...) on table that helps you to retrieve your data
You can find QueryBuilder Documentation here :  

You can also create an **UserEntity** which will represents your User

```php
<?php
<?php


namespace OZA\Database\Tests\Entities;


use OZA\Database\Query\Entity;
use OZA\Database\Query\Relations\ManyToOne;

class UserEntity extends Entity
{

    /**
     * @param string $value
     * @return mixed
     */
    public function getEmailAttribute(string $value)
    {
        return strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        return strtoupper($value);
    }

    /**
     * @return ManyToOne
     */
    public function posts()
    {
        return $this->manyToOne(PostEntity::class, 'user_id', 'id');
    }
}
```

 Then you can fetch users like : 
 ```php
 <?php
 // Create new User
 \App\Entities\UserEntity::make([
     'name' => 'Aboubacar',
     'email' => 'user@email.com'
])->create();
 
 // Find a User
 \App\Entities\UserEntity::query()->find(2);
 
 // Count
  \App\Entities\UserEntity::query()->count();
  
  // With Where clause
  \App\Entities\UserEntity::query()->where('name', 'aboubacar');
  
  \App\Entities\UserEntity::query()->where('name', 'LIKE', '%bouba%');
  
  \App\Entities\UserEntity::query()->where(function (\OZA\Database\Query\QueryBuilder $builder) {
     $builder->where('name', 'aboubacar')
     ->orWhere('name', 'oza')
     ->get(); 
  });
 ```
 There are plenty methods on QueryBuilder , If you have already work with Laravel
 Just use it like Laravel QueryBuilder.