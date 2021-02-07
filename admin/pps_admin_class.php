<?php
/**
 * The admin class for this plugin that is called in /includes/pps-class.php
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class PPS_Admin {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
      $this->plugin = PPS_NAME;
      $this->version = PPS_VERSION;
   }

   public function register_admin_css() {
     wp_enqueue_style(
       $this->plugin, plugin_dir_url( __FILE__ ) . 'css/styles.css',
       array(),
       PPS_NAME,
       'all'
     );
   }

   public function register_admin_js() {
     wp_enqueue_script(
       $this->plugin,
       plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ),
       PPS_NAME,
       false
     );
   }

   	public function update_display( $input ) {
   		update_option( 'pps_display', $input['display_settings'] );
   	}

    public function admin_add_menu() {
      add_options_page(
        'Post & Page Shortcode',
        'View PPS Settings',
        'manage_options',
        'pps_display_settings',
        array( $this, 'view' )
      );
    }

   	public function admin_init() {
   		add_settings_section(
   		 'display_option_section',
   		 'Display Options',
   		 array( $this, 'view' ),
   		 'pps_display_settings'
   		);

   		register_setting(
   			'display_settings_option',
   			'pps_display'
   		);

   		add_settings_field(
   		 'pps_display',
   		 'Select Display Option',
   		 array( $this, 'view' ),
   		 'pps_display_settings',
   		 'display_option_section'
   		);
   	}

   	function view() {
       include plugin_dir_path(__FILE__) . 'views/page.php';
   	}

}
