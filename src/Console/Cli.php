<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 00:13
 */

namespace OZA\Database\Console;


use OZA\Database\Console\Commands\BaseCommand;
use OZA\Database\Console\Commands\MigrationCommand;
use OZA\Database\Helpers\ClassesFinder;

class Cli
{
    private $argv;
    private $argc;

    /**
     * List of all commands
     *
     * @var array
     */
    private $commands;

    /**
     * Cli constructor.
     * @param $argv
     * @param $argc
     */
    public function __construct($argv, $argc)
    {
        $this->argv = $argv;
        $this->argc = $argc;
        $this->allCommands();
    }

    public function process()
    {
        $action = $this->getAction();
        if (!$action) die('no action is set');

        $command = $this->getCommand($action);
        if (!$command) $this->noCommandFounded();

        $this->run($command);
    }

    /**
     * Get all arguments passed in command line
     *
     * @return array
     */
    protected function arguments(): array
    {
        return array_filter(array_slice($this->argv, 2), function ($item) {
            return substr($item, 0, 1) !== '-';
        });
    }

    /**
     * Get all available commands
     *
     * @return Cli
     */
    protected function allCommands(): self
    {
        $this->commands = ClassesFinder::find(__DIR__, BaseCommand::class);
        return $this;
    }


    /**
     * Get Command that has a given signature
     *
     * @param string $string
     * @return mixed|null
     */
    protected function getCommand(string $string)
    {
        foreach ($this->commands as $command) {
            $signature = (new $command)->{'firstSegment'}();
            if ($signature === $string) return $command;
        }

        return null;
    }

    /**
     * If no command is found
     *
     */
    protected function noCommandFounded()
    {
        exit('no command found');
    }

    /**
     * Run command
     *
     * @param string $command
     * @param string|null $method
     */
    protected function run(string $command, ?string $method = 'handle')
    {
        if (method_exists($command, $method)) {
            (new $command)->{$method}();
        }
    }

    /**
     * Get $argv second argument
     * which represent in our app the action
     *
     * @return string|null
     */
    protected function getAction()
    {
        return $this->argv[1] ?? null;
    }

}