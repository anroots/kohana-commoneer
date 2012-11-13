3.0.0
=====

* Built for PSR-0 compliance with Kohana 3.3
* Renamed class files for PSR-0 compliance
* Removed Commoneer_Validation
* Moved Input::not_equals to Valid class
* Removed Commoneer_Security
* Rename Input to Filter
* Commoneer_Exception has been refactored to Commoneer_HTTP_Exception. Only HTTP exception handling is overriden.
* Overhaul Commoneer_Controller_Template API (and rename to Controller_Template)
* Remove Controller_Ajax (should be replaced with a dedicated API module)
* Add view action to Crud controller interface. Add Crud controller trait.
* Refactored the Assets class. Removed always_include assets.
* I18n public views
* ORM::get changed to ORM::exclude_deleted

2.0.1
=====

* Add ?r= to the query args when session timeout causes a redirect to the login controller.

2.0
=====

* Overhaul of the API-s
* HTML::breadcrumbs can now accept undefined number of crumbs in one call, using func_get_args
* Date::mysql_date accepts DateTime and throws InvalidArgumentException
* Added I18n helper
* Removed the concept of $filters and $execute from ORM::get()
* Removed deprecated ::CSS references from the Assets class, the class now throws InvalidArgumentExceptions instead of ExceptionSarcasm
* Assets class now uses Minify by default.
* Security::safe_string is deprecated, replaced by URL::title
* Assets class has a new always_include config option
* The ORM model has a new method, `changed_log`
* Controllers can now auto-load and make accessible from the view their associated models via a new class property, _orm_name

(this list is not complete)

1.4
=====

* New class: Valid for extra validation rules
* Deprecated LESS support from Assets class
* Assets now have presets (Asset::preset())
* Date::mysql_date() now treats empty input as time() (previous behaviour was to return null)
* Assets auto including just got smarter, realizing there exist such things as controller directorys
* Input::str2bool static function
* Added default auth controller + view for quick login pages
* Added config/app.php
* Changed class names/inheritance to better reflect the HMVC pattern