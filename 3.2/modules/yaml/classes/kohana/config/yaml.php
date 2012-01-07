<?php defined('SYSPATH') or die('No direct script access.');
/**
 * YAML configuration file reader.
 * @package   Kohana/YAML
 * @category  Configuration
 * @author    Jan Stránský <jan.stransky@arnal.cz>
 * @author    Gabriel Evans <gabriel@codeconcoction.com>
 */
class Kohana_Config_YAML extends Kohana_Config_File_Reader {

	/**
	 * @var  string  Configuration group name
	 */
	protected $_configuration_group;

	/**
	 * @var  bool  Has the config group changed?
	 */
	protected $_configuration_modified = FALSE;

	public function __construct($directory = 'config')
	{
		// Set the configuration directory name
		$this->_directory = trim($directory, '/');

		// Load the empty array
		parent::__construct();
	}

	/**
	 * Load and merge all of the configuration files in this group.
	 *
	 *     $config->load($name);
	 *
	 * @param   string  configuration group name
	 * @param   array   configuration array
	 * @return  $this   clone of the current object
	 * @uses    Kohana::load
	 */
	public function load($group, array $config = NULL)
	{
		if ($files = Kohana::find_file($this->_directory, $group, 'yml', TRUE))
		{
			// Initialize the config array
			$config = array();

			foreach ($files as $file)
			{
				if (Kohana::$caching === TRUE)
				{
					$yaml = Kohana::cache($file);

					if (empty($yaml))
					{
						// Cache the file
						$yaml = YAML::instance()->parse_file($file, TRUE);
						Kohana::cache($file, $yaml);
					}
				}
				else
				{
					$yaml = YAML::instance()->parse_file($file, TRUE);
				}

				// Merge each file to the configuration array
				$config = Arr::merge($config, $yaml);
			}
		}

		return parent::load($group, $config);
	}

} // End Kohana_Config_YAML
