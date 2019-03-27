<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 18:38
 */

namespace OZA\Database\Tests;


use OZA\Database\Exceptions\Column\InvalidTypeForAutoIncrement;
use OZA\Database\Migrations\Column;
use OZA\Database\Migrations\Table;

class ColumnDefinitionTest extends TestCase
{
    /**
     * @param string|null $type
     * @param string|null $name
     * @param mixed ...$args
     * @return Column
     */
    protected function prepareTest(?string $type = 'string', ?string $name = 'test_column', ...$args)
    {
        $table = new Table('test');
        $column = call_user_func_array([$table, $type], array_merge([$name], $args));

        return $column;
    }

    public function test_auto_increment_with_non_integer()
    {
        $column = $this->prepareTest('string');
        $this->expectException(InvalidTypeForAutoIncrement::class);
        $column->autoIncrement();
    }

    public function test_auto_increment()
    {
        $column = $this->prepareTest('integer');
        $column->autoIncrement();

        $this->assertEquals("test_column INT(10) AUTO_INCREMENT NOT NULL", $column->toSql());
    }

    public function test_nullable()
    {
        $column = $this->prepareTest('integer');
        $column->nullable();

        $this->assertEquals("test_column INT(10) NULL", $column->toSql());
    }

    public function test_default_value()
    {
        $column = $this->prepareTest('integer');
        $column->default(2);

        $this->assertEquals("test_column INT(10) DEFAULT 2 NOT NULL", $column->toSql());
    }

    public function test_add_index()
    {
        $column = $this->prepareTest('integer');
        $column->index();

        $table = $column->getTable();

        $this->assertNotEmpty($table->getIndexes());
    }
}