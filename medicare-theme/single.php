<?php
/**
 * The template for displaying single posts.
 *
 * @package Medicare_Clinic
 */

get_header();
?>

<main id="primary" class="site-main single-post">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="entry-meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $categories = get_the_category();
                    if ( $categories ) :
                    ?>
                        <div class="entry-categories">
                            <?php foreach ( $categories as $cat ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                    <?php echo esc_html( $cat->name ); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
