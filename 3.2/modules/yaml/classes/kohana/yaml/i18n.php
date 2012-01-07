<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extension of I18n class, supporting language files written in YAML:
 *
 *     # APPPATH/i18n/es.yml
 *     Spanish: Español
 *     Hello, world!: ¡Hola, mundo!
 *
 * @package    Kohana/YAML
 * @author     Gabriel Evans <gabriel@codeconcoction.com>
 * @copyright  (c) 2010 Gabriel Evans
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */
class Kohana_YAML_I18n extends Kohana_I18n {

	/**
	 * Returns the translation table for a given language, using YAML.
	 *
	 *     // Get all defined Spanish messages
	 *     $messages = I18n::load('es-es');
	 *
	 * @param   string   language to load
	 * @return  array
	 */
	public static function load($lang)
	{
		if (isset(I18n::$_cache[$lang]))
		{
			return I18n::$_cache[$lang];
		}

		// New translation table
		$table = array();

		// Split the language: language, region, locale, etc
		$parts = explode('-', $lang);

		do
		{
			// Create a path for this set of parts
			$path = implode(DIRECTORY_SEPARATOR, $parts);

			$yaml_files = Kohana::find_file('i18n', $path, 'yml', TRUE);
			$php_files  = Kohana::find_file('i18n', $path, NULL, TRUE);

			$files = array_merge($yaml_files, $php_files);

			if ($files)
			{
				$t = array();
				foreach ($files as $file)
				{
					if (substr($file, -4) === '.yml')
					{
						if (Kohana::$caching === TRUE)
						{
							$cached_file = Kohana::cache($file);

							if ( ! empty($cached_file))
							{
								// Merge the cached YAML language strings into the sub table
								$t = array_merge($t, $cached_file);
							}
							else
							{
								// Cache the file
								$cached_file = YAML::instance()->parse_file($file);
								Kohana::cache($file, $cached_file);

								// Merge the YAML language strings into the sub table
								$t = array_merge($t, $cached_file);
							}
						}
						else
						{
							// Merge the YAML language strings into the sub table
							$t = array_merge($t, YAML::instance()->parse_file($file));
						}
					}
					else
					{
						// Merge the language strings into the sub table
						$t = array_merge($t, Kohana::load($file));
					}
				}

				// Append the sub table, preventing less specific language
				// files from overloading more specific files
				$table += $t;
			}

			// Remove the last part
			array_pop($parts);
		}
		while ($parts);

		// Cache the translation table locally
		return I18n::$_cache[$lang] = $table;
	}

}
