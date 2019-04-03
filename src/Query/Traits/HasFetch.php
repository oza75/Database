<?php


namespace OZA\Database\Query\Traits;

use OZA\Database\Events\Emitter;
use OZA\Database\Query\Entity;
use PDO;
use PDOStatement;

/**
 * Trait HasFetch
 *
 * @method  PDO pdo()
 * @package OZA\Database\Query\Traits
 */
trait HasFetch
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * Get Query result
     *
     * @return mixed
     */
    public function get()
    {
        return $this->processSync($this->execute()->fetchAll());
    }

    /**
     * @param  Entity[]|Entity $result
     * @return mixed
     */
    protected function processSync($result)
    {
        if (is_array($result)) {
            foreach ($result as $entity) {
                if ($entity instanceof Entity) {
                    $entity->syncOriginal();
                }
            }
            return $result;
        }

        if ($result instanceof Entity) {
            $result->syncOriginal();
        }

        return $result;
    }

    /**
     * Get pdo statement
     *
     * @param  null $sql
     * @return bool|PDOStatement
     */
    protected function execute($sql = null)
    {
        $sql = is_null($sql) ? $this->toSql() : $sql;
        $statement = $this->pdo()->prepare($sql);

        if (is_null($this->getEntity())) {
            $statement->setFetchMode($this->getFetchMode());
        } else {
            $statement->setFetchMode($this->getFetchMode(), $this->getEntity());
        }
        $statement->execute($this->getParams());
        Emitter::instance()->emit('db.changed', $statement, $sql, $this->getParams());

        return $statement;
    }

    /**
     * Find item by id
     *
     * @param  string $column
     * @param  $id
     * @return mixed
     */
    public function find($id, ?string $column = 'id')
    {
        $this->where($column, $id);

        return $this->processSync($this->execute()->fetch());
    }

    /**
     * Get one row
     *
     * @return mixed
     */
    public function first()
    {
        $this->limit(1);

        return $this->processSync($this->execute()->fetch());
    }

    /**
     * @param  int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }
}