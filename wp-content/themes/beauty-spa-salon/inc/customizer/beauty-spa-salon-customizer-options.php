<?php
/**
 * Customizer section options.
 *
 * @package beauty-spa-salon
 *
 */

function beauty_spa_salon_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'consultstreet_footer_copright_text',
			array(
				'sanitize_callback' =>  'beauty_spa_salon_sanitize_text',
				'default' => __('Copyright &copy; 2023 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> Beauty Spa Salon theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'beauty-spa-salon'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('consultstreet_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','beauty-spa-salon'),
				'section' => 'consultstreet_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));

}
add_action( 'customize_register', 'beauty_spa_salon_customizer_theme_settings' );

function beauty_spa_salon_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}