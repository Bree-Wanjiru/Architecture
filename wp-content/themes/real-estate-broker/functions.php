<?php
/**
 * Theme Functions.
 */

if ( ! function_exists( 'real_estate_broker_setup' ) ) :

/* Theme Setup */
function real_estate_broker_setup() {

	$GLOBALS['content_width'] = apply_filters( 'real_estate_broker_content_width', 640 );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', real_estate_realtor_font_url() ) );

}
endif; 
add_action( 'after_setup_theme', 'real_estate_broker_setup' );

add_action( 'wp_enqueue_scripts', 'real_estate_broker_enqueue_styles' );
function real_estate_broker_enqueue_styles() {
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
	$parent_style = 'real-estate-realtor-basic-style'; // Style handle of parent theme.
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'real-estate-broker-style', get_stylesheet_uri(), array( $parent_style ) );
	require get_parent_theme_file_path( '/theme-color-option.php' );
	wp_add_inline_style( 'real-estate-realtor-basic-style',$real_estate_realtor_custom_css );
	require get_theme_file_path( '/theme-color-option.php' );
	wp_add_inline_style( 'real-estate-broker-style',$real_estate_broker_custom_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/* Theme Widgets Setup */
function real_estate_broker_widgets_init() {
	//Footer widget areas
	$real_estate_realtor_widget_areas = get_theme_mod('footer_widget_areas', '4');
	for ($i=1; $i<=$real_estate_realtor_widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'real-estate-broker' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'real_estate_broker_widgets_init' );

function real_estate_broker_customizer_register() { 
	global $wp_customize;
	$wp_customize->remove_section( 'real_estate_realtor_example_1' );
	$wp_customize->remove_setting( 'real_estate_realtor_second_color' );
	$wp_customize->remove_control( 'real_estate_realtor_second_color' );
} 
add_action( 'customize_register', 'real_estate_broker_customizer_register', 11 );

add_action( 'init', 'real_estate_broker_remove_parent_function');
function real_estate_broker_remove_parent_function() {
	remove_action('admin_notices', 'real_estate_realtor_notice');
	remove_action( 'admin_menu', 'real_estate_realtor_gettingstarted' );
}

// Customizer Section
function real_estate_broker_customizer ( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

   	$wp_customize->add_setting('real_estate_broker_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Real_Estate_Realtor_Icon_Changer(
        $wp_customize,'real_estate_broker_phone_icon',array(
		'label'	=> __('Phone Icon','real-estate-broker'),
		'transport' => 'refresh',
		'section'	=> 'real_estate_realtor_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('real_estate_broker_phone_number',array(
		'default'	=> '',
		'sanitize_callback'	=> 'real_estate_broker_sanitize_phone_number'
	));
	$wp_customize->add_control('real_estate_broker_phone_number',array(
		'label'	=> __('Add Phone Number','real-estate-broker'),
		'section'	=> 'real_estate_realtor_topbar',
		'type'		=> 'text'
	));

	//Location
	$wp_customize->add_section('real_estate_broker_location_section',array(
		'title'	=> __('Location Section','real-estate-broker'),
		'priority' => null,
		'panel' => 'real_estate_realtor_panel_id',
	));

	$wp_customize->add_setting('real_estate_broker_show_location_section',array(
	 'default' => true,
	 'sanitize_callback'	=> 'real_estate_realtor_sanitize_checkbox'
	));
	$wp_customize->add_control('real_estate_broker_show_location_section',array(
	 'type' => 'checkbox',
	 'label' => __('Show / Hide Location Section','real-estate-broker'),
	 'section' => 'real_estate_broker_location_section'
	));

	$wp_customize->add_setting('real_estate_broker_location_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('real_estate_broker_location_section_title',array(
		'label'	=> esc_html__('Section Heading','real-estate-broker'),		
		'section'=> 'real_estate_broker_location_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('real_estate_broker_location_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('real_estate_broker_location_section_text',array(
		'label'	=> esc_html__('Section Text','real-estate-broker'),		
		'section'=> 'real_estate_broker_location_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_posts = array();
	$i = 0;
	$cat_posts[]='Select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('real_estate_broker_location_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'real_estate_realtor_sanitize_choices',
	));
	$wp_customize->add_control('real_estate_broker_location_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Location category ','real-estate-broker'),
		'section' => 'real_estate_broker_location_section',
	));
	
}
add_action( 'customize_register', 'real_estate_broker_customizer' );

function real_estate_broker_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/*--------------section-pro.php part------------------------------*/
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );

