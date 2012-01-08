<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Words aren't enough sometimes, you need some sarcasm to do the trick
 *
 * @since 1.0
 * @package Commoneer
 * @subpackage Exception
 */
class Exception_Sarcasm extends Commoneer_Exception
{

    /**
     * @var int Sarcasm error code
     */
    protected $_code = 666;

    /**
     * Construct a new Exception_Sarcasm
     *
     * @param string $message
     * @param array $variables
     * @param int $code
     */
    public function __construct($message = 'Oh? Did you honestly just try to do that?', array $variables = array(), $code = 666)
    {
        parent::__construct($message, $variables, $code);
    }

}
