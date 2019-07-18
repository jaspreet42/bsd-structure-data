<?php 
/*
  Plugin Name: BSD Structure Data
  Plugin URI:
  Description: Simple WordPress plugin for  Structured Data
  Version: 1.0
  Author: BSD Team
  Author URI:
 */
ob_start();
function installer() {
    include(plugin_dir_path(__FILE__) . 'admin/installer.php');
}
register_activation_hook(__file__, 'installer');
include(plugin_dir_path(__FILE__) . 'admin/settings.php');
include(plugin_dir_path(__FILE__) . '/header_scripts.php');
include(plugin_dir_path(__FILE__) . '/all_shortcodes.php');
include(plugin_dir_path(__FILE__) . 'admin/LocalBusiness/nap-address-functions.php');
include(plugin_dir_path(__FILE__) . 'admin/LocalBusiness/page-options-meta-boxes.php');
/* * ***************
 * Load Admin js & Styles
 */
function add_plugin_styles_plugin() {

    wp_register_style('plugin_style', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('plugin_style');
     
}
add_action('admin_init', 'add_plugin_styles_plugin');
function media_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script('media-uploader', plugins_url('media-uploader.js', __FILE__), array('jquery'));
    wp_enqueue_script('media-uploader');
    wp_enqueue_script( 'mytabs',  plugins_url('/admin/js/mytabs.js', __FILE__),  array( 'jquery-ui-tabs' ) );
   
}
add_action('admin_enqueue_scripts', 'media_uploader_enqueue');
/* * ***************
 * Load  js & Styles in theme
 */
function add_plugin_styles_theme() {
    wp_register_script('plugin_theme_script', plugins_url('admin/js/custom.js', __FILE__));
    wp_enqueue_script('plugin_theme_script');
    wp_register_style('plugin_theme_style', plugins_url('header_style.css', __FILE__));
    wp_enqueue_style('plugin_theme_style');
}
add_action('init', 'add_plugin_styles_theme');
ob_clean();


class Smashing_Updater {
  protected $file;
  protected $plugin;
  protected $basename;
  protected $active;

  public function __construct( $file ) {
    $this->file = $file;
    add_action( 'admin_init', array( $this, 'set_plugin_properties' ) );
    return $this;
  }

  public function set_plugin_properties() {
    $this->plugin   = get_plugin_data( $this->file );
    $this->basename = plugin_basename( $this->file );
    $this->active   = is_plugin_active( $this->basename );
  }
}


private $username;
private $repository;
private $authorize_token;
private $github_response;

public function set_username( $username ) {
  $this->username = $username;
}
public function set_repository( $repository ) {
  $this->repository = $repository;
}
public function authorize( $token ) {
  $this->authorize_token = $token;
}

// Include our updater file
include_once( plugin_dir_path( __FILE__ ) . 'update.php');

$updater = new Smashing_Updater( __FILE__ ); // instantiate our class
$updater->set_username( 'jaspreet42' ); // set username
$updater->set_repository( 'bsd-structure-data' ); // set repo
