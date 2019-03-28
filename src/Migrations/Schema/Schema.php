<?php


namespace OZA\Database\Migrations\Schema;


use Exception;
use OZA\Database\Db;
use OZA\Database\Migrations\Table;

class Schema
{
    use SchemaCommand;

    /**
     * @var Db
     */
    protected $db;
    /**
     *
     * @var string
     */
    protected $command;

    /**
     * List of available commands
     *
     * @var array
     */
    protected $availableCommands = ['create', 'alter', 'drop'];

    /**
     * Schema constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = Db::fromConfig();
    }

    /**
     * Set schema command
     *
     * @param string $command
     * @throws Exception
     */
    protected function setCommand(string $command)
    {
        if (!in_array(strtolower($command), $this->availableCommands))
            throw new Exception('Command not available');

        $this->command = $command;
    }

    /**
     *
     * @param Table $table
     * @return bool
     * @throws Exception
     */
    protected function execute(Table $table)
    {
        if (is_null($this->command)) throw new Exception('Command is not already set');
        return $table->setCommand($this->command)->exec();
    }

}