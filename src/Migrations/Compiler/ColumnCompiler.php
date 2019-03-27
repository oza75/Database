<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 19:00
 */

namespace OZA\Database\Migrations\Compiler;


use OZA\Database\Migrations\Column;

class ColumnCompiler extends SQLCompiler
{
    /**
     * @var Column
     */
    private $column;

    /**
     * @var string
     */
    protected $separator = " ";

    /**
     * Compile Column to sql
     *
     * @param Column $column
     * @return string
     */
    public static function compile(Column $column): string
    {
        $compiler = new self();
        $compiler->column = $column;

        $compiler
            ->compileName()
            ->compileType()
            ->compileUnsigned()
            ->compileDefault()
            ->compileNullable()
            ->compileAutoIncrement();

        return $compiler->handle();
    }

    /**
     * Compile Type
     *
     * @return ColumnCompiler
     */
    protected function compileType(): self
    {
        $type = $this->column->getType();
        $sql = $type['type'];
        if (isset($type['length']) && !is_null($type['length'])) $sql .= "({$type['length']})";

        $this->addPart($sql);
        return $this;
    }

    /**
     * @return ColumnCompiler
     */
    private function compileName(): self
    {
        $this->addPart($this->column->getName());
        return $this;
    }

    /**
     * @return ColumnCompiler
     */
    private function compileDefault(): self
    {
        $default = $this->column->getDefault();

        if (!is_null($default)) {
            $sql = 'DEFAULT ' . (is_numeric($default) ? $default : "'$default'");
            $this->addPart($sql);
        }

        return $this;

    }

    /**
     * @return ColumnCompiler
     */
    private function compileNullable(): self
    {
        $nullable = $this->column->isNullable();
        $sql = $nullable ? "NULL" : 'NOT NULL';

        $this->addPart($sql);

        return $this;
    }

    /**
     * @return ColumnCompiler
     */
    private function compileAutoIncrement(): self
    {
        if ($this->column->isAutoIncrement()) {
            $this->addPart("AUTO_INCREMENT");
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function compileUnsigned()
    {
        if ($this->column->isUnsigned()) {
            $this->addPart("UNSIGNED");
        }

        return $this;
    }

}