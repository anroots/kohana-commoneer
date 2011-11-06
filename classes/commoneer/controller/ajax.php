<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Provides AJAX functionality
 *
 * Every response has a bare minimum of 2 attributes (unless specifically denied):
 * json.status, which is a numeric status code and json.response, containing any textual data
 *
 * @since 1.1
 * @abstract
 * @package Commoneer
 * @category Controller
 * @author Ando Roots 2011
 */
abstract class Commoneer_Controller_Ajax extends Commoneer_Controller_Template
{


	// Will be returned as JSON.status
	const STATUS_OK             = 200;
	const STATUS_ERROR          = -1;
	const STATUS_BAD_REQUEST    = 400;
	const STATUS_UNAUTHORIZED   = 401;

	/**
	 * Whether to use the 'bare' response format,
	 * that is to say: don't include json.status and json.response
	 * Some plugins, such as the jQuery UI autocomplete need this
	 * @var bool
	 */
	protected $_bare = FALSE;

	/**
	 * Output a JSON response
	 *
	 * @since 1.1
	 * @param mixed $data Either an assoc array or status code
	 * @param string $message The message to respond with, empty when not using the shorthand
	 * @return void
	 */
	public function respond($data = array(), $message = NULL)
	{
		if (!$this->_bare) {

			// The long format input with assoc array data
			if (is_array($data)) {
				if (!array_key_exists('status', $data)) {
					$data['status'] = self::STATUS_OK;
				}

				if (!array_key_exists('response', $data)) {
					$data['response'] = NULL;
				}

			} else { // Shorthand: CODE, MESSAGE
				$data = array('status' => $data, 'response' => $message);
			}
		}
		// Return the JSON data.
		$this->response->headers('Content-Type','application/json');
		$this->response->body(json_encode($data));

		// Exit with proper encoding and JSON body
		die($this->response->send_headers()->body());
	}
}