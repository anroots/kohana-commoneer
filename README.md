Kohana Module Template
======================

This is a base template intended to help you create your own Kohana 3 Module.

Is important to understand that most modules won't need models, controlers, views, etc... since this is a Module Template to learn about what you can do with Kohana. I think that for newbies It's easier to delete what you don't need that to write from scratch what you need... so feel free to play, delete, add anything you want.

The intention is not to provide with a *fix structure* of how a module should be, but to provide an start point for your our custom modules.

**Important**: You could delete everything and only keep one file is that is what you need.

How to use this module
----------------------

To use this **Kohana Module Template**, just:

1. Download and extract the code from [Github](https://github.com/sebicas/kohana-module-template).
2. Place the module into your Kohana instances modules folder.
3. Enable the module within the application bootstrap within the section entitled `modules`.

Go to `application/bootstrap.php`, look for `Kohana::modules()` and add:

    'modulename' => MODPATH.'kohana-module-template', // Module Name & Path can be diferent if you like

Example:

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

Replace 'modulename' and 'kohana-module-template' for your own name & path respectably.

See it working
--------------

To see a **Demo** of the Module working go to [http://kohana.sebicas.com/modulename](http://kohana.sebicas.com/modulename)

How to Write a Module Resources
-------------------------------

Here is a list of articles I found about how to write your own Modules in Kohana 3

* [Writing a module for Kohana3](http://query7.com/writing-a-module-for-kohana3)
* [Kohana PHP 3.0 (KO3) Tutorial Part 8](http://www.dealtaker.com/blog/2010/04/30/kohana-php-3-0-ko3-tutorial-part-8/)

Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b my_markup`)
3. Commit your changes (`git commit -am "Added Snarkdown"`)
4. Push to the branch (`git push origin my_markup`)
5. Create an [Issue][1] with a link to your branch
6. Enjoy a refreshing orange juice and wait

Colaborators
------------

Thanks to the following colaborators:

* [sebicas](https://github.com/sebicas)

Future Planned support
----------------------

In the near future, additional support for the following methods will be included.

* **Jelly-style driver configuration**