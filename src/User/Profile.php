<?php

namespace Technosailor\Twilio\User;

use WP_User;

class Profile {

	const NAME = 'user-profile';

	const META_PHONE      = 'twilio_sms_phone';
	const META_ENABLE_2FA = 'twilio_enable_2fa';

	public function register_meta_phone_field( WP_User $user ) {

		$phone = get_user_meta( $user->ID, self::META_PHONE, true );
		?>
		<table class="form-table">
			<tbody>
			<tr>
				<th><label for="<?php echo esc_attr( self::META_PHONE ) ?>">Phone Number</th>
				<td>
					<input name="<?php echo esc_attr( self::META_PHONE ) ?>" type="text" id="<?php echo esc_attr( self::META_PHONE ) ?>" value="<?php echo $phone ?>" class="regular-text">
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	public function register_meta_2fa_field( WP_User $user ) {

		$two_factor_enabled = get_user_meta( $user->ID, self::META_ENABLE_2FA, true );
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="<?php echo esc_attr( self::META_ENABLE_2FA ) ?>">Enable 2FA</th>
					<td>
						<input name="<?php echo esc_attr( self::META_ENABLE_2FA ) ?>" type="checkbox" id="<?php echo esc_attr( self::META_ENABLE_2FA ) ?>" <?php checked( $two_factor_enabled, "1", true ) ?>>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

}