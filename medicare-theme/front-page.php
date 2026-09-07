<?php
/**
 * Front Page Template
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

get_template_part( 'template-parts/content', 'hero' );
get_template_part( 'template-parts/content', 'about' );
get_template_part( 'template-parts/content', 'why-choose' );
get_template_part( 'template-parts/content', 'services' );
get_template_part( 'template-parts/content', 'results' );
get_template_part( 'template-parts/content', 'journey' );

get_footer();
