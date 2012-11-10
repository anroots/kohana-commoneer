<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Configuration exception
 *
 * @since 1.0
 * @package Commoneer
 * @subpackage Exception
 */
class Exception_Config extends Kohana_Exception {

	/**
	 * @var int Config error code
	 */
	const CODE = 741;

	/**
	 * Construct a new Config error
	 *
	 * @param string $message
	 * @param array $variables
	 * @param int $code
	 */
	public function __construct($message = 'Configuration error', array $variables = array(), $code = self::CODE)
	{
		parent::__construct($message, $variables, $code);
	}

}
