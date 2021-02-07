<?php
/**
 * The public class for this plugin that is called in /includes/pps-class.php
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class PPS_Public {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
      $this->plugin = PPS_NAME;
      $this->version = PPS_VERSION;
   }

   public function register_public_css() {
     wp_enqueue_style(
       $this->plugin, plugin_dir_url( __FILE__ ) . 'css/styles.css',
       array(),
       PPS_NAME,
       'all'
     );
   }

   public function register_public_js() {
     wp_enqueue_script(
       $this->plugin,
       plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ),
       PPS_NAME,
       false
     );
   }

   /**
 	 * Get the display option from the db
 	 *
 	 * @since    0.1
 	 */
 	public static function get_display_option() {
 		// The date should have been saved in the wp_options database by the user
 		// Otherwise, return a default empty array
 		return get_option( 'pps_display', array() );
 	}

  /**
  * Create the shortcode with a user attribute for post type
  *
  * @since    0.1
  */
   public function add_shortcode( $atts ) {
     $code = shortcode_atts( array(
       'type' => 'post',
     ), $atts );

      $shortcode = esc_html( $code['type'] );

      return $this->return_pps( $shortcode );
   }

   /**
   * Return the posts in either grid or masonry styling
   *
   * @since    0.1
   */
   public function return_pps( $input ) {
     // Get the user selected display option from the settings page
     $display_option = $this->get_display_option();

     // For the pagination
     $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

     $args = array(
       'post_type' => $input,
       'post_status' => 'publish',
       'posts_per_page' => 10,
       'paged'  => $paged
     );

     $return_posts_pages = new WP_Query( $args );

     // If there are posts for this post type...
     if ( $return_posts_pages->have_posts() ) :

       // ...start the container for the entire grid/masonry
       echo '<div class="' . $display_option . '_container">';

         while ( $return_posts_pages->have_posts() ) : $return_posts_pages->the_post();

         // For each item
         echo '<div class="' . $display_option . '_list">';

         if ( has_post_thumbnail() ) {
            echo '<div class="' . $display_option . '_list">';
            the_post_thumbnail();
            echo '</div>';
          }

          echo '<div class="title">';
          echo '<a href="' . get_permalink() . '" title="Read">';
          the_title();
          echo '</a>';
          echo '</div>';

          echo '<div class="' . $display_option . '_excerpt"><p>';
          the_excerpt();
          echo '</p></div>';

          echo '<div class="' . $display_option . '_date">' . get_the_date() . '</div>';

          echo '</div>';

        endwhile; // exit the loop
        echo '</div>'; // End of container

        // Start the pagination
        echo '<div class="pagination">';
          previous_posts_link( '&laquo; Back' );
          next_posts_link( 'Next Page &raquo;', $return_posts_pages->max_num_pages );
        echo '</div>';

        wp_reset_postdata();

    endif; // Exit the if statement
   }

}
