<?php


namespace OZA\Database\Query;


class InsertQuery
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * InsertQuery constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Sql
     *
     * @return string
     */
    public function toSql()
    {
        return $this->compile();
    }

    /**
     * Compile Sql
     *
     * @return string
     */
    private function compile()
    {
        $keys = array_keys($this->attributes);
        $column = join(', ', $keys);
        $params = join(', ', array_map(function ($item) {
            return '?';
        }, $keys));

        return sprintf("( %s ) VALUES ( %s )", $column, $params);
    }

    /**
     * Get Builder Params
     *
     * @return array
     */
    public function getParams()
    {
        return array_values($this->attributes);
    }

}