<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 19:00
 */

namespace OZA\Database\Compiler;


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
    protected $dontQuotesTypes = [
        'TIMESTAMP', 'DATE', 'DATETIME'
    ];

    /**
     * Compile Column to sql
     *
     * @param  Column $column
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
            ->compileOnUpdate()
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
        if (isset($type['length']) && !is_null($type['length'])) { $sql .= "({$type['length']})";
        }

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
            $sql = 'DEFAULT ' . $this->parseDefault($default);
            $this->addPart($sql);
        }

        return $this;

    }

    /**
     * Compile on update expression
     *
     * @return $this
     */
    private function compileOnUpdate()
    {
        $onUpdate = $this->column->getOnUpdate();
        if (strlen(trim($onUpdate))) {
            $sql = 'ON UPDATE ' . $onUpdate;
            $this->addPart($sql);
        }

        return $this;
    }

    /**
     * Parse default value
     *
     * @param  $default
     * @return string
     */
    protected function parseDefault($default)
    {
        $type = strtoupper($this->column->getType()['type']);
        if (in_array($type, $this->dontQuotesTypes) || is_numeric($default)) { return $default;
        }

        return "'$default'";
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