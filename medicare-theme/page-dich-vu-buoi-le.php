<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$SVG_CART_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>';

$services_query = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => -1,
	'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
) );

$has_services = $services_query->have_posts();
?>

<section class="banner" data-aos="fade-up">
	<img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/banner.jpg' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
</section>

<section class="single-services" id="single-services" aria-label="Dịch Vụ Buổi Lẻ">
	<div class="container">

		<h2 class="single-services__title" data-aos="fade-up"><?php echo esc_html( get_the_title() ); ?></h2>

		<?php if ( $has_services ) : ?>

			<?php
			$terms = get_terms( array( 'taxonomy' => 'service_category', 'hide_empty' => true ) );

			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				$groups = array();
				foreach ( $terms as $term ) {
					$groups[] = array(
						'title' => $term->name,
						'layout' => 'grid',
						'posts' => get_posts( array(
							'post_type' => 'service',
							'posts_per_page' => -1,
							'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
							'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $term->term_id ) ),
						) ),
					);
				}
			} else {
				$face_posts = array();
				$body_posts = array();
				while ( $services_query->have_posts() ) {
					$services_query->the_post();
					$section = function_exists( 'get_field' ) ? get_field( 'section' ) : '';
					if ( 'body' === $section ) {
						$body_posts[] = $services_query->post;
					} else {
						$face_posts[] = $services_query->post;
					}
				}
				wp_reset_postdata();

				$groups = array(
					array( 'title' => 'ĐẶC TRỊ VÙNG MẶT', 'layout' => 'grid', 'posts' => $face_posts ),
					array( 'title' => 'PHỤC HỒI & TÁI TẠO BODY', 'layout' => 'grid', 'posts' => $body_posts ),
				);
			}

			foreach ( $groups as $group ) :
				if ( empty( $group['posts'] ) ) continue;
				?>
				<div class="single-services__section-group" data-aos="fade-up">
					<?php if ( ! empty( $group['title'] ) ) : ?>
						<h3 class="single-services__category" data-aos="fade-up"><?php echo esc_html( $group['title'] ); ?></h3>
					<?php endif; ?>

					<div class="<?php echo ( 'wide' === $group['layout'] ) ? 'single-services__wide-wrapper' : 'single-services__grid'; ?>">
						<?php foreach ( $group['posts'] as $service_post ) :
							setup_postdata( $service_post );
							$service_id    = get_the_ID();
							$service_title = get_the_title();
							$service_link  = get_permalink( $service_id );

							$benefits    = function_exists( 'get_field' ) ? get_field( 'benefits', $service_id ) : '';
							$indications = function_exists( 'get_field' ) ? get_field( 'indications', $service_id ) : '';
							$price       = function_exists( 'get_field' ) ? get_field( 'price', $service_id ) : '';

							if ( ! empty( $benefits ) ) {
								$benefits = array_filter( array_map( 'trim', explode( "\n", (string) $benefits ) ) );
							} else {
								$benefits = array();
							}

							$thumb_html = '';
							if ( has_post_thumbnail( $service_id ) ) {
								$thumb_html = get_the_post_thumbnail( $service_id, 'service-card', array( 'class' => 'single-services__card-img', 'loading' => 'lazy' ) );
							}
							?>
							<article class="single-services__card" data-aos="fade-up">
								<div class="single-services__card-media">
									<?php if ( $thumb_html ) : ?>
										<?php echo $thumb_html; ?>
									<?php else : ?>
										<img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="<?php echo esc_attr( $service_title ); ?>" class="single-services__card-img" loading="lazy">
									<?php endif; ?>
								</div>

								<div class="single-services__card-body">
									<h4 class="single-services__card-title"><?php echo esc_html( $service_title ); ?></h4>

									<?php if ( ! empty( $benefits ) ) : ?>
										<div class="single-services__section-title">TÁC DỤNG</div>
										<ul class="single-services__benefits">
											<?php foreach ( $benefits as $benefit ) : ?>
												<li class="single-services__benefit-item"><?php echo esc_html( $benefit ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<?php if ( ! empty( $indications ) ) : ?>
										<div class="single-services__section-title">CHỈ ĐỊNH</div>
										<p class="single-services__indications"><?php echo esc_html( $indications ); ?></p>
									<?php endif; ?>

									<div class="single-services__card-footer">
										<span class="single-services__price">Giá: <?php echo esc_html( function_exists( 'medicare_format_price' ) && ! empty( $price ) ? medicare_format_price( $price ) : $price ); ?></span>
										<a href="<?php echo esc_url( $service_link ); ?>" class="single-services__cart-btn" aria-label="Tìm hiểu thêm <?php echo esc_attr( $service_title ); ?>">
											<?php echo $SVG_CART_ICON; ?>
										</a>
									</div>
									<a href="<?php echo esc_url( $service_link ); ?>" class="single-services__learn-more">Tìm hiểu thêm</a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach;
			wp_reset_postdata();
			?>

		<?php else : ?>

			<?php
			$fallback_groups = array(
				array(
					'title' => 'LASER ĐẶC TRỊ VÙNG MẶT',
					'items' => array(
						array( 'title' => 'LASER CO2 FRACTIONAL', 'image' => 'laser-co2-fractional.jpg', 'benefits' => array( 'Tạo các vi cột tổn thương nhiệt siêu nhỏ xuyên từ thượng bì xuống trung bì theo dạng phân đoạn', 'Kích thích cơ chế tái tạo mô tự nhiên & Thúc đẩy tăng sinh collagen và elastin mới', 'Hỗ trợ tái cấu trúc nền da và cải thiện kết cấu da', 'Giúp làm mịn bề mặt da và thu nhỏ lỗ chân lông', 'Hỗ trợ tăng độ săn chắc và cải thiện độ đàn hồi của da' ), 'indications' => 'Sẹo rỗ sau mụn, Lỗ chân lông to, Bề mặt da sần, kết cấu da không mịn, Da không đều màu.', 'price' => '2.000.000 VNĐ' ),
						array( 'title' => 'ĐẦU ĐỐT VI ĐIỂM', 'image' => 'dau-dot-vi-diem.jpg', 'benefits' => array( 'Tạo vi tổn thương nhiệt rất nhỏ và chính xác trên bề mặt da', 'Hỗ trợ loại bỏ các mô da không mong muốn', 'Kích thích quá trình tái tạo mô mới', 'Thúc đẩy tăng sinh collagen, giúp da phục hồi tốt hơn', 'Hỗ trợ làm phẳng và cải thiện bề mặt da' ), 'indications' => 'Sẹo rỗ, Sẹo lồi nhỏ, U mềm treo (skin tag), Mụn thịt.', 'price' => '1.500.000 VNĐ' ),
						array( 'title' => 'LASER PT', 'image' => 'laser-pt.jpg', 'benefits' => array( 'Giúp làm dịu nhanh các nốt mụn viêm, mụn sưng đỏ', 'Hỗ trợ giảm vi khuẩn gây mụn và hạn chế mụn lan rộng', 'Giúp giảm sưng, hỗ trợ mụn xẹp nhanh hơn', 'Hỗ trợ phục hồi da và hạn chế thâm sau mụn', 'Góp phần ổn định nền da và giảm nguy cơ tái phát mụn' ), 'indications' => 'Sẹo rỗ, sẹo lồi nhỏ, mụn thịt, u mềm treo', 'price' => '2.000.000 VNĐ' ),
						array( 'title' => 'LASER FRACTIONAL', 'image' => 'laser-fractional.jpg', 'benefits' => array( 'Kích thích tăng sinh Collagen & Elastin, tái cấu trúc nền da', 'Làm đầy sẹo rỗ, se khít lỗ chân lông, làm mịn bề mặt da', 'Tăng độ săn chắc, đàn hồi và giúp da đều màu' ), 'indications' => 'Sẹo rỗ sau mụn, lỗ chân lông to, da sần sùi kém mịn, da lão hóa chùng nhão nhẹ, da không đều màu', 'price' => '3.000.000 VNĐ' ),
						array( 'title' => 'LASER 1064', 'image' => 'laser-1064.jpg', 'benefits' => array( 'Tác động vào sắc tố nằm sâu trong da, hỗ trợ cải thiện các vấn đề tăng sắc tố sâu', 'Hỗ trợ giảm viêm và làm dịu vùng da tổn thương', 'Kích thích hoạt động của nguyên bào sợi, thúc đẩy quá trình tăng sinh collagen', 'Hỗ trợ phục hồi cấu trúc da và cải thiện độ đàn hồi', 'Góp phần ổn định nền da và hỗ trợ quá trình tái tạo da' ), 'indications' => 'Da đang có tình trạng viêm hoặc tổn thương sau mụn, Da có sắc tố sâu, thâm, nám.', 'price' => '3.000.000 VNĐ' ),
						array( 'title' => 'LASER 532', 'image' => 'laser-532.jpg', 'benefits' => array( 'Hỗ trợ phá vỡ sắc tố nông, giúp cải thiện thâm sau mụn', 'Tác động vào các mao mạch giãn ở vùng viêm, giúp giảm đỏ và làm dịu da', 'Hỗ trợ giảm viêm và ổn định vùng da đang có mụn', 'Góp phần làm sáng và đều màu da sau quá trình điều trị mụn' ), 'indications' => 'Thâm sau mụn (PIH), Nám nông, tàn nhang nhẹ, Đốm nâu, tăng sắc tố bề mặt, Hồng ban sau viêm, Da không đều màu, xỉn màu.', 'price' => '2.000.000 VNĐ' ),
					),
				),
				array(
					'title' => 'LASER PHỤC HỒI & TÁI TẠO BODY',
					'items' => array(
						array( 'title' => 'LASER FRACTIONAL (BODY/LƯNG)', 'image' => 'laser-body-fractional.jpg', 'benefits' => array( 'Kích thích tăng sinh collagen & elastin, làm phẳng sẹo và vết thâm body', 'Tái tạo bề mặt da mịn màng, se khít lỗ chân lông và ngừa dày sừng trên da' ), 'indications' => 'Thâm mụn lưng/ngực/mông, sẹo rỗ body, viêm nang lông', 'price' => '5.000.000 VNĐ' ),
						array( 'title' => 'LASER TONING', 'image' => 'laser-body-toning.jpg', 'benefits' => array( 'Phá vỡ melanin dưới da, làm mờ thâm nám, tàn nhang & thâm sạm trên da', 'Trẻ hóa nền da, se khít lỗ chân lông và làm đều màu da toàn diện' ), 'indications' => 'Nám mảng, nám sâu, tàn nhang, đốm nâu, da xỉn màu', 'price' => '5.000.000 VNĐ' ),
						array( 'title' => 'LASER NÁCH 2IN1', 'image' => 'laser-body-nach.jpg', 'benefits' => array( 'Khử thâm sạm sâu, làm sáng mịn và đều màu vùng da dưới cánh tay', 'Thu nhỏ lỗ chân lông, hạn chế tiết mồ hôi và giảm sần sùi' ), 'indications' => 'Thâm nách sau cạo/nhổ/wax, da nách sần sùi, lỗ chân lông to', 'price' => '3.000.000 VNĐ' ),
						array( 'title' => 'LASER FRACTIONAL + TONING (COMBO CHUYÊN SÂU)', 'image' => 'laser-body-combo.jpg', 'benefits' => array( 'Tác động kép: Vừa làm phẳng kết cấu da sần/sẹo, vừa xử lý sắc tố thâm sạm tầng sâu', 'Phục hồi, tái sinh toàn diện nền da sáng khỏe và mịn màng tối đa' ), 'indications' => 'Tình trạng kết hợp thâm đốm, thâm sạm nặng và sẹo/sần bề mặt diện rộng', 'price' => '3.000.000 VNĐ' ),
					),
				),
				array(
					'title' => 'PEEL ĐẶC TRỊ VÙNG MẶT',
					'items' => array(
						array( 'title' => 'PEEL TRỊ SẸO', 'image' => 'peel-tri-seo.jpg', 'benefits' => array( 'Loại bỏ tế bào sừng già cỗi, thúc đẩy tái tạo tế bào mới', 'Tăng sinh collagen, làm đầy sẹo lõm và làm mịn bề mặt da', 'Thông thoáng lỗ chân lông, giúp da khỏe và hấp thụ dưỡng chất tối ưu' ), 'indications' => 'Sẹo rỗ/sẹo lõm, da sần sùi kém mịn, da không đều màu', 'price' => '1.500.000 VNĐ' ),
						array( 'title' => 'PEEL SẮC TỐ DA', 'image' => 'peel-sac-to.jpg', 'benefits' => array( 'Đào thải lớp tế bào sừng chứa melanin tích tụ trên bề mặt', 'Làm mờ nám, tàn nhang và các đốm nâu tăng sắc tố', 'Tái tạo nền da sáng mịn, đều màu và tăng khả năng hấp thu dưỡng chất' ), 'indications' => 'Nám nông, tàn nhang, thâm sạm, da xỉn màu và không đều màu trên da', 'price' => '1.500.000 VNĐ' ),
						array( 'title' => 'PEEL TRỊ MỤN', 'image' => 'peel-tri-mun.jpg', 'benefits' => array( 'Loại bỏ da chết và bã nhờn tích tụ trên da, giải phóng bít tắc cổ nang lông', 'Hỗ trợ gom khô cồi mụn, giảm sưng viêm nhanh chóng', 'Làm sạch sâu, giúp bề mặt da thông thoáng và ổn định nền da' ), 'indications' => 'Mụn ẩn, mụn đầu đen, mụn viêm sưng, trên da nhiều dầu thừa bít tắc', 'price' => '1.500.000 VNĐ' ),
					),
				),
				array(
					'title' => 'PEEL PHỤC HỒI & TÁI TẠO BODY',
					'items' => array(
						array( 'title' => 'PEEL NGỰC', 'image' => 'peel-body-nguc.jpg', 'benefits' => array( 'Đào thải bã nhờn, thông thoáng cổ nang lông và gom cồi mụn vùng ngực', 'Mờ thâm mụn, loại bỏ tế bào sừng già cỗi giúp bề mặt da sáng mịn' ), 'indications' => 'Mụn viêm, mụn ẩn, thâm mụn, da vùng ngực sần sùi kém mịn', 'price' => '3.500.000 VNĐ' ),
						array( 'title' => 'PEEL MÔNG', 'image' => 'peel-body-mong.jpg', 'benefits' => array( 'Xử lý triệt để lớp sừng dày, chai sần tích tụ do ma sát và ngồi nhiều', 'Đào thải hắc sắc tố, làm sáng hồng và mịn màng vùng da mông' ), 'indications' => 'Mông thâm sạm, da mông thô ráp sần sùi, mụn li ti hạt kê vùng mông', 'price' => '3.000.000 VNĐ' ),
						array( 'title' => 'PEEL NÁCH', 'image' => 'peel-body-nach.jpg', 'benefits' => array( 'Phá hủy hắc sắc tố bề mặt, làm sáng và đều màu vùng da dưới cánh tay', 'Làm mịn bề mặt, se khít lỗ chân lông và giảm tình trạng sần da gà do cạo/nhổ' ), 'indications' => 'Vùng da nách thâm & sạm màu, sần sùi, thô ráp sau tẩy/triệt lông nhiều lần', 'price' => '1.500.000 VNĐ' ),
						array( 'title' => 'PEEL LƯNG / 2 TAY / 2 CHÂN', 'image' => 'peel-body-lung-tay-chan.jpg', 'benefits' => array( 'Giải phóng bít tắc nang lông, giảm viêm sưng và ngăn ngừa mụn body lây lan', 'Đào thải sắc tố sạm xỉn, cải thiện viêm nang lông và làm đều màu da diện rộng' ), 'indications' => 'Mụn lưng, thâm mụn body, viêm nang lông, da tay chân thô ráp', 'price' => '5.000.000 VNĐ' ),
					),
				),
				array(
					'title' => 'LĂN KIM ĐẶC TRỊ SẸO RỖ',
					'wide' => true,
					'items' => array(
						array( 'title' => 'LĂN KIM ĐẶC TRỊ SẸO RỖ', 'image' => 'lan-kim-dac-tri-seo.jpg', 'benefits' => array( 'Tạo vi tổn thương cơ học, kích hoạt cơ chế tự phục hồi tự nhiên của da', 'Tăng sinh collagen & elastin mạnh mẽ, tái tạo và làm săn chắc cấu trúc da', 'Cải thiện độ mịn màng, làm mờ thâm và se khít lỗ chân lông' ), 'indications' => 'Sẹo rỗ sau mụn, thâm sau mụn, lỗ chân lông to, da sần sùi, không đều màu', 'price' => '2.000.000 VNĐ' ),
					),
				),
				array(
					'title' => 'PHI KIM TÁI TẠO DA',
					'wide' => true,
					'items' => array(
						array( 'title' => 'PHI KIM TÁI TẠO DA', 'image' => 'phi-kim-tai-tao-da.jpg', 'benefits' => array( 'Đầu kim di chuyển thẳng đứng tác động chính xác, hạn chế tối đa xâm lấn bề mặt', 'Kích thích tăng sinh collagen & elastin, tái tạo tế bào mới chuyên sâu', 'Tăng khả năng hấp thụ dưỡng chất, phục hồi nền da mịn màng và sáng khỏe' ), 'indications' => 'Sẹo rỗ sau mụn, lỗ chân lông to, thâm sau mụn, da sần sùi, không đều màu', 'price' => '2.000.000 VNĐ' ),
					),
				),
			);

			foreach ( $fallback_groups as $group ) :
				$is_wide = ! empty( $group['wide'] );
				?>
				<div class="single-services__section-group" data-aos="fade-up">
					<?php if ( ! empty( $group['title'] ) ) : ?>
						<h3 class="single-services__category" data-aos="fade-up"><?php echo esc_html( $group['title'] ); ?></h3>
					<?php endif; ?>

					<div class="<?php echo $is_wide ? 'single-services__wide-wrapper' : 'single-services__grid'; ?>">
						<?php foreach ( $group['items'] as $item ) :
							$image_url = MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/' . $item['image'];
							?>
							<article class="single-services__card <?php echo $is_wide ? 'single-services__card--horizontal' : ''; ?>" data-aos="fade-up">
								<div class="single-services__card-media">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="single-services__card-img" loading="lazy">
								</div>

								<div class="single-services__card-body">
									<h4 class="single-services__card-title"><?php echo esc_html( $item['title'] ); ?></h4>

									<div class="single-services__section-title">TÁC DỤNG</div>
									<ul class="single-services__benefits">
										<?php foreach ( $item['benefits'] as $benefit ) : ?>
											<li class="single-services__benefit-item"><?php echo esc_html( $benefit ); ?></li>
										<?php endforeach; ?>
									</ul>

									<div class="single-services__section-title">CHỈ ĐỊNH</div>
									<p class="single-services__indications"><?php echo esc_html( $item['indications'] ); ?></p>

									<div class="single-services__card-footer">
										<span class="single-services__price">Giá: <?php echo esc_html( $item['price'] ); ?></span>
										<button class="single-services__cart-btn" type="button" aria-label="Thêm <?php echo esc_attr( $item['title'] ); ?> vào giỏ hàng">
											<img src="<?php echo esc_url( MEDICARE_THEME_URI . '/assets/images/dich-vu-buoi-le/cart-btn.svg' ); ?>" alt="Giỏ hàng" class="single-services__cart-icon">
										</button>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>

		<?php endif; ?>

	</div>
</section>

<?php get_footer();
