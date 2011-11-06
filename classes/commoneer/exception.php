<?php defined('SYSPATH') or die('No direct script access.');

class Commoneer_Exception extends Kohana_Kohana_Exception {

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
