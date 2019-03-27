<?php

use OZA\Database\Migrations\MigrationTable;
use OZA\Database\Migrations\Table;

class tableNameFormatted extends MigrationTable
{

    /**
     * Create tableName
     *
     * @param Table $table
     */
    public function up(Table $table)
    {
        // required
        $table->setName('tableName');

        $table->integer('id')->autoIncrement()->index();

        $table->timestamps();

    }


}