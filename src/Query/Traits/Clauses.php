<?php


namespace OZA\Database\Query\Traits;


use Exception;
use OZA\Database\Query\QueryBuilder;

trait Clauses
{

    /**
     * List of all wheres clauses
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * Query Params
     *
     * @var array
     */
    protected $params = [];


    /**
     * Add where clause
     *
     * @param  string|callable $column
     * @param  mixed|null      $operator
     * @param  mixed|null      $condition
     * @return $this
     */
    public function where($column, $operator = null, $condition = null)
    {
        $args = func_get_args();

        if (count($args) == 1) {
            $exception = new Exception('The where clause must take more than one argument');
            return $this->addWhereClause($column, '=', is_callable($args[0]) ? $args[0] : $exception, 'AND');
        }

        if (count($args) == 2) {
            $operator = '=';
            $condition = $args[1];
        }

        return $this->addWhereClause($column, $operator, $condition, 'AND');
    }

    /**
     * Add a where Clause
     *
     * @param  string|callable $column
     * @param  string          $operator
     * @param  mixed           $condition
     * @param  string          $logic
     * @return QueryBuilder|Clauses
     */
    protected function addWhereClause($column, string $operator, $condition, string $logic)
    {
        $param = $this->getWhereClauseStringParams($condition);

        $clause = ['column' => $column, 'operator' => $operator, 'condition' => $param, 'logic' => $logic];
        $this->wheres[] = $clause;
        return $this;
    }

    /**
     * @param  $condition
     * @return array|callable|string
     */
    protected function getWhereClauseStringParams($condition)
    {
        $param = is_array($condition) ? join(', ', array_fill(0, count($condition), '?')) : "?";

        if (is_callable($condition)) {
            $param = $condition;
        } else {
            if (is_array($condition)) {
                $this->params = array_merge($this->params, $condition);
            } else { $this->params[] = $condition;
            }
        }

        return $param;
    }

    /**
     * Add orWhere clause
     *
     * @param  string|callable $column
     * @param  string|null     $operator
     * @param  string|null     $condition
     * @return QueryBuilder
     */
    public function orWhere($column, $operator = null, $condition = null)
    {
        $args = func_get_args();

        if (count($args) == 1) {
            $exception = new Exception('The where clause must take more than one argument');
            return $this->addWhereClause($column, '=', is_callable($args[0]) ? $args[0] : $exception, 'OR');
        }

        if (count($args) == 2) {
            $operator = '=';
            $condition = $args[1];
        }

        return $this->addWhereClause($column, $operator, $condition, 'OR');
    }

    /**
     * Add whereIn clause
     *
     * @param  string $column
     * @param  array  $data
     * @return QueryBuilder|Clauses
     */
    public function whereIn(string $column, array $data)
    {
        return $this->addWhereClause($column, 'in', $data, 'AND');
    }

    /**
     * Add where in clause
     *
     * @param  string $column
     * @param  array  $data
     * @return QueryBuilder|Clauses
     */
    public function orWhereIn(string $column, array $data)
    {
        return $this->addWhereClause($column, 'in', $data, 'OR');
    }

    /**
     * @return array
     */
    public function getWheres(): array
    {
        return $this->wheres;
    }

    /**
     * @param array $params
     */
    public function mergeParams(array $params)
    {
        $this->params = array_merge($this->getParams(), $params);
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}