<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Handles the inclusion of static assets such as css and js files.
 *
 * This class makes it simple to use stylesheets and scrips on as-needed basis
 * so you don't have to include everything in your template, always.
 *
 * @example Assets::use_script('tablesorter'); echo Assets::render();
 * @since 1.0
 * @package Commoneer
 * @author Ando Roots 2011
 * @copyright GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
class Commoneer_Assets implements Commoneer_Assets_Interface
{

	/**
	 * File extensions
	 */
	const CSS = 'css';
	const SCRIPT = 'js';
	const STYLE = 'less';

	/**
	 * Known asset types as an array
	 *
	 * @since 1.4
	 * @var array
	 */
	protected static $_assets_types = array(Commoneer_Assets::CSS, Commoneer_Assets::SCRIPT, Commoneer_Assets::STYLE);

	/**
	 * Singleton pattern, store instance
	 * @var Commoneer_Assets
	 */
	protected static $_instance;


	/**
	 * Holds the HTML of included files
	 * Syntax: array(type => array(alias => HTML))
	 * @var array
	 */
	protected $_assets = array();


	/**
	 * Class config, loaded on construct
	 * @var \Kohana_Config_Group|object
	 */
	private $_config;


	/**
	 * Load config once, on construction
	 */
	protected function __construct()
	{
		$this->_config = Kohana::$config->load('assets');
		if (Assets::$_instance === NULL) {
			Assets::$_instance = $this;
		}
	}

	/**
	 * Can't clone!
	 * @return object
	 */
	public function __clone()
	{
		return Assets::instance();
	}


	/**
	 * Get the singleton instance of the class
	 *
	 * @since 1.0
	 * @static
	 * @return Commoneer_Assets
	 */
	public static function instance()
	{
		if (Assets::$_instance === NULL) {
			// Create a new instance
			Assets::$_instance = new Assets;
		}
		return Assets::$_instance;
	}


	/**
	 * Add a new script file to the current request
	 *
	 * @since 1.0
	 * @static
	 * @param string|array $names Either a predefined alias or a path. Can also be an array of aliases/paths
	 * @return Commoneer_Assets
	 */
	public static function use_script($names)
	{
		Assets::instance()->_add_resource(Assets::SCRIPT, $names);
		return Assets::instance();
	}


	/**
	 * Add a new style to the current request
	 *
	 * @since 1.0
	 * @static
	 * @param string|array $names Either a predefined alias or a path. Can also be an array of aliases/paths
	 * @return Commoneer_Assets
	 */
	public static function use_style($names)
	{
		Assets::instance()->_add_resource(Assets::STYLE, $names);
		return Assets::instance();
	}


	/**
	 * Add a new css file to the current request
	 *
	 * @since 1.0
	 * @static
	 * @param string|array $names Either a predefined alias or a path. Can also be an array of aliases/paths
	 * @return Commoneer_Assets
	 */
	public static function use_css($names)
	{
		Assets::instance()->_add_resource(Assets::CSS, $names);
		return Assets::instance();
	}


	/**
	 * Include a preset
	 *
	 * Presets are groups of assets defined in the config file preset subsection
	 *
	 * @throws Exception_Sarcasm
	 * @since 1.4
	 * @static
	 * @param string $alias The alias of the preset
	 * @return Commoneer_Assets
	 */
	public static function preset($alias)
	{
		$presets = Assets::instance()->_config->get('presets');

		if (!array_key_exists($alias, $presets)) {
			throw new Exception_Sarcasm("Tried to load assets preset ':name', but it's not listed in the Commoneer Assets configuration file.", array(':name' => $alias));
		}

		// Loop over all types of assets (style,script) in the preset
		foreach ($presets[$alias] as $type => $values) {
			if (empty($values)) {
				continue;
			}

			// Add assets of this type
			Assets::instance()->_add_resource($type, $values);

		}
		return Assets::instance();
	}

