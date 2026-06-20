<?php
/**
 * Showcase: Safe WordPress content editing pattern
 *
 * Layout stays in PHP partials. Admin edits text via ACF — never full-section HTML.
 * This snippet is sanitized for public demo; not client production code.
 *
 * @author Muhammad Hamid
 * @link   https://github.com/muhammad-hamid-jamil
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get field value with fallback to hardcoded default in the template.
 */
function demo_field( $name, $default = '', $post_id = null ) {
	if ( function_exists( 'get_field' ) && $post_id ) {
		$value = get_field( $name, $post_id );
		if ( null !== $value && false !== $value && '' !== $value ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Echo plain text safely.
 */
function demo_text( $name, $default = '' ) {
	echo esc_html( demo_field( $name, $default ) );
}

// In template partials — layout never changes, only the string:
// <h1><?php demo_text( 'hero_heading', 'Expand Your Business Globally' ); ?></h1>
