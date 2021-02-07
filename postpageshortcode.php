<?php
/**
 *
 * @link              https://www.urlhere.com
 * @since             0.1
 *
 * Plugin Name: Posts & Pages Shortcode
 * Description: This shortcode: [pps_shortcode type="post/page/custom"]  allows you to add a number of recent posts or pages in grid or masonry format anywhere on your site.
 * Version: 1.7
 * Author: Noora Chahine
 * Author URI: http://www.github.com/nuratun
 * Wordpress Version: 5.4 and above
**/

if ( !defined( 'ABSPATH' ) ) die;

define( 'PPS_VERSION', '1.7' );
define( 'PPS_NAME', 'Posts Pages Shortcode' );

// The core plugin file
require( plugin_dir_path( __FILE__ ) . 'includes/pps-class.php' );

function run_PPS() {
	$plugin = new PostPageShortcode();
	$plugin->run();
}

run_PPS();
