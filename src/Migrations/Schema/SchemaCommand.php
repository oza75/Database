<?php


namespace OZA\Database\Migrations\Schema;


use OZA\Database\Migrations\Table;

trait SchemaCommand
{

    /**
     * Prepare schema
     *
     * @param string        $name
     * @param string        $command
     * @param callable|null $callback
     */
    public function prepare(string $name, string $command, ?callable $callback = null)
    {
        $table = new Table($name);
        $this->setCommand($command);
        if ($callback) { $callback($table);
        }
        $this->execute($table);
    }

    /**
     * Create table
     *
     * @param string   $name
     * @param callable $callback
     */
    public function create(string $name, callable $callback)
    {
        $this->prepare($name, 'create', $callback);
    }

    /**
     * Alter Table
     *
     * @param string   $name
     * @param callable $callback
     */
    public function alter(string $name, callable $callback)
    {
        $this->prepare($name, 'alter', $callback);
    }

    /**
     * @param string $name
     */
    public function drop(string $name)
    {
        $this->prepare($name, 'drop');
    }
}