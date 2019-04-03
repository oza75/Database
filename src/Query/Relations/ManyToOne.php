<?php


namespace OZA\Database\Query\Relations;


use Exception;
use OZA\Database\Query\Entity;
use OZA\Database\Query\EntityQueryBuilder;
use OZA\Database\Query\QueryBuilder;

class ManyToOne
{
    /**
     * The related entity
     *
     * @var Entity
     */
    protected $entity;
    /**
     * @var string
     */
    private $column;
    /**
     * @var string
     */
    private $related;
    /**
     * @var mixed
     */
    private $value;

    /**
     * ManyToOne constructor.
     *
     * @param string $related
     * @param string $column
     * @param $value
     */
    public function __construct(string $related, string $column, $value)
    {
        $this->related = $related;
        $this->column = $column;
        $this->value = $value;
        $this->entity();

        $this->addFetchingWhereClause();
    }

    /**
     * Resolve related entity
     *
     * @return Entity
     */
    protected function entity()
    {
        if (is_null($this->entity)) {
            $this->entity = new $this->related();
            $this->entity->getQuery();
        }

        return $this->entity;
    }

    /**
     * Add Where clause when we want to fetch results
     *
     * @return QueryBuilder
     */
    protected function addFetchingWhereClause()
    {
        return $this->getQuery()->where($this->column, $this->value);
    }

    /**
     * Get Entity Query
     *
     * @return EntityQueryBuilder
     */
    public function getQuery()
    {
        $query = $this->entity()->getQuery();

        return $query;
    }

    /**
     * Get Query Sql
     *
     * @return string
     */
    public function toSql()
    {
        return $this->getQuery()->toSql();
    }

    /**
     * Get Results
     *
     * @return mixed
     */
    public function get()
    {
        return $this->getQuery()->get();
    }

    /**
     * Get a specific row with its id
     *
     * @param  int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->getQuery()->find($id, $this->entity()->getPrimaryKey());
    }

    /**
     * Add where clause to query
     *
     * @param  $column
     * @param  $operator
     * @param  $value
     * @return ManyToOne
     */
    public function where($column, $operator, $value)
    {
        $this->getQuery()->where(...func_get_args());

        return $this;
    }

    /**
     * Add or where clause to query
     *
     * @param  $column
     * @param  $operator
     * @param  $value
     * @return ManyToOne
     */
    public function orWhere($column, $operator, $value)
    {
        $this->getQuery()->orWhere(...func_get_args());

        return $this;
    }

    /**
     * Get First row
     *
     * @return mixed
     */
    public function first()
    {
        return $this->getQuery()->first();
    }

    /**
     * Limit query
     *
     * @param  int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->getQuery()->limit($limit);

        return $this;
    }

    /**
     * Create related data
     *
     * @param  array $attributes
     * @return bool|Entity
     * @throws Exception
     */
    public function create(array $attributes)
    {
        $this->entity = null;

        $attributes[$this->column] = $this->value;

        return $this->entity()->create($attributes);
    }

    /**
     * Add WhereIn Clause
     *
     * @param  string $column
     * @param  array  $data
     * @return $this
     */
    public function whereIn(string $column, array $data)
    {
        $this->getQuery()->whereIn($column, $data);

        return $this;
    }

    /**
     * Add or WhereIn clause
     *
     * @param  string $column
     * @param  array  $data
     * @return ManyToOne
     */
    public function orWhereIn(string $column, array $data)
    {
        $this->getQuery()->orWhereIn($column, $data);

        return $this;
    }

    /**
     * Call entity methods
     *
     * @param  $name
     * @param  $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->entity(), $name], $arguments);
    }
}