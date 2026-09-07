<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Medicare_Clinic
 */

get_header();
?>

<main id="primary" class="site-main error-404">
    <div class="container" style="text-align:center; padding:6rem 1.5rem;">
        <h1 class="error-404__title" style="font-size:4rem; font-weight:700; color:var(--color-primary); margin-bottom:1rem;">404</h1>
        <p style="font-size:1.15rem; margin-bottom:2rem;">Trang bạn tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hero-slider__btn hero-slider__btn--solid" style="display:inline-block;">
            Về Trang Chủ
        </a>
    </div>
</main>

<?php
get_footer();
