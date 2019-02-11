<?php
namespace Technosailor\Twilio;

use Technosailor\Twilio\Rest\Two_Factor;

class Init {

	protected static $_instance;

	protected $providers = [];

	public function init() {
		$this->register_providers();
	}

	public function register_providers() {
		$this->providers[ Two_Factor::NAME ] = new Two_Factor();

		$this->rest_api();
	}

	public function rest_api() {
		add_action( 'rest_api_init', function() {
			$this->providers[ Two_Factor::NAME ]->register_routes();
		} );
	}

	/**
	 * Singleton only allows the loading of the namespace once.
	 *
	 * @return Init
	 * @throws \Exception
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			$className       = __CLASS__;
			self::$_instance = new $className();
		}
		return self::$_instance;
	}
}