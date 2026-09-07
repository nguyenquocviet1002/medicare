<?php
/**
 * Template part: Featured Services Slider
 * Pulls from the 'service' CPT.
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$services = get_posts( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'suppress_filters' => true,
) );
?>
<section class="services-slider" aria-label="Dịch Vụ Nổi Bật Tại Medicare Clinic">
    <!-- Tiêu Đề Section -->
    <div class="services-slider__header">
        <h2 class="services-slider__title" data-aos="fade-up">Dịch Vụ Nổi Bật Tại Medicare Clinic</h2>
    </div>

    <!-- Khung Chứa Slider (Viewport) -->
    <div class="services-slider__viewport">
        <div class="services-slider__track" id="services-track">
            <?php if ( $services ) : ?>
                <?php $count = count( $services ); ?>
                <?php foreach ( $services as $index => $service ) : ?>
                    <?php
                    $title    = get_the_title( $service );
                    $desc     = get_the_excerpt( $service );
                    if ( empty( $desc ) ) {
                        $desc = get_the_content( $service );
                    }
                    $price    = function_exists( 'get_field' ) ? get_field( 'price', $service->ID ) : '';
                    $thumb_id = get_post_thumbnail_id( $service );
                    $img_url  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'service-card' ) : ( MEDICARE_THEME_URI . '/assets/images/Home/service-cfu.jpg' );
                    $link     = get_permalink( $service );
                    ?>
                    <article class="services-slider__slide <?php echo $index === 2 ? 'services-slider__slide--active' : ''; ?>">
                        <div class="services-slider__card">
                            <div class="services-slider__card-media">
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="services-slider__card-img" loading="lazy">
                            </div>
                            <div class="services-slider__card-body">
                                <h3 class="services-slider__card-title"><?php echo esc_html( $title ); ?></h3>
                                <p class="services-slider__card-desc"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $desc ), 30 ) ); ?></p>
                                <?php if ( $price ) : ?>
                                <div class="services-slider__card-price">Giá: <?php echo esc_html( $price ); ?></div>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $link ); ?>" class="services-slider__card-btn">Tìm hiểu thêm</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <?php
                // Fallback static slides
                $fallback = array(
                    array( 'img' => 'service-laser-fractional.jpg', 'title' => 'LASER FRACTIONAL', 'desc' => 'Cải thiện sẹo rỗ sâu, tái tạo bề mặt da sần, kết cấu da săn chắc, giảm nếp nhăn và tăng độ đàn hồi cho da.', 'price' => '2.500.000 VNĐ' ),
                    array( 'img' => 'service-peel.jpg', 'title' => 'PEEL TRỊ MỤN', 'desc' => 'Peel Trị Mụn Giúp Loại Bỏ Lớp Tế Bào Sừng Và Bã Nhờn Tích Tụ Trên Bề Mặt Da, Từ Đó Làm Sạch Lỗ Chân Lông Và Giảm Tình Trạng Bít Tắc Nguyên Nhân Chính Gây Mụn...', 'price' => '1.500.000 VNĐ' ),
                    array( 'img' => 'service-cfu.jpg', 'title' => 'CFU ÈLIFE', 'desc' => 'CFU Èlife Là Công Nghệ Nâng Cơ Sử Dụng Sóng Siêu Âm Hội Tụ Chính Xác, Tác Động Sâu Vào Các Tầng Cấu Trúc Của Da, Giúp Kích Thích Tăng Sinh Collagen Và Cải Thiện Độ Săn Chắc...', 'price' => '5.000.000 - 30.000.000 VNĐ' ),
                    array( 'img' => 'service-meso-acnezone.jpg', 'title' => 'MESO ACNEZONE', 'desc' => 'Meso Acnezone Giúp Giảm Viêm, Kháng Khuẩn Và Kiểm Soát Bã Nhờn, Hỗ Trợ Gom Nhân Mụn Và Hạn Chế Hình Thành Mụn Mới; Đồng Thời Giúp Làm Dịu Da Và Giảm Nguy Cơ Thâm Sau Mụn...', 'price' => '3.000.000 VNĐ' ),
                    array( 'img' => 'service-meso-rejuran.jpg', 'title' => 'MESO REJURAN', 'desc' => 'Rejuran Healer Giúp Phục Hồi Da Nhờ Hoạt Chất PN Tinh Khiết, Kích Thích Sản Sinh Collagen Và Elastin, Nhờ Đó Da Tăng Độ Đàn Hồi, Thu Nhỏ Lỗ Chân Lông...', 'price' => '7.000.000 VNĐ' ),
                );
                $count = count( $fallback );
                foreach ( $fallback as $index => $item ) :
                ?>
                <article class="services-slider__slide <?php echo $index === 2 ? 'services-slider__slide--active' : ''; ?>">
                    <div class="services-slider__card">
                        <div class="services-slider__card-media">
                            <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/' . $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="services-slider__card-img" loading="lazy">
                        </div>
                        <div class="services-slider__card-body">
                            <h3 class="services-slider__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <p class="services-slider__card-desc"><?php echo esc_html( $item['desc'] ); ?></p>
                            <div class="services-slider__card-price">Giá: <?php echo esc_html( $item['price'] ); ?></div>
                            <a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/' ) ); ?>" class="services-slider__card-btn">Tìm hiểu thêm</a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Dấu Chấm Phân Trang (Dots) -->
    <div class="services-slider__pagination" id="services-pagination"></div>
</section>
