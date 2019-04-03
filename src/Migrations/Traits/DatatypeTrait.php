<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 17:03
 */

namespace OZA\Database\Migrations\Traits;


use OZA\Database\Migrations\Column;

trait DatatypeTrait
{
    /**
     * Varchar Column
     *
     * @param  string $name
     * @return Column
     */
    public function string(string $name)
    {
        return $this->addColumn($name, 'VARCHAR', 255);
    }


    /**
     * Integer column
     *
     * @param  string $name
     * @return Column
     */
    public function integer(string $name): Column
    {
        return $this->addColumn($name, 'INT', 10);
    }

    /**
     * Big Integer Column
     *
     * @param  string $name
     * @return Column
     */
    public function bigInteger(string $name): Column
    {
        return $this->addColumn($name, 'BIGINT');
    }

    /**
     * Tiny Integer Column
     *
     * @param  string $name
     * @return Column
     */
    public function tinyInteger(string $name): Column
    {
        return $this->addColumn($name, 'TINYINT');
    }

    /**
     * @param  string   $name
     * @param  int|null $max
     * @param  int|null $scale
     * @return Column
     */
    public function float(string $name, ?int $max = 20, ?int $scale = 2): Column
    {
        return $this->addColumn($name, 'FLOAT', "$max,$scale");
    }

    /**
     * Create double column
     *
     * @param  string   $name
     * @param  int|null $max
     * @param  int|null $scale
     * @return Column
     */
    public function double(string $name, ?int $max = 20, ?int $scale = 2): Column
    {
        return $this->addColumn($name, 'DOUBLE', "$max,$scale");
    }

    /**
     * Create decimal column
     *
     * @param  string   $name
     * @param  int|null $max
     * @param  int|null $scale
     * @return Column
     */
    public function decimal(string $name, ?int $max = 38, ?int $scale = 2): Column
    {
        return $this->addColumn($name, 'DECIMAL', "$max,$scale");
    }


    /**
     * Create text column
     *
     * @param  string $name
     * @return Column
     */
    public function text(string $name): Column
    {
        return $this->addColumn($name, 'TEXT');
    }

    /**
     * Create Medium Text column
     *
     * @param  string $name
     * @return Column
     */
    public function mediumText(string $name): Column
    {
        return $this->addColumn($name, 'MEDIUMTEXT');
    }

    /**
     * Create blob column
     *
     * @param  string $name
     * @return Column
     */
    public function blob(string $name): Column
    {
        return $this->addColumn($name, 'BLOB');
    }

    /**
     * Create long text column
     *
     * @param  string $name
     * @return Column
     */
    public function longText(string $name): Column
    {
        return $this->addColumn($name, 'LONGTEXT');
    }


    /**
     * Create tiny text column
     *
     * @param  string $name
     * @return Column
     */
    public function tinyText(string $name): Column
    {
        return $this->addColumn($name, "TINYTEXT");
    }


    /**
     * Create enum column
     *
     * @param  string $name
     * @param  array  $possibilities
     * @return Column
     */
    public function enum(string $name, array $possibilities): Column
    {
        $options = join(
            ',', array_map(
                function ($item) {
                    return "'$item'";
                }, $possibilities
            )
        );

        return $this->addColumn($name, 'ENUM', $options);
    }

    /**
     * Create date column
     *
     * @param  string $name
     * @return Column
     */
    public function date(string $name): Column
    {
        return $this->addColumn($name, "DATE");
    }

    /**
     * Create datetime column
     *
     * @param  string $name
     * @return Column
     */
    public function datetime(string $name): Column
    {
        return $this->addColumn($name, 'DATETIME');
    }

    /**
     * Create timestamp column
     *
     * @param  string $name
     * @return Column
     */
    public function timestamp(string $name): Column
    {
        return $this->addColumn($name, 'TIMESTAMP')->default('CURRENT_TIMESTAMP')->onUpdate('CURRENT_TIMESTAMP');
    }

    /**
     * Create time column
     *
     * @param  string $name
     * @return Column
     */
    public function time(string $name): Column
    {
        return $this->addColumn($name, "TIME");
    }

    /**
     * Create year column
     *
     * @param  string $name
     * @return Column
     */
    public function year(string $name): Column
    {
        return $this->addColumn($name, 'YEAR');
    }

    /**
     * create created_at and updated_at column
     *
     * @return void
     */
    public function timestamps(): void
    {
        $this->timestamp('created_at');
        $this->timestamp('updated_at');
    }



}