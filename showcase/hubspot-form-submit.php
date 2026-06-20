<?php
/**
 * Showcase: Server-side HubSpot Forms API proxy
 *
 * Custom HTML forms submit via WordPress AJAX → HubSpot API.
 * No embed scripts — pixel-perfect frontend preserved.
 *
 * @author Muhammad Hamid
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Submit form data to HubSpot (adds visitor IP + tracking cookie).
 *
 * @param string $portal_id HubSpot portal ID (store in wp_options / ACF — not in repo).
 * @param string $form_guid Published HubSpot form GUID.
 * @param array  $fields    [ ['name' => 'email', 'value' => '...'], ... ]
 * @param array  $context   pageUri, pageName, hutk, ipAddress.
 */
function demo_hubspot_submit( $portal_id, $form_guid, $fields, $context = array() ) {
	$url = sprintf(
		'https://api.hsforms.com/submissions/v3/integration/submit/%s/%s',
		preg_replace( '/\D+/', '', $portal_id ),
		sanitize_text_field( $form_guid )
	);

	$response = wp_remote_post(
		$url,
		array(
			'timeout' => 15,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode(
				array(
					'fields'  => $fields,
					'context' => $context,
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$code = (int) wp_remote_retrieve_response_code( $response );
	if ( $code < 200 || $code >= 300 ) {
		return new WP_Error( 'hubspot_error', wp_remote_retrieve_body( $response ) );
	}

	return true;
}
