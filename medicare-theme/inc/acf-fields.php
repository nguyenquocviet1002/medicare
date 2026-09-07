<?php
/**
 * ACF Field Groups (registered via PHP, no ACF UI needed)
 * Requires Advanced Custom Fields Pro plugin
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

/* ==========================================================
   FIELD GROUP: Service (Buổi Lẻ)
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_service',
    'title'    => 'Thông Tin Dịch Vụ',
    'fields'   => array(
        array(
            'key'          => 'field_service_benefits',
            'label'        => 'Tác Dụng',
            'name'         => 'benefits',
            'type'         => 'textarea',
            'rows'         => 4,
            'instructions' => 'Mỗi dòng = 1 tác dụng (hiển thị dạng bullet list)',
        ),
        array(
            'key'          => 'field_service_indications',
            'label'        => 'Chỉ Định',
            'name'         => 'indications',
            'type'         => 'textarea',
            'rows'         => 3,
        ),
        array(
            'key'          => 'field_service_price',
            'label'        => 'Giá',
            'name'         => 'price',
            'type'         => 'text',
            'placeholder'  => 'VD: 2.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_service_is_compare',
            'label'        => 'Hiện ảnh Before/After',
            'name'         => 'is_compare',
            'type'         => 'true_false',
            'default_value' => 0,
        ),
        array(
            'key'          => 'field_service_section',
            'label'        => 'Section',
            'name'         => 'section',
            'type'         => 'select',
            'choices'      => array(
                'face'  => 'Đặc Trị Vùng Mặt',
                'body'  => 'Phục Hồi & Tái Tạo Body',
            ),
            'default_value' => 'face',
        ),
        array(
            'key'          => 'field_service_order',
            'label'        => 'Thứ Tự Sắp Xếp',
            'name'         => 'menu_order',
            'type'         => 'number',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'service',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );

/* ==========================================================
   FIELD GROUP: Treatment (Liệu Trình)
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_treatment',
    'title'    => 'Thông Tin Liệu Trình',
    'fields'   => array(
        array(
            'key'          => 'field_treatment_before_img',
            'label'        => 'Ảnh Trước',
            'name'         => 'before_img',
            'type'         => 'image',
            'return_format' => 'url',
            'preview_size'  => 'thumbnail',
        ),
        array(
            'key'          => 'field_treatment_after_img',
            'label'        => 'Ảnh Sau',
            'name'         => 'after_img',
            'type'         => 'image',
            'return_format' => 'url',
            'preview_size'  => 'thumbnail',
        ),
        array(
            'key'          => 'field_treatment_inclusions',
            'label'        => 'Điểm Nổi Bật Gói',
            'name'         => 'inclusions',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Thêm Mục',
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inclusion_text',
                    'label' => 'Nội Dung',
                    'name'  => 'text',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_inclusion_highlight',
                    'label'        => 'Highlight',
                    'name'         => 'highlight',
                    'type'         => 'true_false',
                    'default_value' => 0,
                ),
            ),
        ),
        array(
            'key'          => 'field_treatment_benefits',
            'label'        => 'Tác Dụng',
            'name'         => 'benefits',
            'type'         => 'textarea',
            'rows'         => 4,
            'instructions' => 'Mỗi dòng = 1 tác dụng',
        ),
        array(
            'key'          => 'field_treatment_price',
            'label'        => 'Giá',
            'name'         => 'price',
            'type'         => 'text',
            'placeholder'  => 'VD: 10.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_treatment_order',
            'label'        => 'Thứ Tự',
            'name'         => 'menu_order',
            'type'         => 'number',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'treatment',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );

/* ==========================================================
   FIELD GROUP: CFU Treatment
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_cfu',
    'title'    => 'Thông Tin CFU ÈLIFE',
    'fields'   => array(
        array(
            'key'          => 'field_cfu_benefits',
            'label'        => 'Tác Dụng',
            'name'         => 'benefits',
            'type'         => 'textarea',
            'rows'         => 4,
        ),
        array(
            'key'          => 'field_cfu_indications',
            'label'        => 'Chỉ Định',
            'name'         => 'indications',
            'type'         => 'textarea',
            'rows'         => 3,
        ),
        array(
            'key'          => 'field_cfu_price',
            'label'        => 'Giá',
            'name'         => 'price',
            'type'         => 'text',
            'placeholder'  => 'VD: 5.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_cfu_original_price',
            'label'        => 'Giá Gốc (nếu có khuyến mãi)',
            'name'         => 'original_price',
            'type'         => 'text',
            'placeholder'  => 'VD: 8.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_cfu_is_compare',
            'label'        => 'Hiện ảnh Before/After',
            'name'         => 'is_compare',
            'type'         => 'true_false',
            'default_value' => 0,
        ),
        array(
            'key'          => 'field_cfu_section',
            'label'        => 'Section',
            'name'         => 'section',
            'type'         => 'select',
            'choices'      => array(
                'buoi_le' => 'Buổi Lẻ',
                'body'    => 'Body',
                'package' => 'Theo Liệu Trình',
            ),
            'default_value' => 'buoi_le',
        ),
        array(
            'key'          => 'field_cfu_order',
            'label'        => 'Thứ Tự',
            'name'         => 'menu_order',
            'type'         => 'number',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'cfu_treatment',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );

/* ==========================================================
   FIELD GROUP: Combo
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_combo',
    'title'    => 'Thông Tin Combo',
    'fields'   => array(
        array(
            'key'          => 'field_combo_subtitle',
            'label'        => 'Tiêu Đề Phụ',
            'name'         => 'subtitle',
            'type'         => 'text',
        ),
        array(
            'key'          => 'field_combo_items',
            'label'        => 'Sản Phẩm/Dịch Vụ trong Combo',
            'name'         => 'combo_items',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => ' thêm Mục',
            'sub_fields'   => array(
                array(
                    'key'   => 'field_combo_item_name',
                    'label' => 'Tên',
                    'name'  => 'name',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_combo_item_value',
                    'label' => 'Giá Trị',
                    'name'  => 'value',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_combo_item_image',
                    'label'        => 'Ảnh',
                    'name'         => 'image',
                    'type'         => 'image',
                    'return_format' => 'url',
                    'preview_size'  => 'thumbnail',
                ),
            ),
        ),
        array(
            'key'          => 'field_combo_deal_price',
            'label'        => 'Giá Ưu Đãi',
            'name'         => 'deal_price',
            'type'         => 'text',
            'placeholder'  => 'VD: 35.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_combo_original_price',
            'label'        => 'Giá Gốc',
            'name'         => 'original_price',
            'type'         => 'text',
            'placeholder'  => 'VD: 43.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_combo_order',
            'label'        => 'Thứ Tự',
            'name'         => 'menu_order',
            'type'         => 'number',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'combo',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );

/* ==========================================================
   FIELD GROUP: Product (Sản Phẩm Tiêm)
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_product',
    'title'    => 'Thông Tin Sản Phẩm',
    'fields'   => array(
        array(
            'key'          => 'field_product_benefits',
            'label'        => 'Tác Dụng',
            'name'         => 'benefits',
            'type'         => 'textarea',
            'rows'         => 4,
        ),
        array(
            'key'          => 'field_product_indications',
            'label'        => 'Chỉ Định',
            'name'         => 'indications',
            'type'         => 'textarea',
            'rows'         => 3,
        ),
        array(
            'key'          => 'field_product_price',
            'label'        => 'Giá',
            'name'         => 'price',
            'type'         => 'text',
            'placeholder'  => 'VD: 3.000.000 VNĐ',
        ),
        array(
            'key'          => 'field_product_sub_category',
            'label'        => 'Phân Nhóm Con',
            'name'         => 'sub_category',
            'type'         => 'text',
            'instructions' => 'VD: MESO MỤN, MESO SẸO, MESO SẮC TỐ...',
            'placeholder'  => 'MESO MỤN',
        ),
        array(
            'key'          => 'field_product_order',
            'label'        => 'Thứ Tự',
            'name'         => 'menu_order',
            'type'         => 'number',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'product',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );

/* ==========================================================
   FIELD GROUP: Home Page Options (Front Page)
   ========================================================== */
