<?php
/**
 * Plugin Name: WP Plugin Singleton
 * Description: A WordPress plugin boilerplate use singleton pattern.
 * Plugin URI: http://truongwp.com/wp-plugin-singleton
 * Author: Truongwp
 * Author URI: http://truongwp.com
 * Version: 1.0
 * License: GPL2
 * Text Domain: wp-plugin-singleton
 * Domain Path: languages
 *
 * @package WP_Plugin_Singleton
 */

/*
Copyright (C) 2016  Truongwp  truongwp@gmail.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'WP_PLUGIN_SINGLETON_VERSION' ) ) {
	return;
}

define( 'WP_PLUGIN_SINGLETON_VERSION', '1.0.0' );
define( 'WP_PLUGIN_SINGLETON_FILE', __FILE__ );
define( 'WP_PLUGIN_SINGLETON_PATH', plugin_dir_path( WP_PLUGIN_SINGLETON_FILE ) );
define( 'WP_PLUGIN_SINGLETON_URL', plugin_dir_url( WP_PLUGIN_SINGLETON_FILE ) );

register_activation_hook( WP_PLUGIN_SINGLETON_FILE, array( 'WP_Plugin_Singleton', 'activate' ) );
register_deactivation_hook( WP_PLUGIN_SINGLETON_FILE, array( 'WP_Plugin_Singleton', 'deactivate' ) );

/**
 * Class WP_Plugin_Singleton
 */
final class WP_Plugin_Singleton {

	/**
	 * Plugin instance.
	 *
	 * @var WP_Plugin_Singleton
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return WP_Plugin_Singleton
	 * @static
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		$this->includes();

		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load plugin function files here.
	 */
	public function includes() {
	}

	/**
	 * Code you want to run when all other plugins loaded.
	 */
	public function init() {
		load_plugin_textdomain( 'wp-plugin-singleton', false, WP_PLUGIN_SINGLETON_PATH . 'languages' );
	}

	/**
	 * Run when activate plugin.
	 */
	public static function activate() {
	}

	/**
	 * Run when deactivate plugin.
	 */
	public static function deactivate() {
	}
}

function wp_plugin_singleton() {
	return WP_Plugin_Singleton::get_instance();
}

$GLOBALS['wp_plugin_singleton'] = wp_plugin_singleton();
