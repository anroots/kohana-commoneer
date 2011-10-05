<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package Commoneer
 * @subpackage Error
 */
class Exception_Not_Implemented extends Kohana_Kohana_Exception
{

    /**
     * @var int Not Implemented Error Code
     */
    protected $_code = 501;

    /**
     * Construct a new Not Implemented Error
     * @param string $message
     * @param array $variables
     * @param int $code
     */
    public function __construct($message = 'Function \':name\' is not yet implemented!', array $variables = array(), $code = 501)
    {
        $variables[':name'] = $this->_get_calling_function_name();
        parent::__construct($message, $variables, $code);
    }

    /**
     * Returns the calling function's name
     * @return string
     */
    private function _get_calling_function_name()
    {
        $backtrace = debug_backtrace();
        return $backtrace[2]['function'];
    }
}
