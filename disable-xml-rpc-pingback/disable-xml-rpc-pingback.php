<?php
/**
 * Plugin Name: Disable XML-RPC Pingback
 * Description: Stops abuse of your site's Pingback method from XML-RPC by simply removing it. While you can use the rest of XML-RPC methods.
 * Author: Samuel Aguilera
 * Version: 1.2.2
 * Author URI: http://www.samuelaguilera.com
 * License: GPL2
 *
 * @package Disable XML-RPC Pingback
 */

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

add_filter( 'xmlrpc_methods', 'sar_block_xmlrpc_attacks' );

/**
 * Unset XML-RPC Methods.
 *
 * @param array $methods Array of current XML-RPC methods.
 */
function sar_block_xmlrpc_attacks( $methods ) {
	unset( $methods['pingback.ping'] );
	unset( $methods['pingback.extensions.getPingbacks'] );
	return $methods;
}

/**
 * Check WP version.
 */
if ( version_compare( get_bloginfo( 'version' ), '4.4', '>=' ) ) {

	add_action( 'wp', 'sar_remove_x_pingback_header_44', 9999 );

	/**
	 * Remove X-Pingback from Header for WP 4.4+.
	 */
	function sar_remove_x_pingback_header_44() {
		header_remove( 'X-Pingback' );
	}
} elseif ( version_compare( get_bloginfo( 'version' ), '4.4', '<' ) ) {

	add_filter( 'wp_headers', 'sar_remove_x_pingback_header' );

	/**
	 * Remove X-Pingback from Header for older WP versions.
	 *
	 * @param array $headers Array with current headers.
	 */
	function sar_remove_x_pingback_header( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
}
