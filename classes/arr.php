<?php defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr
{

    /**
     * Check that $input contains all $expected keys
     * Used for avoiding array index errors from POST data
     * @static
     * @param array $input The input array, usually from $_POST
     * @param array $expected Array of expected keys
     * @return bool Returns TRUE if all keys in $expected are present in $input
     */
    public static function check_keys(array $input, array $expected)
    {
        // One of the arrays is empty, the other isn't
        if ((empty($input) || empty($expected)) && (!empty($input) || !empty($expected))) {
            return FALSE;
        }

        if (empty($input) && empty($expected)) {
            return TRUE;
        }

        foreach ($expected as $expected_key) {
            if (!array_key_exists($expected_key, $input)) {
                return FALSE;
            }
        }
        return TRUE;
    }
}
