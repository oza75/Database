<?php


namespace OZA\Database\Facade;


abstract class BaseFacade
{
    /**
     * @param  $name
     * @param  $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $class = (new static())->resolve();
        $builder = new $class();
        return call_user_func_array([$builder, $name], $arguments);
    }

    /**
     * Return the name of builder Class
     *
     * @return mixed
     */
    abstract protected function resolve();
}