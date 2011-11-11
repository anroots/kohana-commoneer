<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Commonly used date functions
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots
 * @since 1.0
 */
class Date extends Kohana_Date
{

	/**
	 * Load date format initial config
	 *
	 * @since 1.0
	 * @see Date::localized_date
	 */
	public function __construct()
	{
		parent::construct();
		Date::$_format_long = Kohana::$config->load('commoneer.date_format_long');
		Date::$_format_short = Kohana::$config->load('commoneer.date_format_short');
	}

	/**
	 * @var string Date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_long = 'd.m.Y H:i';

	/**
	 * @var string Date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_short = 'd.m.Y';


	/**
	 * Converts input date to MYSQL format
	 *
	 * Numeric input will be treated as time from UNIX_EPOCH
	 *
	 * @example: Date::mysql_date(31.12.2001 00:00:06, FALSE) == '2011-12-31'
	 * @static
	 * @param string $date Any valid date string
	 * @param bool $include_time If true, return H:i:s also
	 * @return null|string NULL on format error, MYSQL format date otherwise
	 */
	public static function mysql_date($date, $include_time = TRUE)
	{
		if (empty($date)) {
			return NULL;
		}

		if (!strtotime($date)) { // Assume date is a timestamp
			if (!is_numeric($date)) { // Malformed string!
				return NULL;
			}
			$date = date('Y-m-d H:i:s', $date);
		}

		return date((bool)$include_time ? 'Y-m-d H:i:s' : 'Y-m-d', strtotime($date));
	}


	/**
	 * Returns the localized version of a date
	 *
	 * Set your local date format in the Commoneer config file
	 * or by dynamically modifying the static format variables
	 *
	 * @static
	 * @since 1.0
	 * @see Date::set_format()
	 * @see Date::$_format_long
	 * @see Date::$_format_short
	 * @param string $date Date string in any format
	 * @param bool $include_time Whether to return the long format
	 * @return null|string
	 */
	public static function localized_date($date, $include_time = FALSE)
	{
		if (empty($date) || !$date = strtotime($date)) {
			return NULL;
		}

		return date((bool)$include_time ? Date::$_format_long : Date::$_format_short, $date);
	}


	/**
	 * Check if the start date is smaller than the end date
	 *
	 * Useful in validation rules
	 * @since 1.0
	 * @param string $start Any date string or timestamp value
	 * @param string $end Any date string or timestamp value
	 * @return bool TRUE if $start is strictly smaller than $end
	 */
	public static function date_smaller_than($start, $end)
	{
		if (
			(!is_numeric($start) && !is_string($start))
			|| (!is_numeric($end) && !is_string($end))
		) {
			return FALSE;
		}

		// Converts input to timestamps if needed
		if (!$ts1 = strtotime($start)) {
			$ts1 = $start;
		}
		if (!$ts2 = strtotime($end)) {
			$ts2 = $end;
		}

		return $ts1 < $ts2;
	}


	/**
	 * Check if the input date is above the allowed limit
	 *
	 * Used for checking for format errors where PHP usually uses the EPOCH
	 * @since 1.0
	 * @static
	 * @param string $date Any valid date string
	 * @param int $min Timestamp of the minimum accepted time, defaults to 1990-ish
	 * @return bool TRUE If the input time is greater than the minimum
	 */
	public static function realistic_date($date, $min = NULL)
	{
		if ($min === NULL) {
			$min = 631152000; // 1990
		}
		$date = strtotime($date);

		// If year is smaller than $min, it's probably invalid
		return !empty($date) && $date > $min;
	}
}