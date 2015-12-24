<?php
/**
 * Theme's front end view.
 *
 * @package Notice_Bar
 */

$extra_class = '';
if ( isset( $theme_settings['position'] ) ) {
	switch ( $theme_settings['position'] ) {
		case 'top':
			$extra_class = 'nb-defult-postion-top';
			break;
		case 'top-fixed':
			$extra_class = 'nb-defult-postion-top-fixed';
			break;
		case 'bottom':
			$extra_class = 'nb-defult-postion-bottom';
			break;
		default:
			break;
	}
}

if ( isset( $theme_settings['bar_control'] ) ) {
	switch ( $theme_settings['bar_control'] ) {
		case 'always':
			$extra_class .= ' nb-default-always';
			break;
		case 'dismiss':
			$extra_class .= ' nb-default-dismiss';
			break;
		case 'close':
			$extra_class .= ' nb-default-close';
			break;
		default:
			break;
	}
}

$styles = '';

// Background color.
if ( isset( $theme_settings['background_color'] ) && ! empty( $theme_settings['background_color'] ) ) {
	$styles .= 'background-color:' . esc_attr( $theme_settings['background_color'] ) . ';';
}

// Color.
if ( isset( $theme_settings['font_color'] ) && ! empty( $theme_settings['font_color'] ) ) {
	$styles .= 'color:' . esc_attr( $theme_settings['font_color'] ) . ';';
}

// Font size.
if ( isset( $theme_settings['font_size'] ) && ! empty( $theme_settings['font_size'] ) ) {
	$styles .= 'font-size:' . intval( $theme_settings['font_size'] ) . 'px;';
}
?>
<div class="nb-default-wrap <?php echo ( ! empty( $extra_class ) ) ? esc_attr( $extra_class ) : '' ; ?>">

    <div class="nb-default-inner"  <?php echo ( ! empty( $styles ) ) ? ' style="'. esc_attr( $styles ) . '"' : '' ; ?>>

        <?php if ( isset( $theme_settings['message'] ) && ! empty( $theme_settings['message'] ) ) : ?>
           <span class="default-message"><?php echo $theme_settings['message']; ?></span>
        <?php endif ?>
        <?php if ( isset( $theme_settings['button_label'] ) && ! empty( $theme_settings['button_label'] ) ) : ?>
        <?php
			$button_url = ( isset( $theme_settings['button_link'] ) && ! empty( $theme_settings['button_link'] ) ) ? esc_url( $theme_settings['button_link'] ) : '#' ;
			$button_target = '';
			$button_target = ( isset( $theme_settings['button_target'] ) && '_blank' === $theme_settings['button_target'] ) ? ' target="_blank"' : '' ;
		?>
        <a href="<?php echo esc_url( $button_url ); ?>" <?php echo esc_attr( $button_target ); ?> class="default-button"><?php echo esc_html( $theme_settings['button_label'] ); ?></a>
        <?php endif; ?>
        <?php if ( 'bottom' !== $theme_settings['position'] &&  isset( $theme_settings['bar_control'] ) && 'dismiss' === $theme_settings['bar_control'] ) : ?>
          <span class="nb-arrow nb-arrow-up"></span>
        <?php elseif ( isset( $theme_settings['bar_control'] ) && 'dismiss' === $theme_settings['bar_control'] ) : ?>
          <span class="nb-arrow nb-arrow-down"></span>
        <?php endif; ?>
			<?php if ( isset( $theme_settings['bar_control'] ) && 'close' === $theme_settings['bar_control'] ) : ?>
             <span id="nb-default-close" class="nb-close"></span>
			<?php endif; ?>
   </div><!-- .nb-default-inner -->

	<?php if ( 'bottom' !== $theme_settings['position'] && isset( $theme_settings['bar_control'] ) && 'dismiss' === $theme_settings['bar_control'] ) : ?>

       <span class="nb-arrow nb-arrow-down" style="display:none;"></span>

	<?php elseif ( isset( $theme_settings['bar_control'] ) && 'dismiss' === $theme_settings['bar_control'] ) : ?>

          <span class="nb-arrow nb-arrow-up" style="display:none;"></span>

    <?php endif; ?>

</div><!-- .nb-default-wrap -->
