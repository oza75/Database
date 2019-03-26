<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 01:09
 */

namespace OZA\Database\Migrations;

use OZA\Database\Db;

class Table
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var Db
     */
    protected $db;

    /**
     * Table constructor.
     * @param string $name
     * @throws \Exception
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->db = Db::fromConfig();
    }

    /**
     * Varchar Column
     *
     * @param string $name
     * @return Column
     */
    public function string(string $name)
    {
        return $this->addColumn($name, 'VARCHAR', 255);
    }


    /**
     * Integer column
     *
     * @param string $name
     * @return Column
     */
    public function integer(string $name): Column
    {
        return $this->addColumn($name, 'INT', 10);
    }

    public function float(string $name, ?int $max = 20, ?int $take = 2): Column
    {
        return $this->addColumn($name, 'FLOAT', "$max,$take");
    }

    /**
     * Add column to table
     *
     * @param string $name
     * @param string $type
     * @param int|null $length
     * @return Column
     */
    protected function addColumn(string $name, string $type, $length = null)
    {
        $column = new Column($name);
        $this->columns[] = $column;
        $column->type($type, $length);
        return $column;
    }


    /**
     * @return string
     */
    public function toSql()
    {
        $parts = ["CREATE TABLE"];
        $parts[] = $this->name;
        $parts[] = '(';

        $columns = [];

        foreach ($this->columns as $column) {
            $columns[] = $column->toSql();
        }

        $parts[] = join(', ', $columns);
        $parts[] = ');';

        return join(' ', $parts);
    }

    /**
     * @return int
     */
    public function migrate()
    {
        return $this->db->getPdo()->exec($this->toSql());
    }

}