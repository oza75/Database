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
     * Get value
     *
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

}