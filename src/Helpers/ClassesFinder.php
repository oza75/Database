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
     * @param  string      $directory
     * @param  string|null $parent
     * @param  bool        $all
     * @return array
     */
    public static function find(string $directory, string $parent = null, bool $all = true)
    {
        $suffix = $all ? '/**/*.php' : '*.php';
        $files = glob($directory . $suffix);
        $classes = [];
        $namespaces = [];

        foreach ($files as $file) {
            $file = realpath($file);
            $dirname = dirname($file);

            if (array_key_exists($dirname, $namespaces)) {
                $namespace = $namespaces[$dirname];
                $namespace .= '\\' . ucfirst(basename($file, '.php'));
                $classes[] = $namespace;
            } else {
                $declared = get_declared_classes();
                include_once $file;
                $diff = array_diff(get_declared_classes(), $declared);
                $class = reset($diff);
                $parts = explode('\\', $class);
                array_pop($parts);
                $namespace = join('\\', $parts);
                $namespaces[$dirname] = $namespace;
            }

            if (!is_null($parent)) {
                if ($parent !== $class && is_subclass_of($class, $parent)) { $classes[] = $class;
                }
            } else { $classes[] = $class;
            }

        }

        return $classes;
    }

    /**
     * Check if a given command is a subclass of a given class
     *
     * @param  string $class
     * @param  string $parent
     * @return bool
     */
    public static function extends(string $class, string $parent)
    {
        return is_subclass_of($class, $parent);
    }

    /**
     * Find classes in files
     * Do not work if the class constructor take arguments
     *
     * @param  array $files
     * @return array
     */
    public static function findClassInFiles(array $files)
    {
        $classes = [];
        foreach ($files as $file) {
            include_once $file;
            $content = file_get_contents($file);
            if (preg_match('/class\s+(\w+)(.*)?[\n]+?\{/', $content, $matches)) {
                $classes[$file] = new $matches[1]();
            }
        }

        return $classes;
    }
}