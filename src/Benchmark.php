<?php
/**
 * Project benchmark
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 03:45
 */

namespace nguyenanhung\Bear\Benchmark;

/**
 * Class Benchmark
 *
 * @package   nguyenanhung\Bear\Benchmark
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Benchmark
{
    /**
     * Benchmark constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * List of all benchmark markers
     *
     * @var    array
     */
    public $marker = array();

    /**
     * Set a benchmark marker
     *
     * Multiple calls to this function can be made so that several
     * execution points can be timed.
     *
     * @param string $name Marker name
     *
     * @return    void
     */
    public function mark(string $name)
    {
        $this->marker[$name] = microtime(true);
    }

    /**
     * Elapsed time
     *
     * Calculates the time difference between two marked points.
     *
     * If the first parameter is empty this function instead returns the
     * {elapsed_time} pseudo-variable. This permits the full system
     * execution time to be shown in a template. The output class will
     * swap the real value for this variable.
     *
     * @param string $point1   A particular marked point
     * @param string $point2   A particular marked point
     * @param int    $decimals Number of decimal places
     *
     * @return    string    Calculated elapsed time on success,
     *            an '{elapsed_string}' if $point1 is empty
     *            or an empty string if $point1 is not found.
     */
    public function elapsed_time(string $point1 = '', string $point2 = '', int $decimals = 4): string
    {
        if ($point1 === '') {
            return '{elapsed_time}';
        }

        if (!isset($this->marker[$point1])) {
            return '';
        }

        if (!isset($this->marker[$point2])) {
            $this->marker[$point2] = microtime(true);
        }

        return number_format($this->marker[$point2] - $this->marker[$point1], $decimals);
    }

    /**
     * Function memory_usage
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 10:52
     *
     * @return string
     */
    public function memory_usage(): string
    {
        return round(memory_get_usage() / 1024 / 1024, 2) . 'MB';
    }
}