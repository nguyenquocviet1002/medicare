<?php
/**
 * Template Name: Sản Phẩm Tiêm
 *
 * The template for displaying the "Sản Phẩm Tiêm" (injection products) page.
 * Pulls from the 'product' CPT grouped by 'product_category' taxonomy tabs
 * and the ACF 'sub_category' field, with fallback static content.
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$san_pham_img = MEDICARE_THEME_URI . '/assets/images/san-pham/';

$product_terms = get_terms( array(
	'taxonomy'   => 'product_category',
	'hide_empty' => false,
	'orderby'    => 'menu_order',
	'order'      => 'ASC',
) );

$any_product = get_posts( array(
	'post_type'      => 'product',
	'posts_per_page' => 1,
	'fields'         => 'ids',
) );
?>

<main id="primary" class="site-main page-template">

	<section class="banner" data-aos="fade-up">
		<img src="<?php echo esc_url( $san_pham_img . 'banner.jpg' ); ?>" alt="">
	</section>

	<section class="tabbed-slider" id="injectable-services" aria-label="Dịch Vụ Tiêm Thẩm Mỹ">
		<div class="container">

			<?php if ( ! empty( $any_product ) && ! is_wp_error( $product_terms ) && ! empty( $product_terms ) ) : ?>

				<div class="tabbed-slider" data-tabs>
					<div class="tabbed-slider__tabs-wrapper">
						<div class="tabbed-slider__tabs" role="tablist">
							<?php $first_term     = true; ?>
							<?php foreach ( $product_terms as $term ) : ?>
								<button
									type="button"
									class="tabbed-slider__tab-btn<?php echo $first_term ? ' is-active' : ''; ?>"
									data-tab-target="<?php echo esc_attr( $term->slug ); ?>"
									role="tab"
									aria-selected="<?php echo $first_term ? 'true' : 'false'; ?>"
								>
									<?php echo esc_html( $term->name ); ?>
								</button>
								<?php $first_term = false; ?>
							<?php endforeach; ?>
						</div>
					</div>

					<?php $first_term = true; ?>
					<?php foreach ( $product_terms as $term ) : ?>

						<?php
						$products = get_posts( array(
							'post_type'      => 'product',
							'posts_per_page' => -1,
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_category',
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
							),
						) );

						$grouped = array();
						foreach ( $products as $product ) {
							$sub = function_exists( 'get_field' ) ? get_field( 'sub_category', $product->ID ) : '';
							$sub = trim( (string) $sub );
							if ( '' === $sub ) {
								$sub = 'Sản Phẩm Khác';
							}
							$grouped[ $sub ][] = $product;
						}
						?>

						<div class="tabbed-slider__pane<?php echo $first_term ? ' is-active' : ''; ?>" data-tab-pane="<?php echo esc_attr( $term->slug ); ?>"<?php echo $first_term ? '' : ' hidden'; ?>>
							<?php if ( ! empty( $grouped ) ) : ?>
								<?php foreach ( $grouped as $sub_title => $items ) : ?>
									<div class="tabbed-slider__section-block" data-aos="fade-up">
										<h3 class="tabbed-slider__category" data-aos="fade-up"><?php echo esc_html( $sub_title ); ?></h3>

										<div class="tabbed-slider__carousel-wrapper">
											<button class="tabbed-slider__nav-btn tabbed-slider__nav-btn--prev" type="button" aria-label="Slide trước">
												<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M19 12H5M12 19l-7-7 7-7"/>
												</svg>
											</button>

											<div class="tabbed-slider__viewport">
												<div class="tabbed-slider__track">
													<?php foreach ( $items as $product ) : ?>
														<?php
														$title         = get_the_title( $product );
														$link          = get_permalink( $product );
														$price         = function_exists( 'get_field' ) ? get_field( 'price', $product->ID ) : '';
														$benefits      = function_exists( 'get_field' ) ? get_field( 'benefits', $product->ID ) : '';
														$indications   = function_exists( 'get_field' ) ? get_field( 'indications', $product->ID ) : '';
														$benefit_lines = $benefits ? preg_split( '/\r\n|\r|\n/', $benefits ) : array();
														$thumb_id      = get_post_thumbnail_id( $product );
														$img_url       = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'service-card' ) : ( $san_pham_img . $term->slug . '-default.jpg' );
														?>
														<div class="tabbed-slider__slide">
															<article class="tabbed-slider__card">
																<div class="tabbed-slider__card-media">
																	<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="tabbed-slider__card-img" loading="lazy">
																</div>

																<div class="tabbed-slider__card-body">
																	<h4 class="tabbed-slider__card-title">
																		<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a>
																	</h4>

																	<div class="tabbed-slider__section-title">TÁC DỤNG</div>
																	<ul class="tabbed-slider__benefits">
																		<?php foreach ( $benefit_lines as $line ) : ?>
																			<?php if ( '' !== trim( $line ) ) : ?>
																				<li class="tabbed-slider__benefit-item"><?php echo esc_html( $line ); ?></li>
																			<?php endif; ?>
																		<?php endforeach; ?>
																	</ul>

																	<?php if ( ! empty( $indications ) ) : ?>
																		<div class="tabbed-slider__section-title">CHỈ ĐỊNH</div>
																		<p class="tabbed-slider__indications"><?php echo wp_kses_post( $indications ); ?></p>
																	<?php endif; ?>

																	<div class="tabbed-slider__card-footer">
																		<span class="tabbed-slider__price">Giá: <?php echo esc_html( $price ); ?></span>
																		<button class="tabbed-slider__cart-btn" type="button" aria-label="Thêm <?php echo esc_attr( $title ); ?> vào giỏ hàng" data-cart-id="<?php echo esc_attr( $product->post_name ); ?>" data-cart-name="<?php echo esc_attr( $title ); ?>" data-cart-price="<?php echo esc_attr( $price ); ?>">
																			<img src="<?php echo esc_url( $san_pham_img . 'cart-btn.svg' ); ?>" alt="Giỏ hàng" class="tabbed-slider__cart-icon">
																		</button>
																	</div>
																</div>
															</article>
														</div>
													<?php endforeach; ?>
												</div>
											</div>

											<button class="tabbed-slider__nav-btn tabbed-slider__nav-btn--next" type="button" aria-label="Slide tiếp theo">
												<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14M12 5l7 7-7 7"/>
												</svg>
											</button>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<?php $first_term = false; ?>
					<?php endforeach; ?>
				</div>

			<?php else : ?>

				<?php
				$fallback = array(
					'meso' => array(
						'name'     => 'MESO',
						'sections' => array(
							'MESO MỤN' => array(
								array(
									'id'           => 'meso-inno-akn',
									'title'        => 'MESO INNOAESTHETICS AKN-ID',
									'image'        => 'meso-inno-akn.jpg',
									'benefits'     => array( 'Kiểm soát tiết bã nhờn, kháng viêm, gom cồi mụn và ngăn ngừa bít tắc nang lông.' ),
									'indications'  => 'Mụn viêm, mụn ẩn, da nhiều dầu',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-dermica-acnezone',
									'title'        => 'MESO DERMICA ACNEZONE',
									'image'        => 'meso-dermica-acnezone.jpg',
									'benefits'     => array( 'Ức chế vi khuẩn gây mụn, làm dịu nhanh các nốt mụn sưng đỏ và giảm kích ứng.' ),
									'indications'  => 'Da dầu mụn, mụn sưng đỏ, viêm tái phát',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-inno-redness',
									'title'        => 'MESO INNOAESTHETICS REDNESS-ID',
									'image'        => 'meso-inno-redness.jpg',
									'benefits'     => array( 'Giảm đỏ mao mạch, làm dịu tình trạng ban đỏ viêm và củng cố thành mạch máu.' ),
									'indications'  => 'Da đỏ sau mụn, hồng ban sau viêm, da giãn mao mạch nhẹ.',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-fetoscell-mun',
									'title'        => 'MESO FETOSCELL',
									'image'        => 'meso-fetoscell-acne.jpg',
									'benefits'     => array( 'Kháng viêm mạnh mẽ, tái tạo tế bào và phục hồi nhanh làn da đang chịu tổn thương do mụn.' ),
									'indications'  => 'Da mụn viêm nặng, tổn thương sâu sau mụn.',
									'price'        => '5.000.000 VNĐ',
								),
							),
							'MESO SẸO' => array(
								array(
									'id'           => 'meso-rejuran-s',
									'title'        => 'MESO REJURAN S',
									'image'        => 'meso-rejuran-s.jpg',
									'benefits'     => array( 'Polynucleotide (PN) độ đậm đặc cao giúp kích thích tăng sinh mô hạt, làm đầy đáy sẹo rỗ và tái tạo cấu trúc da.' ),
									'indications'  => 'Sẹo rỗ đáy vuông, sẹo lõm sau mụn, bề mặt da lồi lõm.',
									'price'        => '7.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-linerase',
									'title'        => 'MESO LINERASE',
									'image'        => 'meso-linerase.jpg',
									'benefits'     => array( 'Bổ sung Collagen Type I tinh khiết tái cấu trúc nền da, tăng độ đàn hồi và lấp đầy các vùng khuyết lõm xơ cứng.' ),
									'indications'  => 'Sẹo rỗ lâu năm, sẹo xơ cứng, teo mô dưới da.',
									'price'        => '15.000.000 VNĐ/LỌ',
								),
							),
							'MESO SẮC TỐ' => array(
								array(
									'id'           => 'meso-fragmyx-oxyx',
									'title'        => 'MESO XCELENS FRAGMYX OXYX',
									'image'        => 'meso-fragmyx-oxyx.jpg',
									'benefits'     => array( 'Cung cấp hoạt chất chống oxy hóa mạnh, trung hòa gốc tự do và làm sáng nền da xỉn màu.' ),
									'indications'  => 'Da sạm xỉn, không đều màu, thiếu sức sống.',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-tranacix',
									'title'        => 'MESO TRANACIX',
									'image'        => 'meso-tranacix.jpg',
									'benefits'     => array( 'Ức chế tổng hợp melanin từ gốc, hỗ trợ mờ nám mảng, tàn nhang và giảm tăng sắc tố.' ),
									'indications'  => 'Nám mảng, thâm sau viêm (PIH), tàn nhang.',
									'price'        => '3.000.000 VNĐ/LỌ',
								),
								array(
									'id'           => 'meso-fetoscell-white',
									'title'        => 'MESO FETOSCELL WHITE',
									'image'        => 'meso-fetoscell-white.jpg',
									'benefits'     => array( 'Đào thải sắc tố thâm sạm, dưỡng trắng chuyên sâu và nâng tông da sáng khỏe.' ),
									'indications'  => 'Da ngăm đen, đốm nâu, da không đều màu.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-exocode-radiance',
									'title'        => 'MESO EXOCODE RADIANCE – R',
									'image'        => 'meso-exocode-radiance.jpg',
									'benefits'     => array( 'Phức hợp Exosome thế hệ mới giúp ức chế enzyme tyrosinase, tái tạo tế bào sáng mịn và căng bóng.' ),
									'indications'  => 'Tăng sắc tố khó điều trị, da xỉn màu lão hóa.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-nucleoskin-topic-pigment',
									'title'        => 'MESO NUCLEOSKIN TOPIC',
									'image'        => 'meso-nucleoskin-topic.jpg',
									'benefits'     => array( 'Liệu pháp cao cấp phục hồi sắc tố đa tầng, tái sinh cấu trúc da trắng sáng và làm mờ thâm nám tầng sâu.' ),
									'indications'  => 'Nám sâu, nám chân đinh kết hợp da lão hóa mỏng yếu.',
									'price'        => '18.000.000 VNĐ/LỌ',
								),
							),
							'MESO PHỤC HỒI' => array(
								array(
									'id'           => 'meso-vitamin-complex',
									'title'        => 'MESO INNOAESTHETICS VITAMIN COMPLEX',
									'image'        => 'meso-vitamin-complex.jpg',
									'benefits'     => array( 'Cung cấp tổ hợp vitamin & khoáng chất thiết yếu, tăng cường đề kháng tự nhiên cho da.' ),
									'indications'  => 'Da mệt mỏi, thiếu dưỡng chất, da xỉn màu do stress.',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-fetoscell-recovery',
									'title'        => 'MESO FETOSCELL',
									'image'        => 'meso-fetoscell-recovery.jpg',
									'benefits'     => array( 'Kích hoạt tái sinh biểu bì, làm lành vi tổn thương và củng cố hàng rào bảo vệ da.' ),
									'indications'  => 'Da nhạy cảm, da tổn thương sau laser/peel hoặc sau mụn.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-dna-infini',
									'title'        => 'MESO DNA INFINI',
									'image'        => 'meso-dna-infini.jpg',
									'benefits'     => array( 'Chiết xuất DNA tinh khiết giúp sửa chữa tế bào tổn thương, tăng sinh collagen và phục hồi nền da yếu.' ),
									'indications'  => 'Da mỏng đỏ, giãn mao mạch, da tổn thương do kem trộn/corticoid.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-rejuran-healer',
									'title'        => 'MESO REJURAN HEALER',
									'image'        => 'meso-rejuran-healer.jpg',
									'benefits'     => array( 'Chiết xuất Polynucleotide (PN) từ DNA cá hồi giúp tái sinh toàn diện tầng trung bì, dày khỏe cấu trúc da.' ),
									'indications'  => 'Da lão hóa, da mỏng yếu nhạy cảm, da mất đàn hồi.',
									'price'        => '7.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-exosome',
									'title'        => 'MESO EXOSOME',
									'image'        => 'meso-exosome.jpg',
									'benefits'     => array( 'Hạt vi tế bào tinh khiết truyền tín hiệu tái sinh da vượt bậc, phục hồi cấp độ tế bào và tăng miễn dịch da.' ),
									'indications'  => 'Nền da suy kiệt, mỏng yếu nặng, da lão hóa chùng nhão.',
									'price'        => '8.000.000 VNĐ',
								),
							),
							'MESO CẤP ẨM, CĂNG BÓNG' => array(
								array(
									'id'           => 'meso-teoxane-redensity-1',
									'title'        => 'MESO TEOXANE TEOSYAL PURESENSE REDENSITY 1',
									'image'        => 'meso-teoxane-redensity.jpg',
									'benefits'     => array( 'Cung cấp tổ hợp độc quyền kết hợp Hyaluronic Acid tự do và phức hợp tái cấu trúc da (axit amin, khoáng chất), tạo hiệu ứng phản chiếu ánh sáng rạng rỡ.' ),
									'indications'  => 'Da lão hóa, chảy xệ nhẹ, da xỉn màu mất độ bóng khỏe.',
									'price'        => '15.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-fetoscell-hydrate',
									'title'        => 'MESO FETOSCELL',
									'image'        => 'meso-fetoscell-hydrate.jpg',
									'benefits'     => array( 'Cấp ẩm kết hợp tái tạo mô, giúp da ngậm nước lâu dài và căng bóng tự nhiên.' ),
									'indications'  => 'Da xỉn màu, thiếu nước, bề mặt thô sần.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-genyal-genyalift',
									'title'        => 'MESO GENYAL GENYALIFT',
									'image'        => 'meso-genyalift.jpg',
									'benefits'     => array( 'Bổ sung Hyaluronic Acid nồng độ cao và Glycerol, ngậm nước sâu, mang lại bề mặt căng mọng.' ),
									'indications'  => 'Da khô ráp, bong tróc, mất nước theo mùa.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-peptide-115',
									'title'        => 'MESO PEPTIDE 115',
									'image'        => 'meso-peptide-115.jpg',
									'benefits'     => array( 'Phức hợp chuỗi peptide chuyên sâu giúp trẻ hóa, tăng sinh sợi nâng đỡ và làm săn chắc da.' ),
									'indications'  => 'Da chùng nhão nhẹ, xuất hiện nếp nhăn li ti.',
									'price'        => '5.000.000 VNĐ',
								),
							),
							'MESO MẮT' => array(
								array(
									'id'           => 'meso-rejuran-i',
									'title'        => 'MESO REJURAN I',
									'image'        => 'meso-rejuran-i.jpg',
									'benefits'     => array( 'Tinh chất PN lỏng chuyên biệt cho vùng mắt mỏng manh, làm dày thành mạch, giảm nếp nhăn li ti và quầng thâm.' ),
									'indications'  => 'Vùng da mắt mỏng yếu, thâm quầng, có rãnh nhăn tĩnh nhẹ.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-nucleoskin-topic-eye',
									'title'        => 'MESO NUCLEOSKIN TOPIC',
									'image'        => 'meso-nucleoskin-eye.jpg',
									'benefits'     => array( 'Trẻ hóa mô mắt tầng sâu, phục hồi độ ẩm và làm sáng đều màu vùng da quanh mắt.' ),
									'indications'  => 'Mắt có quầng thâm, bọng mắt nhẹ, khô nhăn quanh mắt.',
									'price'        => '7.000.000 VNĐ',
								),
							),
							'MESO TÓC' => array(
								array(
									'id'           => 'meso-anteage-hair',
									'title'        => 'MESO ANTEAGE MDX HAIR EXOSOME SOLUTION',
									'image'        => 'meso-anteage-hair.jpg',
									'benefits'     => array( 'Công nghệ Exosome chuyên biệt tái sinh nang tóc teo biến, kích hoạt nang tóc ngủ đông phát triển mạnh mẽ.' ),
									'indications'  => 'Hói đầu, rụng tóc lâu năm, nang tóc suy kiệt.',
									'price'        => '10.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-inno-hair',
									'title'        => 'MESO INNO HAIR',
									'image'        => 'meso-inno-hair.jpg',
									'benefits'     => array( 'Bổ sung dưỡng chất kéo dài chu kỳ sống của sợi tóc, kích thích mọc tóc con và làm dày mật độ tóc.' ),
									'indications'  => 'Rụng tóc nội tiết, tóc thưa thớt, chân tóc yếu.',
									'price'        => '5.000.000 VNĐ',
								),
								array(
									'id'           => 'meso-dermica-hairzon',
									'title'        => 'MESO DERMICA HAIRZON',
									'image'        => 'meso-dermica-hairzon.jpg',
									'benefits'     => array( 'Kích thích lưu thông máu chân tóc, nuôi dưỡng nang tóc và ngăn ngừa rụng tóc sớm.' ),
									'indications'  => 'Rụng tóc theo mùa, tóc yếu dễ gãy rụng.',
									'price'        => '3.000.000 VNĐ',
								),
							),
						),
					),
					'bap' => array(
						'name'     => 'BAP',
						'sections' => array(
							'KỸ THUẬT TIÊM BAP TRẺ HÓA' => array(
								array(
									'id'           => 'bap-b32',
									'title'        => 'B32',
									'image'        => 'bap-b32.jpg',
									'benefits'     => array( 'Cung cấp phức hợp HA sinh học hỗ trợ tái tạo mô liên kết, cải thiện kết cấu da mịn màng và tăng độ đàn hồi.' ),
									'indications'  => 'Da thiếu sức sống, kém săn chắc, bề mặt thô sần.',
									'price'        => '7.000.000 VNĐ',
								),
								array(
									'id'           => 'bap-ejal40',
									'title'        => 'EJAL 40',
									'image'        => 'bap-ejal40.jpg',
									'benefits'     => array( 'Hyaluronic Acid phân tử tối ưu giúp kích hoạt nguyên bào sợi, phục hồi hàng rào bảo vệ và tái tạo độ căng mọng cho bề mặt da.' ),
									'indications'  => 'Da khô ráp, mất độ bóng mượt, lão hóa sớm.',
									'price'        => '6.000.000 VNĐ',
								),
								array(
									'id'           => 'bap-karisma',
									'title'        => 'KARISMA',
									'image'        => 'bap-karisma.jpg',
									'benefits'     => array( 'Chứa Collagen tái tổ hợp chuỗi polypeptide và HA, kích thích tăng sinh collagen tự thân, phục hồi độ săn chắc và làm mờ nếp nhăn.' ),
									'indications'  => 'Da chùng nhão, nếp nhăn li ti, thiếu hụt cấu trúc mô nâng đỡ.',
									'price'        => '8.000.000 VNĐ',
								),
								array(
									'id'           => 'bap-profhilo',
									'title'        => 'PROFHILO',
									'image'        => 'bap-profhilo.jpg',
									'benefits'     => array( '100% Hyaluronic Acid tinh khiết nồng độ cao tác động đa tầng, tái cấu trúc mô mỡ dưới da, cấp ẩm sâu và nâng cơ chảy xệ.' ),
									'indications'  => 'Da lão hóa, chảy xệ nhẹ, mất nước và kém đàn hồi.',
									'price'        => '12.000.000 VNĐ',
								),
							),
						),
					),
					'filler' => array(
						'name'     => 'FILLER',
						'sections' => array(
							'FILLER TẠO HÌNH CHUẨN Y KHOA' => array(
								array(
									'id'           => 'filler-han',
									'title'        => 'FILLER HÀN',
									'image'        => 'filler-han.jpg',
									'benefits'     => array( 'Làm đầy nhanh các vùng khuyết lõm và tạo form dáng thanh tú.' ),
									'indications'  => 'Tạo hình cằm V-line, môi căng mọng, rãnh cười nông.',
									'price'        => '4.000.000 VNĐ/CC',
								),
								array(
									'id'           => 'filler-restylane',
									'title'        => 'RESTYLANE (CHÂU ÂU)',
									'image'        => 'filler-restylane.jpg',
									'benefits'     => array( 'Công nghệ liên kết chéo NASHA/OBT chuẩn FDA, định hình sắc nét, giữ form chuẩn xác và chống tràn hiệu quả.' ),
									'indications'  => 'Tạo hình sống mũi, cằm, rãnh lệ, làm đầy rãnh mũi má sâu.',
									'price'        => '12.000.000 VNĐ/CC',
								),
								array(
									'id'           => 'filler-teoxane',
									'title'        => 'FILLER TEOXANE (CHÂU ÂU)',
									'image'        => 'filler-teoxane.jpg',
									'benefits'     => array( 'Dòng filler động học thích ứng theo mọi biểu cảm cử động cơ mặt, không vón cục, tạo cảm giác hoàn toàn tự nhiên.' ),
									'indications'  => 'Rãnh cười, nếp nhăn động, môi, hốc mắt trũng.',
									'price'        => '12.000.000 VNĐ/CC',
								),
								array(
									'id'           => 'filler-infini',
									'title'        => 'INFINI (CHÂU ÂU)',
									'image'        => 'filler-infini.jpg',
									'benefits'     => array( 'Độ tương thích sinh học cao, định hình mềm mại tự nhiên và duy trì độ ẩm mịn cho mô cơ.' ),
									'indications'  => 'Da khô ráp, mất độ bóng mượt, lão hóa sớm.',
									'price'        => '8.000.000 VNĐ/CC',
								),
							),
						),
					),
					'botox' => array(
						'name'     => 'BOTOX',
						'sections' => array(
							'BOTOX XÓA NHĂN & THON GỌN HÀM' => array(
								array(
									'id'           => 'botox-allergan',
									'title'        => 'BOTOX ALLERGAN',
									'image'        => 'botox-allergan.jpg',
									'benefits'     => array( 'Thương hiệu Botox chuẩn Y khoa hàng đầu từ Mỹ, kiểm soát lan tỏa chuẩn xác, hiệu quả êm ái và kéo dài bền bỉ.' ),
									'indications'  => 'Xóa nhăn vùng mặt chuyên sâu, thu gọn phì đại cơ cắn và hạ góc hàm.',
									'price'        => '15.000.000 VNĐ',
								),
								array(
									'id'           => 'botox-nabota',
									'title'        => 'BOTOX NABOTA',
									'image'        => 'botox-nabota.jpg',
									'benefits'     => array( 'Phong bế dẫn truyền thần kinh tạm thời, làm giãn cơ co rút giúp xóa mờ nếp nhăn biểu cảm và thu nhỏ khối cơ phì đại.' ),
									'indications'  => 'Vết chân chim, nhăn trán, nhăn cau mày, cơ hàm bạnh, thon gọn bắp tay/bắp chân.',
									'price'        => '3.000.000 VNĐ',
								),
								array(
									'id'           => 'botox-xeomin',
									'title'        => 'BOTOX XEOMIN',
									'image'        => 'botox-xeomin.jpg',
									'benefits'     => array( 'Dòng Botox tinh khiết không chứa protein phức hợp, hạn chế nguy cơ kháng thuốc/lờn thuốc sau nhiều lần tiêm.' ),
									'indications'  => 'Tiêm xóa nhăn định kỳ, thu gọn góc hàm cho khách hàng có cơ địa dễ kháng botox.',
									'price'        => '15.000.000 VNĐ',
								),
							),
						),
					),
				);
				?>

				<div class="tabbed-slider" data-tabs>
					<div class="tabbed-slider__tabs-wrapper">
						<div class="tabbed-slider__tabs" role="tablist">
							<?php $first_term = true; ?>
							<?php foreach ( $fallback as $slug => $data ) : ?>
								<button
									type="button"
									class="tabbed-slider__tab-btn<?php echo $first_term ? ' is-active' : ''; ?>"
									data-tab-target="<?php echo esc_attr( $slug ); ?>"
									role="tab"
									aria-selected="<?php echo $first_term ? 'true' : 'false'; ?>"
								>
									<?php echo esc_html( $data['name'] ); ?>
								</button>
								<?php $first_term = false; ?>
							<?php endforeach; ?>
						</div>
					</div>

					<?php $first_term = true; ?>
					<?php foreach ( $fallback as $slug => $data ) : ?>
						<div class="tabbed-slider__pane<?php echo $first_term ? ' is-active' : ''; ?>" data-tab-pane="<?php echo esc_attr( $slug ); ?>"<?php echo $first_term ? '' : ' hidden'; ?>>
							<?php foreach ( $data['sections'] as $section_title => $items ) : ?>
								<div class="tabbed-slider__section-block" data-aos="fade-up">
									<h3 class="tabbed-slider__category" data-aos="fade-up"><?php echo esc_html( $section_title ); ?></h3>

									<div class="tabbed-slider__carousel-wrapper">
										<button class="tabbed-slider__nav-btn tabbed-slider__nav-btn--prev" type="button" aria-label="Slide trước">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
												<path d="M19 12H5M12 19l-7-7 7-7"/>
											</svg>
										</button>

										<div class="tabbed-slider__viewport">
											<div class="tabbed-slider__track">
												<?php foreach ( $items as $item ) : ?>
													<div class="tabbed-slider__slide">
														<article class="tabbed-slider__card">
															<div class="tabbed-slider__card-media">
																<img src="<?php echo esc_url( $san_pham_img . $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="tabbed-slider__card-img" loading="lazy">
															</div>

															<div class="tabbed-slider__card-body">
																<h4 class="tabbed-slider__card-title"><?php echo esc_html( $item['title'] ); ?></h4>

																<div class="tabbed-slider__section-title">TÁC DỤNG</div>
																<ul class="tabbed-slider__benefits">
																	<?php foreach ( $item['benefits'] as $line ) : ?>
																		<li class="tabbed-slider__benefit-item"><?php echo esc_html( $line ); ?></li>
																	<?php endforeach; ?>
																</ul>

																<div class="tabbed-slider__section-title">CHỈ ĐỊNH</div>
																<p class="tabbed-slider__indications"><?php echo wp_kses_post( $item['indications'] ); ?></p>

																<div class="tabbed-slider__card-footer">
																	<span class="tabbed-slider__price">Giá: <?php echo esc_html( $item['price'] ); ?></span>
																	<button class="tabbed-slider__cart-btn" type="button" aria-label="Thêm <?php echo esc_attr( $item['title'] ); ?> vào giỏ hàng" data-cart-id="<?php echo esc_attr( $item['id'] ); ?>" data-cart-name="<?php echo esc_attr( $item['title'] ); ?>" data-cart-price="<?php echo esc_attr( $item['price'] ); ?>">
																		<img src="<?php echo esc_url( $san_pham_img . 'cart-btn.svg' ); ?>" alt="Giỏ hàng" class="tabbed-slider__cart-icon">
																	</button>
																</div>
															</div>
														</article>
													</div>
												<?php endforeach; ?>
											</div>
										</div>

										<button class="tabbed-slider__nav-btn tabbed-slider__nav-btn--next" type="button" aria-label="Slide tiếp theo">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
												<path d="M5 12h14M12 5l7 7-7 7"/>
											</svg>
										</button>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?php $first_term = false; ?>
					<?php endforeach; ?>
				</div>

			<?php endif; ?>

		</div>
	</section>

</main>

<?php
get_footer();
