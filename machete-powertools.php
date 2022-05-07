<?php
/**
 * Plugin Name: Machete PowerTools
 * Plugin URI: https://machetewp.com/powertools/
 * Description: Machete PowerTools is an upgrade module targeted to WordPress developers and power users. PowerTools adds new features and improves some of the Machete modules you know and love.
 * Version: 4.0
 * Author: Nilo Velez
 * Author URI: http://www.nilovelez.com
 * License: WTFPL
 * License URI: http://www.wtfpl.net/txt/copying/

 * @package WordPress
 * @subpackage Machete-Powertools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'MACHETE_POWERTOOLS_INIT', 'ec5287c45f0e70ec22d52e8bcbeeb640' );
define( 'MACHETE_POWERTOOLS_VERSION', 'v4.0' );
define( 'MACHETE_POWERTOOLS_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'MACHETE_POWERTOOLS_BASE_PATH', plugin_dir_path( __FILE__ ) );

register_activation_hook(
	__FILE__,
	function() {
		add_option( 'machete_activation_welcome', 'pending' );
	}
);

if ( ! class_exists( 'machete_extension_tools' ) ) {
	require 'class-machete-extension-tools.php';
}

add_action(
	'init',
	function() {
		global $machete;
		global $machete_extension_tools;

		$machete_extension_tools = new machete_extension_tools( 'Machete PowerTools Activator' );

		if ( ! $machete_extension_tools->check_machete_install() ) {
			return;
		}

	}
);
