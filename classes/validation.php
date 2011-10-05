<?php defined('SYSPATH') or die('No direct script access.');

class Validation extends Kohana_Validation
{

    /**
     * Displays validation exceptions
     * @static
     * @uses Notify::msg A flash-message module
     * @param $e ORM_Validation_Exception array
     * @return void
     */
    public static function show_errors($e)
    {
        if (is_string($e)) {
            Notify::msg($e, 'error');
            return;
        }

        if (is_object($e)) {
            $e = $e->errors('validation');
        }
        if (!empty($e) && is_array($e)) {
            foreach ($e as $error) {
                Notify::msg($error, 'error');
            }
        }
    }
}
