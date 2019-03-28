<?php

use OZA\Database\Migrations\Interfaces\MigrationTableInterface;
use OZA\Database\Migrations\Schema\Schema;
use OZA\Database\Migrations\Table;

class CreateCommentsMigration implements MigrationTableInterface
{

    /**
     * Create table
     *
     * @param Schema $schema
     * @return mixed
     */
    public function up(Schema $schema): void
    {
        $schema->create('comments', function (Table $table) {

            $table->integer('id')->autoIncrement()->index();

            $table->timestamps();
        });
    }

    /**
     * Called when rollback
     *
     * @param Schema $schema
     * @return mixed
     */
    public function down(Schema $schema): void
    {
        $schema->drop('comments');
    }
}