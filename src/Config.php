<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 17:27
 */

namespace OZA\Database;


use Composer\Autoload\ClassLoader;
use OZA\Database\Helpers\Arr;
use ReflectionClass;

class Config
{
    /**
     * An instance of config
     *
     * @var Config|null
     */
    protected static $_instance = null;

    /**
     * List of all configuration files
     *
     * @var array
     */
    protected $files = [];

    /**
     * An associative array of all config
     *
     * @var array
     */
    protected $configs = [];

    /**
     * Config constructor.
     *
     * @param string|null $filename
     */
    protected function __construct(?string $filename = null)
    {
        if (is_null($filename)) {
            $reflection = new ReflectionClass(ClassLoader::class);
            $root = dirname(dirname($reflection->getFileName()));
            $filename = realpath($root . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "db.php");
        }

        $this->register($filename);
        $this->load();
    }

    /**
     * @return Config|null
     */
    public static function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public static function get(string $key, ?string $default = null)
    {
        return static::instance()->getConfigs($key) ?? $default;
    }

    /**
     * Register a config file
     *
     * @param string|null $filename
     */
    public function register(?string $filename)
    {
        if (is_dir($filename)) {
            $this->files = array_merge($this->getFiles(), glob($filename . '**/*.php'));
        } else {
            $this->files[] = $filename;
        }

        $this->load();
    }

    /**
     * Load configurations
     */
    protected function load()
    {
        foreach ($this->getFiles() as $file) {
            $name = basename($file, '.php');
            $this->configs[$name] = include $file;
        }
    }

    /**
     * Get configurations files
     *
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Get configuration data
     *
     * @param string $key
     * @return null|array|mixed
     */
    public function getConfigs(string $key)
    {
        return Arr::get($this->configs, $key);
    }

}