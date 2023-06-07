<?php
/**
 * Theme functions and definitions
 *
 * @package Beauty Spa Salon
 */

/**
 * After setup theme hook
 */
function beauty_spa_salon_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'beauty-spa-salon', get_stylesheet_directory() . '/languages' );	
	require get_stylesheet_directory() . '/inc/customizer/beauty-spa-salon-customizer-options.php';
}
add_action( 'after_setup_theme', 'beauty_spa_salon_theme_setup' );

/**
 * Load assets.
 */

function beauty_spa_salon_theme_css() {
	wp_enqueue_style( 'beauty-spa-salon-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('beauty-spa-salon-child-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('beauty-spa-salon-default-css', get_stylesheet_directory_uri() . "/assets/css/theme-default.css" );
    wp_enqueue_style('beauty-spa-salon-bootstrap-smartmenus-css', get_stylesheet_directory_uri() . "/assets/css/bootstrap-smartmenus.css" ); 	
}
add_action( 'wp_enqueue_scripts', 'beauty_spa_salon_theme_css', 99);

/**
 * Import Options From Parent Theme
 *
 */
function beauty_spa_salon_parent_theme_options() {
	$consultstreet_mods = get_option( 'theme_mods_consultstreet' );
	if ( ! empty( $consultstreet_mods ) ) {
		foreach ( $consultstreet_mods as $consultstreet_mod_k => $consultstreet_mod_v ) {
			set_theme_mod( $consultstreet_mod_k, $consultstreet_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'beauty_spa_salon_parent_theme_options' );

/**
 * Fresh site activate
 *
 */
$fresh_site_activate = get_option( 'fresh_beauty_spa_salon_site_activate' );
if ( (bool) $fresh_site_activate === false ) {
	
	set_theme_mod( 'consultstreet_main_slider_overlay_disable', true );
	set_theme_mod( 'consultstreet_menu_container_size', 'container' );
	set_theme_mod( 'consultstreet_footer_container_size', 'container' );
	set_theme_mod( 'consultstreet_top_header_container_size', 'container' );
	set_theme_mod( 'consultstreet_typography_disabled', true );
	set_theme_mod( 'consultstreet_theme_color', 'theme-tickle-me-pink' );
	set_theme_mod( 'consultstreet_main_header_style', 'classic' );
	set_theme_mod( 'consultstreet_typography_h1_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_h2_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_h3_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_h4_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_h5_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_h6_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_typography_widget_title_font_family', 'Merienda' );
	set_theme_mod( 'consultstreet_blog_layout', 'consultstreet_blog_layout2' );

	update_option( 'fresh_beauty_spa_salon_site_activate', true );
}

/**
 * Page header
 *
 */
function beauty_spa_salon_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'beauty_spa_salon_custom_header_args', array(
		'default-image'      => get_stylesheet_directory_uri().'/assets/img/page-header.jpg',
		'default-text-color' => '#000',
		'width'              => 1920,
		'height'             => 650,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'beauty_spa_salon_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'beauty_spa_salon_custom_header_setup' );

function beauty_spa_salon_custom_customizer_options() { 
$consultstreet_main_slider_content_color = get_theme_mod('consultstreet_main_slider_content_color', '#fff');
?>
    <style type="text/css">
		<?php if($consultstreet_main_slider_content_color != null) : ?>
		.theme-slider-content .title-large{ color: <?php echo $consultstreet_main_slider_content_color; ?>;}
		.theme-slider-content .description{ color: <?php echo $consultstreet_main_slider_content_color; ?>;}
		<?php endif; ?>
   </style>
<?php }
add_action('wp_footer','beauty_spa_salon_custom_customizer_options');

/**
 * Custom background
 *
 */
function beauty_spa_salon_custom_background_setup() {
	add_theme_support( 'custom-background', apply_filters( 'beauty_spa_salon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'beauty_spa_salon_custom_background_setup' );


if ( ! function_exists( 'beauty_spa_salon_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see beauty_spa_salon_custom_header_setup().
	 */
	function beauty_spa_salon_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?> !important;
			}

			<?php endif; ?>
		</style>
		<?php
	}
endif;