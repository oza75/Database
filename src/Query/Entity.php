<?php


namespace OZA\Database\Query;


use Exception;
use OZA\Database\Facade\TableNameResolver;
use OZA\Database\Query\Traits\HasRelations;

class Entity
{
    use  HasRelations;

    /**
     * List of all original values that fetched from database
     *
     * @var array
     */
    protected $originals = [];

    /**
     * List of all attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $table;

    /**
     * The primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var EntityQueryBuilder
     */
    protected $builder;

    public function __construct(?array $attributes = [])
    {

        if (empty($this->attributes)) {
            $this->fillAttributes($attributes);
        }

        $this->boot();
    }

    /**
     * Fill attributes
     *
     * @param  array $attributes
     * @return $this
     */
    public function fillAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * Boot Entity
     */
    public function boot()
    {
        $this->setTable();
    }

    /**
     * Set Entity Table name
     */
    private function setTable()
    {
        $this->table = TableNameResolver::get($this);
    }

    public static function make(?array $attributes = [])
    {
        return new static($attributes);
    }

    /**
     * @return array
     */
    public static function all()
    {
        return static::query()->get();
    }

    /**
     * @return EntityQueryBuilder
     */
    public static function query()
    {
        return (new static)->getQuery();
    }

    /**
     * Get Query Builder
     */
    public function getQuery()
    {
        return new EntityQueryBuilder($this);
    }

    /**
     *
     * @param  $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    /**
     * Set Attribute
     *
     * @param  $name
     * @param  $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->setAttribute($name, $value);
    }

    /**
     * Get Attribute
     *
     * @param  $name
     * @return mixed
     */
    public function getAttribute($name)
    {
        $method_name = sprintf('get%sAttribute', ucfirst($name));

        if (method_exists($this, $method_name)) {
            return $this->{$method_name}($this->attributes[$name]);
        }

        return $this->attributes[$name];
    }

    /**
     * Set Attribute
     *
     * @param  $name
     * @param  $value
     * @return mixed
     */
    public function setAttribute($name, $value)
    {
        $method_name = sprintf("set%sAttribute", ucfirst($name));

        //        $this->originals[$name] = $value;

        if (method_exists($this, $method_name)) {
            $value = $this->{$method_name}($value);
        }

        $this->attributes[$name] = $value;

        return $value;
    }

    /**
     * Cast id to int type
     *
     * @param  $value
     * @return int
     */
    public function setIdAttribute($value)
    {
        return (int)$value;
    }

    /**
     * Save attributes
     *
     * @return bool|Entity
     * @throws Exception
     */
    public function save()
    {
        return $this->getQuery()->save();
    }

    /**
     * Insert attributes to database
     *
     * @param  array|null $attributes
     * @return bool|Entity
     * @throws Exception
     */
    public function create(?array $attributes = [])
    {
        return $this->getQuery()->create($attributes);
    }

    /**
     * Count rows of a query
     *
     * @return int
     */
    public function count()
    {
        return $this->getQuery()->count();
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array
     */
    public function getOriginals(): array
    {
        return $this->originals;
    }

    /**
     * Clone Entity
     *
     * @return Entity
     */
    public function clone(): Entity
    {
        return clone $this;
        //        $class = get_class($this);
        //        $entity = new $class($this->getAttributes());
        //        $entity->setOriginals($this->getOriginals());
        //        return $entity;
    }

    public function getEntity()
    {
        return static::class;
    }

    /**
     * @return Entity
     */
    public function syncOriginal(): Entity
    {
        $this->originals = $this->getAttributes();

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return bool
     */
    public function isNewEntity()
    {
        return empty($this->originals);
    }

    /**
     * Get changed attributes
     *
     * @return array
     */
    public function changedAttributes()
    {
        $changed = [];

        foreach ($this->attributes as $key => $value) {
            if (!isset($this->originals[$key])) { $changed[$key] = $value;
            } else if ($this->originals[$key] !== $value) { $changed[$key] = $value;
            }
        }

        return $changed;
    }

    /**
     * Get Entity primary column
     *
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

}