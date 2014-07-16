<?php
/**
 * Plugin Name: WooCommerce Integration  Demo
 * Plugin URI: https://github.com/BFTrick/woocommerce-integration-demo
 * Description: A plugin demonstrating how to add a new WooCommerce integration.
 * Author: Patrick Rauland
 * Author URI: http://speakinginbytes.com/
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

if ( ! class_exists( 'WC_Integration_Demo' ) ) :

class WC_Integration_Demo {

    /**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;


	/**
	 * Initialize the plugin.
	 */
	private function __construct() {

		// Checks with WooCommerce is installed.
		if ( class_exists( 'WC_Integration' ) ) {
			// Integration classes.
			include_once 'includes/class-wc-integration-demo-integration.php';

			// Register the integration.
			add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );

		} else {
			// throw an admin notice error
		}
	}


	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


	/**
	 * Add a new integration to WooCommerce.
	 */
	public function add_integration( $integrations ) {
		$integrations[] = 'WC_Integration_Demo_Integration';
		return $integrations;
	}

}

add_action( 'plugins_loaded', array( 'WC_Integration_Demo', 'get_instance' ), 0 );

endif;
