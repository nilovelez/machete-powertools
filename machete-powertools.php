<?php
/*
Plugin Name: Machete PowerTools
Plugin URI: https://machetewp.com/powertools/
Description: Machete PowerTools is an upgrade module targeted to WordPress developers and power users. PowerTools adds new features and improves some of the Machete modules you know and love.
Version: 2.0
Author: Nilo Velez
Author URI: http://www.nilovelez.com
License: WTFPL
License URI: http://www.wtfpl.net/txt/copying/
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define ('MACHETE_POWERTOOLS_INIT','ec5287c45f0e70ec22d52e8bcbeeb640');
define ('MACHETE_POWERTOOLS_VERSION','v2.0');
define ('MACHETE_POWERTOOLS_BASE_URL',  plugin_dir_url( __FILE__ ));
define ('MACHETE_POWERTOOLS_BASE_PATH',  plugin_dir_path( __FILE__ ));


register_activation_hook( __FILE__, 'machete_powertools_screen_activate' );

function machete_powertools_screen_activate() {
	set_transient( '_machete_powertools_welcome_redirect', true, 30 );
}


function machete_powertools_do_activation_redirect() {
  if ( ! get_transient( '_machete_powertools_welcome_redirect' ) ) {
    return;
  }
  delete_transient( '_machete_powertools_welcome_redirect' );
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }
  wp_safe_redirect( add_query_arg( array( 'page' => 'machete' ), admin_url( 'admin.php' ) ) );
}
add_action( 'admin_init', 'machete_powertools_do_activation_redirect' );


function machete_powertools_check_machete() {
  $machete_path = 'machete/machete.php';
  if ( ! file_exists(WP_PLUGIN_DIR.'/'.$machete_path)) {

      function machete_powertool_orphan_warning() {
          $install_url = admin_url('plugin-install.php?tab=plugin-information&amp;plugin=machete&amp;TB_iframe=true&amp;width=772&amp;height=435');

          ?>
          <div class="notice notice-info is-dismissible">
            <p><strong>Machete PowerTools Activator</strong> only works if <strong>Machete</strong> is installed and active. <a href="<?php echo $install_url ?>" class="thickbox open-plugin-details-modal" aria-label="Machete" data-title="Machete">Click here to install Machete</a>.</p>
          </div>
          <?php
      }
      add_action( 'admin_notices', 'machete_powertool_orphan_warning' );
  }

}

add_action( 'admin_init',  'machete_powertools_check_machete');