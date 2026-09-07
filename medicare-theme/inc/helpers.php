<?php
/**
 * Helper functions
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Format price in Vietnamese style (dots as thousands separator)
 */
function medicare_format_price( $price ) {
    if ( empty( $price ) ) return '';
    $clean = preg_replace( '/[^0-9]/', '', $price );
    return number_format( (float) $clean, 0, '', '.' ) . ' VNĐ';
}

/**
 * Get theme option with default
 */
function medicare_get_option( $key, $default = '' ) {
    return get_theme_mod( 'medicare_' . $key, $default );
}

/**
 * Get custom logo URL or fallback
 */
function medicare_logo_url() {
    if ( has_custom_logo() ) {
        $logo_id = get_theme_mod( 'custom_logo' );
        $logo    = wp_get_attachment_image_url( $logo_id, 'full' );
        if ( $logo ) return $logo;
    }
    return MEDICARE_THEME_URI . '/assets/images/header/logo-medicare.svg';
}

/**
 * Get footer logo URL or fallback
 */
function medicare_footer_logo_url() {
    $footer_logo = get_theme_mod( 'medicare_footer_logo' );
    if ( $footer_logo ) return $footer_logo;
    return MEDICARE_THEME_URI . '/assets/images/footer/logo-medicare.svg';
}

/**
 * Check if current page is active in menu
 */
function medicare_is_current_url( $url ) {
    $current = set_url_scheme( home_url( add_query_arg( array() ) ) );
    return $url === $current || trailingslashit( $url ) === trailingslashit( $current );
}

/**
 * Get social links with defaults
 */
function medicare_get_social_links() {
    return array(
        'facebook'  => get_theme_mod( 'medicare_social_facebook', '#' ),
        'youtube'   => get_theme_mod( 'medicare_social_youtube', '#' ),
        'messenger' => get_theme_mod( 'medicare_social_messenger', '#' ),
        'tiktok'    => get_theme_mod( 'medicare_social_tiktok', '#' ),
    );
}

/**
 * Get contact info
 */
function medicare_get_contact_info() {
    return array(
        'working_hours' => get_theme_mod( 'medicare_working_hours', 'Thời gian làm việc: 8.00 AM - 18.00 PM' ),
        'address'       => get_theme_mod( 'medicare_address', 'Số 10 ngõ 4 Pháo Đài Láng, Láng Thượng, Đống Đa, Hà Nội' ),
        'email'         => get_theme_mod( 'medicare_email', 'medicareclinics.hn@gmail.com' ),
        'phone'         => get_theme_mod( 'medicare_phone', '077 8486 888' ),
        'phone_raw'     => get_theme_mod( 'medicare_phone_raw', '0778486888' ),
    );
}
