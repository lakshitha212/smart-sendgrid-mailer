<?php
/*
Plugin Name: Smart Sendgrid Mailer
Plugin URI: #
Description: Smart Sendgrid Mailer plugin is a wordpress plugin
Version: 1.0
Author: Lakshitha212
Author URI: https://github.com/lakshitha212
*/
define('SSM_DIR', dirname(__FILE__));
define('SSM_THEMES_DIR', SSM_DIR . "/themes");
define('SSM_URL', WP_PLUGIN_URL . "/" . basename(SSM_DIR));
define('SSM_VERSION', '1.0');
global $jal_db_version;
$ssm_db_version = '1.0';
function ssm_install()
{
    global $wpdb;
    global $ssm_db_version;
    $table_name = $wpdb->prefix . 'smart_sendgrid_mailer';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		api_key text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    add_option('ssm_db_version', $ssm_db_version);
}
register_activation_hook(__FILE__, 'ssm_install');

// register_deactivation_hook(( string $file, callable $callback );
// register_uninstall_hook( string $file, callable $callback );