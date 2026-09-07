<?php
/**
 * Enqueue scripts and styles
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function medicare_enqueue_assets() {
    $version = MEDICARE_THEME_VERSION;
    $uri     = MEDICARE_THEME_URI;

    // ── Global Styles (normalize, tokens, grid) ──
    wp_enqueue_style( 'medicare-global', $uri . '/assets/css/global.min.css', array(), $version );

    // ── Header Styles ──
    wp_enqueue_style( 'medicare-header', $uri . '/assets/css/header.min.css', array(), $version );

    // ── Footer Styles ──
    wp_enqueue_style( 'medicare-footer', $uri . '/assets/css/footer.min.css', array(), $version );

    // ── Page-specific Styles ──
    if ( is_front_page() ) {
        wp_enqueue_style( 'medicare-home', $uri . '/assets/css/home.min.css', array(), $version );
    }

    if ( is_page( 'dich-vu-buoi-le' ) ) {
        wp_enqueue_style( 'medicare-buoi-le', $uri . '/assets/css/buoi-le.min.css', array(), $version );
    }

    if ( is_page( 'dich-vu-lieu-trinh' ) ) {
        wp_enqueue_style( 'medicare-lieu-trinh', $uri . '/assets/css/lieu-trinh.min.css', array(), $version );
    }

    if ( is_page( 'cfu-eliffe' ) ) {
        wp_enqueue_style( 'medicare-cfu', $uri . '/assets/css/cfu.min.css', array(), $version );
    }

    if ( is_page( 'combo' ) ) {
        wp_enqueue_style( 'medicare-combo', $uri . '/assets/css/combo.min.css', array(), $version );
    }

    if ( is_page( 'san-pham' ) ) {
        wp_enqueue_style( 'medicare-san-pham', $uri . '/assets/css/san-pham.min.css', array(), $version );
    }

    if ( is_page( 'gio-hang' ) ) {
        wp_enqueue_style( 'medicare-cart', $uri . '/assets/css/cart.min.css', array(), $version );
    }

    // ── Header JS (mobile drawer) ──
    wp_enqueue_script( 'medicare-header-js', $uri . '/assets/js/header.js', array(), $version, true );

    // ── Page-specific JS ──
    if ( is_front_page() ) {
        wp_enqueue_script( 'medicare-scroll-reveal', $uri . '/assets/js/scroll-reveal.js', array(), $version, true );
        wp_enqueue_script( 'medicare-hero-slider', $uri . '/assets/js/hero-slider.js', array(), $version, true );
        wp_enqueue_script( 'medicare-about-counters', $uri . '/assets/js/about-counters.js', array(), $version, true );
        wp_enqueue_script( 'medicare-services-slider', $uri . '/assets/js/services-slider.js', array(), $version, true );
        wp_enqueue_script( 'medicare-results-slider', $uri . '/assets/js/results-slider.js', array(), $version, true );
        wp_enqueue_script( 'medicare-compare-sliders', $uri . '/assets/js/compare-sliders.js', array(), $version, true );
        wp_enqueue_script( 'medicare-journey-gallery', $uri . '/assets/js/journey-gallery.js', array(), $version, true );
    }

    if ( is_page( array( 'dich-vu-buoi-le', 'dich-vu-lieu-trinh', 'cfu-eliffe', 'combo', 'san-pham' ) ) ) {
        wp_enqueue_script( 'medicare-scroll-reveal', $uri . '/assets/js/scroll-reveal.js', array(), $version, true );
        wp_enqueue_script( 'medicare-tabs', $uri . '/assets/js/tabs.js', array(), $version, true );
    }

    // ── Cart JS (load on all pages for badge + toast) ──
    wp_enqueue_script( 'medicare-cart', $uri . '/assets/js/cart.js', array(), $version, true );

    // Localize script for AJAX/cart
    wp_localize_script( 'medicare-cart', 'medicareData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'themeUri' => $uri,
        'homeUrl' => home_url( '/' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'medicare_enqueue_assets' );
