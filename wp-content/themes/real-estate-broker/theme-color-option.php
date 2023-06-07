<?php

	$real_estate_broker_custom_css ='';

	// slider condition
	$real_estate_realtor_slider_hide = get_theme_mod( 'real_estate_realtor_slider_hide', false);
	if($real_estate_realtor_slider_hide == false){
    	$real_estate_broker_custom_css .='.page-template-home-page #header{';
			$real_estate_broker_custom_css .='position:static; background-color: #18d5eb; padding-bottom:10px';
		$real_estate_broker_custom_css .='} ';
	}

	// slider content spacing
	$real_estate_realtor_slider_content_left_padding = get_theme_mod('real_estate_realtor_slider_content_left_padding');
	$real_estate_broker_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .readbutton{';
		$real_estate_broker_custom_css .='%;left: '.esc_attr($real_estate_realtor_slider_content_left_padding).'%;right: '.esc_attr($real_estate_realtor_slider_content_left_padding).'%;';
	$real_estate_broker_custom_css .='}';

	// slider overlay
	$real_estate_realtor_enable_slider_overlay = get_theme_mod('real_estate_realtor_enable_slider_overlay', true);
	if($real_estate_realtor_enable_slider_overlay == false){
		$real_estate_broker_custom_css .='#slider image{';
			$real_estate_broker_custom_css .='opacity:1;';
		$real_estate_broker_custom_css .='}';
	} 
	$real_estate_realtor_slider_overlay_color = get_theme_mod('real_estate_realtor_slider_overlay_color');
	if($real_estate_realtor_enable_slider_overlay != ''){
		$real_estate_broker_custom_css .='#slider{';
			$real_estate_broker_custom_css .='background-color: '.esc_attr($real_estate_realtor_slider_overlay_color).';';
		$real_estate_broker_custom_css .='}';
	}

	// menu padding
	$real_estate_realtor_menu_padding = get_theme_mod('real_estate_realtor_menu_padding');
	$real_estate_broker_custom_css .='.primary-navigation ul li a{';
		$real_estate_broker_custom_css .='padding: '.esc_attr($real_estate_realtor_menu_padding).'px;';
	$real_estate_broker_custom_css .='}';

	//Theme Color Option
	$real_estate_realtor_first_color = get_theme_mod('real_estate_realtor_first_color');
	$real_estate_broker_custom_css .='.listing-btn a, #scrollbutton i, .postbtn a, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.added_to_cart,.primary-navigation ul li a:before, #sidebar ul li:before, .primary-navigation ul ul a:hover, #header, .pagination a:hover, #sidebar .tagcloud a:hover, .footer-wp .tagcloud a:hover, #sidebar input[type="submit"]:hover, .nav-next a:hover, .nav-previous a:hover, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, input[type="submit"], #popular-properties .tablinks.active, .footer-wp h3:after, .footer-wp input[type="submit"], .footer-wp button, #sidebar button, .copyright-wrapper, .blog-section h2:after, .postbtn a, .pagination .current, #sidebar h3:after, #comments a.comment-reply-link, #comments input[type="submit"].submit, nav.woocommerce-MyAccount-navigation ul li, .metabox i:before {';
		$real_estate_broker_custom_css .='background-color: '.esc_attr($real_estate_realtor_first_color).';';
	$real_estate_broker_custom_css .='}';

	$real_estate_broker_custom_css .='.location-content{';
		$real_estate_broker_custom_css .='background: linear-gradient(0, '.esc_attr($real_estate_realtor_first_color).' 10%, transparent 85%);';
	$real_estate_broker_custom_css .='}';

	$real_estate_broker_custom_css .='#sidebar ul li a:hover, .footer-wp h3, .nav-previous a:hover, .nav-next a:hover, #sidebar .textwidget p a:hover, .footer-wp .textwidget p a, .footer-wp a.rsswidget, .footer-wp li a:hover, #sidebar .custom_read_more a:hover, .footer-wp .custom_read_more a, .navigation.post-navigation a:hover, .metabox a:hover, .blog-section h2 a:hover, td.product-name a:hover, a {';
		$real_estate_broker_custom_css .='color: '.esc_attr($real_estate_realtor_first_color).';';
	$real_estate_broker_custom_css .='}';

	$real_estate_broker_custom_css .='.heading-box, #scrollbutton i {';
			$real_estate_broker_custom_css .='border-color: '.esc_attr($real_estate_realtor_first_color).';';
	$real_estate_broker_custom_css .='}';

	// media
	$real_estate_broker_custom_css .='@media screen and (max-width:1000px) {';
	$real_estate_broker_custom_css .=' .toggle-menu i{';
		$real_estate_broker_custom_css .=' background-color: '.esc_attr($real_estate_realtor_first_color).';';
	$real_estate_broker_custom_css .='} }';

	//Copyright background css
	$real_estate_realtor_copyright_text_background = get_theme_mod('real_estate_realtor_copyright_text_background');
	$real_estate_broker_custom_css .='.copyright-wrapper{';
		$real_estate_broker_custom_css .='background-color: '.esc_attr($real_estate_realtor_copyright_text_background).';';
	$real_estate_broker_custom_css .='}';

	