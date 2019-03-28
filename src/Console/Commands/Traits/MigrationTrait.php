<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 28/03/19
 * Time: 17:19
 */

namespace OZA\Database\Console\Commands\Traits;


use Exception;
use OZA\Database\Config;
use OZA\Database\Db;
use OZA\Database\Helpers\Arr;
use OZA\Database\Helpers\ClassesFinder;
use OZA\Database\Migrations\MigrationTableMigration;
use OZA\Database\Migrations\Table;
use PDO;

trait MigrationTrait
{

    /**
     * Get all migrations classes
     *
     * @return array
     */
    private function getAllMigrations()
    {
        $files = glob(Config::get('db.migrations.folder') . '/*.php');
        $files = array_map(function ($item) {
            return realpath($item);
        }, $files);
        $files = Arr::except($files, Arr::pluck($this->databaseMigrations, 'filename'));

        return ClassesFinder::findClassInFiles($files);
    }

    /**
     * Create migrations table if the table not exists in database
     *
     * @throws Exception
     */
    protected function createMigrationsTableIfNotExists()
    {
        if (!Db::fromConfig()->tableExists(self::MIGRATION_TABLE_NAME)) {
            $table = new Table(self::MIGRATION_TABLE_NAME);
            $table->setCommand('create');
            (new MigrationTableMigration)->up($table);
            $table->migrate();
        }
    }

    /**
     * Get all migrations in database
     *
     * @throws Exception
     */
    protected function getDatabaseMigrations()
    {
        $pdo = Db::fromConfig()->getPdo();
        $query = $pdo->query('SELECT * from ' . self::MIGRATION_TABLE_NAME . ' ORDER BY belongs desc;');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $file
     * @param int $belongs
     * @throws Exception
     */
    protected function addMigration($file, int $belongs)
    {
        $pdo = Db::fromConfig()->getPdo();
        $query = $pdo->prepare('INSERT INTO ' . self::MIGRATION_TABLE_NAME . '(filename, belongs) VALUES (:file, :belongs);');
        $query->execute([':file' => $file, ':belongs' => $belongs]);
    }

    /**
     * Remove Migration
     *
     * @param $filename
     * @throws Exception
     */
    protected function removeMigration($filename)
    {
        $pdo = Db::fromConfig()->getPdo();
        $query = $pdo->prepare('DELETE FROM ' . self::MIGRATION_TABLE_NAME . ' WHERE filename = :file');
        $query->execute([':file' => $filename]);
    }
}