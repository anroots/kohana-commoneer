<?php defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr
{

    /**
     * Check that $input contains all $expected keys
     * Used for avoiding array index errors from POST data
     * If $autofill is set, creates the missing keys and returns true.
     * @static
     * @param array $input The input array, usually from $_POST
     * @param array $expected Array of expected keys
     * @param bool $autofill If TRUE, creates and fills the missing keys with NULL values instead
     * @return bool Returns TRUE if all keys in $expected are present in $input
     */
    public static function check_keys(array &$input, array $expected, $autofill = FALSE)
    {
        // Return FALSE on missing keys
        if (!$autofill) {

            if ((empty($input) && !empty($expected))) {
                return FALSE;
            }

        } else {

            if (empty($expected)) {
                return TRUE;
            }
            // Fill with NULLs
            if (empty($input) && !empty($expected)) {
                $expected = array_fill(0, count($expected), NULL);
                return array_flip($expected);

            }
        }


        // Check each input array key against expected
        foreach ($expected as $expected_key) {
            if (!array_key_exists($expected_key, $input)) {
                if ($autofill) {
                    $input[$expected_key] = NULL;
                } else {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
}
