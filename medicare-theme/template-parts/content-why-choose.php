<?php
/**
 * Template part: Why Choose
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$items = array(
    array(
        'icon' => 'why-icon1.png',
        'title' => 'Tư Vấn Trực Tiếp Từ Chuyên Gia',
        'desc'  => 'Thăm khám trực tiếp cùng đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm. Chẩn đoán chính xác tình trạng mụn, nám, viêm da và lập phác đồ cá nhân hóa.',
    ),
    array(
        'icon' => 'why-icon2.png',
        'title' => 'Trị Liệu Bằng Công Nghệ Cao',
        'desc'  => 'Sở hữu dàn công nghệ hiện đại bậc nhất, giải quyết triệt để các vấn đề về da. Quy trình điều trị được kiểm soát nghiêm ngặt, chuẩn y khoa.',
    ),
    array(
        'icon' => 'why-icon3.png',
        'title' => 'Đồng Hành & Hỗ Trợ Khách Hàng 24/7',
        'desc'  => 'Đội ngũ bác sĩ, chuyên viên luôn sẵn sàng giải đáp thắc mắc & hướng dẫn quy trình chăm sóc da tại nhà, giúp duy trì kết quả điều trị bền vững.',
    ),
    array(
        'icon' => 'why-icon4.png',
        'title' => 'Phục Vụ Tận Tâm Chuyên Nghiệp',
        'desc'  => 'Trải nghiệm quy trình chăm sóc chuẩn y khoa với thái độ tận tâm, chu đáo. Mang lại sự hài lòng tối đa thông qua không gian hiện đại và dịch vụ đẳng cấp.',
    ),
);
?>
<section class="why-choose" aria-label="Lý do nên chọn Medicare Clinic">
    <div class="container">
        <div class="why-choose__wrapper">

            <!-- ================= CỘT TRÁI: TIÊU ĐỀ & 4 CARD TÍNH NĂNG ================= -->
            <div class="why-choose__content">
                <h2 class="why-choose__title" data-aos="fade-up">
                    Lý Do Nên Chọn<br>
                    Medicare Clinic ?
                </h2>

                <div class="why-choose__cards">
                    <?php foreach ( $items as $item ) : ?>
                    <article class="why-choose__card" data-aos="fade-up">
                        <div class="why-choose__card-icon" aria-hidden="true">
                            <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/' . $item['icon'] ); ?>" alt="" width="42" height="42" class="why-choose__card-icon-img">
                        </div>
                        <h3 class="why-choose__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="why-choose__card-desc"><?php echo esc_html( $item['desc'] ); ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>
