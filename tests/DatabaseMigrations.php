<?php


namespace OZA\Database\Tests;


use Exception;
use OZA\Database\Console\Commands\MigrateCommand;

trait DatabaseMigrations
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        (new MigrateCommand)->handle();
    }
}