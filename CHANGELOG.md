2.0
=====
* Overhaul of the API-s
* HTML::breadcrumbs can now accept undefined number of crumbs in one call, using func_get_args
* Date::mysql_date accepts DateTime and throws InvalidArgumentException
* Added I18n helper
* Removed the concept of $filters and $execute from ORM::get()

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