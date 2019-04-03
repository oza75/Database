<?php


namespace OZA\Database\Query;


use Exception;
use OZA\Database\Facade\Query;

/**
 * Class EntityQueryBuilder
 * @method QueryBuilder where($column, $operator = null, $value = null)
 * @package OZA\Database\Query
 */
class EntityQueryBuilder
{
    protected $entity;
    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * EntityQueryBuilder constructor.
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;

        $this->setQuery();
    }

    /**
     * Set new Query
     *
     * @return QueryBuilder
     */
    public function newQuery()
    {
        $this->setQuery();

        return $this->getQuery();
    }

    /**
     * Get Query Builder
     *
     * @return QueryBuilder
     */
    public function getQuery()
    {
        if (is_null($this->query)) {
            $this->setQuery();
        }

        return $this->query;
    }

    /**
     * Set QueryBuilder
     *
     */
    public function setQuery()
    {
        $query = Query::table($this->entity->getTable());
        $query->setEntity($this->entity->getEntity());
        $this->query = $query;
    }

    /**
     * Find by id
     *
     * @param $id
     * @param string|null $column
     * @return Entity|mixed
     */
    public function find($id, ?string $column = null)
    {
        $column = is_null($column) ? $this->entity->getPrimaryKey() : $column;

        return $this->getQuery()->find($id, $column);
    }

    /**
     * Save entity
     *
     * @return bool|Entity
     * @throws Exception
     */
    public function save()
    {
        if ($this->entity->isNewEntity()) {
            return $this->create($this->entity->getAttributes());
        }

        $result = $this->getQuery()
            ->where($this->entity->getPrimaryKey(), $this->entity->getAttribute($this->entity->getPrimaryKey()))
            ->update($this->entity->changedAttributes());

        $result->syncOriginal();

        return $result;
    }

    /**
     * Create and return values
     *
     * @param array $attributes
     * @return bool|Entity
     * @throws Exception
     */
    public function create(?array $attributes = [])
    {
        if (empty($this->entity->getAttributes()) && empty($attributes)) {
            throw new Exception('There is no attributes to insert');
        }

        $this->entity->fillAttributes($attributes);
        $query = $this->getQuery();

        $id = $query->insertAndGetId($this->entity->getAttributes());
        if ($id) {
            $id = is_numeric($id) ? $id : (int)$id;
            $this->entity->setAttribute('id', $id);
            $this->entity->syncOriginal();
            return $this->entity;
        }
        return false;
    }

    /**
     * Count Number of rows
     *
     * @return int
     */
    public function count()
    {
        return $this->getQuery()->count();
    }

    /**
     * Get all
     *
     * @return array
     */
    public function get()
    {
        return $this->getQuery()->get();
    }

    /**
     * @return string
     */
    public function toSql()
    {
        return $this->getQuery()->toSql();
    }

//    public function eagerLoad(array $relations)
//    {
//        $relations = array_map(function ($relation) {
//
//        });
//        return $this->getQuery()->eagerLoad($relations);
//    }

    /**
     * Get Query Parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->getQuery()->getParams();
    }

    /**
     * Forwards not defined method call to QueryBuilder
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->getQuery(), $name], $arguments);
    }
}