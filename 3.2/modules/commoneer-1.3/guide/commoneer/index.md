Commoneer Version 1.3 (Dec 17 2011)
=======================================

Commoneer provides commonly used helpers, methods and classes that the author saw fit to add to Kohana.
The module extends several Kohana's built-in classes, providing additional functions and behaviour.

The module strongly reflects my developing style and might not me suitable for everyone.

Core Philosophy
---------------

One should be able to do more with less code, thereby strong convention over configuration approach is taken. Controllers are smart enough to find their own views and assets.
Extendable classes lay out the groundwork for common operations such as delete and find_all.

Included Classes
----------------

**Assets** - Dynamic inclusion of stylesheets and scripts on as-needed basis.
No need to write if statements to your master template file when all you have to do is add
    Assets::use_script('tablesorter')
to your controller action and the script gets included.

**Controller_Template** - Adds convention over configuration automatic view detection and convenience attributes

**Controller_Ajax** - Call $this->respond($data); and have JSON output out of the box

**Commoneer_ORM** - Extends the ORM module, overriding the delete() and adding get()

**Overriden error pages** - We don't want clients to see the default stacktrace on Production, show a friendlier error page isntead.


Extended Helpers
----------------
* Date - Convert dates to localized / mysql format
* Input - Manipulate and check user input
* Security
* Arr
* Validation - recursively display (ORM) error messages


Install
=======

Copy to Kohana's modules folder and rename to commoneer. Add a line to application/bootstrap.php to enable it.

Maintenance and versioning
==========================
I'm using this module as a basis in most of my projects (daily) so as soon as new idea hits me, I'll probably add them here.
The master always holds the latest working version and previous and next versions are visible as branches.

Documentation
=============

Minimal Kohana Userguide documentation is provided as well as Phpdoc style comments.

View the latest version and be part of the community at [https://github.com/anroots/kohana-commoneer](https://github.com/anroots/kohana-commoneer)

_Commoneer Kohana Module by Ando Roots 2011 ando+dev@roots.ee_