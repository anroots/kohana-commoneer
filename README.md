Kohana Module Template
======================

This is a base template intended to help you create your own Kohana 3 Module.

The intention is not to provide with a fix structure of how a module should be, but to provide an start point for your our custom modules.

*Fell free to Fork and make your own changes.*

Planned support
---------------

In the near future, additional support for the following methods will be included.

1. Drivers

Using Cache
-----------

To use this Kohana Module Template, just:

1. Download and extract the code from [Github](https://github.com/sebicas/kohana-module-template).
2. Place the module into your Kohana instances modules folder.
3. Finally enable the module within the application bootstrap within the section entitled _modules_.

How to use this module
----------------------

Go to bootstrap.php and look for Kohana::modules() array and add:

'modulename' => MODPATH.'kohana-module-template',  // Module Name & Path can be diferent if you like

Example:

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
        // 'auth'       => MODPATH.'auth',       // Basic authentication
        // 'cache'      => MODPATH.'cache',      // Caching with multiple backends
        // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
        'database'   => MODPATH.'database',   // Database access
        // 'image'      => MODPATH.'image',      // Image manipulation
        'orm'        => MODPATH.'orm',        // Object Relationship Mapping
        // 'unittest'   => MODPATH.'unittest',   // Unit testing
        'userguide'  => MODPATH.'userguide',  // User guide and API documentation
This -> 'modulename'  => MODPATH.'kohana-module-template',  // Module Name & Path can be diferent if you like
        ));

Replace 'modulename' and 'kohana-module-template' for your own name & path respectably.