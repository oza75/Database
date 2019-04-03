<?php


namespace OZA\Database\Query\Traits;

///**
// * Trait EntityFacade
// * @method static QueryBuilder query()
// * @method static static create(array $attributes)
// * @method static static find($id)
// * @method static count()
// * @method static static[] all()
// * @package OZA\Database\Query\Traits
// */
trait EntityFacade
{
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $builder = new static();
        return call_user_func_array([$builder, $name], $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, $name . 'Method'], $arguments);
    }
}