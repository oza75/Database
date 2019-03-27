<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 18:28
 */

namespace OZA\Database\Migrations\Traits;


use OZA\Database\Exceptions\Column\InvalidTypeForAutoIncrement;
use OZA\Database\Migrations\Column;

trait ColumnDefinition
{
    /**
     * @var bool
     */
    protected $autoIncrement = false;

    /**
     * @var string
     */
    protected $default;
    /**
     * @var bool
     */
    protected $nullable;

    protected $unsigned = false;

    private $integerTypes = [
        'INT', 'BIGINT', 'TINYINT'
    ];

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
     * Index column
     *
     * @param string|null $name
     * @return $this
     */
    public function index(?string $name = null)
    {
        $name = $name ?? $this->getName();
        $this->getTable()->addIndex($name);

        return $this;
    }

    /**
     * Add primary key
     *
     * @return $this
     */
    public function primary()
    {
        $this->getTable()->addPrimaryKey($this->getName());

        return $this;
    }

    /**
     * Add unique constraint
     *
     * @return $this
     */
    public function unique(): self
    {
        $this->getTable()->addUniqueKey($this->getName());

        return $this;
    }

    /**
     * @return Column
     */
    public function autoIncrement(): self
    {
        if (!in_array($this->type['type'], $this->integerTypes)) {
            return $this;
//            throw new InvalidTypeForAutoIncrement('Only column that has type ' . join(' or ', $this->integerTypes) . ' can be autoIncremented');
        }

        $this->autoIncrement = true;
        return $this;
    }

    /**
     * Make int types unsigned
     *
     * @return $this
     * @throws InvalidTypeForAutoIncrement
     */
    public function unsigned()
    {
        if (!in_array($this->type['type'], $this->integerTypes)) {
            throw new InvalidTypeForAutoIncrement('Only column that has type ' . join(' or ', $this->integerTypes) . ' can be unsigned');
        }

        $this->unsigned = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoIncrement(): bool
    {
        return $this->autoIncrement;
    }

    /**
     * @return null|bool
     */
    public function isNullable(): ?bool
    {
        return $this->nullable;
    }

    /**
     * @return null|string
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isUnsigned(): bool
    {
        return $this->unsigned;
    }
}