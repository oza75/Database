<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 17:35
 */

namespace OZA\Database\Migrations\Interfaces;

use OZA\Database\Migrations\Column;

interface DatatypeInterface
{
    /**
     * Varchar Column
     *
     * @param string $name
     * @return Column
     */
    public function string(string $name);

    /**
     * Integer column
     *
     * @param string $name
     * @return Column
     */
    public function integer(string $name): Column;

    /**
     * Big Integer Column
     *
     * @param string $name
     * @return Column
     */
    public function bigInteger(string $name): Column;

    /**
     * Tiny Integer Column
     *
     * @param string $name
     * @return Column
     */
    public function tinyInteger(string $name): Column;

    /**
     * @param string $name
     * @param int|null $max
     * @param int|null $scale
     * @return Column
     */
    public function float(string $name, ?int $max = 20, ?int $scale = 2): Column;

    /**
     * Create double column
     * @param string $name
     * @param int|null $max
     * @param int|null $scale
     * @return Column
     */
    public function double(string $name, ?int $max = 20, ?int $scale = 2): Column;

    /**
     * Create text column
     *
     *
     * @param string $name
     * @return Column
     */
    public function text(string $name): Column;

    /**
     * Create Medium Text column
     *
     * @param string $name
     * @return Column
     */
    public function mediumText(string $name): Column;

    /**
     * Create blob column
     *
     * @param string $name
     * @return Column
     */
    public function blob(string $name): Column;

    /**
     * Create long text column
     *
     * @param string $name
     * @return Column
     */
    public function longText(string $name): Column;

    /**
     * Create tiny text column
     *
     * @param string $name
     * @return Column
     */
    public function tinyText(string $name): Column;

    /**
     * Create enum column
     *
     * @param string $name
     * @param array $possibilities
     */
    public function enum(string $name, array $possibilities);

}