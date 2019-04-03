<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 18:38
 */

namespace OZA\Database\Helpers;


class Str
{

    /**
     * Sanitize string and return only alpha numeric characters
     *
     * @param  string $string
     * @return string|string[]|null
     */
    public static function sanitize(string $string)
    {
        return preg_replace("/[^A-Za-z0-9_ ]/", '', $string);

    }

    /**
     * Studly Case
     *
     * @output = 'text_case' => TextCase
     *
     * @param  string $string
     * @return string
     * @author OZA <abouba181@gmail.com>, ig: @mr_oza.dev
     */
    public static function studly(string $string)
    {
        return join(
            '', array_map(
                function ($part) {
                    return ucfirst(strtolower($part));
                }, explode('_', $string)
            )
        );
    }

    /**
     * Check if string ends with a given value
     *
     * @param  string $haystack
     * @param  string $needle
     * @return bool
     */
    public static function endsWith(string $haystack, string $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * Get string without a part
     *
     * @param  string $string
     * @param  string $part
     * @return mixed
     */
    public static function withoutPart(string $string, string $part)
    {
        return str_replace($part, '', $string);
    }

    /**
     * Get Snake case string
     *
     * @param  string $string
     * @return string
     */
    public static function snake(string $string)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $string)), '_');
    }

    /**
     * Get Plural
     *
     * @param  string $string
     * @return string
     */
    public static function plural(string $string)
    {
        return self::endsWith($string, 's') ? $string : $string . 's';
    }
}