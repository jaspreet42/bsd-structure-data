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


public function initialize() {
  add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'modify_transient' ), 10, 1 );
  add_filter( 'plugins_api', array( $this, 'plugin_popup' ), 10, 3);
  add_filter( 'upgrader_post_install', array( $this, 'after_install' ), 10, 3 );
}

// Include our updater file
include_once( plugin_dir_path( __FILE__ ) . 'update.php');

$updater = new Smashing_Updater( __FILE__ ); // instantiate our class
$updater->set_username( 'jaspreet42' ); // set username
$updater->set_repository( 'bsd-structure-data' ); // set repo
$updater->initialize(); // initialize the updater

public function modify_transient( $transient ) {

  if( property_exists( $transient, 'checked') ) { // Check if transient has a checked property
    if( $checked = $transient->checked ) { // Did WordPress check for updates?
      $this->get_repository_info(); // Get the repo info
      $out_of_date = version_compare( $this->github_response['tag_name'], $checked[$this->basename], 'gt' ); // Check if we're out of date
      if( $out_of_date ) {
        $new_files = $this->github_response['zipball_url']; // Get the ZIP
        $slug = current( explode('/', $this->basename ) ); // Create valid slug
        $plugin = array( // setup our plugin info
          'url' => $this->plugin["PluginURI"],
          'slug' => $slug,
          'package' => $new_files,
          'new_version' => $this->github_response['tag_name']
        );
        $transient->response[ $this->basename ] = (object) $plugin; // Return it in response
      }
    }
  }
  return $transient; // Return filtered transient
}
