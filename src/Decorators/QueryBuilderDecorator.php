<?php


namespace OZA\Database\Decorators;


use OZA\Database\Query\QueryBuilder;

class QueryBuilderDecorator extends QueryBuilder
{

    /**
     * QueryBuilderDecorator constructor.
     * @param QueryBuilder $builder
     */
    public function __construct(QueryBuilder $builder)
    {
        parent::__construct();

        foreach ($builder as $property => $value) $this->{$property} = $value;

        var_dump($this);
        die();
    }
}