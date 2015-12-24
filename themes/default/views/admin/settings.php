<?php
/**
 * Theme's backend settings.
 *
 * @package Notice_Bar
 */

?>
<div class="form-element-wrapper">
	<label for="nb_theme_default_settings_message"><?php esc_attr_e( 'Message', 'notice-bar' ); ?></label>
	<input type="text" name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][message]" value="<?php echo esc_attr( $theme_settings['message'] ); ?>" id="nb_theme_default_settings_message" />
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Position', 'notice-bar' ); ?></label>
	<select name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][position]" id="theme_default_settings_position">
		<option value="top" <?php selected( $theme_settings['position'], 'top' ); ?>>Top Absolute</option>
		<option value="top-fixed" <?php selected( $theme_settings['position'], 'top-fixed' ); ?>>Top Fixed</option>
		<option value="bottom" <?php selected( $theme_settings['position'], 'bottom' ); ?>>Bottom</option>
	</select>
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Button Label', 'notice-bar' ); ?></label>
	<input type="text"  name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][button_label]" value="<?php echo $theme_settings['button_label']; ?>" id="theme_default_settings_button_label" />
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Button Link', 'notice-bar' ); ?></label>
	<input type="text"  name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][button_link]"  value="<?php echo $theme_settings['button_link']; ?>"/>
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Button Target', 'notice-bar' ); ?></label>
	<select name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][button_target]">
		<option value="_self" <?php selected( $theme_settings['button_target'], '_self' ); ?>><?php _e( 'Same window', 'notice-bar' ); ?></option>
		<option value="_blank" <?php selected( $theme_settings['button_target'], '_blank' ); ?>><?php _e( 'New window', 'notice-bar' ); ?></option>
	</select>
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Background Color', 'notice-bar' ); ?></label>
	<input type="text"  name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][background_color]"  value="<?php echo $theme_settings['background_color']; ?>"  class="nb-default-color-field"  data-default-color="#dd3333" id="theme_default_settings_bg_color" />
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Font Color', 'notice-bar' ); ?></label>
	<input type="text"  name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][font_color]"  value="<?php echo $theme_settings['font_color']; ?>"  class="nb-default-color-field"  data-default-color="#ffffff" id="theme_default_settings_font_color" />
</div>

<div class="form-element-wrapper">
	<label><?php _e( 'Font Size', 'notice-bar' ); ?></label>
	<input type="number"  name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][font_size]"  value="<?php echo ( isset( $theme_settings['font_size'] ) )?$theme_settings['font_size']:12; ?>"  class="nb-default-font-size-field" id="theme_default_settings_font_size" />
</div>

<div class="form-element-wrapper">
	<label for="nb-default-bar-control"><?php _e( 'Hide/Close Button', 'notice-bar' ); ?></label>
	<select name="<?php echo NB_SETTINGS_NAME; ?>[theme_default_settings][bar_control]" id="nb-default-bar-control">
		<option value="always" <?php selected( $theme_settings['bar_control'], 'always' );?>><?php _e( 'No Button', 'notice-bar' ); ?></option>
		<option value="dismiss" <?php selected( $theme_settings['bar_control'], 'dismiss' );?>><?php _e( 'Toggle Button', 'notice-bar' ); ?></option>
		<option value="close" <?php selected( $theme_settings['bar_control'], 'close' );?>><?php _e( 'Close Button', 'notice-bar' ); ?></option>
	</select>
</div>

<script type="text/javascript">
jQuery( function( $ ){
	$(".nb-default-color-field").wpColorPicker();

	// $("#theme_default_settings_font_color").wpColorPicker();

	// $("#theme_default_settings_bg_color").wpColorPicker({
	// 	change: function(event,ui){
	// 		// $("#nb-theme-live-demo .nb-default-wrap").css('backgroundColor',ui.color.toString()  );
	// 	}
	// });

	// $("#theme_default_settings_font_color").wpColorPicker({
	// 	change: function(event,ui){
	// 		// $("#nb-theme-live-demo .nb-default-wrap").css('color',ui.color.toString()  );
	// 	}
	// });

	// $(".nb-default-color-field").wpColorPicker();
	/*$("body").on('keyup', "#nb_theme_default_settings_message", function(){
		var message = $(this).val();
		$("#nb-theme-live-demo .nb-default-wrap .default-message").text( message );
	});
	$("body").on('keyup', "#theme_default_settings_button_label", function(){
		var button_text = $(this).val();
		$("#nb-theme-live-demo .nb-default-wrap .default-button").show();
		if( ''== button_text)
			$("#nb-theme-live-demo .nb-default-wrap .default-button").hide();
		$("#nb-theme-live-demo .nb-default-wrap .default-button").text( button_text );
	});
	$("body").on('keyup', "#theme_default_settings_button_label", function(){
		var button_text = $(this).val();
		$("#nb-theme-live-demo .nb-default-wrap .default-button").text( button_text );
	});

	$("body").on('change', "#theme_default_settings_position", function(){
		var position = $(this).val();

		if( 'top' == position ){
			$("#nb-default-position-top-fixed").slideDown('slow');
		}
		else{
			$("#nb-default-position-top-fixed").slideUp('slow');
		}

		var class_name = ('top'==position)?"nb-defult-postion-top":"nb-defult-postion-bottom";
		$("#nb-theme-live-demo .nb-default-wrap").removeClass( 'nb-defult-postion-top' ).removeClass('nb-defult-postion-bottom');
		$("#nb-theme-live-demo .nb-default-wrap").addClass( class_name );
	});

	$("body").on( "click","#nb-default-position-top-fixed input", function(){
		if( $(this).is(":checked" ) ){
			$(".nb-default-wrap").addClass("nb-defult-postion-fixed");
		}
		else{

			$(".nb-default-wrap").removeClass("nb-defult-postion-fixed");
		}
	});

	var bar_control = $('input.nb-bar-control:checked').val();
	if( 'always' == bar_control ){
		$("span.nb-close").hide();
		$("span.nb-arrow-up").hide();
	}
	if( 'close' == bar_control ){
		$("span.nb-arrow-up").hide('fast', function(){

		$("span.nb-close").show("slow");
	});
	}
	if( 'dismiss' == bar_control ){
		$("span.nb-close").hide('fast', function(){

		$("span.nb-arrow-up").show("slow");
	});
	}
	$("body").on('click','input.nb-bar-control', function(){
		var bar_control = $(this).val();
		if( 'always' == bar_control ){
			$("span.nb-close").fadeOut();
			$("span.nb-arrow-up").fadeOut();
		}
		if( 'close' == bar_control ){
			$("span.nb-arrow-up").fadeOut('fast', function(){

			$("span.nb-close").fadeIn("slow");
		});
		}
		if( 'dismiss' == bar_control ){
			$("span.nb-close").fadeOut('fast', function(){

			$("span.nb-arrow-up").fadeIn("slow");
		});
		}
	})*/
	// $("body").on('keyup', "#theme_default_settings_font_color", function(){
	// 	var color = $(this).val();
	// 	alert( color );
	// 	$("#nb-theme-live-demo .nb-default-wrap").css({
	// 	colro: color} );
	// });


});
</script>
