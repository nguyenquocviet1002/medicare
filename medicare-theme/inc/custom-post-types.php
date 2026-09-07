<?php
/**
 * Custom Post Types & Taxonomies
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function medicare_register_cpts() {

    /* ==========================================================
       1. SERVICE (Dịch Vụ Buổi Lẻ)
       ========================================================== */
    register_post_type( 'service', array(
        'labels'       => array(
            'name'               => 'Dịch Vụ Buổi Lẻ',
            'singular_name'      => 'Dịch Vụ',
            'add_new_item'       => 'Thêm Dịch Vụ mới',
            'edit_item'          => 'Chỉnh sửa Dịch Vụ',
            'all_items'          => 'Tất cả Dịch Vụ',
            'search_items'       => 'Tìm kiếm Dịch Vụ',
            'not_found'          => 'Không tìm thấy Dịch Vụ',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-calendar-alt',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'dich-vu' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'service_category', 'service', array(
        'labels'       => array(
            'name'          => 'Loại Dịch Vụ',
            'singular_name' => 'Loại Dịch Vụ',
            'add_new_item'  => 'Thêm Loại mới',
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'loai-dich-vu' ),
        'show_in_rest' => true,
    ) );

    /* ==========================================================
       2. TREATMENT (Liệu Trình)
       ========================================================== */
    register_post_type( 'treatment', array(
        'labels'       => array(
            'name'               => 'Liệu Trình',
            'singular_name'      => 'Liệu Trình',
            'add_new_item'       => ' thêm Liệu Trình mới',
            'edit_item'          => 'Chỉnh sửa Liệu Trình',
            'all_items'          => 'Tất cả Liệu Trình',
            'search_items'       => 'Tìm kiếm Liệu Trình',
            'not_found'          => 'Không tìm thấy Liệu Trình',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-clipboard',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'lieu-trinh' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'treatment_category', 'treatment', array(
        'labels'       => array(
            'name'          => 'Nhóm Liệu Trình',
            'singular_name' => 'Nhóm Liệu Trình',
            'add_new_item'  => 'Thêm Nhóm mới',
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'nhom-lieu-trinh' ),
        'show_in_rest' => true,
    ) );

    /* ==========================================================
       3. CFU_TREATMENT (CFU ÈLIFE)
       ========================================================== */
    register_post_type( 'cfu_treatment', array(
        'labels'       => array(
            'name'               => 'CFU ÈLIFE',
            'singular_name'      => 'Dịch Vụ CFU',
            'add_new_item'       => ' thêm Dịch Vụ CFU mới',
            'edit_item'          => 'Chỉnh sửa Dịch Vụ CFU',
            'all_items'          => 'Tất cả Dịch Vụ CFU',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-star-filled',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'cfu-eliffe' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'cfu_category', 'cfu_treatment', array(
        'labels'       => array(
            'name'          => 'Nhóm CFU',
            'singular_name' => 'Nhóm CFU',
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'nhom-cfu' ),
        'show_in_rest' => true,
    ) );

    /* ==========================================================
       4. COMBO
       ========================================================== */
    register_post_type( 'combo', array(
        'labels'       => array(
            'name'               => 'Combo',
            'singular_name'      => 'Combo',
            'add_new_item'       => 'Thêm Combo mới',
            'edit_item'          => 'Chỉnh sửa Combo',
            'all_items'          => 'Tất cả Combo',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons bundles',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'combo' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'combo_type', 'combo', array(
        'labels'       => array(
            'name'          => 'Loại Combo',
            'singular_name' => 'Loại Combo',
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'loai-combo' ),
        'show_in_rest' => true,
    ) );

    /* ==========================================================
       5. PRODUCT (Sản Phẩm Tiêm)
       ========================================================== */
    register_post_type( 'product', array(
        'labels'       => array(
            'name'               => 'Sản Phẩm Tiêm',
            'singular_name'      => 'Sản Phẩm',
            'add_new_item'       => ' thêm Sản Phẩm mới',
            'edit_item'          => 'Chỉnh sửa Sản Phẩm',
            'all_items'          => 'Tất cả Sản Phẩm',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-superhero',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'san-pham-tiem' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'product_category', 'product', array(
        'labels'       => array(
            'name'          => 'Dòng Sản Phẩm',
            'singular_name' => 'Dòng Sản Phẩm',
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'dong-san-pham' ),
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'medicare_register_cpts' );

/**
 * Flush rewrite rules on theme activation
 */
function medicare_rewrite_flush() {
    medicare_register_cpts();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'medicare_rewrite_flush' );
