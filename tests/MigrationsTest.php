<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 00:12
 */

namespace OZA\Database\Tests;


use Exception;
use OZA\Database\Db;
use OZA\Database\Migrations\Table;

class MigrationsTest extends DatabaseTestCase
{

    public function test_get_pdo()
    {

        $db = new Db('mysql', 'localhost', 'db_package', 'aboubacar', 'aboubacar');

        $this->assertNotNull($db);
        $this->assertInstanceOf(Db::class, $db);
    }


    /**
     * @throws Exception
     */
    public function test_create_string_columns()
    {
        $table = new Table('users');
        $table->setCommand('create');
        $table->string('name')->nullable();
        $table->string('username')->default('hello@world');

        $this->assertEquals("CREATE TABLE users ( name VARCHAR(255) NULL, username VARCHAR(255) DEFAULT 'hello@world' NOT NULL );", $table->toSql());
    }

    /**
     * @throws Exception
     */
    public function test_create_int_decimal_columns()
    {
        $table = new Table('users');
        $table->setCommand('create');
        $table->integer('likes')->default(0);
        $table->float('prices')->default(150);
        $table->integer('votes')->nullable();

        $this->assertEquals('CREATE TABLE users ( likes INT(10) DEFAULT 0 NOT NULL, prices FLOAT(20,2) DEFAULT 150 NOT NULL, votes INT(10) NULL );', $table->toSql());
    }

    /**
     * @throws Exception
     */
    public function test_migrate_table()
    {
        $table = new Table('users');
        $table->setCommand('create');
        $table->integer('id')->autoIncrement()->unsigned();
        $table->string('name')->nullable();
        $table->string('username')->default('hello@world');
        $table->integer('likes')->default(0);
        $table->float('prices')->default(150);
        $table->integer('votes')->nullable();
//        var_dump($table->toSql());
//        die();
        $this->assertTrue($table->migrate());
    }
}