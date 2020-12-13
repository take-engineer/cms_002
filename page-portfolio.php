<?php
/*
Template Name: PORTFOLIO
*/
?>

<?php get_header(); ?>

		<main class="l-main">
			<article class="l-subpage">

				<?php get_template_part( 'parts/headline' ); ?>

				<section class="p-portfolio">

					<?php
						$args = array(
							'paged' => get_query_var('paged'),
							'post_type' => 'portfolio_post',
							'orderby' => 'date',
							'order' => 'DESC',
						);
						$wp_query = new WP_Query($args);

						if($wp_query->have_posts()): ?>
						<div class="p-portfolio-list">
							<?php
								while($wp_query->have_posts()):
									$wp_query->the_post();


							?>

								<article class="p-portfolio-item js-animate js-fade-in">
									<a href="<?= esc_url( get_permalink() ); ?>" class="p-portfolio-link">
										<figure class="p-portfolio-figure">
											<?php
												if(has_post_thumbnail()):?>
													<?php
														the_post_thumbnail('medium',array(
														'class' => 'p-portfolio-figure-img',
														'alt' => get_the_title(),
													)); ?>
												<?php else: ?>
													<img class="p-portfolio-figure-img" src="<?= get_template_directory_uri(); ?>/img/noimage.png" alt="">
												<?php endif; ?>
										</figure>
										<div class="p-portfolio-caption c-arrow">
											<?php /*
												<div class="p-portfolio-meta">
													<?php
														$terms = get_the_terms($post->ID, 'portfolio_type');
														if($terms){
															$term_name = $terms[0]->name;
														}
														if($term_name):
													?>
														<div class="p-portfolio-cat"><?php echo $term_name; $term_name = null; ?></div>
													<?php endif; ?>
													<time class="p-portfolio-time" datetime="<?php the_time('Y.n.j');?>"><?php the_time('Y.n.j'); ?></time>
												</div>
											*/ ?>
											<h4 class="p-portfolio-ttl"><?php the_title(); ?></h4>
										</div>
									</a>
								</article>

							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>

					<?php	/* if(function_exists( "pagination" )){
							pagination( $additional_loop->max_num_pages );
						}*/
					?>


					<?php /* get_sidebar(); */ ?>
				</section>

			</article>
		</main>

<?php get_footer(); ?>
