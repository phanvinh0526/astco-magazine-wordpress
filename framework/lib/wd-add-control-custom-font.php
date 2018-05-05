<?php
/**
 * Customizer Font Control class
 *
 * Display fonts combobox on WP Customizer
 */
function tvlgiao_wpdance_register_customizer_control_font( $wp_customize ){
	/*
	* 	Failsafe is safe
	*/
	if ( ! isset( $wp_customize ) ) {
		return;
	}
	/**
	 * Create a Font Control control
	 * 
	 */
	class Tvlgiao_Wpdance_Custom_Font_Control extends WP_Customize_Control{
		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'wpdance_font';
		/**
		 * Enqueue scripts and styles for the custom control.
		 * 
		 *
		 * @access public
		*/
		public function enqueue() {
			wp_register_style('tvlgiao-wpdance-customizer', TVLGIAO_WPDANCE_THEME_CSS.'/wd_customize.css', array());
			wp_enqueue_style('tvlgiao-wpdance-customizer');
		}
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			} ?>
			<span class="customize-control-title">
				<?php echo esc_attr( $this->label ); ?>
				<?php if (!empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</span>
			<div id="input_<?php echo esc_attr($this->id); ?>">
				<select <?php $this->link(); ?>>
					<optgroup label="<?php esc_html_e("Web Fonts", 'wpdance'); ?>">
						<?php global $tvlgiao_wpdance_font_web; ?>
						<?php foreach ( $tvlgiao_wpdance_font_web as $value_font_size => $label_font_size ) : ?>
							<option <?php selected( $value_font_size, get_the_ID() ) ?> value="<?php echo esc_attr( $value_font_size ); ?>"><?php echo esc_html( $label_font_size ); ?></option>
						<?php endforeach; ?>						
					</optgroup>
					<optgroup label="<?php esc_html_e("Google Fonts", 'wpdance'); ?>">
						<?php foreach ( $this->choices as $value => $label ) : ?>
							<option <?php selected( $this->value(), get_the_ID() ) ?> value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</optgroup>
				</select>
			</div>
			<?php			
		}

	}	
}
// Settings API options initilization and validation
add_action( 'customize_register', 'tvlgiao_wpdance_register_customizer_control_font' );
?>