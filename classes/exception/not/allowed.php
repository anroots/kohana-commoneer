<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package Commoneer
 * @subpackage Exception
 */
class Exception_Not_Allowed extends Commoneer_Exception
{

    /**
     * @var int Not Implemented Error Code
     */
    protected $_code = 405;

    /**
     * Construct a new Not Implemented Error
     * @param string $message
     * @param array $variables
     * @param int $code
     */
    public function __construct($message = 'Method \':name\' called with invalid parameters!', array $variables = array(), $code = 501)
    {
        $variables[':name'] = $this->get_calling_function_name();
        parent::__construct($message, $variables, $code);
    }

}