class Real_Estate_Broker_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'real-estate-broker';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

/*---------------customizer.php part--------------------------*/
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Real_Estate_Broker_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Real_Estate_Broker_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Real_Estate_Broker_Customize_Section_Pro(
				$manager,
				'real_estate_broker',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Real Estate Broker Pro', 'real-estate-broker' ),
					'pro_text' => esc_html__( 'Go Pro', 'real-estate-broker' ),
					'pro_url'  => esc_url('https://www.buywptemplates.com/themes/real-estate-broker-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */

	public function enqueue_control_scripts() {

		wp_enqueue_script( 'real-estate-broker-customize-controls', get_stylesheet_directory_uri() . '/js/customize-controls-child.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'real-estate-broker-customize-controls', get_stylesheet_directory_uri() . '/css/customize-controls-child.css' );
	}
}

// Doing this customizer thang!
Real_Estate_Broker_Customize::get_instance();

// Find By Location
function real_estate_broker_bn_custom_meta_location() {
    add_meta_box( 'bn_child_meta', __( 'Location Section Feilds', 'real-estate-broker' ), 'real_estate_broker_meta_callback_location', 'post', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'real_estate_broker_bn_custom_meta_location');
}

function real_estate_broker_meta_callback_location( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'real_estate_broker_location_meta_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $noof_property = get_post_meta( $post->ID, 'real_estate_broker_noof_property', true );
    $property_detail = get_post_meta( $post->ID, 'real_estate_broker_property_detail', true );
    $property_price = get_post_meta( $post->ID, 'real_estate_broker_property_price', true );
    ?>
    <div id="testimonials_custom_stuff">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'No. of Properties', 'real-estate-broker' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="real_estate_broker_noof_property" id="real_estate_broker_noof_property" value="<?php echo esc_attr($noof_property); ?>" />
                    </td>
                </tr>
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'Property Detail', 'real-estate-broker' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="real_estate_broker_property_detail" id="real_estate_broker_property_detail" value="<?php echo esc_attr($property_detail); ?>" />
                    </td>
                </tr>
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'Price', 'real-estate-broker' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="real_estate_broker_property_price" id="real_estate_broker_property_price" value="<?php echo esc_attr($property_price); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function real_estate_broker_bn_metadesig_save( $post_id ) {
    if (!isset($_POST['real_estate_broker_location_meta_nonce']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['real_estate_broker_location_meta_nonce']) ), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Property Amount Data
    if( isset( $_POST[ 'real_estate_broker_noof_property' ] ) ) {
        update_post_meta( $post_id, 'real_estate_broker_noof_property', strip_tags( wp_unslash( $_POST[ 'real_estate_broker_noof_property' ]) ) );
    }
    // Save Sale or Rent Data
    if( isset( $_POST[ 'real_estate_broker_property_detail' ] ) ) {
        update_post_meta( $post_id, 'real_estate_broker_property_detail', strip_tags( wp_unslash( $_POST[ 'real_estate_broker_property_detail' ]) ) );
    }
    // Save Bedrooms Data
    if( isset( $_POST[ 'real_estate_broker_property_price' ] ) ) {
        update_post_meta( $post_id, 'real_estate_broker_property_price', strip_tags( wp_unslash( $_POST[ 'real_estate_broker_property_price' ]) ) );
    }
}
add_action( 'save_post', 'real_estate_broker_bn_metadesig_save' );