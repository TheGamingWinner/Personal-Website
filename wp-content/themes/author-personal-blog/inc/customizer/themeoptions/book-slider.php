<?php
Kirki::add_section( 'books_slider_settings', array(
    'title'          => esc_html__( 'Books Slider Settings', 'author-personal-blog' ),
    'description'          => esc_html__( 'This slider will appear on the blog page below the about section.', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_book_settings_panel',
) );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'switch',
    'settings'    => 'books_slider_on_off',
    'label'       => esc_html__( 'Show Book Slider', 'author-personal-blog' ),
    'section'     => 'books_slider_settings',
    'default'     => '0',
    'choices'     => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' ),
    ],
] );
Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'number',
	'settings'    => 'books_per_page',
	'label'       => esc_html__( 'Post Per Page', 'author-personal-blog' ),
	'section'     => 'books_slider_settings',
	'default'    => 5,
] );
Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'number',
	'settings'    => 'slide_to_show',
	'label'       => esc_html__( 'Slide To Show', 'author-personal-blog' ),
	'section'     => 'books_slider_settings',
	'default'    => 4,
] );
Kirki::add_field( 'author_portfolio_pro_config', [
    'type'        => 'custom',
    'settings'    => 'book_section_title_sep',
    'section'     => 'books_slider_settings',
    'default'         => '<h3 style="text-align:center;padding:10px 10px; background:#fff; margin:0;">' . __( 'Section Title', 'author-personal-blog' ) . '</h3>',
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'book_section_title_on_off',
    'label'       => esc_html__( 'Section Title On//Off', 'author-personal-blog' ),
    'section'     => 'books_slider_settings',
    'default'     => '0',
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'text',
    'settings'    => 'book_section_title',
    'label'       => esc_html__( 'Book Section Title', 'author-personal-blog' ),
    'section'     => 'books_slider_settings',
    'default'     => __('Read My Books', 'author-personal-blog'),
] );