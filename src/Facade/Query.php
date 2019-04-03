<?php


namespace OZA\Database\Facade;


use OZA\Database\Query\QueryBuilder;

/**
 * Class Query
 *
 * @method  static QueryBuilder table(string $name)
 * @package OZA\Database\Query\Facade
 */
class Query extends BaseFacade
{
    /**
     * @return mixed|string
     */
    protected function resolve()
    {
        return QueryBuilder::class;
    }
}