<?php


namespace OZA\Database\Query;

use OZA\Database\Compiler\QueryCompiler;
use OZA\Database\Db;
use OZA\Database\Events\Emitter;
use OZA\Database\Facade\InsertQuery as Insert;
use OZA\Database\Query\Traits\Clauses;
use OZA\Database\Query\Traits\Countable;
use OZA\Database\Query\Traits\HasFetch;
use OZA\Database\Query\Traits\Selectable;
use PDO;
use PDOStatement;

class QueryBuilder
{
    use Clauses, Selectable, HasFetch, Countable;

    /**
     * Current table
     *
     * @var string
     */
    protected $table;
    /**
     * @var string
     */
    protected $command = 'SELECT';
    /**
     * @var bool
     */
    protected $subQuery = false;
    /**
     * Database connection
     *
     * @var Db
     */
    protected $db;
    /**
     * @var
     */
    protected $entity;
    /**
     * @var int
     */
    protected $fetchMode = PDO::FETCH_OBJ;
    /**
     * @var string
     */
    private $updateSql;

    public function __construct()
    {
        $this->db = Db::fromConfig();
    }

    /**
     * Set current table
     *
     * @param  string $table
     * @return QueryBuilder
     */
    public function table(string $table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get table
     *
     * @return string|null
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return string|null
     */
    public function getCommand(): ?string
    {
        return $this->command;
    }

    /**
     * @param  string|null $command
     * @return QueryBuilder
     */
    public function setCommand(?string $command = null): QueryBuilder
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubQuery(): bool
    {
        return $this->subQuery;
    }

    /**
     * @param  bool $subQuery
     * @return QueryBuilder
     */
    public function setSubQuery(bool $subQuery): QueryBuilder
    {
        $this->subQuery = $subQuery;
        return $this;
    }

    /**
     * @return int
     */
    public function getFetchMode(): int
    {
        return $this->fetchMode;
    }

    /**
     * @param  int $fetchMode
     * @return QueryBuilder
     */
    public function setFetchMode(int $fetchMode): QueryBuilder
    {
        $this->fetchMode = $fetchMode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param  mixed $entity
     * @return QueryBuilder
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        $this->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);
        return $this;
    }

    /**
     * @param  array $attributes
     * @return bool
     */
    public function insert(array $attributes)
    {
        $this->performInsert($attributes);
        return true;
    }

    /**
     * @param  array $attributes
     * @return bool|PDOStatement
     */
    public function performInsert(array $attributes)
    {
        $this->setCommand('insert');
        $query = Insert::make($attributes);
        $sql = $this->toSql() . ' ' . $query->toSql();
        $this->mergeParams($query->getParams());
        $statement = $this->pdo()->prepare($sql);
        $statement->execute($this->getParams());
        Emitter::instance()->emit('db.changed', $statement);
        return $statement;
    }

    /**
     * Compile query to sql
     *
     * @return string
     */
    public function toSql(): string
    {
        return QueryCompiler::compile($this);
    }

    /**
     * Get Pdo instance
     *
     * @return PDO
     */
    protected function pdo()
    {
        return $this->db->getPdo();
    }

    /**
     * @param  array $attributes
     * @return string
     */
    public function insertAndGetId(array $attributes)
    {
        $this->performInsert($attributes);
        return $this->pdo()->lastInsertId();
    }

    /**
     * Update rows
     *
     * @param  array $attributes
     * @return bool|PDOStatement
     */
    public function update(array $attributes)
    {
        $this->setCommand('update');
        $query = new UpdateQuery($attributes);
        $this->mergeParams($query->getParams());
        $this->updateSql = $query->toSql();

        $statement = $this->pdo()->prepare($this->toSql());
        $statement->execute($this->getParams());
        Emitter::instance()->emit('db.changed', $statement);
        return $statement;
    }

    /**
     * @return string
     */
    public function getUpdateSql(): string
    {
        return $this->updateSql;
    }
}