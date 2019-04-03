<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 28/03/19
 * Time: 12:35
 */

namespace OZA\Database\Console\Commands;


use Exception;
use OZA\Database\Console\Commands\Traits\MigrationTrait;
use OZA\Database\Db;
use OZA\Database\Helpers\Arr;
use OZA\Database\Helpers\ClassesFinder;
use OZA\Database\Migrations\Schema\Schema;

class MigrationRollbackCommand extends BaseCommand
{
    use MigrationTrait;

    protected $signature = 'migrate:rollback';

    const  MIGRATION_TABLE_NAME = 'database_migrations';
    /**
     * @var array
     */
    protected $databaseMigrations = [];

    /**
     * @throws Exception
     */
    public function handle()
    {
        $this->databaseMigrations = $this->getDatabaseMigrations();
        if (empty($this->databaseMigrations)) { return;
        }

        $lastMigration = $this->databaseMigrations[0]['belongs'];
        $toRollbacks = array_filter(
            $this->databaseMigrations, function ($item) use ($lastMigration) {
                return $item['belongs'] == $lastMigration;
            }
        );

        $files = Arr::pluck($toRollbacks, 'filename');
        $migrations = ClassesFinder::findClassInFiles($files);

        foreach ($migrations as $file => $migration) {
            $migration->down(new Schema);
            echo sprintf("[MIGRATION] %s dropped.\n", basename($file));
            $this->removeMigration($file);
        }
    }
}