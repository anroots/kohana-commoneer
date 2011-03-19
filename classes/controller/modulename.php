<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Modulename Controler
 *
 * Is recomended to include all the specific module's controlers
 * in the module directory for easy transport of your code.
 *
 * @package    Modulename
 * @category   Base
 * @author     Myself Team
 * @copyright  (c) 2012 Myself Team
 * @license    http://kohanaphp.com/license.html
 */
class Controller_Modulename extends Controller {

    public function action_index()
    {

        // Instanciating the Module Class
        $Modulename = new Modulename;

        // Or Call a Statis Method
        Modulename::show_text('Cool!');

    }

} // End Welcome
