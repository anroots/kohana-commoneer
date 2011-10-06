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
            $date = date('Y-m-d H:i:s', $date);
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

}