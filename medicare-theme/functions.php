<?php
/**
 * Medicare Clinic Theme Functions
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MEDICARE_THEME_VERSION', '1.0.0' );
define( 'MEDICARE_THEME_DIR', get_template_directory() );
define( 'MEDICARE_THEME_URI', get_template_directory_uri() );

// Core setup
require_once MEDICARE_THEME_DIR . '/inc/theme-setup.php';
require_once MEDICARE_THEME_DIR . '/inc/enqueue.php';
require_once MEDICARE_THEME_DIR . '/inc/helpers.php';
require_once MEDICARE_THEME_DIR . '/inc/custom-post-types.php';
require_once MEDICARE_THEME_DIR . '/inc/acf-fields.php';
require_once MEDICARE_THEME_DIR . '/inc/walker-nav-menu.php';
