<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Commonly used date functions
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots
 */
class Date extends Kohana_Date
{

    /**
     * Converts input date to MYSQL format
     * @static
     * @param string $date Any valid date string
     * @param bool $include_time If true, return H:i:s also
     * @return null|string
     */
    public static function mysql_date($date = NULL, $include_time = TRUE)
    {
        if (empty($date)) {
            return NULL;
        }
        if (!strtotime($date) && $date > 1) {
            $date = date('Y-m-d H:i:s', (int)$date);
        }

        if ($include_time) {
            return date('Y-m-d H:i:s', strtotime($date));
        }
        return date('Y-m-d', strtotime($date));
    }


    /**
     * Returns the localized version of a date
     * @static
     * @param $date
     * @param bool $include_time Whether to return hours and minutes
     * @return null|string
     */
    public static function localized_date($date, $include_time = FALSE)
    {
        if (empty($date)) {
            return NULL;
        }


        if (strpos($date, '-')) {
            if ($include_time) {
                return date('d.m.Y H:i', strtotime($date));
            }
            return date('d.m.Y', strtotime($date));
        }
        return $date;
    }


    /**
     * Check if start date is smaller than end date
     * @param string $start
     * @param string $end
     * @return bool
     */
    public static function date_smaller_than($start, $end)
    {
        return strtotime($start) < strtotime($end);
    }


    /**
     * Check if the input date is realistic
     * Used for checking for format errors where PHP usually uses the 0 date (1970)
     * @static
     * @param string $date Any valid date string
     * @return bool TRUE if we're reasonably sure the date is OK
     */
    public static function realistic_date($date)
    {
        $date = strtotime($date);

        // If year is smaller than 1990, it's probably invalid
        if ($date < 631152000) {
            return FALSE;
        }
        return TRUE;
    }
}