<?php
/**
 * Template part: Skin Journey Gallery
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$stories = range( 1, 8 );
?>
<section class="journey" aria-label="Hành Trình Lấy Lại Làn Da">
    <div class="container">

        <!-- Tiêu Đề Section -->
        <div class="journey__header">
            <h2 class="journey__title" data-aos="fade-up">Hành Trình Lấy Lại Làn Da</h2>
        </div>

    </div>

    <!-- Khung Gallery Trượt Ngang (Full Viewport) -->
    <div class="journey__viewport">
        <div class="journey__track" id="journey-track">
            <?php foreach ( $stories as $n ) : ?>
            <article class="journey__card">
                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/Home/journey-story-' . $n . '.jpg' ); ?>" alt="Hành trình điều trị của khách hàng" class="journey__card-img" loading="lazy">
                <div class="journey__card-play" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
