Commoneer Version 3.0.0 DEV
======================

Commoneer provides commonly used helpers and extensible classes that the author saw fit to add to Kohana.
The module extends several Kohana's built-in classes, providing additional functionality and behaviour.

The module strongly reflects my developing style and might not be suitable for everyone.

See http://anroots.github.com/kohana-commoneer/ for additional information.

Core Philosophy
---------------

One should be able to do more with less code, thereby strong convention over configuration approach is taken. Controllers are smart enough to find their own views and assets.
Extensible classes lay out the groundwork for common operations such as delete and find_all for modules.

Included Classes
----------------

**Assets** - Dynamic inclusion of stylesheets and scripts on as-needed basis.
No need to write if statements to your master template file when all you have to do is add
    Assets::use_script('tablesorter')
to your controller action and the script gets included. The output is automatically minified.

**Controller_Template** extension - Adds convention over configuration automatic view detection and convenience attributes
**Controller_Template** - Adds convention over configuration automatic view detection and convenience attributes

**Controller_Ajax** - Call $this->respond($data); and have JSON output out of the box

**Commoneer_ORM** - Extends the ORM module, overriding the delete() and adding get()

**Overriden error pages** - We don't want clients to see the default stacktrace on Production, show a friendlier error page instead.

Extended Helpers
----------------
* Date - Convert dates to localized / mysql format
* Input - Manipulate and check user input
* Security
* Arr
* Validation - recursively display (ORM) error messages

Dependencies
=============

* Default Kohana modules (Database, ORM...)
* Notify module by kaltar: https://github.com/kaltar/Notify
* Minify: https://github.com/mrclay/minify

Install
=======

Standard Kohana module install:

* Clone the repository into your MODPATH folder:

    cd your/modules/folder &&
   git://github.com/anroots/kohana-commoneer.git

* Add a line to the modules definition in application/bootstrap.php to enable Commoneer

    Kohana::modules(array(
    'auth' => MODPATH . 'auth',
    ...
    'commoneer' => MODPATH. 'commoneer',
    );

* See the userguide and API browser for usage information (enable the userguide module and visit http://localhost/your-kohana-installation/guide)

Maintenance and Versioning
==========================
I'm using this module as a basis in most of my projects (daily) so as soon as new idea hits me, I'll probably add them here.
The master always holds the latest working version and previous and next versions are visible as branches.

Documentation
=============

Kohana Userguide documentation is provided as well as Phpdoc style comments. Activate the userguide module and navigate to http://localhost/your-kohana-path/guide.
