<?php


namespace OZA\Database\Facade;


use OZA\Database\Query\Entity;
use OZA\Database\Query\TableNameResolver as Resolver;

/**
 * Class TableNameResolver
 *
 * @method  static string get(Entity $entity)
 * @package OZA\Database\Facade
 */
class TableNameResolver extends BaseFacade
{

    /**
     * Return the name of builder Class
     *
     * @return mixed
     */
    protected function resolve()
    {
        return Resolver::class;
    }
}