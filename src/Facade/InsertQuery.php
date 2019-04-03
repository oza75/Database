<?php


namespace OZA\Database\Facade;


class InsertQuery
{

    public static function make(array $attributes)
    {
        $builder = new \OZA\Database\Query\InsertQuery($attributes);
        return $builder;
    }
}