	/**
	 * Add HTML of the appropriate type to the load que
	 *
	 * Example: _add_resource(Assets::STYLE, 'common.less')
	 * would add <style type...> to be included in the HEAD
	 *
	 * @throws Exception_Sarcasm
	 * @since 1.0
	 * @param const $type One of the asset types (STYLE, SCRIPT, CSS)
	 * @param mixed $names A single file or an array of file paths relative to the asset root
	 * @return void
	 */
	private function _add_resource($type, $names)
	{

		if (empty($names)) {
			return;
		}

		if (!is_array($names)) {
			$names = array($names);
		}

		// Add every specified file to the load que
		foreach ($names as $file) {
			$path = $this->_find_file($type, $file);
			if (!$path) {
				continue;
			}

			// Add HTML for including the asset
			switch ($type) {
				case Assets::STYLE:
					$this->_assets[$type][$file] = '<link rel="stylesheet/less" type="text/css" href="' . URL::base() . $path . '">';
					break;
				case  Assets::SCRIPT:
					$this->_assets[$type][$file] = HTML::script($path);
					break;
				case Assets::CSS:
					$this->_assets[$type][$file] = HTML::style($path);
					break;
			}
		}
	}

	/**
	 * Get a list of known assets types
	 *
	 * @since 1.4
	 * @static
	 * @return array An array of asset types
	 */
	public static function known()
	{
		return Commoneer_Assets::$_assets_types;
	}

	/**
	 * Return asset HTML includes
	 *
	 * ...and clear the include que
	 *
	 * @throws Exception_Sarcasm
	 * @since 1.0
	 * @param string $type The type of assets to render (script/style)
	 * @return string|null HTML markup
	 */
	private function _render($type = NULL)
	{
		if (!in_array($type, Commoneer_Assets::known())) {
			throw new Exception_Sarcasm('Unknown asset type for inclusion: :name', array(':name' => $type));
		}

		$html = NULL;

		// Auto include matching controller/action resource files
		if ($this->_config->auto_include) {
			$file = (Request::current()->directory() ? Request::current()->directory() . DIRECTORY_SEPARATOR : NULL) . Request::current()->controller() . DIRECTORY_SEPARATOR . Request::current()->action();
			$this->_add_resource($type, $file);
		}

		// Nothing to render
		if (empty($this->_assets) || !array_key_exists($type, $this->_assets)) {
			return NULL;
		}

		// Render
		if (!empty($this->_assets[$type])) {
			$html = implode("\n", $this->_assets[$type]);
			$this->_assets[$type] = array();
		}
		return $html;

	}

	/**
	 * Render all assets at once
	 *
	 * @since 1.2
	 * @return null|string
	 */
	private function _render_all()
	{
		$html = NULL;
		foreach ($this->_assets as $type => $assets) {
			$html .= $this->_render($type);
		}
		return $html;
	}


	/**
	 * Output all included assets as HTML style/script tags
	 *
	 * Clears the matching asset que when done.
	 * @since 1.0
	 * @param bool|string $type Render only a specific type of assets. Defaults to all
	 * @static
	 * @return string HTML markup
	 */
	public static function render($type = TRUE)
	{
		return $type === TRUE ? Assets::instance()->_render_all() : Assets::instance()->_render($type);
	}


	/**
	 * Try to locate an asset file
	 *
	 * Look for the predefined assets first
	 * Search in all defined assets paths
	 *
	 * @throws Exception_Sarcasm
	 * @since 1.0
	 * @param string $type Asset type
	 * @param string $file Partial file path
	 * @return bool|string Partial file path for including in the template on success, FALSE on 404
	 */
	private function _find_file($type, $file)
	{
		if (!in_array($type, Commoneer_Assets::known())) {
			throw new Exception_Sarcasm('Unknown asset type for inclusion: :name', array(':name' => $type));
		}

		// If the file is an alias to a known asset, get it's path from the config file
		if (array_key_exists($type, $this->_config->assets_paths)) {
			if (array_key_exists($file, $this->_config->known_assets[$type])) {
				return $this->_config->assets_url . $this->_config->known_assets[$type][$file] . '.' . $type;
			}
		}
		// The file isn't predefined, search for it in all predefined asset folders
		if (array_key_exists($type, $this->_config->assets_paths) && !empty($this->_config->assets_paths[$type])) {
			foreach ($this->_config->assets_paths[$type] as $path) {
				$file_path = $path . $file . '.' . $type;
				if (file_exists(DOCROOT . $file_path)) {
					return $this->_config->assets_url . $file_path;
				}
			}

		}

		Kohana::$log->write(Kohana_Log::ERROR, 'Tried to load asset "' . $file . '", but got error 404.');
		return FALSE;
	}

}