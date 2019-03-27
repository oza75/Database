<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 18:55
 */

namespace OZA\Database\Migrations\Compiler;

/**
 * Class SQLCompiler
 * @package OZA\Database\Migrations\Compiler
 */
class SQLCompiler
{
    protected $parts = [];
    protected $separator = ',';

    /**
     * @return string
     */
    protected final function handle()
    {
        return join($this->separator, $this->parts);
    }

    /**
     * @param string $sql
     * @return $this
     */
    protected function addPart(string $sql): self
    {
        $this->parts[] = $sql;
        return $this;
    }
}