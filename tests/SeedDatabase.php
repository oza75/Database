<?php


namespace OZA\Database\Tests;


use Exception;
use OZA\Database\Console\Commands\MigrateCommand;
use OZA\Database\Facade\Query;

trait SeedDatabase
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        (new MigrateCommand)->handle();

        $this->seedUsers();
    }

    public function seedUsers()
    {
        $data = [
            ['email' => 'abouba181@gmail.com',
                'name' => 'aboubacar'
            ],
            [
                'email' => 'abouba181pro@gmail.com',
                'name' => 'aboubacar'
            ],
            [
                'email' => 'abouba181pro2@gmail.com',
                'name' => 'aboubacar'
            ],
            [
                'email' => 'abouba181pro3@gmail.com',
                'name' => 'aboubacar3'
            ]
        ];

        foreach ($data as $datum) {
            Query::table('users')->insert($datum);
        }
    }
}