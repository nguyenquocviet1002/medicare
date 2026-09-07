<?php
/**
 * Header Template
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header" role="banner">
    <div class="container">
        <div class="header__wrapper">

            <!-- 1. Logo Thương Hiệu -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="Medicare Clinic - Trang Chủ">
                <img src="<?php echo esc_url( medicare_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="header__logo-img" width="160" height="48">
            </a>

            <!-- 2. Lớp phủ mờ (Backdrop) khi mở menu trên Mobile -->
            <div class="header__backdrop" id="header-backdrop"></div>

            <!-- 3. Navigation Menu -->
            <nav class="header__nav" id="main-nav" aria-label="Menu điều hướng chính">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'header__menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 2,
                    'walker'         => new Medicare_Walker_Nav_Menu(),
                ) );
                ?>
            </nav>

            <!-- 4. Hành động (Giỏ hàng & Nút mở menu mobile) -->
            <div class="header__actions">
                <!-- Nút Giỏ Hàng -->
                <a href="<?php echo esc_url( home_url( '/gio-hang/' ) ); ?>" class="header__action-btn header__action-btn--cart" aria-label="Xem giỏ hàng">
                    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/header/icon-cart.svg' ); ?>" class="header__cart-icon" alt="" width="22" height="26">
                    <span class="header__cart-badge" aria-hidden="true"></span>
                </a>

                <!-- Nút Toggle Mobile Menu (Hamburger) -->
                <button class="header__toggle" id="menu-toggle" type="button" aria-label="Mở danh mục menu"
                    aria-expanded="false" aria-controls="main-nav">
                    <span class="header__toggle-bar"></span>
                    <span class="header__toggle-bar"></span>
                    <span class="header__toggle-bar"></span>
                </button>
            </div>

        </div>
    </div>
</header>
