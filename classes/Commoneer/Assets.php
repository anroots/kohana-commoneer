<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Handles the inclusion of static assets such as css and js files.
 * This class makes it easy to use stylesheets and scrips on as-needed basis
 * so you don't have to include everything in your template, always.
 *
 * @example Assets::use_script('tablesorter'); echo Assets::render();
 * @example Assets::preset('jquery-ui');
 * @example Assets::use_script('custom_script')->use_style('custom_style')->render();
 * @since 1.0
 * @uses Minify, http://code.google.com/p/minify/
 * @package Commoneer
 * @author Ando Roots <ando@sqroot.eu>
 */
class Commoneer_Assets {

	/**
	 * Javascript file extension
	 *
	 * @since 1.0
	 */
	const SCRIPT = 'js';

	/**
	 * CSS file extension
	 *
	 * @since 1.0
	 */
	const STYLE = 'css';

	/**
	 * Known asset types as an array
	 *
	 * @since 1.4
	 * @var array
	 */
	protected static $_assets_types = array(Commoneer_Assets::SCRIPT, Commoneer_Assets::STYLE);

	/**
	 * @var string The min directory (of Minify)
	 */
	public static $min_dir = 'min';

	/**
	 * Singleton pattern, store instance
	 *
	 * @var Commoneer_Assets
	 */
	protected static $_instance;

	/**
	 * Holds the URI paths of included files
	 * Syntax: array(type => array(alias => path))
	 *
	 * @var array
	 */
	protected $_assets = array();


	/**
	 * Class config, loaded on construct
	 *
	 * @var \Kohana_Config_Group|object
	 */
	private $_config;

