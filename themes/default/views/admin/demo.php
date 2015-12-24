<?php
/**
 * Theme's backend demo.
 *
 * @package Notice_Bar
 */

<div class="nb-default-wrap <?php echo ( 'top' === $theme_settings['position'])?"nb-defult-postion-top":"nb-defult-postion-bottom"; ?>" style="background-color:<?php echo esc_url( $theme_settings['background_color'] ); ?>;color:<?php echo esc_url( $theme_settings['font_color'] ); ?>">
	<span class="default-message">
		<?php echo $theme_settings['message']; ?>
	</span>
	<a href="<?php echo esc_url( $theme_settings['button_link'] ); ?>" target="<?php echo esc_attr( $theme_settings['button_target'] ); ?>" class="default-button"><?php echo esc_attr( $theme_settings['button_label'] ); ?></a>
	<span class="nb-arrow nb-arrow-up"></span>
	<span class="nb-arrow nb-arrow-down" style="display:none;"></span>
	<span class="nb-close" style="display:none;"></span>
</div><!-- .nb-default-wrap -->
