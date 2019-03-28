<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 00:26
 */

namespace OZA\Database\Console\Commands;


use OZA\Database\Console\Commands\Traits\HasInput;
use OZA\Database\Console\Commands\Traits\HasSignature;

class BaseCommand
{
    use HasSignature, HasInput;
    /**
     * Signature of command
     *
     * @var string
     */
    protected $signature;

    /**
     * Command description
     *
     * @var string
     */
    protected $description = "No description";

    public function __construct()
    {
    }

    /**
     * handle a command
     * Put your main code in this method
     *
     */
    public function handle()
    {
    }
}