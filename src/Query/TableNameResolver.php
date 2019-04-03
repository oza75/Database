<?php


namespace OZA\Database\Query;


use OZA\Database\Helpers\Str;

class TableNameResolver
{
    public function get(Entity $entity)
    {
        $classname = get_class($entity);
        $parts = explode('\\', $classname);
        $name = array_pop($parts);
        $name = $this->name($name);
        return $this->sanitize($name);
    }

    /**
     * @param string $classname
     * @return mixed
     */
    protected function name(string $classname)
    {
        return explode('Entity', $classname)[0];
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function sanitize($name)
    {
        return Str::plural(Str::snake($name));
    }
}