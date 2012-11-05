<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Override Kohana's default HTTP Exception handler with Commoneer's
 * Override applies only in a non-development environment
 *
 * @see Kohana::$environment
 * @author Ando Roots <ando@sqroot.eu>
 * @package Commoneer
 * @subpackage Exception
 * @since 1.3
 */
class Commoneer_HTTP_Exception extends Kohana_HTTP_Exception
{

	public function __construct($message = null, array $variables = null, Exception $previous = null)
	{
		if (Kohana::$environment !== Kohana::DEVELOPMENT) {
			self::$error_view = 'commoneer/error';
		}
		parent::__construct($message, $variables, $previous);
	}
}
