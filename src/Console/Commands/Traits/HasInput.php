<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 02:25
 */

namespace OZA\Database\Console\Commands\Traits;


trait HasInput
{

    /**
     * Get all arguments passed in command line
     *
     * @return array
     */
    protected function inputs(): array
    {
        return array_filter($this->getArgv(), function ($item) {
            return substr($item, 0, 1) !== '-';
        });
    }

    /**
     * Get options input ( all input that start with - );
     *
     * @return array
     */
    protected function optionsInput(): array
    {
        return array_filter($this->getArgv(), function ($item) {
            return substr($item, 0, 1) == '-';
        });
    }

    /**
     * Get all arguments
     *
     * @return array
     */
    protected function arguments(): array
    {
        $segments = $this->signatureArguments();
        $segments = array_slice($segments, 1);

        $mapped = [];
        foreach ($segments as $key => $segment) {
            $name = str_replace('{', '', $segment);
            $name = str_replace('}', '', $name);

            $mapped[$name] = $this->inputs()[$key];
        }

        return $mapped;
    }

    /**
     * Get argument
     *
     * @param string|null $name
     * @param null $default
     * @return string|array|null
     */
    protected function argument(?string $name = null, $default = null)
    {
        if (is_null($name)) return $this->arguments();

        return $this->arguments()[$name] ?? $default;
    }

    /**
     * Get all options
     *
     */
    protected function options()
    {
        $options = $this->signatureOptions();
        $mapped = $this->fillWithDefaultOptions();

        foreach ($this->optionsInput() as $input) {
            foreach ($options as $option) {
                $regex = preg_replace('/=(.*)/', '', $option);
                preg_match("/{$regex}=?(.*)/", $input, $matches);
                if (!empty($matches)) {
                    $name = str_replace('-', '', $regex);
                    $mapped[$name] = trim($matches[1]) == '' ? true : $matches[1];
                }
            }
        }

        return $this->filterBooleans($mapped);
    }

    /**
     * Convert string boolean to real boolean ( 'true' => true && 'false' => false)
     *
     * @param $mapped
     * @return array
     */
    protected function filterBooleans($mapped)
    {
        return array_map(function ($item) {
            if (is_string($item) && in_array($item, ['true', 'false'])) $item = filter_var($item, FILTER_VALIDATE_BOOLEAN);
            return $item;
        }, $mapped);
    }

    /**
     * Get option with a given name
     *
     * @param string|null $name
     * @param null $default
     * @return array|string|null
     */
    public function option(?string $name = null,  $default = null)
    {
        return is_null($name) ? $this->options() : $this->options()[$name] ?? $default;
    }

    /**
     * Fill options array with default values
     *
     * @return array
     */
    protected function fillWithDefaultOptions()
    {
        $options = $this->signatureOptions();
        $mapped = [];
        foreach ($options as $option) {
            $option = preg_replace('/=$/', '=false', $option);

            preg_match('/--([a-zA-Z]+)=?([a-zA-Z]+)/', $option, $matches);
            if (!empty($matches)) {
                $mapped[$matches[1]] = $matches[2];
            }
        }

        return $mapped;
    }

    /**
     * Get argv global values
     *
     * @return array
     */
    protected function getArgv(): array
    {
        return array_slice($GLOBALS['argv'], 2);
    }
}