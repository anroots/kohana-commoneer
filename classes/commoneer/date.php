<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Commonly used date functions
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots <anroots@itcollege.ee>
 * @since 1.0
 */
class Commoneer_Date extends Kohana_Date {

	/**
	 * Timestamp format of MYSQL, with time
	 *
	 * @since 2.0
	 * @see self::mysql_date()
	 */
	const MYSQL_LONG = 'Y-m-d H:i:s';

	/**
	 * Timestamp format of MYSQL, date only
	 *
	 * @since 2.0
	 * @see self::mysql_date()
	 */
	const MYSQL_SHORT = 'Y-m-d';

	/**
	 * @var string Long date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_long = 'd.m.Y H:i';

	/**
	 * @var string Short date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_short = 'd.m.Y';


	/**
	 * Load date format initial config
	 *
	 * @since 1.0
	 * @see Date::localized_date
	 */
	public function __construct()
	{
		parent::construct();

		$format_long = Kohana::$config->load('commoneer.date_format_long');
		if (! empty($format_long)) {
			self::$_format_long = $format_long;
		}

		$format_short = Kohana::$config->load('commoneer.date_format_short');
		if (! empty($format_short)) {
			self::$_format_short = $format_short;
		}
	}


	/**
	 * Converts input date to MYSQL format
	 * Numeric input will be treated as time from UNIX_EPOCH
	 *
	 * @example: Date::mysql_date(31.12.2001 00:00:06, FALSE) == '2011-12-31'
	 * @static
	 * @param string|int|null|DateTime $date Any valid date string. Leave empty to use NOW().
	 * @param bool $include_time If true, return H:i:s also
	 * @throws InvalidArgumentException
	 * @return string MYSQL format date
	 */
	public static function mysql_date($date = NULL, $include_time = TRUE)
	{
		if (empty($date)) {
			$date = time();
		} elseif ($date instanceof DateTime) {
			return $date->format($include_time ? self::MYSQL_LONG : self::MYSQL_SHORT);
		}

		if (! strtotime($date)) { // Assume date is a timestamp
			if (! is_numeric($date)) { // Malformed string!
				throw new InvalidArgumentException('Invalid $date, "'.(string) $date.'"!');
			}
			$date = date(self::MYSQL_LONG, $date);
		}

		return date($include_time ? self::MYSQL_LONG : self::MYSQL_SHORT, strtotime($date));
	}


	/**
	 * Returns the localized version of a date
	 * Set your local date format in the Commoneer config file
	 * or by dynamically modifying the static format variables
	 *
	 * @static
	 * @since 1.0
	 * @see Date::set_format()
	 * @see Date::$_format_long
	 * @see Date::$_format_short
	 * @param string $date Date string in any format, timestamp or empty for time()
	 * @param bool $include_time Whether to return the long format
	 * @return string Date string in the specified localized format
	 */
	public static function localized_date($date = NULL, $include_time = FALSE)
	{
		if (is_numeric($date) && $date > 1) {
			// Timestamp given, do nothing
		} elseif (is_string($date) && ! empty($date)) {
			$date = strtotime($date);
		} else { // Default: time()
			$date = time();
		}

		return date((bool) $include_time ? Date::$_format_long : Date::$_format_short, $date);
	}


	/**
	 * Check if the start date is smaller than the end date
	 * Useful in validation rules
	 *
	 * @since 1.0
	 * @param string $start Any date string or timestamp value
	 * @param string $end Any date string or timestamp value
	 * @return bool TRUE if $start is strictly smaller than $end
	 */
	public static function date_smaller_than($start, $end)
	{
		if (
			(! is_numeric($start) && ! is_string($start))
			|| (! is_numeric($end) && ! is_string($end))
		) {
			return FALSE;
		}

		// Converts input to timestamps if needed
		if (! $ts1 = strtotime($start)) {
			$ts1 = $start;
		}
		if (! $ts2 = strtotime($end)) {
			$ts2 = $end;
		}

		return $ts1 < $ts2;
	}


	/**
	 * Check if the input date is above the allowed limit
	 * Used for checking for format errors where PHP usually uses the EPOCH
	 *
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
		return ! empty($date) && $date > $min;
	}
}