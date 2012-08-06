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