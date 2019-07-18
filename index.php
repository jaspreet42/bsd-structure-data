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


class BFIGitHubPluginUpdater {
 
    private $slug; // plugin slug
    private $pluginData; // plugin data
    private $username="jaspreet42"; // GitHub username
    private $repo="bsd-structure-data"; // GitHub repo name
    private $pluginFile; // __FILE__ of our plugin
    private $githubAPIResult; // holds data from GitHub
    private $accessToken; // GitHub private repo token
 
    function __construct( $pluginFile, $gitHubUsername, $gitHubProjectName, $accessToken = '' ) {
        add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );
        add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );
        add_filter( "upgrader_post_install", array( $this, "postInstall" ), 10, 3 );
 
        $this->pluginFile = $pluginFile;
        $this->username = $gitHubUsername;
        $this->repo = $gitHubProjectName;
        $this->accessToken = $accessToken;
    }
 
    // Get information regarding our plugin from WordPress
    private function initPluginData() {
        // code here
      $this->slug = plugin_basename( $this->pluginFile );
$this->pluginData = get_plugin_data( $this->pluginFile );
    }
 
    // Get information regarding our plugin from GitHub
    private function getRepoReleaseInfo() {
       / Only do this once
if ( ! empty( $this->githubAPIResult ) ) {
    return;
}
      
     // Query the GitHub API
$url = "https://api.github.com/repos/{$this->username}/{$this->repo}/releases";
 
// We need the access token for private repos
if ( ! empty( $this->accessToken ) ) {
    $url = add_query_arg( array( "access_token" => $this->accessToken ), $url );
}
 
// Get the results
$this->githubAPIResult = wp_remote_retrieve_body( wp_remote_get( $url ) );
if ( ! empty( $this->githubAPIResult ) ) {
    $this->githubAPIResult = @json_decode( $this->githubAPIResult );
} 
      
     // Use only the latest release
if ( is_array( $this->githubAPIResult ) ) {
    $this->githubAPIResult = $this->githubAPIResult[0];
} 
      
    }
 
    // Push in plugin version information to get the update notification
    public function setTransitent( $transient ) {
      // If we have checked the plugin data before, don't re-check
if ( empty( $transient->checked ) ) {
    return $transient;
}
      // Get plugin & GitHub release information
$this->initPluginData();
$this->getRepoReleaseInfo();
      // Check the versions if we need to do an update
$doUpdate = version_compare( $this->githubAPIResult->tag_name, $transient->checked[$this->slug] );
      
      // Update the transient to include our updated plugin data
if ( $doUpdate == 1 ) {
    $package = $this->githubAPIResult->zipball_url;
 
    // Include the access token for private GitHub repos
    if ( !empty( $this->accessToken ) ) {
        $package = add_query_arg( array( "access_token" => $this->accessToken ), $package );
    }
 
    $obj = new stdClass();
    $obj->slug = $this->slug;
    $obj->new_version = $this->githubAPIResult->tag_name;
    $obj->url = $this->pluginData["PluginURI"];
    $obj->package = $package;
    $transient->response[$this->slug] = $obj;
}
 
return $transient;
      
      
      
      
    }
 
    // Push in plugin version information to display in the details lightbox
    public function setPluginInfo( $false, $action, $response ) {
        // code ehre
        return $response;
    }
 
    // Perform additional actions to successfully install our plugin
    public function postInstall( $true, $hook_extra, $result ) {
        // code here
        return $result;
    }
}
