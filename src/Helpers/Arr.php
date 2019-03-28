<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:24
 */

namespace OZA\Database\Helpers;


class Arr
{

    /**
     * Get Array value with dot notation
     *
     * @example $a = ['database' => ['name' => 'root', 'password' => '']]
     *          Arr::get($a, 'database.name') will return 'root'
     *
     * @author OZA <abouba181@gmail.com>
     * @param \ArrayAccess|array $data
     * @param string $key
     * @param null $default
     * @return \ArrayAccess|mixed|null
     */
    public static function get($data, string $key, $default = null)
    {
        $keys = explode('.', $key);
        $result = $data;

        foreach ($keys as $key) $result = $result[$key] ?? $default;

        return $result;
    }

    /**
     * Pluck key
     *
     * @param array $data
     * @param string $key
     * @return array
     */
    public static function pluck(array $data, string $key)
    {
        return array_map(function ($item) use ($key) {
            if (is_object($item)) return $item->{$key};
            return $item[$key];
        }, $data);
    }

    /**
     * Excepts
     *
     * @param array $files
     * @param array $excepts
     * @return array
     */
    public static function except(array $files, $excepts = [])
    {
        return array_filter($files, function ($item) use ($excepts) {
            return !in_array($item, $excepts);
        });
    }

}