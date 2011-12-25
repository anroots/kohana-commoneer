<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used array functions
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots
 * @since 1.0
 */
class Arr extends Kohana_Arr
{

	/**
	 * Check that $input contains all $expected keys
	 *
	 * Used for avoiding array index errors from POST data (when Request::current()->post() is not suitable)
	 * If $autofill is set, creates the missing keys and returns true.
	 *
	 * @since 1.0
	 * @static
	 * @param array $input The input array, usually from $_POST
	 * @param array $expected Array of expected keys
	 * @param bool $autofill If TRUE, creates and fills the missing keys with NULL values instead
	 * @return bool Returns TRUE if all keys in $expected are present in $input
	 */
	public static function check_keys(array &$input, array $expected, $autofill = TRUE)
	{

		if (!$autofill) { // Return FALSE on missing keys

			if ((empty($input) && !empty($expected))) {
				return FALSE;
			}

		} else { // Fill with NULLs

			if (empty($expected)) {
				return TRUE;
			}
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


	/**
	 * Unset all keys that have empty string values
	 *
	 * @since 1.0
	 * @static
	 * @param array $input
	 * @return array
	 */
	public static function unset_empty(array $input)
	{
		if (!is_array($input) || empty($input)) {
			return array();
		}

		foreach ($input as $key => $value) {
			if (is_string($value) && $value == '') {
				unset($input[$key]);
			}
		}
		return $input;
	}


    /**
     * ucwords for callback to array_walk
     *
     * @see ucwords
     * @see array_walk
     * @static
     * @param $value
     * @param $key
     * @return string
     */
    public static function ucwords(&$value, $key) {
        $value = ucwords($value);
    }
}
