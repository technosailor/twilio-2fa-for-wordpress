<?php
namespace Technosailor\Twilio;

use Technosailor\Twilio\Rest\Two_Factor;
use Technosailor\Twilio\User\Profile;
use WP_User;

class Init {

	protected static $_instance;

	protected $providers = [];

	public function init() {
		$this->register_providers();
	}

	public function register_providers() {
		$this->providers[ Two_Factor::NAME ] = new Two_Factor();
		$this->providers[ Profile::NAME ] = new Profile();

		$this->rest_api();
		$this->users();
	}

	public function rest_api() {
		add_action( 'rest_api_init', function() {
			$this->providers[ Two_Factor::NAME ]->register_routes();
		} );
	}

	public function users() {
		$callback = function( WP_User $user ) {
			$this->providers[ Profile::NAME ]->register_meta_phone_field( $user );
			$this->providers[ Profile::NAME ]->register_meta_2fa_field( $user );
		};

		add_action( 'show_user_profile', $callback );
		add_action( 'edit_user_profile', $callback );
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