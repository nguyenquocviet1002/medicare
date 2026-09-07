<?php
/**
 * Template part: Results Slider (Hình Ảnh Khách Hàng Điều Trị)
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$slides = array(
    array(
        'title' => 'Điều Trị Sẹo',
        'service_img' => 'results-scar-service.jpg',
        'service_alt' => 'Quy trình điều trị sẹo',
        'compare' => array( 'results-scar-compare.jpg', 'results-scar-compare1.jpg', 'results-scar-compare2.jpg' ),
        'compare_alt' => 'So sánh trước và sau điều trị sẹo',
    ),
    array(
        'title' => 'Điều Trị Mụn',
        'service_img' => 'results-acne-service.jpg',
        'service_alt' => 'Quy trình điều trị mụn',
        'compare' => array( 'results-acne-compare.jpg', 'results-acne-compare1.jpg', 'results-acne-compare2.jpg' ),
        'compare_alt' => 'So sánh trước và sau điều trị mụn',
    ),
    array(
        'title' => 'Liệu Trình CFU',
        'service_img' => 'results-cfu-service.jpg',
        'service_alt' => 'Quy trình nâng cơ CFU',
        'compare' => array( 'results-cfu-compare.jpg', 'results-cfu-compare1.jpg', 'results-cfu-compare2.jpg' ),
        'compare_alt' => 'So sánh trước và sau nâng cơ CFU',
    ),
    array(
        'title' => 'Meso',
        'service_img' => 'results-meso-service.jpg',
        'service_alt' => 'Quy trình cấy Meso',
        'compare' => array( 'results-meso-compare.jpg', 'results-meso-compare1.jpg', 'results-meso-compare2.jpg' ),
        'compare_alt' => 'So sánh trước và sau cấy Meso',
    ),
);
?>
<section class="results-slider" aria-label="Hình Ảnh Khách Hàng Điều Trị">
    <div class="container">

        <!-- Tiêu Đề Section -->
        <div class="results-slider__header">
            <h2 class="results-slider__title" data-aos="fade-up">Hình Ảnh Khách Hàng Điều Trị</h2>
        </div>

        <!-- Khung Chứa Slider (Viewport & Track) -->
        <div class="results-slider__wrapper">

            <!-- Nút Prev -->
            <button class="results-slider__nav-btn results-slider__nav-btn--prev" type="button" aria-label="Slide trước">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Track Trượt Ngang -->
            <div class="results-slider__viewport">
                <div class="results-slider__track">
                    <?php foreach ( $slides as $k => $slide ) : ?>
                    <article class="results-slider__slide <?php echo $k === 0 ? 'results-slider__slide--active' : ''; ?>">
                        <div class="results-slider__grid">
                            <div class="results-slider__service-card">
                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/' . $slide['service_img'] ); ?>" alt="<?php echo esc_attr( $slide['service_alt'] ); ?>" class="results-slider__service-img" loading="lazy">
                                <div class="results-slider__service-overlay">
                                    <h3 class="results-slider__service-title"><?php echo esc_html( $slide['title'] ); ?></h3>
                                    <div class="results-slider__service-actions">
                                        <a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/' ) ); ?>" class="results-slider__service-btn">Đăng Kí Tư Vấn</a>
                                        <a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/' ) ); ?>" class="results-slider__service-btn">Tìm hiểu thêm</a>
                                    </div>
                                </div>
                            </div>

                            <div class="results-slider__compare-card">
                                <div class="results-slider__compare-track">
                                    <?php foreach ( $slide['compare'] as $ci => $img ) : ?>
                                    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/' . $img ); ?>" alt="<?php echo esc_attr( $slide['compare_alt'] ); ?>" class="results-slider__compare-img <?php echo $ci === 0 ? 'results-slider__compare-img--active' : ''; ?>" loading="lazy">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Nút Next -->
            <button class="results-slider__nav-btn results-slider__nav-btn--next" type="button" aria-label="Slide tiếp theo">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Pagination Dots -->
            <div class="results-slider__pagination">
                <?php foreach ( $slides as $k => $slide ) : ?>
                <button class="results-slider__dot <?php echo $k === 0 ? 'results-slider__dot--active' : ''; ?>" type="button" aria-label="Slide <?php echo esc_attr( $k + 1 ); ?>"></button>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</section>
