<?php

/**
 *
 * Uninstall script
 *
 * This file contains all the logic required to uninstall the plugin
 *
 */


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;

// machete powertool options:
delete_option('machete_powertools_settings');