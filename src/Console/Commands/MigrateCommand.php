<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:49
 */

namespace OZA\Database\Console\Commands;


use OZA\Database\Config;

class MigrateCommand extends BaseCommand
{
    protected $signature = 'migrate';


    public function handle()
    {
        $migrations = $this->getAllMigrations(Config::get('db.migrations.folder'));
    }

    private function getAllMigrations($get)
    {
    }
}