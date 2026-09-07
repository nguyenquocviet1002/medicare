<?php
/**
 * Footer Template
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$contact    = medicare_get_contact_info();
$socials    = medicare_get_social_links();
?>

    <footer class="footer" id="footer" aria-label="Chân trang Medicare Clinic">
        <div class="container">
            <div class="footer__grid">

                <!-- ================= CỘT 1: THÔNG TIN THƯƠNG HIỆU & LIÊN HỆ ================= -->
                <div class="footer__brand">
                    <!-- Logo -->
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo" aria-label="Medicare Clinic - Trang Chủ">
                        <img src="<?php echo esc_url( medicare_footer_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer__logo-img" width="160" height="60">
                    </a>

                    <!-- Danh sách thông tin liên hệ -->
                    <ul class="footer__contacts">
                        <li class="footer__contact-item">
                            <span class="footer__contact-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                            <span class="footer__contact-text"><?php echo esc_html( $contact['working_hours'] ); ?></span>
                        </li>

                        <li class="footer__contact-item">
                            <span class="footer__contact-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </span>
                            <span class="footer__contact-text"><?php echo esc_html( $contact['address'] ); ?></span>
                        </li>

                        <li class="footer__contact-item">
                            <span class="footer__contact-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"
                                class="footer__contact-link"><?php echo esc_html( $contact['email'] ); ?></a>
                        </li>

                        <li class="footer__contact-item">
                            <span class="footer__contact-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </span>
                            <a href="tel:<?php echo esc_attr( $contact['phone_raw'] ); ?>" class="footer__contact-link"><?php echo esc_html( $contact['phone'] ); ?></a>
                        </li>
                    </ul>

                    <!-- Mạng xã hội -->
                    <div class="footer__socials">
                        <?php if ( ! empty( $socials['facebook'] ) && $socials['facebook'] !== '#' ) : ?>
                        <a href="<?php echo esc_url( $socials['facebook'] ); ?>" class="footer__social-btn footer__social-btn--facebook" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $socials['youtube'] ) && $socials['youtube'] !== '#' ) : ?>
                        <a href="<?php echo esc_url( $socials['youtube'] ); ?>" class="footer__social-btn footer__social-btn--youtube" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $socials['messenger'] ) && $socials['messenger'] !== '#' ) : ?>
                        <a href="<?php echo esc_url( $socials['messenger'] ); ?>" class="footer__social-btn footer__social-btn--messenger" aria-label="Messenger" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0C5.373 0 0 4.974 0 11.111c0 3.498 1.744 6.614 4.469 8.654V24l4.088-2.242c1.09.302 2.247.464 3.443.464 6.627 0 12-4.975 12-11.111S18.627 0 12 0zm1.191 14.963l-3.055-3.26-5.963 3.26 6.559-6.963 3.13 3.259 5.889-3.259-6.56 6.963z" />
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $socials['tiktok'] ) && $socials['tiktok'] !== '#' ) : ?>
                        <a href="<?php echo esc_url( $socials['tiktok'] ); ?>" class="footer__social-btn footer__social-btn--tiktok" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ================= CỘT 2–5: FOOTER NAV MENU ================= -->
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer__menu-group',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                        'walker'         => new Medicare_Footer_Nav_Walker(),
                    ) );
                    ?>
                <?php else : ?>
                    <!-- Fallback: Static columns if no menu assigned -->
                    <div class="footer__col">
                        <h4 class="footer__title">Trang chủ</h4>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/' ) ); ?>" class="footer__nav-link">Buổi Lẻ</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/#peel' ) ); ?>" class="footer__nav-link">Peel</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/#laser' ) ); ?>" class="footer__nav-link">Laser</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/#lan-kim' ) ); ?>" class="footer__nav-link">Lăn Kim</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-buoi-le/#phi-kim' ) ); ?>" class="footer__nav-link">Phi Kim</a></li>
                        </ul>
                    </div>

                    <div class="footer__col">
                        <h4 class="footer__title">Điều trị</h4>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-lieu-trinh/' ) ); ?>" class="footer__nav-link">Liệu Trình</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-lieu-trinh/#dieu-tri-seo' ) ); ?>" class="footer__nav-link">Điều Trị Sẹo</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/dich-vu-lieu-trinh/#dieu-tri-mun' ) ); ?>" class="footer__nav-link">Điều Trị Mụn</a></li>
                        </ul>
                    </div>

                    <div class="footer__col">
                        <h4 class="footer__title">Thẩm Mỹ</h4>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/cfu-eliffe/' ) ); ?>" class="footer__nav-link">CFU ÈLIFE</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/combo/' ) ); ?>" class="footer__nav-link">Combo</a></li>
                        </ul>
                    </div>

                    <div class="footer__col">
                        <h4 class="footer__title">Sản Phẩm</h4>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/san-pham/#meso' ) ); ?>" class="footer__nav-link">MESO</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/san-pham/#bap' ) ); ?>" class="footer__nav-link">BAP</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/san-pham/#filler' ) ); ?>" class="footer__nav-link">Filler</a></li>
                            <li class="footer__nav-item"><a href="<?php echo esc_url( home_url( '/san-pham/#botox' ) ); ?>" class="footer__nav-link">Botox</a></li>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
