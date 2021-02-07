<?php
/**
 * The main class for this plugin
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class PostPageShortcode {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
  		$this->plugin = PPS_NAME;
      $this->version = PPS_VERSION;
  	}


  	/**
  	 * Register all the other classes in this plugin
  	 *
  	 * @since    0.1
  	 */
  	private function other_classes() {
      require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/pps_admin_class.php' );
      require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'public/pps_public_class.php' );
  	}

  	/**
  	 * Register all the admin related stuff
  	 *
  	 * @since    0.1
  	 */
  	private function admin_side() {
      $admin_side = new PPS_Admin();

  		add_action( 'admin_enqueue_scripts', array( $admin_side, 'register_admin_css' ) );
  		add_action( 'admin_enqueue_scripts', array( $admin_side, 'register_admin_js' ) );

      add_action( 'admin_menu', array( $admin_side, 'admin_add_menu' ) );
      add_action( 'admin_init', array( $admin_side, 'admin_init' ) );
  	}


  	/**
  	 * Register all the public related stuff
  	 *
  	 * @since    0.1
  	 */
  	private function public_side() {
      $public_side = new PPS_Public();

  		add_action( 'wp_enqueue_scripts', array( $public_side, 'register_public_css' ) );
  		add_action( 'wp_enqueue_scripts', array( $public_side, 'register_public_js' ) );

      add_shortcode( 'pps_shortcode', array( $public_side, 'add_shortcode' ) );

  	}

    /**
     * @since    0.1
     */
    public function run() {
      $this->other_classes();
      $this->admin_side();
      $this->public_side();
    }

}
