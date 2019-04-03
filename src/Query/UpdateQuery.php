<?php


namespace OZA\Database\Query;


class UpdateQuery
{
    /**
     * @var array
     */
    private $attributes;

    /**
     *
     * UpdateQuery constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toSql();
    }

    /**
     * @return string
     */
    public function toSql()
    {
        return $this->compile();
    }

    /**
     * @return string
     */
    protected function compile()
    {
        return join(", ", array_map(function ($item) {
            return "$item = ?";
        }, array_keys($this->attributes)));
    }

    public function getParams()
    {
        return array_values($this->attributes);
    }
}