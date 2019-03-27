<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 20:05
 */

namespace OZA\Database\Migrations\Compiler;


use OZA\Database\Migrations\Table;

class TableCompiler extends SQLCompiler
{
    /**
     * @var string
     */
    protected $separator = " ";

    /**
     * @var Table
     */
    protected $table;

    /**
     * @param Table $table
     * @return string
     */
    public static function compile(Table $table)
    {
        $compiler = new self();
        $compiler->table = $table;

        return $compiler
            ->compileCommand()
            ->compileName()
            ->addPart('(')
            ->compileColumns()
            ->compileConstraints()
            ->addPart(');')
            ->compileIndexes()
            ->handle();
    }

    /**
     * Compile Command
     *
     * @return TableCompiler
     */
    private function compileCommand(): self
    {
        return $this->addPart('CREATE TABLE');
    }

    /**
     * Compile Table name
     *
     * @return TableCompiler
     */
    private function compileName(): self
    {
        return $this->addPart($this->table->getName());
    }

    /**
     * Compile All Column
     *
     * @return $this
     */
    private function compileColumns(): self
    {
        $sqls = [];

        foreach ($this->table->getColumns() as $column) {
            $sqls[] = $column->toSql();
        }

        return $this->addPart(join(', ', $sqls));

    }

    /**
     * Compile all primary keys
     *
     * @return TableCompiler
     */
    private function compilePrimaryKeys(): self
    {
        return $this->addPart(
            sprintf(" CONSTRAINT %s PRIMARY KEY (%s) ",
                'pk_' . strtolower($this->table->getName()),
                join(', ', $this->table->getPrimaryKeys())
            ));
    }

    private function compileUniqueKeys(): self
    {
        return $this->addPart(
            sprintf(" CONSTRAINT %s UNIQUE (%s) ",
                'uc_' . strtolower($this->table->getName()),
                join(', ', $this->table->getUniqueKeys())
            ));
    }

    /**
     * Compile Contraints
     * @return TableCompiler
     */
    private function compileConstraints(): self
    {
        if (count($this->table->getPrimaryKeys()) > 0) {
            $this->addPart(',')
                ->compilePrimaryKeys();
        }

        if (count($this->table->getUniqueKeys()) > 0) {
            $this->addPart(',')
                ->compileUniqueKeys();
        }

        return $this;
    }


    private function compileIndexes(): self
    {
        $indexes = $this->table->getIndexes();

        if (!empty($indexes)) {
            $name = substr(join('_', $indexes), 0, 25) . '_index';
            $this->addPart(
                sprintf("CREATE INDEX %s ON %s (%s);",
                    $name, $this->table->getName(),
                    join(", ", $indexes)
                ));
        }

        return $this;
    }

    /**
     * Quotes values
     *
     * @param array $array
     * @return array
     */
    protected function quotes(array $array): array
    {
        return array_map(function ($item) {
            return "'$item'";
        }, $array);
    }
}