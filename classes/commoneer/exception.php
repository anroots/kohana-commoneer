<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Override Kohana's default Exception handler with Commoneer's
 *
 * Override applies only in a non-development environment
 *
 * @see Kohana::$environment
 * @author Ando Roots
 * @package Commoneer
 * @subpackage Exception
 * @since 1.3
 */
class Commoneer_Exception extends Kohana_Kohana_Exception
{
	/**
	 * Overrides Kohana's Exception handler
	 *
	 * @since 1.3
	 * @static
	 * @param Exception $e
	 */
	public static function handler(Exception $e)
	{
		if (Kohana::$environment === Kohana::DEVELOPMENT) {
			parent::handler($e); // Use Kohana's exception handler on DEVELOPMENT
		}
		else
		{
			try // Output the error page
			{
				Kohana::$log->add(Log::ERROR, parent::text($e));
				die(View::factory('commoneer/exception', array('message' => $e->message, 'code' => $e->code)));
			}
			catch (Exception $e) // Only the message if there's no view
			{
				ob_get_level() && ob_clean();
				die($e->message);
			}
		}
	}

	/**
	 * Returns the calling function's name
	 *
	 * @since 1.0
	 * @return string
	 */
	public function get_calling_function_name()
	{
		$backtrace = debug_backtrace();
		return $backtrace[2]['function'];
	}
}
