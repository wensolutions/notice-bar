<?php
/**
 * Admin settings page content.
 *
 * @package Notice_Bar
 */

?>
<div class="wrap" id="nb-settings-wrap">

    <h1><?php esc_html_e( 'Notice Bar', 'notice-bar' ); ?></h1>
    
    <?php if( isset( $_GET['success'] ) && 'true' == $_GET['success'] ) : ?>
    <div id="notice-bar-settings_updated" class="updated settings-error notice is-dismissible"> 
      <p>
        <strong><?php _e( 'Settings saved.', 'notice-bar' ); ?></strong>
      </p>
      <button type="button" class="notice-dismiss">
        <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'notice-bar' ); ?></span>
      </button>
    </div>
    <?php endif; ?>

    <div id="poststuff">

      <div id="post-body" class="metabox-holder columns-2">

        <!-- main content -->
        <div id="post-body-content">

            <div class="meta-box-sortables ui-sortable">

              <div class="postbox">

			    <h3><?php esc_html_e( 'Settings', 'notice-bar' ); ?></h3>
                <div class="inside">

                  <form action="" method="post" id="nb-admin-settings-form">

                    <div class="form-element-wrapper">

                      <label for="nb-status"><?php _e( 'Status', 'notice-bar' ); ?></label>

                      <select name="<?php echo NB_SETTINGS_NAME; ?>[status]" id="nb-status">
                        <option value="enabled" <?php selected( $ws_notice_settings['status'], 'enabled' ); ?>><?php esc_html_e( 'Enabled', 'notice-bar' ); ?></option>
                        <option value="disabled" <?php selected( $ws_notice_settings['status'], 'disabled' ); ?>><?php esc_html_e( 'Disabled', 'notice-bar' ); ?></option>
                      </select>

                    </div><!-- .form-element-wrapper -->

                    <div class="form-element-wrapper">
	                      <label for="nb-theme"><?php esc_html_e( 'Theme', 'notice-bar' ); ?></label>
							<?php
							if ( ! empty( $nb_themes ) ) {

								printf( '<select name="%s"  id="nb-theme">', NB_SETTINGS_NAME . '[theme]' );

								foreach ( $nb_themes as $slug => $theme ) {

									$selected = selected( $ws_notice_settings['theme'], $slug, false );

									printf( '<option value="%s" %s>%s</option>', $slug, $selected, $theme['name'] );

								}

								echo '</select>';
							}
							?>
                    </div><!-- .form-element-wrapper -->

                    <div id="nb-theme-settings-holder">
                      <!-- This area will load theme settings -->
                    </div>
                    
                    <?php wp_nonce_field( 'nb_settings_action', 'nb_settings_nonce_field' ); ?>

                    <input type="submit" name="nb-submit" value="<?php esc_html_e( 'Save', 'notice-bar' ); ?>" class="button-primary" />

                    <input type="button" name="button" value="<?php esc_html_e( 'Preview', 'notice-bar' ); ?>" class="button-secondary" id="preview-theme-settings"/>

                  </form><!-- #nb-admin-settings-form -->

                </div> <!-- .inside -->

              </div> <!-- .postbox -->

            </div> <!-- .meta-box-sortables .ui-sortable -->

        </div> <!-- post-body-content -->

        <!-- sidebar -->
        <div id="postbox-container-1" class="postbox-container">
        <?php include NB_BASE_PATH . '/views/backend/sidebar.php'; ?>
        </div> <!-- #postbox-container-1 .postbox-container -->

      </div> <!-- #post-body .metabox-holder .columns-2 -->

      <br class="clear">
  </div> <!-- #poststuff -->

</div>
<script>
function nb_admin_load_theme_settings(){
  var theme = jQuery("select#nb-theme").val();
  console.log( theme );
  jQuery("#nb-theme-settings-holder").html( 'Loading...' );
  jQuery("#nb-theme-live-demo").html( '' );
  jQuery.post( ajaxurl, {theme:theme,action:'nb_load_theme_settings'}, function( data ){
      var obj = jQuery.parseJSON( data );

      if( 'success' == obj.status ){

        jQuery("#nb-theme-settings-holder").html( obj.data );

      }
      else{

          jQuery("#nb-theme-settings-holder").html( obj.message );

      }
  });
}
nb_admin_load_theme_settings();

function nb_admin_load_theme_preview(){
  var admin_settings = jQuery("form#nb-admin-settings-form").serialize();
  jQuery.post( ajaxurl+"?action=nb_load_theme_preview", admin_settings, function( data ){
      var obj = jQuery.parseJSON( data );

      if( 'success' == obj.status ){

        jQuery("#nb-theme-live-demo").remove();
        jQuery("body.wp-admin").prepend( obj.demo );

      }
      else{
          jQuery("#nb-theme-live-demo").remove();

      }
  });
}
jQuery( function($){
    $("select#nb-theme").change( function(){
        nb_admin_load_theme_settings();
    });
    $("#preview-theme-settings").click( function(){
        nb_admin_load_theme_preview();
    });
});
</script>
