<?php
/**
 * Template part: About & Stats
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$about_img = function_exists( 'get_field' ) ? get_field( 'about_image', 'option' ) : '';
$about_desc= function_exists( 'get_field' ) ? get_field( 'about_desc', 'option' ) : '';

$stat_partners        = function_exists( 'get_field' ) ? get_field( 'stat_partners', 'option' ) : '90+';
$stat_partners_label  = function_exists( 'get_field' ) ? get_field( 'stat_partners_label', 'option' ) : 'Đối Tác Đồng Hành';
$stat_customers       = function_exists( 'get_field' ) ? get_field( 'stat_customers', 'option' ) : '5.000+';
$stat_customers_label = function_exists( 'get_field' ) ? get_field( 'stat_customers_label', 'option' ) : 'Khách Hàng Tin Tưởng';
$stat_success         = function_exists( 'get_field' ) ? get_field( 'stat_success', 'option' ) : '98%';
$stat_success_label   = function_exists( 'get_field' ) ? get_field( 'stat_success_label', 'option' ) : 'Ca Điều Trị Thành Công';

if ( empty( $about_img ) ) {
    $about_img = MEDICARE_THEME_URI . '/assets/images/Home/about-doctor-consulting.jpg';
}

if ( empty( $about_desc ) ) {
    $about_desc = "Chúng tôi hiểu rằng mỗi làn da đều có một câu chuyện riêng và xứng đáng được chăm sóc bằng sự thấu hiểu sâu sắc nhất. Không chỉ đơn thuần là một phòng khám da liễu, MEDiCARE là không gian nơi công nghệ y khoa hiện đại hòa quyện cùng tâm huyết của đội ngũ chuyên gia.\n\nChúng tôi không chỉ điều trị các vấn đề về da, mà còn cùng bạn khai phá phiên bản tự tin nhất của chính mình. Với triết lý làm đẹp bền vững, MEDiCARE cam kết đồng hành cùng bạn từ bước thăm khám đầu tiên cho đến khi sở hữu diện mạo rạng rỡ, giúp bạn yêu thêm vẻ đẹp tự nhiên của mình mỗi ngày.";
}
$desc_paragraphs = array_filter( array_map( 'trim', explode( "\n", $about_desc ) ) );
?>
<section class="about" aria-label="Giới thiệu về Medicare Clinic">
    <div class="container">

        <!-- Phần 1: Khối Giới Thiệu (2 Cột: Hình Ảnh & Nội Dung) -->
        <div class="about__grid" data-aos="fade-up">

            <!-- Cột Trái: Hình Ảnh Khám & Soi Da -->
            <div class="about__media">
                <img src="<?php echo esc_url( $about_img ); ?>"
                    alt="Bác sĩ Medicare Clinic soi da và tư vấn phác đồ cho khách hàng" class="about__img"
                    loading="lazy" width="600" height="420">
            </div>

            <!-- Cột Phải: Nội Dung Giới Thiệu -->
            <div class="about__content">
                <h2 class="about__title" data-aos="fade-up">MEDiCARE CLINIC</h2>

                <div class="about__description">
                    <?php foreach ( $desc_paragraphs as $p ) : ?>
                        <p class="about__desc"><?php echo esc_html( $p ); ?></p>
                    <?php endforeach; ?>
                </div>

                <!-- Nhóm Nút Hành Động -->
                <div class="about__actions">
                    <a href="#tu-van" class="about__btn about__btn--outline">Đăng Ký Tư Vấn</a>
                    <a href="#gioi-thieu" class="about__btn about__btn--outline">Tìm hiểu thêm</a>
                </div>
            </div>

        </div>

        <!-- Phần 2: Banner Khối Số Liệu Thống Kê (Stats Banner) -->
        <div class="about__stats" data-aos="fade-up">
            <div class="about__stat-item">
                <span class="about__stat-number"><?php echo esc_html( $stat_partners ); ?></span>
                <span class="about__stat-label"><?php echo esc_html( $stat_partners_label ); ?></span>
            </div>
            <div class="about__stat-item">
                <span class="about__stat-number"><?php echo esc_html( $stat_customers ); ?></span>
                <span class="about__stat-label"><?php echo esc_html( $stat_customers_label ); ?></span>
            </div>
            <div class="about__stat-item">
                <span class="about__stat-number"><?php echo esc_html( $stat_success ); ?></span>
                <span class="about__stat-label"><?php echo esc_html( $stat_success_label ); ?></span>
            </div>
        </div>

    </div>
</section>
