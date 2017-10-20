<?php
/*
Plugin Name: Smart Sendgrid Mailer
Plugin URI: #
Description: Smart Sendgrid Mailer plugin is a wordpress plugin
Version: 1.0
Author: Lakshitha212
Author URI: https://github.com/lakshitha212
Domain Path: /languages
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

// register_deactivation_hook( __FILE__, 'pluginprefix_function_to_run' );
// register_uninstall_hook(__FILE__, 'pluginprefix_function_to_run');

add_action('admin_menu', 'ssm_create_menu');

function ssm_create_menu() {
	add_menu_page('SSM Plugin Settings', 'SSM Settings', 'administrator', __FILE__, 'ssm_settings_page');
	add_action( 'admin_init', 'register_ssm_settings' );
}


function register_ssm_settings() {
	register_setting( 'ssm-settings-group', 'ssm_api_key' );
}

function ssm_settings_page() {
?>
<div class="wrap">
<h1>Smart Sendgrid Mailer</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'ssmn-settings-group' ); ?>
    <?php do_settings_sections( 'ssm-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Sendgrid API Key</th>
        <td><input type="text" name="ssm_api_key" value="<?php echo esc_attr( get_option('ssm_api_key') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>