	/**
	 * Load config once, on construction
	 *
	 * @throws InvalidArgumentException
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
	 *
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
		Assets::instance()->_add_resource(self::SCRIPT, $names);
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
	 * Include a preset
	 * Presets are groups of assets defined in the config file preset subsection
	 *
	 * @example Assets::instance()->preset('dates');
	 * @example Assets::instance()->preset(array('jquery-ui', 'dates'));
	 * @since 1.4
	 * @static
	 * @param string|array $aliases The alias(es) of the preset
	 * @throws Kohana_Exception
	 * @return Commoneer_Assets
	 */
	public static function preset($aliases)
	{
		$presets = Assets::instance()->_config->get('presets');

		if (! is_array($aliases)) {
			$aliases = array($aliases);
		}

		foreach ($aliases as $alias) {
			if (! array_key_exists($alias, $presets)) {
				throw new Kohana_Exception("Tried to load assets preset ':name', but it's not listed in the Commoneer Assets
				configuration file.", array(':name' => $alias));
			}

			// Loop over all types of assets (style,script) in the preset
			foreach ($presets[$alias] as $type => $values) {
				if (empty($values)) {
					continue;
				}

				// Add assets of this type
				Assets::instance()->_add_resource($type, $values);

			}
		}
		return Assets::instance();
	}

	/**
	 * Add HTML of the appropriate type to the load queue
	 * Example: _add_resource(Assets::STYLE, 'common.less')
	 * would add <style type...> to be included in the HEAD
	 *
	 * @since 1.0
	 * @param string $type One of the asset types (STYLE, SCRIPT)
	 * @param mixed $names A single file or an array of file paths relative to the asset root
	 * @return void
	 */
	private function _add_resource($type, $names)
	{
		if (empty($names)) {
			return;
		}

		if (! is_array($names)) {
			$names = array($names);
		}

		// Add every specified file to the load queue
		foreach ($names as $file) {
			$path = $this->_find_file($type, $file);
			if (! $path) {
				continue;
			}

			if ($this->_config->debug) {
				Kohana::$log->add(Log::DEBUG, 'Adding asset of type ":type", name: :name, path: :path', array(
					':type' => $type,
					':name' => $file,
					':path' => $path
				));
			}

			// Add HTML for including the asset
			switch ($type) {
				case Assets::STYLE:
					$this->_assets[$type][$file] = $path;
					break;
				case  Assets::SCRIPT:
					$this->_assets[$type][$file] = $path;
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
	 * ...and clear the include queue
	 *
	 * @throws InvalidArgumentException
	 * @since 1.0
	 * @param string $type The type of assets to render (script/style)
	 * @return string|null HTML markup
	 */
	private function _render($type = NULL)
	{
		if (! in_array($type, Commoneer_Assets::known())) {
			throw new InvalidArgumentException(__('Unknown asset type for inclusion: :name', array(':name' => $type)));
		}

		$html = NULL;

		// Auto include matching controller/action resource files
		if ($this->_config->auto_include) {
			$file = (Request::current()->directory() ? Request::current()->directory().DIRECTORY_SEPARATOR :
				NULL).Request::current()->controller().DIRECTORY_SEPARATOR.Request::current()->action();
			$file = strtolower($file);
			$this->_add_resource($type, $file);
		}

		// Nothing to render
		if (empty($this->_assets) || ! array_key_exists($type, $this->_assets)) {
			if ($this->_config->debug) {
				Kohana::$log->add(Log::DEBUG, 'Nothing to render for asset type :type!', array(
					':type'=> $type
				));
			}
			return NULL;
		}

		// Render
		if (! empty($this->_assets[$type])) {

			// Implode all assets of $type into a CSV list
			$paths = implode(",", $this->_assets[$type]);

			if ($this->_config->debug) {
				Kohana::$log->add(Log::DEBUG, 'Rendering the following assets: :list. Controller: :controller,
				Action: :action.', array(
					':list'      => $paths,
					':controller'=> Request::current()->controller(),
					':action'    => Request::current()->action()
				));
			}

			// Get the full URI for those assets, piping it thought Minify
			$uri = $this->_get_min_uri($paths);

			// Get a HTML include tag for the assets
			if ($type === self::SCRIPT) {
				$html = '<script type="text/javascript" src="'.$uri.'"></script>';
			} else {
				$html = '<link rel="stylesheet" type="text/css" href="'.$uri.'" />';
			}

			// Reset stack
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
	 * Clears the matching asset queue when done.
	 *
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
	 * Look for the predefined assets first
	 * Search in all defined assets paths
	 *
	 * @throws InvalidArgumentException
	 * @since 1.0
	 * @param string $type Asset type
	 * @param string $file Partial file path
	 * @return bool|string Partial file path for including in the template on success, FALSE on 404
	 */
	private function _find_file($type, $file)
	{
		if (! in_array($type, Commoneer_Assets::known())) {
			throw new InvalidArgumentException(__('Unknown asset type for inclusion: :name', array(':name' => $type)));
		}

		// If the file is an alias to a known asset, get it's path from the config file
		if (array_key_exists($type, $this->_config->assets_paths)) {
			if (array_key_exists($file, $this->_config->known_assets[$type])) {
				return $this->_config->known_assets[$type][$file].'.'.$type;
			}
		}
		// The file isn't predefined, search for it in all predefined asset folders
		if (array_key_exists($type, $this->_config->assets_paths) && ! empty($this->_config->assets_paths[$type])) {
			foreach ($this->_config->assets_paths[$type] as $path) {
				$file_path = $path.$file.'.'.$type;
				if (file_exists(DOCROOT.$file_path)) {

					// Remove configured base_url from the path (for the minify module)
					if ($this->_config->min_base !== NULL) {
						return ltrim($file_path, $this->_config->min_base);
					}
					return $file_path;
				}
			}

		}

		Log::instance()->write(Kohana_Log::ERROR, 'Tried to load asset "'.$file.'", but got error 404.');
		return FALSE;
	}

	/**
	 * Get full URI for the Minify script, with $paths as arguments
	 *
	 * @param string $paths A CSV list of asset paths
	 * @since 2.0
	 * @return string Full URI for $paths
	 */
	private function _get_min_uri($paths)
	{
		$b = $this->_config->min_base === NULL ? NULL : 'b='.$this->_config->min_base.'&';
		$uri = URL::base('http').self::$min_dir.'/'.$b.'f='.$paths;
		return $uri;
	}
}
