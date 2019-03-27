<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:51
 */

namespace OZA\Database\Helpers;


class ClassesFinder
{
    /**
     * Find all classes in a given directory
     *
     * @param string $directory
     * @param string|null $parent
     * @return array
     */
    public static function find(string $directory, string $parent = null)
    {
        $files = glob($directory . '/**/*.php');
        $classes = [];
        $namespaces = [];

        foreach ($files as $file) {
            $dirname = dirname($file);

            if (array_key_exists($dirname, $namespaces)) {
                $namespace = $namespaces[$dirname];
                $namespace .= '\\' . ucfirst(basename($file, '.php'));
                $classes[] = $namespace;
            } else {
                $class = require $file;
                var_dump($class, $class::class);
                die();
            }

            $class = $namespace . "\\" . basename($file, '.php');
            var_dump($namespace, $parent);
            die();
            if (!is_null($parent)) {
                if ($parent !== $class && is_subclass_of($class, $parent)) $classes[] = $class;
            } else $classes[] = $class;

        }

        return $classes;
    }

    /**
     * Check if a given command is a subclass of a given class
     *
     * @param string $class
     * @param string $parent
     * @return bool
     */
    public static function extends(string $class, string $parent)
    {
        return is_subclass_of($class, $parent);
    }
}