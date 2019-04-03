<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 17:48
 */

namespace OZA\Database\Tests;


use Exception;
use OZA\Database\Config;
use OZA\Database\Migrations\Table;

class DatatypeTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_string_column()
    {
        $table = $this->prepareTest('string', 'email');

        $this->assertEquals("CREATE TABLE test ( email VARCHAR(255) NOT NULL );", $table->toSql());
    }

    public function test_integer_column()
    {
        $table = $this->prepareTest('integer', 'email');

        $this->assertEquals("CREATE TABLE test ( email INT(10) NOT NULL );", $table->toSql());
    }

    public function test_bigint_column()
    {
        $table = $this->prepareTest('bigInteger', 'email');

        $this->assertEquals("CREATE TABLE test ( email BIGINT NOT NULL );", $table->toSql());
    }

    public function test_tiny_integer()
    {
        $table = $this->prepareTest('tinyInteger', 'email');

        $this->assertEquals("CREATE TABLE test ( email TINYINT NOT NULL );", $table->toSql());
    }

    public function test_float_column()
    {
        $table = $this->prepareTest('float', 'email', 10, 2);

        $this->assertEquals("CREATE TABLE test ( email FLOAT(10,2) NOT NULL );", $table->toSql());
    }

    public function test_double_column()
    {
        $table = $this->prepareTest('double', 'email');

        $this->assertEquals("CREATE TABLE test ( email DOUBLE(20,2) NOT NULL );", $table->toSql());
    }


    public function test_double_with_params()
    {
        $table = $this->prepareTest('double', 'email', 10, 4);

        $this->assertEquals("CREATE TABLE test ( email DOUBLE(10,4) NOT NULL );", $table->toSql());
    }


    public function test_decimal()
    {
        $table = $this->prepareTest('decimal', 'email');

        $this->assertEquals("CREATE TABLE test ( email DECIMAL(38,2) NOT NULL );", $table->toSql());
    }


    public function test_decimal_with_params()
    {
        $table = $this->prepareTest('decimal', 'email', 20, 3);

        $this->assertEquals("CREATE TABLE test ( email DECIMAL(20,3) NOT NULL );", $table->toSql());
    }


    public function test_text_column()
    {
        $table = $this->prepareTest('text', 'email');

        $this->assertEquals("CREATE TABLE test ( email TEXT NOT NULL );", $table->toSql());
    }

    public function test_medium_text()
    {
        $table = $this->prepareTest('mediumText', 'email');

        $this->assertEquals("CREATE TABLE test ( email MEDIUMTEXT NOT NULL );", $table->toSql());
    }

    public function test_tiny_text_column()
    {
        $table = $this->prepareTest('tinyText', 'email');

        $this->assertEquals("CREATE TABLE test ( email TINYTEXT NOT NULL );", $table->toSql());
    }

    public function test_long_text_column()
    {
        $table = $this->prepareTest('longText', 'email');

        $this->assertEquals("CREATE TABLE test ( email LONGTEXT NOT NULL );", $table->toSql());
    }

    public function test_blob_text_column()
    {
        $table = $this->prepareTest('blob', 'email');

        $this->assertEquals("CREATE TABLE test ( email BLOB NOT NULL );", $table->toSql());
    }

    public function test_enum_column()
    {
        $table = $this->prepareTest('enum', 'email', ['male', 'female']);

        $this->assertEquals("CREATE TABLE test ( email ENUM('male','female') NOT NULL );", $table->toSql());
    }

    public function test_date_column()
    {
        $table = $this->prepareTest('date', 'email');

        $this->assertEquals("CREATE TABLE test ( email DATE NOT NULL );", $table->toSql());
    }

    public function test_datetime_column()
    {
        $table = $this->prepareTest('datetime', 'email');

        $this->assertEquals("CREATE TABLE test ( email DATETIME NOT NULL );", $table->toSql());
    }

    public function test_time_column()
    {
        $table = $this->prepareTest('time', 'email');

        $this->assertEquals("CREATE TABLE test ( email TIME NOT NULL );", $table->toSql());
    }

    public function test_year_column()
    {
        $table = $this->prepareTest('year', 'email');

        $this->assertEquals("CREATE TABLE test ( email YEAR NOT NULL );", $table->toSql());
    }

    public function test_timestamp_column()
    {
        $table = $this->prepareTest('timestamp', 'email');

        $this->assertEquals("CREATE TABLE test ( email TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP );", $table->toSql());
    }

    protected function prepareTest(string $type, string $name, ...$args)
    {
        $table = new Table('test');
        $table->setCommand('create');
        call_user_func_array([$table, $type], array_merge([$name], $args));

        return $table;
    }

    public function test_foreign_key()
    {
        $table = new Table('test');
        $table->setCommand('create');
        $table->integer('user_id');
        $table->foreign('user_id')->references('id')->on('users');

        $this->assertEquals('CREATE TABLE test ( user_id INT(10) NOT NULL , CONSTRAINT Fk_UsersTest FOREIGN KEY (user_id) REFERENCES users(id) );', $table->toSql());
    }

    public function test_foreign_key_with_onDelete()
    {
        $table = new Table('test');
        $table->setCommand('create');
        $table->integer('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        $this->assertEquals('CREATE TABLE test ( user_id INT(10) NOT NULL , CONSTRAINT Fk_UsersTest FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE cascade );', $table->toSql());
    }

    public function test_foreign_key_with_onUpdate()
    {
        $table = new Table('test');
        $table->setCommand('create');
        $table->integer('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

        $this->assertEquals('CREATE TABLE test ( user_id INT(10) NOT NULL , CONSTRAINT Fk_UsersTest FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE cascade );', $table->toSql());
    }

}