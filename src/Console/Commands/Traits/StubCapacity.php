<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:41
 */

namespace OZA\Database\Console\Commands\Traits;


trait StubCapacity
{

    /**
     *
     * Replace all variables inside stub
     *
     * @param $stub
     * @param array $variables
     * @return mixed
     */
    protected function replaceVariables($stub, array $variables)
    {
        foreach ($variables as $key => $value) {
            $stub = str_replace($key, $value, $stub);
        }

        return $stub;
    }
}