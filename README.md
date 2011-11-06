Commoneer version 1.1 RELEASE CANDIDATE
=========

Commoneer provides commonly used helpers, methods and classes that the author saw fit to add to Kohana.
The module extends several Kohana's built-in helpers, providing additional functions and behaviours.

The module strongly reflects my developing style and might not me suitable for everyone.

Included Classes
----------------

**Assets** - Dynamic inclusion of stylesheets and scripts on as-needed basis.

No need to write if statements to your master template file when all you have to do is add
    Assets::use_script('tablesorter')
to your controller action and the script gets included.


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
