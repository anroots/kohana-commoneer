# Auto I18n #
Auto I18n is a module for Kohana 3, that will automatically collect internationalization strings and save them into _/application/i18n/{I18n::$lang}.php_ file whenever it can't find translated one.

# How it really works? #
Whenever you'll call __ function, I18n will "get" a translated value from language file. When it can't find requested value, such request is cached and default value is returned (like original I18n). 

When script processing is complete, _I18n::write(_) method is called that writes all missing values into a language file.

# Configuration #
Just clone/copy files to _/modules/auto-i18n_ and enable module by adding:

_'auto-i18n' => MODPATH.'auto-i18n', // Automatic i18n file generation_

to _Kohana::modules_ call in your bootstrap. 

Remember to move all I18n calls in your bootstrap **under** modules registration.

This module isn't meant to be used in production enviroment. Use it in development stage to prepare all needed translations and then turn it off by commenting it in _Kohana::modules_ or by setting _auto-i18n.active_ to false.

# Credits #

I've took code posted by [Mikito Takada](http://blog.mixu.net/2010/06/02/kohana3-automatically-collect-internationalization-strings/#codesyntax_1), cleaned and optimized it up a bit and wrapped into a Kohana 3 compatible module. This way it's easier to use.