<?php


namespace OZA\Database\Migrations\Constraints;


use OZA\Database\Helpers\Str;
use OZA\Database\Migrations\Table;

class ForeignConstraint
{

    /**
     * The reference column
     *
     * @var string
     */
    protected $reference;
    /**
     * The reference table
     *
     * @var string
     */
    protected $table;
    /**
     * @var Table
     */
    protected $firstTable;
    /**
     * @var string
     */
    protected $onDelete;
    /**
     * @var string
     */
    protected $onUpdate;
    /**
     * Concerned Column
     *
     * @var string
     */
    private $column;
    /**
     * The name of the key
     *
     * @var string
     */
    private $name;

    /**
     * ForeignConstraint constructor.
     *
     * @param Table $table
     * @param string $column
     * @param string|null $name
     */
    public function __construct(Table $table, string $column, string $name = null)
    {
        $this->column = $column;
        $this->name = $name;
        $this->firstTable = $table;
    }

    /**
     * Set reference column
     *
     * @param string $column
     * @return $this
     */
    public function references(string $column)
    {
        $this->reference = $column;
        return $this;
    }

    /**
     * Set reference table
     *
     * @param string $table
     * @return $this
     */
    public function on(string $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get sql
     *
     * @return string
     */
    public function toSql()
    {
        return $this->compile();
    }

    /**
     * Compile Constraint to sql
     *
     * @return string
     */
    protected function compile()
    {
        $keyName = 'Fk_' . Str::studly($this->table . '_' . $this->firstTable->getName());
        $name = $this->column;

        $sql = sprintf("CONSTRAINT %s FOREIGN KEY (%s) REFERENCES %s(%s)", $keyName, $name, $this->table, $this->reference);

        if (!is_null($this->onUpdate)) {
            $sql .= " ON UPDATE {$this->onUpdate}";
        }

        if (!is_null($this->onDelete)) {
            $sql .= " ON DELETE {$this->onDelete}";
        }

        return $sql;
    }

    /**
     * Set onDelete mode
     *
     * @param string $type
     * @return $this
     */
    public function onDelete(string $type)
    {
        $this->onDelete = $type;

        return $this;
    }

    /**
     * Set onUpdate mode
     *
     * @param string $type
     * @return ForeignConstraint
     */
    public function onUpdate(string $type)
    {
        $this->onUpdate = $type;

        return $this;
    }

}