<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used input filtering functions
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots
 */
class Input
{

    /**
     * Convert comma to period in the input string
     * @static
     * @param string|int $input An input string
     * @param int|bool $round How many decimal places to return?
     * @return float
     */
    public static function mysql_float($input = 0, $round = FALSE)
    {
        if (empty($input)) {
            return (float)0;
        }
        $input = (float)rtrim(str_replace(',', '.', $input), ' 0');
        if ($round === FALSE) {
            return $input;
        }
        return round($input, $round);
    }


    /**
     * Returns NULL if value is empty (string)
     * Used to keep MYSQL field default NULL when $_POST gives an empty string
     * @static
     * @param string $input
     * @return null|string
     */
    public static function null_or_value($input)
    {
        if (empty($input)) {
            return NULL;
        }
        return $input;
    }


}