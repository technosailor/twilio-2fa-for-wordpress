<?php
namespace Technosailor\Twilio\Rest;

use WP_REST_Request;
use WP_REST_Server;

class Two_Factor {

	const NAME = 'two-factor-authentication';

	public function register_routes() {
		register_rest_route( 'twilio', '/two-factor-auth/(?P<user_id>\d+)/(?P<auth_token>[a-zA-Z0-9]+)', [
			[
				'methods'   => WP_REST_Server::CREATABLE,
				'callback'  => [ $this, 'two_factor_auth' ],
			]
		] );
	}

	public function two_factor_auth( WP_REST_Request $request ) {
		$user_id = $request->get_param( 'user_id' );
		$auth_token = $request->get_param( 'auth_token' );

		wp_send_json_success();
	}
}