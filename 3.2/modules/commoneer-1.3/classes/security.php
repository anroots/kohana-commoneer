<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used security functions
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots
 * @since 1.0
 */
class Security extends Kohana_Security
{


    /**
     * Returns a safe string for aliases/url-s/file names
     *
     * @since 1.0
     * @static
     * @param string $input Arbitrary string
     * @return string Cleaned input string
     */
    public static function safe_string($input)
    {

        if (!empty($input)) {
            $input = iconv("utf-8", "ascii//TRANSLIT", $input);
            $input = strtolower(preg_replace('/[^a-zA-Z0-9-._]/', '', $input));
        }
        $input = str_replace(' ', '', $input);
        return strtolower(trim($input));
    }
}