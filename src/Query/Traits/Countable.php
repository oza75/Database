<?php


namespace OZA\Database\Query\Traits;

use PDO;

/**
 * Trait Countable
 * @method PDO pdo()
 * @package OZA\Database\Query\Traits
 */
trait Countable
{
    /**
     * Count rows
     *
     * @return  integer
     */
    public function count(): int
    {
//        $sql = sprintf("COUNT (*) as %s", strtolower($this->getTable()));
        $this->select(["COUNT(*)"]);
        $statement = $this->pdo()->query($this->toSql());
        return $statement->fetchColumn();
    }
}