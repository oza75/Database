<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 01:22
 */

namespace OZA\Database\Migrations;


use OZA\Database\Compiler\ColumnCompiler;
use OZA\Database\Migrations\Traits\ColumnDefinition;

class Column
{
    use ColumnDefinition;

    /**
     * @var string
     */
    private $name;

    protected $type = ['type' => null];
    /**
     * @var Table
     */
    protected $table;


    /**
     * Column constructor.
     * @param string $name
     * @param Table $table
     */
    public function __construct(string $name, Table $table)
    {
        $this->name = $name;
        $this->table = $table;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toSql();
    }

    /**
     * @return string
     */
    public function toSql(): string
    {
        $sql = ColumnCompiler::compile($this);

        return $sql;
    }

    /**
     * @param string $type
     * @param null $length
     * @return $this
     */
    public function type(string $type, $length = null)
    {
        $this->type = ['type' => $type, 'length' => $length];
        return $this;
    }


    /**
     * @return array
     */
    public function getType(): array
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

}