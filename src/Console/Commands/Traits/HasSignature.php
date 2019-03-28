<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 27/03/19
 * Time: 01:57
 */

namespace OZA\Database\Console\Commands\Traits;


trait HasSignature
{

    /**
     * @return array
     */
    public function firstSegment()
    {
        return $this->signatureSegments(0);
    }

    /**
     * Get signatures segments
     *
     * @param int|null $segment
     * @return array
     */
    public function signatureSegments(?int $segment = null)
    {
        $segments = array_values(array_filter(explode(" ", $this->signature), function ($item) {
            return trim($item) !== '';
        }));

        return !is_null($segment) ? $segments[$segment] : $segments;
    }

    /**
     * Get signature segments without hooks ({|})
     *
     * @return array
     */
    public function signatureSegmentsWithoutHooks()
    {
        return array_map(function ($item) {
            return preg_replace('/[{|}]/', '', $item);
        }, $this->signatureSegments());
    }

    /**
     * Get only signature arguments
     *
     * @return array
     */
    public function signatureArguments(): array
    {
        return array_values(array_filter($this->signatureSegmentsWithoutHooks(), function ($item) {
            return substr($item, 0, 1) !== '-';
        }));
    }


    /**
     * Get  options array
     *
     * @return array
     */
    public function signatureOptions(): array
    {
        return array_values(array_filter($this->signatureSegmentsWithoutHooks(), function ($item) {
            return substr($item, 0, 1) == '-';
        }));
    }
}