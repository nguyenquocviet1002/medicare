<?php
/**
 * The template for displaying search results.
 *
 * @package Medicare_Clinic
 */

get_header();
?>

<main id="primary" class="site-main search-template">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                Kết quả tìm kiếm cho: <span><?php echo esc_html( get_search_query() ); ?></span>
            </h1>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-grid__item' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="posts-grid__thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="posts-grid__content">
                            <?php the_title( '<h2 class="posts-grid__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
                            <div class="posts-grid__excerpt"><?php the_excerpt(); ?></div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; Trước',
                    'next_text' => 'Sau &raquo;',
                ) );
                ?>
            </div>
        <?php else : ?>
            <p>Không tìm thấy kết quả phù hợp.</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
