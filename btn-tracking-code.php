<?php
/**
 * Plugin Name: BTN Tracking Code
 * Plugin URI: https://businesstechninjas.com
 * Description: Add tracking code on the site.
 * Version: 1.0
 * Author: Business Tech Ninjas
 * Author URI: https://businesstechninjas.com
 */


 // If this file is called directly, abort.
 if (! defined('ABSPATH')) {
 	header('HTTP/1.0 403 Forbidden');
 	die();
 }

// Set Constants
define('BTN_TC_VERSION', '1.0');
$btn_tc = plugins_url( '', __FILE__ );
define('BTN_TC_URL', $btn_tc . '/');

add_action('admin_menu', 'tracking_code_create_menu');
function tracking_code_create_menu() {
	add_menu_page( __( 'Tracking Code', 'btn-tracking-code' ), 'Tracking Code', 'manage_options', 'btn-tracking-code', 'tracking_code_settings_page', 'dashicons-media-code'  );
	add_action( 'admin_init', 'register_tracking_code_settings' );
}


add_action('admin_enqueue_scripts', 'tc_enqueue_scripts');
function tc_enqueue_scripts( $hook ){

    if( $hook === 'toplevel_page_btn-tracking-code' ){
        $url = BTN_TC_URL . 'tracking-code.js';
        $v = BTN_TC_VERSION;
        wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
        wp_enqueue_script('btn-tracking-code-js', $url, array('jquery'), $v, 'all');

    }
}

function register_tracking_code_settings() {
  register_setting( 'tracking-code-settings-group', 'tracking_wp_head_content' );
  register_setting( 'tracking-code-settings-group', 'tracking_opening_content' );
  register_setting( 'tracking-code-settings-group', 'tracking_closing_content' );
}

function tracking_code_settings_page() {
?>
<h1>Tracking Code</h1>
<form method="post" action="options.php">
    <?php settings_fields( 'tracking-code-settings-group' ); ?>
    <?php do_settings_sections( 'tracking-code-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
          <th scope="row">Head Tracking Code</th>
          <td colspan='3'><textarea id="tracking_wp_head_content"  name="tracking_wp_head_content"><?php echo esc_attr( get_option('tracking_wp_head_content') ); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row">After Opening Body</th>
          <td colspan='3'><textarea  id="tracking_opening_content"  name="tracking_opening_content"><?php echo esc_attr( get_option('tracking_opening_content') ); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row">Footer</th>
          <td colspan='3'><textarea  id="tracking_closing_content" name="tracking_closing_content"><?php echo esc_attr( get_option('tracking_closing_content') ); ?></textarea></td>
        </tr>
    </table>

    <?php submit_button(); ?>

</form>


<?php }


//Add Head Tracking Code
add_action("wp_head", "btn_wp_head");
function btn_wp_head(){
  if(!empty(get_option('tracking_wp_head_content'))){
      echo get_option('tracking_wp_head_content');
  }
}

//Opening Body Tracking Code
add_action("wp_body_open", "btn_wp_body_open");
function btn_wp_body_open(){
  if(!empty(get_option('tracking_opening_content'))){
      echo get_option('tracking_opening_content');
  }
}


//After Closing Body Tracking Code
add_action("wp_footer", "btn_wp_footer");
function btn_wp_footer(){
  if(!empty(get_option('tracking_closing_content'))){
      echo get_option('tracking_closing_content');
  }
}