acf_add_local_field_group( array(
    'key'      => 'group_home_options',
    'title'    => 'Tùy Chỉnh Trang Chủ',
    'fields'   => array(
        array(
            'key'          => 'field_hero_slides',
            'label'        => 'Hero Slides',
            'name'         => 'hero_slides',
            'type'         => 'repeater',
            'button_label' => 'Thêm Slide',
            'sub_fields'   => array(
                array(
                    'key'   => 'field_slide_title',
                    'label' => 'Tiêu Đề',
                    'name'  => 'title',
                    'type'  => 'textarea',
                    'rows'  => 2,
                ),
                array(
                    'key'   => 'field_slide_features',
                    'label' => 'Đặc Điểm',
                    'name'  => 'features',
                    'type'  => 'textarea',
                    'rows'  => 4,
                    'instructions' => 'Mỗi dòng = 1 feature',
                ),
                array(
                    'key'   => 'field_slide_btn_outline',
                    'label' => 'Nút Outline',
                    'name'  => 'btn_outline',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_slide_btn_outline_url',
                    'label' => 'URL Nút Outline',
                    'name'  => 'btn_outline_url',
                    'type'  => 'url',
                ),
                array(
                    'key'   => 'field_slide_btn_solid',
                    'label' => 'Nút Solid',
                    'name'  => 'btn_solid',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_slide_btn_solid_url',
                    'label' => 'URL Nút Solid',
                    'name'  => 'btn_solid_url',
                    'type'  => 'url',
                ),
                array(
                    'key'          => 'field_slide_bg',
                    'label'        => 'Ảnh Nền',
                    'name'         => 'bg_image',
                    'type'         => 'image',
                    'return_format' => 'url',
                ),
                array(
                    'key'          => 'field_slide_device',
                    'label'        => 'Ảnh Thiết Bị',
                    'name'         => 'device_image',
                    'type'         => 'image',
                    'return_format' => 'url',
                ),
                array(
                    'key'   => 'field_slide_device_alt',
                    'label' => 'Alt Thiết Bị',
                    'name'  => 'device_alt',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_slide_reverse',
                    'label'        => 'Đảo Ngược Layout',
                    'name'         => 'is_reverse',
                    'type'         => 'true_false',
                    'default_value' => 0,
                ),
            ),
        ),
        array(
            'key'          => 'field_about_image',
            'label'        => 'Ảnh Giới Thiệu',
            'name'         => 'about_image',
            'type'         => 'image',
            'return_format' => 'url',
        ),
        array(
            'key'          => 'field_about_desc',
            'label'        => 'Mô Tả Giới Thiệu',
            'name'         => 'about_desc',
            'type'         => 'textarea',
            'rows'         => 6,
        ),
        array(
            'key'          => 'field_stats_partners',
            'label'        => 'Số Đối Tác',
            'name'         => 'stat_partners',
            'type'         => 'text',
            'default_value' => '90+',
        ),
        array(
            'key'          => 'field_stats_partners_label',
            'label'        => 'Nhãn Đối Tác',
            'name'         => 'stat_partners_label',
            'type'         => 'text',
            'default_value' => 'Đối Tác Đồng Hành',
        ),
        array(
            'key'          => 'field_stats_customers',
            'label'        => 'Số Khách Hàng',
            'name'         => 'stat_customers',
            'type'         => 'text',
            'default_value' => '5.000+',
        ),
        array(
            'key'          => 'field_stats_customers_label',
            'label'        => 'Nhãn Khách Hàng',
            'name'         => 'stat_customers_label',
            'type'         => 'text',
            'default_value' => 'Khách Hàng Tin Tưởng',
        ),
        array(
            'key'          => 'field_stats_success',
            'label'        => 'Tỷ Lệ Thành Công',
            'name'         => 'stat_success',
            'type'         => 'text',
            'default_value' => '98%',
        ),
        array(
            'key'          => 'field_stats_success_label',
            'label'        => 'Nhãn Thành Công',
            'name'         => 'stat_success_label',
            'type'         => 'text',
            'default_value' => 'Ca Điều Trị Thành Công',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'acf-options-home',
            ),
        ),
    ),
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
) );
