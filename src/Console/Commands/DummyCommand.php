<?php

use OZA\Database\Console\Commands\BaseCommand;


class DummyCommand extends BaseCommand
{
    /**
     * The signature of the command
     *
     * @var string
     */
    protected $signature = 'command:signature';

    /**
     * The description of the command
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * DummyCommand constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /***
     * handle your command | Put your main code here
     *
     */
    public function handle()
    {

    }
}