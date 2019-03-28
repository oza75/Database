<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:49
 */

namespace OZA\Database\Console\Commands;

use OZA\Database\Console\Commands\Traits\MigrationTrait;
use OZA\Database\Migrations\Schema\Schema;
use OZA\Database\Migrations\Table;

class MigrateCommand extends BaseCommand
{
    use MigrationTrait;

    protected $signature = 'migrate';

    const  MIGRATION_TABLE_NAME = 'database_migrations';

    protected $databaseMigrations = [];

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->createMigrationsTableIfNotExists();
        $this->databaseMigrations = $this->getDatabaseMigrations();

        $migrations = $this->getAllMigrations();
        $belongs = empty($this->databaseMigrations) ? 1 : $this->databaseMigrations[0]['belongs'] + 1;
        foreach ($migrations as $file => $migration) {
            $migration->up(new Schema);
            echo sprintf("[MIGRATION] %s migrated.\n", basename($file));
            $this->addMigration($file, $belongs);
        }

        echo "All Tables migrated successfully";
    }

}