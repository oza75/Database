<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 01:09
 */

namespace OZA\Database\Migrations;

use Exception;
use OZA\Database\Db;
use OZA\Database\Migrations\Compiler\TableCompiler;
use OZA\Database\Migrations\Interfaces\DatatypeInterface;
use OZA\Database\Migrations\Traits\DatatypeTrait;
use PDOStatement;

class Table implements DatatypeInterface
{
    use DatatypeTrait;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    protected $command;
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
        } catch (Exception $exception) {

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
     * @return false|PDOStatement
     * @throws Exception
     */
    public function migrate()
    {
        return $this->exec();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function exec()
    {
        try {
            $this->db->getPdo()->query($this->toSql());
            return true;
        } catch (Exception $e) {
            throw $e;
        }
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
     * @param string $command
     * @return Table
     */
    public function setCommand(string $command): Table
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
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

    /**
     * Add unique key to table
     *
     * @param string $name
     * @return $this
     */
    public function addUniqueKey(string $name)
    {
        $this->uniques[] = $name;

        return $this;
    }

    /**
     * Drop table if exists
     *
     * @param string $table
     * @throws Exception
     */
    public static function dropIfExists(string $table)
    {
        if (!Db::fromConfig()->tableExists($table)) return;

        $pdo = Db::fromConfig()->getPdo();
        $pdo->query(sprintf("DROP TABLE %s", $table));

    }
}