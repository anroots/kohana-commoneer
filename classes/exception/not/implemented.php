<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @since 1.0
 * @package Commoneer
 * @subpackage Exception
 */
class Exception_Not_Implemented extends Commoneer_Exception {

	/**
	 * @var int Not Implemented Error Code
	 */
	const CODE = 501;

	/**
	 * Construct a new Not Implemented Error
	 *
	 * @param string $message
	 * @param array $variables
	 * @param int $code
	 */
	public function __construct($message = 'Function \':name\' is not yet implemented!', array $variables = array(),
	                            $code = self::CODE)
	{
		$variables[':name'] = $this->get_calling_function_name();
		parent::__construct($message, $variables, $code);
	}


}
