<?php defined('SYSPATH') or die('No direct script access.');
/**
 * YAML driver from PECL using LibYAML for parsing and dumping. Supports YAML 1.1.
 *
 * [!!] You must compile/install and enable the php-yaml extension to use this driver.
 *
 * @package    Kohana/YAML
 * @category   Drivers
 * @author     Gabriel Evans <gabriel@codeconcoction.com>
 * @copyright  (c) 2010 Gabriel Evans
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */
class Kohana_YAML_PECL extends YAML {

	public function parse($string)
	{
		return yaml_parse($string);
	}

	public function dump($data)
	{
		return yaml_emit($data, YAML_UTF8_ENCODING);
	}

}
