<?php
/**
 * Template part: Hero Slider
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$slides = function_exists( 'get_field' ) ? get_field( 'hero_slides', 'option' ) : array();
?>
<section class="hero-slider" aria-label="Khuyến mãi &amp; Dịch vụ nổi bật">
    <div class="hero-slider__wrapper">

        <!-- Nút điều hướng Trước (Prev) -->
        <button class="hero-slider__nav-btn hero-slider__nav-btn--prev" type="button" aria-label="Slide trước">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Danh sách Slides -->
        <div class="hero-slider__track">
            <?php if ( ! empty( $slides ) ) : ?>
                <?php $i = 0; foreach ( $slides as $slide ) : ?>
                    <?php
                    $title       = isset( $slide['title'] ) ? $slide['title'] : '';
                    $features    = isset( $slide['features'] ) ? $slide['features'] : '';
                    $btn_outline = isset( $slide['btn_outline'] ) ? $slide['btn_outline'] : 'Đăng Ký Tư Vấn';
                    $btn_out_url = isset( $slide['btn_outline_url'] ) ? $slide['btn_outline_url'] : '#tu-van';
                    $btn_solid   = isset( $slide['btn_solid'] ) ? $slide['btn_solid'] : 'Tìm hiểu thêm';
                    $btn_sol_url = isset( $slide['btn_solid_url'] ) ? $slide['btn_solid_url'] : '#chi-tiet';
                    $bg_img      = isset( $slide['bg_image'] ) ? $slide['bg_image'] : '';
                    $device_img  = isset( $slide['device_image'] ) ? $slide['device_image'] : '';
                    $device_alt  = isset( $slide['device_alt'] ) ? $slide['device_alt'] : '';
                    $is_reverse  = isset( $slide['is_reverse'] ) && $slide['is_reverse'];
                    $feature_arr = array_filter( array_map( 'trim', explode( "\n", $features ) ) );
                    $i++;
                    ?>
                    <article class="hero-slider__slide <?php echo $i === 1 ? 'hero-slider__slide--active' : ''; ?>" data-index="<?php echo esc_attr( $i - 1 ); ?>">
                        <?php if ( $bg_img ) : ?>
                        <div class="hero-slider__media-bg">
                            <img src="<?php echo esc_url( $bg_img ); ?>" alt="" class="hero-slider__bg-img" loading="lazy">
                        </div>
                        <?php endif; ?>
                        <div class="container">
                            <div class="hero-slider__grid <?php echo $is_reverse ? 'hero-slider__grid--reverse' : ''; ?>">

                                <?php if ( $is_reverse && $device_img ) : ?>
                                <!-- Hình ảnh (Nằm bên trái khi reverse) -->
                                <div class="hero-slider__media">
                                    <div class="hero-slider__media-device">
                                        <img src="<?php echo esc_url( $device_img ); ?>" alt="<?php echo esc_attr( $device_alt ); ?>"
                                            class="hero-slider__device-img" width="520" height="600">
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Nội dung -->
                                <div class="hero-slider__content">
                                    <div class="hero-slider__title"><?php echo wp_kses_post( $title ); ?></div>

                                    <?php if ( ! empty( $feature_arr ) ) : ?>
                                    <ul class="hero-slider__features">
                                        <?php foreach ( $feature_arr as $feature ) : ?>
                                        <li class="hero-slider__feature-item">
                                            <span class="hero-slider__feature-bullet"></span>
                                            <span class="hero-slider__feature-text"><?php echo esc_html( $feature ); ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>

                                    <?php if ( $btn_outline || $btn_solid ) : ?>
                                    <div class="hero-slider__actions">
                                        <?php if ( $btn_outline ) : ?>
                                        <a href="<?php echo esc_url( $btn_out_url ); ?>" class="hero-slider__btn hero-slider__btn--outline"><?php echo esc_html( $btn_outline ); ?></a>
                                        <?php endif; ?>
                                        <?php if ( $btn_solid ) : ?>
                                        <a href="<?php echo esc_url( $btn_sol_url ); ?>" class="hero-slider__btn hero-slider__btn--solid"><?php echo esc_html( $btn_solid ); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ( ! $is_reverse && $device_img ) : ?>
                                <!-- Hình ảnh (Nằm bên phải) -->
                                <div class="hero-slider__media">
                                    <div class="hero-slider__media-device">
                                        <img src="<?php echo esc_url( $device_img ); ?>" alt="<?php echo esc_attr( $device_alt ); ?>"
                                            class="hero-slider__device-img" width="520" height="600">
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <?php
                // Fallback: Static slide 1
                ?>
                <article class="hero-slider__slide hero-slider__slide--active" data-index="0">
                    <div class="hero-slider__media-bg">
                        <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/treatment-bg-1.jpg' ); ?>" alt="Liệu trình trị sẹo" class="hero-slider__bg-img" loading="lazy">
                    </div>
                    <div class="container">
                        <div class="hero-slider__grid">
                            <div class="hero-slider__content">
                                <h1 class="hero-slider__title">CẢI THIỆN SẸO RỖ<br>TÁI CẤU TRÚC LÀN DA</h1>
                                <ul class="hero-slider__features">
                                    <li class="hero-slider__feature-item"><span class="hero-slider__feature-bullet"></span><span class="hero-slider__feature-text">Phác đồ 5in1 cá nhân hóa theo từng loại sẹo</span></li>
                                    <li class="hero-slider__feature-item"><span class="hero-slider__feature-bullet"></span><span class="hero-slider__feature-text">Kết hợp công nghệ laser &amp; kích thích collagen</span></li>
                                    <li class="hero-slider__feature-item"><span class="hero-slider__feature-bullet"></span><span class="hero-slider__feature-text">Cải thiện bề mặt da mịn màng</span></li>
                                </ul>
                                <div class="hero-slider__actions">
                                    <a href="#tu-van" class="hero-slider__btn hero-slider__btn--outline">Đăng Ký Tư Vấn</a>
                                    <a href="#chi-tiet" class="hero-slider__btn hero-slider__btn--solid">Tìm hiểu thêm</a>
                                </div>
                            </div>
                            <div class="hero-slider__media">
                                <div class="hero-slider__media-device">
                                    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/discovery-pico-machine.png' ); ?>" alt="Máy Discovery Pico Laser" class="hero-slider__device-img" width="520" height="600">
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endif; ?>
        </div>

        <!-- Dấu chấm phân trang nằm trong vùng container -->
        <div class="container">
            <div class="hero-slider__pagination">
                <?php if ( ! empty( $slides ) ) : ?>
                    <?php foreach ( $slides as $k => $slide ) : ?>
                    <button class="hero-slider__dot <?php echo $k === 0 ? 'hero-slider__dot--active' : ''; ?>" type="button" aria-label="Đi đến slide <?php echo esc_attr( $k + 1 ); ?>"></button>
                    <?php endforeach; ?>
                <?php else : ?>
                    <button class="hero-slider__dot hero-slider__dot--active" type="button" aria-label="Đi đến slide 1"></button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Nút điều hướng Tiếp (Next) -->
        <button class="hero-slider__nav-btn hero-slider__nav-btn--next" type="button" aria-label="Slide tiếp theo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>

    </div>
</section>
