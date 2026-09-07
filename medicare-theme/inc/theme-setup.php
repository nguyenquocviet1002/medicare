<?php
/**
 * Theme Setup
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function medicare_setup() {
    // Title tag support
    add_theme_support( 'title-tag' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'hero-slide', 1920, 800, true );
    add_image_size( 'service-card', 600, 400, true );
    add_image_size( 'combo-card', 400, 300, true );
    add_image_size( 'before-after', 500, 350, true );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 48,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Register nav menus
    register_nav_menus( array(
        'primary'   => esc_html__( 'Menu chính', 'medicare-clinic' ),
        'footer'    => esc_html__( 'Menu chân trang', 'medicare-clinic' ),
    ) );

    // Custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
}
add_action( 'after_setup_theme', 'medicare_setup' );

/**
 * Register widget areas
 */
function medicare_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'medicare-clinic' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'medicare-clinic' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'medicare_widgets_init' );
