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

    // Config data
    protected $_config;

    /**
     * Class Main Constructor Method
     * This method is executed every time your module class is instantiated.
     */
    public function __construct() {

        // Loading module configuration file data
        $this->_config = Kohana::config('modulename');

        // Say hi! usign date entered in the config file
        echo 'Hello Modulename! '.$this->_config['some_config_value'];

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