<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 01:22
 */

namespace OZA\Database\Migrations;


class Column
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    protected $default;
    /**
     * @var bool
     */
    protected $nullable;

    protected $type;

    /**
     * Column constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Set default value for a column
     *
     * @param $default
     * @return $this
     */
    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Set nullable value
     *
     * @return $this
     */
    public function nullable()
    {
        $this->nullable = true;
        return $this;
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
    public function toSql(): string
    {
        $parts = [$this->name];
        $parts[] = $this->getType();

        if (!is_null($this->default)) {
            $parts[] = 'DEFAULT ' . (is_numeric($this->default) ? $this->default : "'$this->default'");
        }

        if ($this->nullable) {
            $parts[] = 'NULL';
        } else {
            $parts[] = 'NOT NULL';
        }
        return join(' ', $parts);
    }

    /**
     * @param string $type
     * @param null $length
     * @return $this
     */
    public function type(string $type, $length = null)
    {
        $this->type = ['type' => $type, 'length' => $length];
        return $this;
    }

    /**
     * @return string
     */
    protected function getType(): string
    {
        $type = $this->type['type'];
        if (isset($this->type['length']) && !is_null($this->type['length'])) $type .= "({$this->type['length']})";

        return $type;
    }
}