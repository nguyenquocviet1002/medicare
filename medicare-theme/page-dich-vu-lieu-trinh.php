<?php
/**
 * Template Name: Liệu Trình
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$treatments = get_posts( array(
	'post_type'      => 'treatment',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'suppress_filters' => true,
) );

$categories = get_terms( array(
	'taxonomy'   => 'treatment_category',
	'hide_empty' => true,
) );

$has_treatments = ( $treatments && ! is_wp_error( $treatments ) && count( $treatments ) > 0 );
?>

<section class="banner" data-aos="fade-up">
	<img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-lieu-trinh/banner.jpg' ); ?>" alt="">
</section>

<section class="package-services" id="package-services" aria-label="Dịch Vụ Liệu Trình">
	<div class="container">

		<!-- Tiêu Đề Chính -->
		<h2 class="package-services__title" data-aos="fade-up">DỊCH VỤ LIỆU TRÌNH</h2>

		<?php if ( $has_treatments && ! is_wp_error( $categories ) && $categories ) : ?>

			<?php
			$grouped = array();
			foreach ( $categories as $term ) {
				$grouped[ $term->term_id ] = array(
					'name'  => $term->name,
					'slug'  => $term->slug,
					'items' => array(),
				);
			}

			foreach ( $treatments as $treatment ) {
				$term_ids = wp_get_post_terms( $treatment->ID, 'treatment_category', array( 'fields' => 'ids' ) );
				$term_id  = ( ! is_wp_error( $term_ids ) && ! empty( $term_ids ) ) ? $term_ids[0] : 0;

				if ( isset( $grouped[ $term_id ] ) ) {
					$grouped[ $term_id ]['items'][] = $treatment;
				} else {
					if ( ! isset( $grouped[0] ) ) {
						$grouped[0] = array( 'name' => 'Liệu Trình', 'slug' => 'lieu-trinh', 'items' => array() );
					}
					$grouped[0]['items'][] = $treatment;
				}
			}

			$active_key = 'group_' . key( $grouped );
			?>

			<!-- Thanh Điều Hướng Tabs -->
			<div class="package-services__tabs-wrapper">
				<div class="package-services__tabs" role="tablist">
					<?php foreach ( $grouped as $term_id => $group ) :
						if ( empty( $group['items'] ) ) continue;
						$group_key  = 'group_' . $term_id;
						$is_active  = ( $group_key === $active_key );
					?>
						<button
							type="button"
							class="package-services__tab-btn <?php echo $is_active ? 'package-services__tab-btn--active' : ''; ?>"
							data-tab="<?php echo esc_attr( $group['slug'] ); ?>"
							role="tab"
							aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
						>
							<?php echo esc_html( $group['name'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Khung Chứa Thẻ Liệu Trình -->
			<div class="package-services__content" id="package-services-content">
				<?php foreach ( $grouped as $term_id => $group ) : ?>
					<?php if ( empty( $group['items'] ) ) continue; ?>
					<div class="package-services__category" data-tab-panel="<?php echo esc_attr( $group['slug'] ); ?>">
						<?php foreach ( $group['items'] as $treatment ) : ?>
							<?php
							$post_id = $treatment->ID;
							$title   = get_the_title( $treatment );

							$before_img = function_exists( 'get_field' ) ? get_field( 'before_img', $post_id ) : '';
							$after_img  = function_exists( 'get_field' ) ? get_field( 'after_img', $post_id ) : '';
							if ( empty( $before_img ) ) {
								$thumb_id = get_post_thumbnail_id( $treatment );
								$before_img = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
							}
							if ( empty( $after_img ) && ! empty( $before_img ) ) {
								$after_img = $before_img;
							}

							$inclusions = function_exists( 'get_field' ) ? get_field( 'inclusions', $post_id ) : array();
							$benefits   = function_exists( 'get_field' ) ? get_field( 'benefits', $post_id ) : '';
							$price      = function_exists( 'get_field' ) ? get_field( 'price', $post_id ) : '';
							$link       = get_permalink( $treatment );

							if ( $benefits && ! is_array( $benefits ) ) {
								$benefits_lines = array_filter( array_map( 'trim', explode( "\n", $benefits ) ) );
							} else {
								$benefits_lines = $benefits ? (array) $benefits : array();
							}

							$display_price = ( function_exists( 'medicare_format_price' ) ) ? medicare_format_price( $price ) : $price;
							if ( empty( $display_price ) ) {
								$display_price = $price;
							}
							?>
							<article class="package-services__card" data-aos="fade-up">

								<!-- Cột Trái: Ảnh Before & After -->
								<?php if ( $before_img ) : ?>
									<div class="package-services__media">
										<div class="package-services__media-item">
											<img src="<?php echo esc_url( $before_img ); ?>" alt="Tình trạng trước điều trị" class="package-services__media-img" loading="lazy">
										</div>
										<?php if ( $after_img ) : ?>
											<div class="package-services__media-item">
												<img src="<?php echo esc_url( $after_img ); ?>" alt="Kết quả sau liệu trình" class="package-services__media-img" loading="lazy">
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<!-- Cột Phải: Nội Dung Chi Tiết Gói -->
								<div class="package-services__body">
									<h3 class="package-services__card-title">
										<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a>
									</h3>

									<!-- Điểm nổi bật gói -->
									<?php if ( $inclusions ) : ?>
										<div class="package-services__inclusions">
											<?php foreach ( $inclusions as $inclusion ) : ?>
												<div class="package-services__inclusion-item">
													<span class="package-services__inclusion-icon" aria-hidden="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
															<line x1="12" y1="8" x2="12" y2="16"></line>
															<line x1="8" y1="12" x2="16" y2="12"></line>
														</svg>
													</span>
													<span class="<?php echo ! empty( $inclusion['highlight'] ) ? 'package-services__inclusion-item--highlight' : ''; ?>">
														<?php if ( ! empty( $inclusion['highlight'] ) ) : ?>
															<strong class="package-services__inclusion-highlight"><?php echo esc_html( $inclusion['text'] ); ?></strong>
														<?php else : ?>
															<?php echo esc_html( $inclusion['text'] ); ?>
														<?php endif; ?>
													</span>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>

									<!-- Tác dụng -->
									<?php if ( $benefits_lines ) : ?>
										<ul class="package-services__benefits">
											<?php foreach ( $benefits_lines as $benefit ) : ?>
												<li class="package-services__benefit-item"><?php echo esc_html( $benefit ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<!-- Footer: Giá & Nút -->
									<div class="package-services__footer">
										<?php if ( $display_price ) : ?>
											<span class="package-services__price">Giá: <?php echo esc_html( $display_price ); ?></span>
										<?php endif; ?>
										<a href="<?php echo esc_url( $link ); ?>" class="package-services__cart-btn" aria-label="Xem thêm <?php echo esc_attr( $title ); ?>">
											Tìm hiểu thêm
										</a>
									</div>

								</div>

							</article>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>

		<?php else : ?>

			<!-- Thanh Điều Hướng Tabs -->
			<div class="package-services__tabs-wrapper">
				<div class="package-services__tabs" role="tablist">
					<button type="button" class="package-services__tab-btn package-services__tab-btn--active" data-tab="dieu-tri-mun" role="tab" aria-selected="true">ĐIỀU TRỊ MỤN</button>
					<button type="button" class="package-services__tab-btn" data-tab="dieu-tri-seo" role="tab" aria-selected="false">ĐIỀU TRỊ SẸO</button>
					<button type="button" class="package-services__tab-btn" data-tab="lieu-trinh-body" role="tab" aria-selected="false">LIỆU TRÌNH BODY</button>
				</div>
			</div>

			<!-- Khung Chứa Thẻ Liệu Trình (Fallback) -->
			<div class="package-services__content" id="package-services-content">

				<?php
				$img_base  = MEDICARE_THEME_URI . '/assets/images/dich-vu-lieu-trinh/';
				$fallback  = array(
					'dieu-tri-mun' => array(
						array(
							'title' => 'LIỆU TRÌNH ĐIỀU TRỊ MỤN CƠ BẢN',
							'before' => 'mun-co-ban-before.jpg',
							'after' => 'mun-co-ban-after.jpg',
							'inclusions' => array(
								array( 'text' => '+ 3 BUỔI PEEL', 'highlight' => false ),
								array( 'text' => '+ 2 BUỔI LASER/ MESO', 'highlight' => false ),
								array( 'text' => 'TẶNG 3 THÁNG', 'highlight' => true ),
							),
							'benefits' => array(
								'Đào thải bã nhờn, dứt điểm mụn ẩn & mụn viêm nhẹ',
								'Làm dịu da, mờ thâm mới và hạn chế tổn thương sau mụn',
								'Giúp bề mặt da thông thoáng, mịn màng và sáng khỏe',
							),
							'price' => '10.000.000 VNĐ',
						),
						array(
							'title' => 'LIỆU TRÌNH ĐIỀU TRỊ MỤN CHUYÊN SÂU',
							'before' => 'mun-chuyen-sau-before.jpg',
							'after' => 'mun-chuyen-sau-after.jpg',
							'inclusions' => array(
								array( 'text' => '4 BUỔI PEEL', 'highlight' => false ),
								array( 'text' => '4 BUỔI LASER/ MESO', 'highlight' => false ),
								array( 'text' => '4 BUỔI LASER PT', 'highlight' => false ),
								array( 'text' => 'TẶNG 6 THÁNG', 'highlight' => true ),
							),
							'benefits' => array(
								'Dứt điểm mụn viêm dai dẳng, mụn tái phát nhiều lần',
								'Làm dịu kích ứng, mờ thâm và ngăn ngừa hình thành sẹo rỗ',
								'Phục hồi hàng rào bảo vệ, giúp nền da khỏe mịn toàn diện',
							),
							'price' => '20.000.000 VNĐ',
						),
					),
					'dieu-tri-seo' => array(
						array(
							'title' => 'LIỆU TRÌNH ĐIỀU TRỊ SẸO CƠ BẢN',
							'before' => 'seo-co-ban-before.jpg',
							'after' => 'seo-co-ban-after.jpg',
							'inclusions' => array(
								array( 'text' => '6 BUỔI ĐIỀU TRỊ SẸO 5IN1', 'highlight' => false ),
								array( 'text' => 'TẶNG 6 THÁNG', 'highlight' => true ),
							),
							'benefits' => array(
								'Làm đầy 50–70% sẹo rỗ nông, se khít lỗ chân lông, cải thiện bề mặt da',
							),
							'price' => '29.000.000 VNĐ',
						),
						array(
							'title' => 'LIỆU TRÌNH ĐIỀU TRỊ SẸO CHUYÊN SÂU',
							'before' => 'seo-chuyen-sau-before.jpg',
							'after' => 'seo-chuyen-sau-after.jpg',
							'inclusions' => array(
								array( 'text' => '6 BUỔI SẸO 5IN1', 'highlight' => false ),
								array( 'text' => '3 BUỔI MESO', 'highlight' => false ),
								array( 'text' => '2 BUỔI LASER 2IN1', 'highlight' => false ),
								array( 'text' => 'TẶNG 12 THÁNG', 'highlight' => true ),
							),
							'benefits' => array(
								'Đầy 70–85% sẹo rỗ lâu năm, phục hồi nền da dày khỏe, thu nhỏ lỗ chân lông rõ rệt',
							),
							'price' => '39.000.000 VNĐ',
						),
						array(
							'title' => 'LIỆU TRÌNH ĐIỀU TRỊ SẸO ĐA TẦNG',
							'before' => 'seo-da-tang-before.jpg',
							'after' => 'seo-da-tang-after.jpg',
							'inclusions' => array(
								array( 'text' => '6 BUỔI SẸO 5IN1', 'highlight' => false ),
								array( 'text' => '6 BUỔI MESO', 'highlight' => false ),
								array( 'text' => '6 BUỔI LASER 3IN1', 'highlight' => false ),
								array( 'text' => 'CHĂM SÓC DA MIỄN PHÍ TRỌN ĐỜI', 'highlight' => false ),
							),
							'benefits' => array(
								'Đầy 85–95% sẹo rỗ phức tạp, sẹo xơ cứng lâu năm; tái sinh nền da căng bóng, săn chắc toàn diện',
							),
							'price' => '80.000.000 VNĐ',
						),
					),
					'lieu-trinh-body' => array(
						array(
							'title' => 'VÙNG NHỎ (NÁCH / 1 TAY / 1 CHÂN)',
							'before' => 'body-vung-nho-before.jpg',
							'after' => 'body-vung-nho-after.jpg',
							'inclusions' => array(
								array( 'text' => '3 BUỔI LASER TONING', 'highlight' => false ),
								array( 'text' => '3 BUỔI CHEMICAL PEEL', 'highlight' => false ),
							),
							'benefits' => array(
								'Mờ thâm sạm rõ rệt, se khít lỗ chân lông, giảm tình trạng sần da gà do cạo/nhổ',
							),
							'price' => '10.000.000 VNĐ',
						),
						array(
							'title' => 'VÙNG TRUNG BÌNH (NGỰC/MÔNG)',
							'before' => 'body-vung-tb-before.jpg',
							'after' => 'body-vung-tb-after.jpg',
							'inclusions' => array(
								array( 'text' => '3 BUỔI LASER TONING/ FRACTIONAL', 'highlight' => false ),
								array( 'text' => '3 BUỔI CHEMICAL PEEL', 'highlight' => false ),
							),
							'benefits' => array(
								'Trị dứt điểm mụn lưng, mờ thâm mụn body, cải thiện viêm nang lông, trả lại làn da mịn màng, sáng khỏe',
							),
							'price' => '15.000.000 VNĐ',
						),
						array(
							'title' => 'VÙNG LỚN (LƯNG / 2 TAY / 2 CHÂN)',
							'before' => 'body-vung-lon-before.jpg',
							'after' => 'body-vung-lon-after.jpg',
							'inclusions' => array(
								array( 'text' => '3 BUỔI LASER TONING/ FRACTIONAL', 'highlight' => false ),
								array( 'text' => '3 BUỔI CHEMICAL PEEL', 'highlight' => false ),
							),
							'benefits' => array(
								'Trị dứt điểm mụn lưng, mờ thâm mụn body, cải thiện viêm nang lông, trả lại làn da mịn màng, sáng khỏe',
							),
							'price' => '22.000.000 VNĐ',
						),
					),
				);

				foreach ( $fallback as $cat_slug => $items ) :
				?>
					<div class="package-services__category" data-tab-panel="<?php echo esc_attr( $cat_slug ); ?>">
						<?php foreach ( $items as $item ) : ?>
							<article class="package-services__card" data-aos="fade-up">

								<!-- Cột Trái: Ảnh Before & After -->
								<div class="package-services__media">
									<div class="package-services__media-item">
										<img src="<?php echo esc_url( $img_base . $item['before'] ); ?>" alt="Tình trạng trước điều trị" class="package-services__media-img" loading="lazy">
									</div>
									<div class="package-services__media-item">
										<img src="<?php echo esc_url( $img_base . $item['after'] ); ?>" alt="Kết quả sau liệu trình" class="package-services__media-img" loading="lazy">
									</div>
								</div>

								<!-- Cột Phải: Nội Dung Chi Tiết Gói -->
								<div class="package-services__body">
									<h3 class="package-services__card-title"><?php echo esc_html( $item['title'] ); ?></h3>

									<!-- Điểm nổi bật gói -->
									<div class="package-services__inclusions">
										<?php foreach ( $item['inclusions'] as $inc ) : ?>
											<div class="package-services__inclusion-item">
												<span class="package-services__inclusion-icon" aria-hidden="true">
													<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
														<line x1="12" y1="8" x2="12" y2="16"></line>
														<line x1="8" y1="12" x2="16" y2="12"></line>
													</svg>
												</span>
												<span class="<?php echo ! empty( $inc['highlight'] ) ? 'package-services__inclusion-item--highlight' : ''; ?>">
													<?php if ( ! empty( $inc['highlight'] ) ) : ?>
														<strong class="package-services__inclusion-highlight"><?php echo esc_html( $inc['text'] ); ?></strong>
													<?php else : ?>
														<?php echo esc_html( $inc['text'] ); ?>
													<?php endif; ?>
												</span>
											</div>
										<?php endforeach; ?>
									</div>

									<!-- Tác dụng -->
									<ul class="package-services__benefits">
										<?php foreach ( $item['benefits'] as $benefit ) : ?>
											<li class="package-services__benefit-item"><?php echo esc_html( $benefit ); ?></li>
										<?php endforeach; ?>
									</ul>

									<!-- Footer: Giá & Nút -->
									<div class="package-services__footer">
										<span class="package-services__price">Giá: <?php echo esc_html( $item['price'] ); ?></span>
										<span class="package-services__cart-btn" role="button" aria-label="Thêm <?php echo esc_attr( $item['title'] ); ?> vào giỏ hàng">
											Tìm hiểu thêm
										</span>
									</div>

								</div>

							</article>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

			</div>

		<?php endif; ?>

	</div>
</section>

<?php
get_footer();
