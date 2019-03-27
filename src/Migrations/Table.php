<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 01:09
 */

namespace OZA\Database\Migrations;

use OZA\Database\Db;
use OZA\Database\Migrations\Compiler\TableCompiler;
use OZA\Database\Migrations\Interfaces\DatatypeInterface;
use OZA\Database\Migrations\Traits\DatatypeTrait;

class Table implements DatatypeInterface
{
    use DatatypeTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * List of all columns
     *
     * @var array
     */
    protected $columns = [];

    /**
     * List of all indexes for a tables
     *
     * @var array
     */
    protected $indexes = [];

    /**
     * List of all primary keys
     *
     * @var array
     */
    protected $primary = [];

    /**
     * List of all uniques columns
     *
     * @var array
     */
    protected $uniques = [];

    /**
     * @var Db
     */
    protected $db;

    /**
     * Table constructor.
     * @param string $name
     */
    public function __construct(?string $name = null)
    {
        $this->name = $name;
        try {
            $this->db = Db::fromConfig();
        } catch (\Exception $exception) {

        }
    }

    /**
     * @return string
     */
    public function toSql()
    {
        return TableCompiler::compile($this);
    }

    /**
     * @return int
     */
    public function migrate()
    {
        return $this->db->getPdo()->exec($this->toSql());
    }

    /**
     * @return array
     */
    public function getIndexes(): array
    {
        return $this->indexes;
    }

    /**
     * Get table name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get tables columns
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Get all primary keys
     *
     * @return array
     */
    public function getPrimaryKeys(): array
    {
        return $this->primary;
    }

    /**
     * Get all uniques keys
     *
     * @return array
     */
    public function getUniqueKeys(): array
    {
        return $this->uniques;
    }

    /**
     * @param string $name
     * @return Table
     */
    public function setName(string $name): Table
    {
        $this->name = $name;
        return $this;
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
        $column = new Column($name, $this);
        $this->columns[] = $column;
        $column->type($type, $length);
        return $column;
    }


    /**
     * Add index
     *
     * @param string $name
     * @return $this
     */
    public function addIndex(string $name)
    {
        $this->indexes[] = $name;
        return $this;
    }

    /**
     * Add a primary key
     *
     * @param string $name
     * @return $this
     */
    public function addPrimaryKey(string $name)
    {
        $this->primary[] = $name;

        return $this;
    }

    public function addUniqueKey(string $name)
    {
        $this->uniques[] = $name;

        return $this;
    }

}