OZA\Database\Console\Commands\MigrateCommand
===============






* Class name: MigrateCommand
* Namespace: OZA\Database\Console\Commands
* Parent class: [OZA\Database\Console\Commands\BaseCommand](OZA-Database-Console-Commands-BaseCommand.md)



Constants
----------


### MIGRATION_TABLE_NAME

    const MIGRATION_TABLE_NAME = 'database_migrations'





Properties
----------


### $signature

    protected string $signature

Signature of command



* Visibility: **protected**


### $databaseMigrations

    protected mixed $databaseMigrations = array()





* Visibility: **protected**


### $description

    protected string $description = "No description"

Command description



* Visibility: **protected**


Methods
-------


### handle

    mixed OZA\Database\Console\Commands\BaseCommand::handle()

handle a command
Put your main code in this method



* Visibility: **public**
* This method is defined by [OZA\Database\Console\Commands\BaseCommand](OZA-Database-Console-Commands-BaseCommand.md)




### getAllMigrations

    array OZA\Database\Console\Commands\MigrateCommand::getAllMigrations()

Get all migrations classes



* Visibility: **private**




### createMigrationsTableIfNotExists

    mixed OZA\Database\Console\Commands\MigrateCommand::createMigrationsTableIfNotExists()

Create migrations table if the table not exists in database



* Visibility: **protected**




### getDatabaseMigrations

    mixed OZA\Database\Console\Commands\MigrateCommand::getDatabaseMigrations()

Get all migrations in database



* Visibility: **protected**




### addMigration

    mixed OZA\Database\Console\Commands\MigrateCommand::addMigration($file, integer $belongs)





* Visibility: **protected**


#### Arguments
* $file **mixed**
* $belongs **integer**



### removeMigration

    mixed OZA\Database\Console\Commands\MigrateCommand::removeMigration($filename)

Remove Migration



* Visibility: **protected**


#### Arguments
* $filename **mixed**



### __construct

    mixed OZA\Database\Console\Commands\BaseCommand::__construct()





* Visibility: **public**
* This method is defined by [OZA\Database\Console\Commands\BaseCommand](OZA-Database-Console-Commands-BaseCommand.md)



