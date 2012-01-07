<?php defined('SYSPATH') or die('No direct script access.');

if (Kohana::$config->load('auto-i18n.active'))
{

    register_shutdown_function(function()
            {
                I18n::write();
            }
        );
}


?>
