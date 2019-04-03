<?php


namespace OZA\Database\Query\Traits;


trait Selectable
{
    /**
     * List of all selected columns
     *
     * @var array
     */
    protected $selects = [];

    /**
     * Distinct
     *
     * @var string|null
     */
    protected $distinctColumn = null;


    /**
     * Select columns in table
     *
     * @param  array $columns
     * @return $this
     */
    public function select(array $columns = [])
    {
        $this->selects = array_merge($this->selects, $columns);
        return $this;
    }

    /**
     * Select Raw
     *
     * @param  string $string
     * @return $this
     */
    public function selectRaw(string $string)
    {
        $this->selects[] = $string;
        return $this;
    }

    /**
     * Select distinct according to a given column
     *
     * @param  string|null $column
     * @return $this
     */
    public function distinct(?string $column = 'id')
    {
        $this->distinctColumn = $column;
        return $this;
    }

    /**
     * Get distinct column
     *
     * @return string|null
     */
    public function getDistinct(): ?string
    {
        return $this->distinctColumn;
    }

    /**
     * Get all selected columns
     *
     * @return array
     */
    public function getSelects(): array
    {
        return $this->selects;
    }

    /**
     * @return null
     */
    public function getSelectRaw()
    {
        return $this->select_raw;
    }
}