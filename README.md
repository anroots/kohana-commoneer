Kohana Module Template
======================

This is a base template intended to help you create your own Kohana 3 Module.

The intention is not to provide with a fix structure of how a module should be, but to provide an start point for your our custom modules.

*Fell free to Fork and make your own changes.*

Colaborators
------------

Thanks to the following colaborators:

* [sebicas](https://github.com/sebicas)

Planned support
---------------

In the near future, additional support for the following methods will be included.

1. Drivers

Using Modulename
----------------

To use this Kohana Module Template, just:

1. Download and extract the code from [Github](https://github.com/sebicas/kohana-module-template).
2. Place the module into your Kohana instances modules folder.
3. Finally enable the module within the application bootstrap within the section entitled _modules_.

How to use this module
----------------------

Go to `application/bootstrap.php`, look for `Kohana::modules()` and add:

<pre>
  'modulename' => MODPATH.'kohana-module-template', // Module Name & Path can be diferent if you like
</pre>

Example:

Replace 'modulename' and 'kohana-module-template' for your own name & path respectably.

<pre>
  Kohana::modules(array(
        // 'auth'       => MODPATH.'auth',       // Basic authentication
        // 'cache'      => MODPATH.'cache',      // Caching with multiple backends
        // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
        // 'database'   => MODPATH.'database',   // Database access
        // 'image'      => MODPATH.'image',      // Image manipulation
        // 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
        // 'unittest'   => MODPATH.'unittest',   // Unit testing
        // 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
        'modulename'  => MODPATH.'kohana-module-template',  // Add Module Name & Path
        ));
</pre>

Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b my_markup`)
3. Commit your changes (`git commit -am "Added Snarkdown"`)
4. Push to the branch (`git push origin my_markup`)
5. Create an [Issue][1] with a link to your branch
6. Enjoy a refreshing orange juice and wait
