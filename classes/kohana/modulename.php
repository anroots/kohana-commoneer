<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Modulename — My own custom module.
 *
 * @package    Modulename
 * @category   Base
 * @author     Myself Team
 * @copyright  (c) 2012 Myself Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Modulename {

    /**
     * Class Main Constructor Method
     * This method is executed every time your module class is instantiated.
     */
    public function __construct() {

        // Load module configuration
        $some_config_value = Kohana::config('modulename.some_config_value');

        // Say hi!
        echo 'Hello Modulename! '.$some_config_value;

    }

    /**
     * Output the given Text
     *
     * @param   string   Text to show
     */
    static function show_text($text) {

        // Echo Some Text
        echo ' & here is the static method! '.$text;

    }

}