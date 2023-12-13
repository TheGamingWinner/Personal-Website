<?php
/**
 * Enqueue scripts and styles.
 */
function author_personal_blog_slider_pages(){
	$sliderPage = false;
	if (is_home()) {
		$sliderPage = true;
	}elseif(class_exists('WooCommerce') && is_product()){
		$sliderPage = true;
	}

	return $sliderPage;
}

function author_personal_blog_scripts() {
	$isMasonryActivated = get_theme_mod('active_masonry_layout', true);
	$isBookSliderActivated = get_theme_mod('books_slider_on_off', false);
	if ( (is_home() && true == $isBookSliderActivated) || class_exists('WooCommerce') && is_product()) {
		wp_enqueue_style( 'slick', esc_url(get_theme_file_uri( 'assets/css/slick.css' )) );
	}
	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
		wp_enqueue_style( 'author-personal-blog-woocommerce', esc_url(get_theme_file_uri( 'assets/css/woocommerce.css' )) );
	}
	if (class_exists('Rswpbs') && true == $isBookSliderActivated ) {
		wp_enqueue_style( 'author-personal-blog-rswpbs', esc_url(get_theme_file_uri( 'assets/css/rswpbs.css' )) );
	}
	wp_enqueue_style( 'author-personal-blog-style', get_stylesheet_uri() );
	$default_social_links_colors =  array(
        'icon_bg_color'   => '#ffffff',
        'icon_text_color'  => '#fb4747',
        'icon_bg_h_color' => '#fb4747',
        'icon_text_h_color' => '#ffffff',
    );
	$about_section_social_links_colors = get_theme_mod('about_section_social_links_colors', $default_social_links_colors);

	$inline_style_data = '
		.about-section-social-links .social-link a{
		'.( array_key_exists('icon_bg_color', $about_section_social_links_colors) ? 'background-color:' . $about_section_social_links_colors['icon_bg_color'] : '').';
		'.( array_key_exists('icon_text_color', $about_section_social_links_colors) ? 'color:' . $about_section_social_links_colors['icon_text_color'] : '').';
	}
	.about-section-social-links .social-link a:hover, .about-section-social-links .social-link a:active{
		'.( array_key_exists('icon_bg_h_color', $about_section_social_links_colors) ? 'background-color:' . $about_section_social_links_colors['icon_bg_h_color'] : '').';
		'.( array_key_exists('icon_text_h_color', $about_section_social_links_colors) ? 'color:' . $about_section_social_links_colors['icon_text_h_color'] : '').';
	}
	';
	wp_add_inline_style('author-personal-blog-style', $inline_style_data);
	if ( (is_home() || is_archive()) && true == $isMasonryActivated) :
		wp_enqueue_script( 'imagesloaded', esc_url( get_template_directory_uri() ) . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'masonry' );
	endif;
	wp_enqueue_script( 'author-personal-blog-menu', esc_url( get_template_directory_uri() ) . '/assets/js/menu.js', array( 'jquery' ), '1.0', true );
	if ( (is_home() && true == $isBookSliderActivated) || class_exists('WooCommerce') && is_product()) {
		wp_enqueue_script( 'slick', esc_url( get_template_directory_uri() ) . '/assets/js/slick.js', array( 'jquery' ), '1.0', true );
	}
	wp_enqueue_script( 'author-personal-blog-active', esc_url( get_template_directory_uri() ) . '/assets/js/active.js', array( 'jquery' ), '1.0', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'author_personal_blog_scripts' );

add_action('customize_controls_enqueue_scripts', 'author_personal_blog_customizer_scripts');
function author_personal_blog_customizer_scripts(){
	wp_enqueue_style('customizer-style', esc_url(get_theme_file_uri('assets/customizer/customizer-style.css')));
}

add_action('enqueue_block_editor_assets', 'author_personal_blog_global_scripts');
add_action('wp_enqueue_scripts', 'author_personal_blog_global_scripts');

function author_personal_blog_global_scripts(){
	wp_enqueue_style( 'bootstrap-grid', esc_url(get_theme_file_uri( 'assets/css/bootstrap-grid.css' )) );
	wp_enqueue_style( 'fontawesome-v4', esc_url(get_theme_file_uri( 'assets/css/fontawesome.css' )) );
	wp_enqueue_style( 'block-style', esc_url(get_theme_file_uri( 'assets/blocks-style/block-styles.css' )) );
}

/**
 * Conditional Script
 */

add_action('wp_print_footer_scripts', 'author_personal_blog_print_scripts');
function author_personal_blog_print_scripts(){
	$showBookSlider = get_theme_mod('books_slider_on_off', false);
	if (is_home() && true == $showBookSlider) :
		?>
		<script type="text/javascript" id="author-personal-blog-book-slider">
			var booksSliders = jQuery('.books-slider-active');
		    booksSliders.each(function(index) {
		        var slideToShow = jQuery(this).attr('data-slideToshow');
		        jQuery(this).slick({
		            slidesToShow: slideToShow,
		            slidesToScroll: 1,
		            autoplay: true,
		            arrows: true,
		            fade: false,
		            nextArrow: '<div class="slick-next"><i class="fa fa-arrow-right"></i></div>',
		            prevArrow: '<div class="slick-prev"><i class="fa fa-arrow-left"></i></div>',
		            responsive: [{
		                    breakpoint: 1024,
		                    settings: {
		                        slidesToShow: 3,
		                    }
		                },
		                {
		                    breakpoint: 600,
		                    settings: {
		                        slidesToShow: 2,
		                    }
		                },
		                {
		                    breakpoint: 480,
		                    settings: {
		                        slidesToShow: 1,
		                        adaptiveHeight: true
		                    }
		                }
		            ]
		        });
		    });
		</script>
    <?php
	endif;
	/**
	 * Print Below Script if its woocommerce product page
	 */
	if (class_exists('WooCommerce') && is_product()) {
		?>
		<script type="text/javascript" id="author-personal-blog-product-page-sliders">
			$('.active-single-gallery').slick({
		        slidesToShow: 1,
		        slidesToScroll: 1,
		        arrows: true,
		        fade: true,
		        asNavFor: '.active-thumbnail-gallery',
		        nextArrow: '<div class="slick-next"><i class="fa fa-arrow-right"></i></div>',
		        prevArrow: '<div class="slick-prev"><i class="fa fa-arrow-left"></i></div>',
		    });
		    $('.active-thumbnail-gallery').slick({
		        slidesToShow: 3,
		        slidesToScroll: 1,
		        asNavFor: '.active-single-gallery',
		        dots: false,
		        centerMode: true,
		        focusOnSelect: true,
		        arrows: true,
		        nextArrow: '<div class="slick-next"><i class="fa fa-arrow-right"></i></div>',
		        prevArrow: '<div class="slick-prev"><i class="fa fa-arrow-left"></i></div>',
		    });
			jQuery('.active-product-related-post-slider').slick({
		        slidesToShow: 4,
		        slidesToScroll: 1,
		        dots: false,
		        arros: true,
		        centerMode: false,
		        focusOnSelect: true,
		        nextArrow: '<div class="slick-next"><i class="fa fa-arrow-right"></i></div>',
		        prevArrow: '<div class="slick-prev"><i class="fa fa-arrow-left"></i></div>',
		    });
		</script>
		<?php
	}
}

