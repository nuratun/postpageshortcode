<?php

/**
  * This is the HTML side of the admin view
  */

?>

<div class="wrap">

    <h1 class="wp-heading-inline">
      <?php echo esc_html( get_admin_page_title() ); ?>
    </h1>

    <hr class="wp-header-end">

    <div class="div-container">
        <p>Select how you want your posts or pages to appear</p>
    </div>

    <form name="pps_display_settings" action="options.php" method="POST">
      <?php settings_fields( 'display_settings_option' ); ?>
      <?php do_settings_sections( 'display_option_section' ); ?>
      <!-- Grab the images -->
      <?php $grid = '/wp-content/plugins/postpageshortcode/admin/images/grid.jpg' ?>
      <?php $masonry = '/wp-content/plugins/postpageshortcode/admin/images/masonry.png' ?>

      <fieldset>
        <legend class="screen-reader-text"><span>Grid</span></legend>
        <div class="field-input-section">
          <img width="100px" src=<?php echo $grid ?> alt="Grid layout" />
            <div>
              <label for="pps_display">
                <input type="radio" class="regular-text" id="grid_option" name="pps_display" value="grid"
                <?php checked( 'grid', get_option( 'pps_display' ) ); ?> /> Grid
              </label>
          </div>
        </div>

        <div class="field-input-section">
          <legend class="screen-reader-text"><span>Masonry</span></legend>
            <img width="100px" src=<?php echo $masonry ?> alt="Masonry layout" />
          <div>
            <label for="pps_display">
              <input type="radio" class="regular-text" id="masonry_option" name="pps_display" value="masonry"
              <?php checked( 'masonry', get_option( 'pps_display' ) ); ?> /> Masonry
            </label>
          </div>
        </div>
      </fieldset>

      <?php submit_button(); ?>
    </form>
</div>
