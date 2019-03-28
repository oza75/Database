<?php


namespace OZA\Database\Migrations\Interfaces;


use OZA\Database\Migrations\Schema\Schema;

interface MigrationTableInterface
{
    /**
     * Create table
     *
     * @param Schema $schema
     * @return mixed
     */
    public function up(Schema $schema): void;

    /**
     * Called when rollback
     *
     * @param Schema $schema
     * @return mixed
     */
    public function down(Schema $schema): void;
}