<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 00:27
 */

namespace OZA\Database\Console\Commands;


use Exception;
use OZA\Database\Config;
use OZA\Database\Console\Commands\Traits\StubCapacity;
use OZA\Database\Helpers\Str;

class MigrationCommand extends BaseCommand
{
    use StubCapacity;

    protected $signature = "migration:create {name} {--table=} ";


    public function handle()
    {
        $this->create();
    }

    protected function create()
    {
        $stub = $this->getStub();
        $data = $this->replaceVariables(
            $stub,
            [
                'tableNameFormatted' => $this->getClassName(),
                'tableName' => $this->getTableName()
            ]
        );
        $filename = $this->getFilename();

        $this->createFile($filename, $data);
        echo basename($filename, '.php') . " created.\n";
    }

    /**
     * Get stub content
     *
     * @param  string|null $type
     * @return false|string
     */
    protected function getStub(?string $type = 'create')
    {
        return file_get_contents(__DIR__ . "/../../stubs/{$type}.stub");
    }

    /**
     * Get migration class name
     *
     * @return string
     */
    private function getClassName()
    {
        $name = $this->argument('name', 'migration_without_name');
        $name = Str::studly($name);
        $name = Str::sanitize($name);

        return Str::endsWith($name, 'Migration') ? $name : $name . 'Migration';
    }


    /**
     * Get table name
     *
     * @return string|string[]|null
     * @throws Exception
     */
    protected function getTableName()
    {
        $table = $this->option('table');
        if (!$table) { throw new Exception('You must defined the name of table (e.g: --table=users)');
        }

        return Str::sanitize($table);
    }

    /**
     * Generate a Migration filename
     *
     * @return array|string|string[]|null
     */
    protected function getFilename()
    {
        $name = $this->argument('name', 'migration_without_name');
        $name = Str::sanitize($name);
        $name = date('Y_m_d_H_i_s') . '_' . $name;

        return Config::get('db.migrations.folder', __DIR__ . '/') . $name . '.php';
    }

    /**
     * Create file
     *
     * @param  string $filename
     * @param  $data
     * @return bool|int
     */
    protected function createFile(string $filename, $data)
    {
        return file_put_contents($filename, $data);
    }
}