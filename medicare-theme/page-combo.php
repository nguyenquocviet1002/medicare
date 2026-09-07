<?php
/**
 * Template Name: Combo
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$combos = get_posts( array(
    'post_type'      => 'combo',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'suppress_filters' => true,
) );
?>

<section class="banner" data-aos="fade-up">
    <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/combo/banner.jpg' ); ?>" alt="">
</section>

<?php if ( $combos ) : ?>
<?php
    $grouped = array();
    foreach ( $combos as $c ) {
        $section = function_exists( 'get_field' ) ? get_field( 'section', $c->ID ) : '';
        if ( empty( $section ) ) {
            $terms = get_the_terms( $c->ID, 'combo_type' );
            $section = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'CÁC GÓI COMBO THẨM MỸ';
        }
        $grouped[ $section ][] = $c;
    }
?>
    <?php foreach ( $grouped as $section_title => $items ) : ?>
    <section class="combo-section" data-aos="fade-up">
        <h2 class="combo-section__title" data-aos="fade-up"><?php echo esc_html( $section_title ); ?></h2>

        <div class="combo-section__list">
            <?php foreach ( $items as $combo ) : ?>
                <?php
                $title       = get_the_title( $combo );
                $subtitle    = function_exists( 'get_field' ) ? get_field( 'subtitle', $combo->ID ) : '';
                $combo_items = function_exists( 'get_field' ) ? get_field( 'combo_items', $combo->ID ) : array();
                $deal_price  = function_exists( 'get_field' ) ? get_field( 'deal_price', $combo->ID ) : '';
                $orig_price  = function_exists( 'get_field' ) ? get_field( 'original_price', $combo->ID ) : '';
                ?>
                <article class="combo-card" data-aos="fade-up">
                    <!-- Header: Tiêu đề & Subtitle -->
                    <div class="combo-card__header">
                        <h3 class="combo-card__title"><?php echo esc_html( $title ); ?></h3>
                        <?php if ( $subtitle ) : ?>
                        <div class="combo-card__subtitle"><?php echo esc_html( $subtitle ); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Danh sách sản phẩm / dịch vụ ghép nối -->
                    <div class="combo-card__items <?php echo esc_attr( 'combo-card__items--count-' . count( $combo_items ) ); ?>">
                        <?php if ( ! empty( $combo_items ) ) : ?>
                            <?php foreach ( $combo_items as $index => $item ) : ?>
                                <?php
                                $item_name  = isset( $item['name'] ) ? $item['name'] : '';
                                $item_value = isset( $item['value'] ) ? $item['value'] : '';
                                $item_img   = isset( $item['image'] ) ? $item['image'] : '';
                                ?>
                                <?php if ( $index > 0 ) : ?>
                                <div class="combo-card__plus-badge" aria-hidden="true">+</div>
                                <?php endif; ?>
                                <div class="combo-card__item">
                                    <?php if ( $item_img ) : ?>
                                    <img src="<?php echo esc_url( $item_img ); ?>" alt="<?php echo esc_attr( $item_name ); ?>" class="combo-card__item-img" loading="lazy">
                                    <?php endif; ?>
                                    <div class="combo-card__item-overlay">
                                        <span class="combo-card__item-name"><?php echo esc_html( $item_name ); ?></span>
                                        <?php if ( $item_value ) : ?>
                                        <span class="combo-card__item-value"><?php echo esc_html( $item_value ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Footer: Giá Ưu Đãi, Giá Gốc & Giỏ Hàng -->
                    <div class="combo-card__footer">
                        <div class="combo-card__price-box">
                            <?php if ( $deal_price ) : ?>
                            <span class="combo-card__deal-price">Giá Ưu Đãi: <?php echo esc_html( $deal_price ); ?></span>
                            <?php endif; ?>
                            <?php if ( $orig_price ) : ?>
                            <span class="combo-card__original-price"><?php echo esc_html( $orig_price ); ?></span>
                            <?php endif; ?>
                        </div>

                        <button class="combo-card__cart-btn" type="button" aria-label="Thêm <?php echo esc_attr( $title ); ?> vào giỏ hàng" data-cart-id="<?php echo esc_attr( $combo->ID ); ?>" data-cart-name="<?php echo esc_attr( $title ); ?>" data-cart-price="<?php echo esc_attr( $deal_price ); ?>">
                            <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/combo/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="combo-card__cart-icon">
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>

<?php else : ?>
    <?php
    $fallback = array(
        array(
            'section_title' => 'CÁC GÓI COMBO THẨM MỸ',
            'combos' => array(
                array(
                    'title' => 'COMBO TÁI SINH DA CHUYÊN SÂU',
                    'subtitle' => 'TRẺ HÓA PHỤC HỒI',
                    'items' => array(
                        array( 'name' => '3 REJURAN HEALER', 'value' => '18.000.000 VNĐ', 'image' => 'rejuran-healer-box.jpg' ),
                        array( 'name' => '1 CFU FULLFACE', 'value' => '25.000.000 VNĐ', 'image' => 'cfu-fullface-treatment.jpg' ),
                    ),
                    'deal' => '35.000.000 VNĐ',
                    'orig' => '43.000.000 VNĐ',
                ),
                array(
                    'title' => 'GLASS SKIN CĂNG BÓNG CHUẨN HÀN',
                    'subtitle' => '',
                    'items' => array(
                        array( 'name' => '3 BAP KARISMA', 'value' => '20.000.000 VNĐ', 'image' => 'bap-karisma-box.jpg' ),
                        array( 'name' => '2 MESO TEOXANE', 'value' => '24.000.000 VNĐ', 'image' => 'meso-teoxane-box.jpg' ),
                    ),
                    'deal' => '36.000.000 VNĐ',
                    'orig' => '44.000.000 VNĐ',
                ),
                array(
                    'title' => 'COMBO LIFTING ELITE',
                    'subtitle' => 'NÂNG CƠ TRẺ HÓA ĐA TẦNG',
                    'items' => array(
                        array( 'name' => '3 KARISMA', 'value' => '20.000.000 VNĐ', 'image' => 'bap-karisma-box.jpg' ),
                        array( 'name' => '1 CFU FULLFACE', 'value' => '25.000.000 VNĐ', 'image' => 'cfu-fullface-treatment.jpg' ),
                    ),
                    'deal' => '38.000.000 VNĐ',
                    'orig' => '45.000.000 VNĐ',
                ),
                array(
                    'title' => 'ULTIMATE LIFT NÂNG CƠ TRẺ HÓA ĐA TẦNG',
                    'subtitle' => 'NÂNG CƠ TRẺ HÓA ĐA TẦNG THU NHỎ LỖ CHÂN LÔNG',
                    'items' => array(
                        array( 'name' => '1 CFU FULL FACE', 'value' => '25.000.000 VNĐ', 'image' => 'cfu-fullface-treatment.jpg' ),
                        array( 'name' => '3 KARISMA', 'value' => '20.000.000 VNĐ', 'image' => 'bap-karisma-box.jpg' ),
                        array( 'name' => '1 MESO BOTOX', 'value' => '4.000.000 VNĐ', 'image' => 'meso-botox-treatment.jpg' ),
                    ),
                    'deal' => '40.000.000 VNĐ',
                    'orig' => '49.000.000 VNĐ',
                ),
                array(
                    'title' => 'TÁI TẠO LÀN DA TOÀN DIỆN',
                    'subtitle' => 'NÂNG CƠ TRẺ HÓA ĐA TẦNG TRẮNG SÁNG',
                    'items' => array(
                        array( 'name' => '1 CFU FULL FACE', 'value' => '25.000.000 VNĐ', 'image' => 'cfu-fullface-treatment.jpg' ),
                        array( 'name' => '3 KARISMA', 'value' => '20.000.000 VNĐ', 'image' => 'bap-karisma-box.jpg' ),
                        array( 'name' => '3 REJURAN HEALER', 'value' => '18.000.000 VNĐ', 'image' => 'rejuran-healer-syringes.jpg' ),
                    ),
                    'deal' => '52.000.000 VNĐ',
                    'orig' => '63.000.000 VNĐ',
                ),
            ),
        ),
        array(
            'section_title' => 'CÁC GÓI COMBO CHO MẮT',
            'combos' => array(
                array(
                    'title' => 'TRŨNG MẮT + THÂM MẮT',
                    'subtitle' => 'TRẺ HÓA TRŨNG & THÂM VÙNG MẮT',
                    'items' => array(
                        array( 'name' => '3 NUCLEOSKIN', 'value' => '', 'image' => 'nucleoskin-box.jpg' ),
                    ),
                    'deal' => '18.000.000 VNĐ',
                    'orig' => '21.000.000 VNĐ',
                ),
                array(
                    'title' => 'THÂM MẮT',
                    'subtitle' => 'CẢI THIỆN QUẦNG THÂM MẮT',
                    'items' => array(
                        array( 'name' => '5 REJURAN I', 'value' => '', 'image' => 'rejuran-i-box.jpg' ),
                    ),
                    'deal' => '20.000.000 VNĐ',
                    'orig' => '25.000.000 VNĐ',
                ),
                array(
                    'title' => 'THÂM NẶNG + TRŨNG NẶNG',
                    'subtitle' => '(INTENSIVE EYE TRŨNG THÂM CHUYÊN SÂU)',
                    'items' => array(
                        array( 'name' => '3 REJURAN I', 'value' => '15.000.000 VNĐ', 'image' => 'rejuran-i-single.jpg' ),
                        array( 'name' => '1 VITAL LIGHT RESTYLANE', 'value' => '12.000.000 VNĐ', 'image' => 'restylane-vital-light.jpg' ),
                    ),
                    'deal' => '24.000.000 VNĐ',
                    'orig' => '27.000.000 VNĐ',
                ),
                array(
                    'title' => 'LÀM ĐẦY TRŨNG MẮT',
                    'subtitle' => '(UNDER EYE VOLUME RESTORATION)',
                    'items' => array(
                        array( 'name' => '1 TEOXANE 2', 'value' => '12.000.000 VNĐ', 'image' => 'meso-teoxane-box.jpg' ),
                        array( 'name' => '3 REJURAN I', 'value' => '15.000.000 VNĐ', 'image' => 'rejuran-i-single.jpg' ),
                    ),
                    'deal' => '24.000.000 VNĐ',
                    'orig' => '27.000.000 VNĐ',
                ),
            ),
        ),
    );

    foreach ( $fallback as $fgroup ) :
        $fb_count = count( $fgroup['combos'] );
    ?>
    <section class="combo-section" data-aos="fade-up">
        <h2 class="combo-section__title" data-aos="fade-up"><?php echo esc_html( $fgroup['section_title'] ); ?></h2>

        <div class="combo-section__list">
            <?php foreach ( $fgroup['combos'] as $index => $combo ) : ?>
                <?php $count = count( $combo['items'] ); ?>
                <article class="combo-card" data-aos="fade-up">
                    <div class="combo-card__header">
                        <h3 class="combo-card__title"><?php echo esc_html( $combo['title'] ); ?></h3>
                        <?php if ( ! empty( $combo['subtitle'] ) ) : ?>
                        <div class="combo-card__subtitle"><?php echo esc_html( $combo['subtitle'] ); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="combo-card__items <?php echo esc_attr( 'combo-card__items--count-' . $count ); ?>">
                        <?php foreach ( $combo['items'] as $i => $item ) : ?>
                            <?php if ( $i > 0 ) : ?>
                            <div class="combo-card__plus-badge" aria-hidden="true">+</div>
                            <?php endif; ?>
                            <div class="combo-card__item">
                                <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/combo/' . $item['image'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" class="combo-card__item-img" loading="lazy">
                                <div class="combo-card__item-overlay">
                                    <span class="combo-card__item-name"><?php echo esc_html( $item['name'] ); ?></span>
                                    <?php if ( ! empty( $item['value'] ) ) : ?>
                                    <span class="combo-card__item-value"><?php echo esc_html( $item['value'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="combo-card__footer">
                        <div class="combo-card__price-box">
                            <span class="combo-card__deal-price">Giá Ưu Đãi: <?php echo esc_html( $combo['deal'] ); ?></span>
                            <span class="combo-card__original-price"><?php echo esc_html( $combo['orig'] ); ?></span>
                        </div>

                        <button class="combo-card__cart-btn" type="button" aria-label="Thêm <?php echo esc_attr( $combo['title'] ); ?> vào giỏ hàng" data-cart-id="combo-fb-<?php echo esc_attr( $index ); ?>" data-cart-name="<?php echo esc_attr( $combo['title'] ); ?>" data-cart-price="<?php echo esc_attr( $combo['deal'] ); ?>">
                            <img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/combo/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="combo-card__cart-icon">
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>
<?php endif; ?>

<?php
get_footer();
