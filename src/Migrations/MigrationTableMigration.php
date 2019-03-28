<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 28/03/19
 * Time: 13:17
 */

namespace OZA\Database\Migrations;


class MigrationTableMigration
{

    public function up(Table $table)
    {
        $table->bigInteger('id')->autoIncrement()->index();
        $table->string('filename')->nullable();
        $table->integer('belongs')->default(0);
        $table->timestamps();
    }

}