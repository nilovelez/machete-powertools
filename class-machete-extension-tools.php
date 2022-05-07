<?php
/**
 * Common class for Machete extensions (External modules)
 * v 1.0

 * @package WordPress
 * @subpackage Machete
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class machete_extension_tools {

	public $extension_title = '';

	public function __construct( $title = '' ) {
		if ( ! empty( $title ) ) {
			$this->extension_title = $title;
		}
	}

	public function notice( $message, $level = 'info', $dismissible = true ) {

		$this->notice_message = $message;
		if ( ! in_array( $level, array( 'error', 'warning', 'info', 'success' ) ) ) {
			$level = 'info';
		}
		$this->notice_class = 'notice notice-' . $level;
		if ( $dismissible ) {
			$this->notice_class .= ' is-dismissible';
		}
		add_action( 'admin_notices', array( $this, 'display_notice' ) );
	}

	public function display_notice() {
		if ( ! empty( $this->notice_message ) ) {
			?>
		<div class="<?php echo $this->notice_class; ?>">
		<p><?php echo $this->notice_message; ?></p>
		</div>
			<?php
		}
	}

	public function check_machete_install() {
		if ( ! file_exists( WP_PLUGIN_DIR . '/machete/inc/class-machete.php' ) ) {

			$install_url = admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=machete&amp;TB_iframe=true&amp;width=772&amp;height=435' );

			if ( ! empty( $this->extension_title ) ) {
				$this->notice( '<strong>' . $this->extension_title . '</strong> only works if <strong>Machete 3.0 or higher</strong> is installed and active. <a href="' . $install_url . '" class="thickbox open-plugin-details-modal" aria-label="Machete" data-title="Machete">Click here to install Machete</a>.' );
			} else {
				$this->notice( '<strong>Machete extensions</strong> only work if <strong>Machete 3.0 or higher</strong> is installed and active. <a href="' . $install_url . '" class="thickbox open-plugin-details-modal" aria-label="Machete" data-title="Machete">Click here to install Machete</a>.' );
			}
			return false;
		}

		if ( ! defined( 'MACHETE_BASE_PATH' ) ) {

			$machete_path = 'machete/machete.php';

			$activation_url = wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $machete_path ), 'activate-plugin_' . $machete_path );

			if ( ! empty( $this->extension_title ) ) {

				$this->notice( '<strong>' . $this->extension_title . '</strong> only works if <strong>Machete 3.0 or higher</strong> is installed and active. <a href="' . $activation_url . '" class="thickbox open-plugin-details-modal" aria-label="Machete" data-title="Machete">Click here to Activate Machete</a>.' );
			} else {
				$this->notice( '<strong>Machete extensions</strong> only work if <strong>Machete 3.0 or higher</strong> is installed and active. <a href="' . $activation_url . '" class="thickbox open-plugin-details-modal" aria-label="Machete" data-title="Machete">Click here to Activate Machete</a>.' );
			}
			return false;
		}
		return true;
	}
}
