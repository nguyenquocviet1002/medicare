<?php
/**
 * Template Name: CFU ÈLIFE
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main id="primary" class="site-main cfu-template">

    <section class="banner" data-aos="fade-up">
        <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/banner.jpg' ); ?>" alt="CFU ÈLIFE Medicare Clinic">
    </section>

    <?php
    $cfu_posts = get_posts( array(
        'post_type'      => 'cfu_treatment',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'suppress_filters' => true,
    ) );
    ?>

    <?php if ( $cfu_posts ) : ?>

        <?php
        $sections = array(
            'buoi_le' => array(
                'id'    => 'cfu-buoi-le',
                'title' => 'CFU ÈLIFFE BUỔI LẺ',
                'type'  => 'detailed',
            ),
            'body' => array(
                'id'    => 'cfu-body',
                'title' => 'CFU ÈLIFE BODY',
                'type'  => 'detailed',
            ),
            'package' => array(
                'id'    => 'cfu-lieu-trinh',
                'title' => 'CFU ÈLIFFE THEO LIỆU TRÌNH',
                'type'  => 'simple',
            ),
        );

        $grouped = array(
            'buoi_le' => array(),
            'body'    => array(),
            'package' => array(),
        );

        foreach ( $cfu_posts as $post ) {
            $section = function_exists( 'get_field' ) ? get_field( 'section', $post->ID ) : 'buoi_le';
            if ( ! isset( $grouped[ $section ] ) ) {
                $section = 'buoi_le';
            }
            $grouped[ $section ][] = $post;
        }
        ?>

        <div class="cfu-page">
            <div class="container">

                <?php foreach ( $sections as $key => $section ) : ?>
                    <?php if ( empty( $grouped[ $key ] ) ) continue; ?>
                    <section class="cfu-section" id="<?php echo esc_attr( $section['id'] ); ?>" data-aos="fade-up">
                        <h2 class="cfu-section__title" data-aos="fade-up"><?php echo esc_html( $section['title'] ); ?></h2>

                        <?php if ( 'simple' === $section['type'] ) : ?>
                            <div class="cfu-section__grid cfu-section__grid--package">
                                <?php foreach ( $grouped[ $key ] as $post ) : ?>
                                    <?php
                                    $title         = get_the_title( $post );
                                    $link          = get_permalink( $post );
                                    $thumb_id      = get_post_thumbnail_id( $post );
                                    $img_url       = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : ( MEDICARE_THEME_URI . '/assets/images/Home/service-cfu.jpg' );
                                    $price         = function_exists( 'get_field' ) ? get_field( 'price', $post->ID ) : '';
                                    $original_price = function_exists( 'get_field' ) ? get_field( 'original_price', $post->ID ) : '';
                                    $display_price = $price ? medicare_format_price( $price ) : '';
                                    $display_original = $original_price ? medicare_format_price( $original_price ) : '';
                                    ?>
                                    <article class="cfu-package-card" data-aos="fade-up">
                                        <div class="cfu-package-card__media">
                                            <a href="<?php echo esc_url( $link ); ?>">
                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="cfu-package-card__img" loading="lazy">
                                            </a>
                                        </div>

                                        <h3 class="cfu-package-card__title"><?php echo esc_html( $title ); ?></h3>

                                        <div class="cfu-package-card__footer">
                                            <div class="cfu-package-card__price-box">
                                                <?php if ( $display_price ) : ?>
                                                    <span class="cfu-package-card__price">Giá: <?php echo esc_html( $display_price ); ?></span>
                                                <?php endif; ?>
                                                <?php if ( $display_original ) : ?>
                                                    <span class="cfu-package-card__original-price"><?php echo esc_html( $display_original ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <a href="<?php echo esc_url( $link ); ?>" class="cfu-package-card__cart-btn" aria-label="Thêm <?php echo esc_attr( $title ); ?> vào giỏ hàng">
                                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="cfu-package-card__cart-icon">
                                            </a>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                        <?php else : ?>
                            <div class="cfu-section__grid">
                                <?php foreach ( $grouped[ $key ] as $post ) : ?>
                                    <?php
                                    $title         = get_the_title( $post );
                                    $link          = get_permalink( $post );
                                    $thumb_id      = get_post_thumbnail_id( $post );
                                    $img_url       = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : ( MEDICARE_THEME_URI . '/assets/images/Home/service-cfu.jpg' );
                                    $benefits      = function_exists( 'get_field' ) ? get_field( 'benefits', $post->ID ) : '';
                                    $indications   = function_exists( 'get_field' ) ? get_field( 'indications', $post->ID ) : '';
                                    $price         = function_exists( 'get_field' ) ? get_field( 'price', $post->ID ) : '';
                                    $display_price = $price ? medicare_format_price( $price ) : '';
                                    $benefit_arr   = array_filter( array_map( 'trim', explode( "\n", $benefits ) ) );
                                    ?>
                                    <article class="cfu-card" data-aos="fade-up">
                                        <div class="cfu-card__media">
                                            <a href="<?php echo esc_url( $link ); ?>">
                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="cfu-card__img" loading="lazy">
                                            </a>
                                        </div>

                                        <div class="cfu-card__body">
                                            <h3 class="cfu-card__title"><?php echo esc_html( $title ); ?></h3>

                                            <?php if ( $benefit_arr ) : ?>
                                                <div class="cfu-card__subtitle">TÁC DỤNG</div>
                                                <ul class="cfu-card__list">
                                                    <?php foreach ( $benefit_arr as $benefit ) : ?>
                                                        <li class="cfu-card__list-item"><?php echo esc_html( $benefit ); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if ( $indications ) : ?>
                                                <div class="cfu-card__subtitle">CHỈ ĐỊNH</div>
                                                <p class="cfu-card__text"><?php echo esc_html( $indications ); ?></p>
                                            <?php endif; ?>

                                            <div class="cfu-card__footer">
                                                <?php if ( $display_price ) : ?>
                                                    <span class="cfu-card__price">Giá: <?php echo esc_html( $display_price ); ?></span>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_url( $link ); ?>" class="cfu-card__cart-btn" aria-label="Thêm <?php echo esc_attr( $title ); ?> vào giỏ hàng">
                                                    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="cfu-card__cart-icon">
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>

            </div>
        </div>

    <?php else : ?>

        <?php
        $fallback = array(
            'buoi_le' => array(
                'id'    => 'cfu-buoi-le',
                'title' => 'CFU ÈLIFFE BUỔI LẺ',
                'type'  => 'detailed',
                'items' => array(
                    array(
                        'title'       => 'CFU ÈLIFE BỌNG MẮT/ VIỀN HÀM/ THÁI DƯƠNG + TRÁN',
                        'image'       => 'cfu-bong-mat.jpg',
                        'benefits'    => array(
                            'Sóng siêu âm hội tụ vi điểm làm săn chắc vùng da quanh mắt, tan mỡ bọng mắt và giảm nếp nhăn li ti',
                            'Siết gọn cơ viền hàm, tiêu biến mỡ thừa và định hình đường nét khuôn mặt góc cạnh, thanh thoát',
                            'Nâng cao cung mày, kéo căng nếp nhăn trán và làm săn chắc vùng thái dương bị chùng',
                        ),
                        'indications' => 'Bọng mỡ mắt dưới, quầng thâm, nếp nhăn đuôi mắt. Đường viền hàm chảy xệ. Nếp nhăn tĩnh trán, rãnh nhăn trán lão hóa',
                        'price'       => '5.000.000 VNĐ',
                    ),
                    array(
                        'title'       => 'CFU ÈLIFE MÁ/CỔ',
                        'image'       => 'cfu-ma-co-compare.jpg',
                        'benefits'    => array(
                            'Co rút lớp cơ SMAS, nâng đỡ mô mỡ má bị xệ, làm đầy rãnh cười và tăng độ săn chắc',
                            'Tái tạo collagen tầng sâu, xóa mờ nếp nhăn vùng cổ và siết chặt da cổ chùng nhão',
                        ),
                        'indications' => 'Má chảy xệ, rãnh sâu, cơ mặt kém đàn hồi. Da cổ lão hóa, xuất hiện ngấn cổ rõ rệt, da chùng nhão',
                        'price'       => '8.000.000 VNĐ',
                    ),
                    array(
                        'title'       => 'CFU ÈLIFE NỌNG',
                        'image'       => 'cfu-nong-compare.jpg',
                        'benefits'    => array(
                            'Hóa lỏng và đào thải mô mỡ dày nọng cằm, co rút da chùng giúp cằm V-line rõ nét',
                        ),
                        'indications' => 'Cằm đôi (nọng cằm dày), mỡ thừa tích tụ dưới cằm, da dưới cằm lỏng lẻo',
                        'price'       => '10.000.000 VNĐ',
                    ),
                ),
            ),
            'body' => array(
                'id'    => 'cfu-body',
                'title' => 'CFU ÈLIFE BODY',
                'type'  => 'detailed',
                'items' => array(
                    array(
                        'title'       => 'CFU GIẢM MỒ HÔI NÁCH',
                        'image'       => 'cfu-giam-mo-hoi-nach.jpg',
                        'benefits'    => array(
                            'Sử dụng sóng siêu âm hội tụ tác động chính xác vào tuyến mồ hôi vùng nách',
                            'Giảm tiết mồ hôi và hỗ trợ ức chế vi khuẩn gây mùi khó chịu',
                            'Giữ vùng nách khô thoáng lâu dài, không xâm lấn và không cần nghỉ dưỡng',
                        ),
                        'indications' => 'Đổ mồ hôi nách nhiều, tăng tiết mồ hôi do cơ địa, vùng nách ẩm ướt khó chịu',
                        'price'       => '5.000.000 VNĐ',
                    ),
                    array(
                        'title'       => 'CFU GIẢM MỒ HÔI NÁCH + BOTOX',
                        'image'       => 'cfu-giam-mo-hoi-nach.jpg',
                        'benefits'    => array(
                            'Tác động kép: CFU làm suy yếu tuyến mồ hôi kết hợp Botox phong bế dẫn truyền thần kinh',
                            'Kiểm soát và ức chế triệt để tình trạng tăng tiết mồ hôi tức thì',
                            'Khử mùi hiệu quả, mang lại vùng nách khô ráo vượt trội và duy trì bền vững',
                        ),
                        'indications' => 'Tăng tiết mồ hôi nách mức độ nặng, mùi hôi nách lâu năm, cần hiệu quả khô thoáng cấp tốc',
                        'price'       => '8.000.000 VNĐ',
                    ),
                    array(
                        'title'       => 'CFU THON GỌN TAY',
                        'image'       => 'cfu-giam-mo-hoi-nach.jpg',
                        'benefits'    => array(
                            'Sóng siêu âm hội tụ tác động nhiệt phá hủy mô mỡ thừa vùng bắp tay',
                            'Kích thích tăng sinh collagen & elastin, siết cơ và làm săn chắc vùng da chùng nhão',
                            'Thu gọn chu vi bắp tay, tạo đường nét thon gọn tự nhiên mà không cần phẫu thuật',
                        ),
                        'indications' => 'Bắp tay to, tích tụ mỡ thừa khó giảm, da cánh tay lỏng lẻo kém săn chắc',
                        'price'       => '10.000.000 VNĐ',
                    ),
                ),
            ),
            'package' => array(
                'id'    => 'cfu-lieu-trinh',
                'title' => 'CFU ÈLIFFE THEO LIỆU TRÌNH',
                'type'  => 'simple',
                'items' => array(
                    array(
                        'title'   => 'CFU FULL FACE',
                        'image'   => 'cfu-full-face-package.jpg',
                        'price'   => '25.000.000 VNĐ',
                        'original_price' => '28.000.000 VNĐ',
                    ),
                    array(
                        'title'   => 'FULL FACE + VÙNG CỔ',
                        'image'   => 'cfu-full-face-co-package.jpg',
                        'price'   => '30.000.000 VNĐ',
                        'original_price' => '36.000.000 VNĐ',
                    ),
                ),
            ),
        );
        ?>

        <div class="cfu-page">
            <div class="container">

                <?php foreach ( $fallback as $key => $section ) : ?>
                    <section class="cfu-section" id="<?php echo esc_attr( $section['id'] ); ?>" data-aos="fade-up">
                        <h2 class="cfu-section__title" data-aos="fade-up"><?php echo esc_html( $section['title'] ); ?></h2>

                        <?php if ( 'simple' === $section['type'] ) : ?>
                            <div class="cfu-section__grid cfu-section__grid--package">
                                <?php foreach ( $section['items'] as $item ) : ?>
                                    <article class="cfu-package-card" data-aos="fade-up">
                                        <div class="cfu-package-card__media">
                                            <a href="<?php echo esc_url( home_url( '/cfu-eliffe/' ) ); ?>">
                                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/cfu/' . $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="cfu-package-card__img" loading="lazy">
                                            </a>
                                        </div>

                                        <h3 class="cfu-package-card__title"><?php echo esc_html( $item['title'] ); ?></h3>

                                        <div class="cfu-package-card__footer">
                                            <div class="cfu-package-card__price-box">
                                                <span class="cfu-package-card__price">Giá: <?php echo esc_html( $item['price'] ); ?></span>
                                                <span class="cfu-package-card__original-price"><?php echo esc_html( $item['original_price'] ); ?></span>
                                            </div>

                                            <a href="<?php echo esc_url( home_url( '/cfu-eliffe/' ) ); ?>" class="cfu-package-card__cart-btn" aria-label="Thêm <?php echo esc_attr( $item['title'] ); ?> vào giỏ hàng">
                                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="cfu-package-card__cart-icon">
                                            </a>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                        <?php else : ?>
                            <div class="cfu-section__grid">
                                <?php foreach ( $section['items'] as $item ) : ?>
                                    <article class="cfu-card" data-aos="fade-up">
                                        <div class="cfu-card__media">
                                            <a href="<?php echo esc_url( home_url( '/cfu-eliffe/' ) ); ?>">
                                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/cfu/' . $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="cfu-card__img" loading="lazy">
                                            </a>
                                        </div>

                                        <div class="cfu-card__body">
                                            <h3 class="cfu-card__title"><?php echo esc_html( $item['title'] ); ?></h3>

                                            <div class="cfu-card__subtitle">TÁC DỤNG</div>
                                            <ul class="cfu-card__list">
                                                <?php foreach ( $item['benefits'] as $benefit ) : ?>
                                                    <li class="cfu-card__list-item"><?php echo esc_html( $benefit ); ?></li>
                                                <?php endforeach; ?>
                                            </ul>

                                            <div class="cfu-card__subtitle">CHỈ ĐỊNH</div>
                                            <p class="cfu-card__text"><?php echo esc_html( $item['indications'] ); ?></p>

                                            <div class="cfu-card__footer">
                                                <span class="cfu-card__price">Giá: <?php echo esc_html( $item['price'] ); ?></span>
                                                <a href="<?php echo esc_url( home_url( '/cfu-eliffe/' ) ); ?>" class="cfu-card__cart-btn" aria-label="Thêm <?php echo esc_attr( $item['title'] ); ?> vào giỏ hàng">
                                                    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="cfu-card__cart-icon">
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>

            </div>
        </div>

    <?php endif; ?>

</main>

<?php
get_footer();
