<?php

use OZA\Database\Migrations\MigrationTable;
use OZA\Database\Migrations\Table;

class CreateUsersMigration extends MigrationTable
{

    /**
     * Create users
     *
     * @param Table $table
     */
    public function up(Table $table)
    {
        // required
        $table->setName('users');

        $table->integer('id')->autoIncrement()->index();

        $table->timestamps();

    }


}