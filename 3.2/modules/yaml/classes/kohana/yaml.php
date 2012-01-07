<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract YAML reader. YAML drivers must extend this class.
 *
 * @package    Kohana/YAML
 * @author     Gabriel Evans <gabriel@codeconcoction.com>
 * @copyright  (c) 2010 Gabriel Evans
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */
abstract class Kohana_YAML {

	/**
	 * @var  object  instance of YAML reader
	 */
	public static $_instance;


	// only instantiable by self
	protected function __construct() {}

	/**
	 * YAML reader singleton. If a driver isn't specified, will use YAML extension
	 * (if loaded) or default to Symfony.
	 * @param   string  driver to be used
	 * @return  object  driver instance
	 */
	public static function instance($driver = NULL)
	{
		if ( ! YAML::$_instance)
		{
			if ( ! $driver)
			{
				// determine best driver available
				$driver = (extension_loaded('yaml')) ? 'YAML_PECL' : 'YAML_Symfony';
			}
			else
			{
				$driver = 'YAML_'.ucfirst($driver);
			}

			YAML::$_instance = new $driver;
		}


		return YAML::$_instance;
	}

	/**
	 * Parse a YAML string to an array.
	 * @param   string  YAML string to be parsed
	 * @return  array   parsed data
	 */
	abstract public function parse($string);

	/**
	 * Parse a YAML file to an array.
	 * @param   string   file to be read
	 * @param   boolean  whether to evaulate PHP tags
	 * @return  array    parsed data
	 */
	public function parse_file($filename, $evaluate = FALSE)
	{
		if ($evaluate)
		{
			ob_start();
			Kohana::load($filename);
			$data = ob_get_clean();
		}
		else
		{
			$data = file_get_contents($filename);
		}

		return $this->parse($data);
	}

	/**
	 * Convert an array of data into YAML.
	 * @param   mixed   input data to be converted into YAML
	 * @return  string  converted YAML
	 */
	abstract public function dump($data);

	/**
	 * Dump an input data to a YAML file.
	 * @param   string  filename to output to
	 * @param   mixed   input data to parse and dump
	 * @return  mixed   number of bytes written, or FALSE on failure
	 */
	public function dump_file($filename, $data)
	{
		return file_put_contents($filename, $this->dump($data));
	}

}
