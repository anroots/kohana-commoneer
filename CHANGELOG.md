v1.4
=====
* Assets now have presets (Asset::preset())
* Date::mysql_date() now treats empty input as time() (previous behaviour was to return null)
* Assets auto including just got smarter, realizing there exist such things as controller directorys