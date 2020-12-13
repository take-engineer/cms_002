<?php get_header(); ?>

		<div class="l-main">
			<article class="l-subpage">

				<?php get_template_part( 'parts/headline' ); ?>

				<div class="l-blog">
					<main class="l-blog-main">

						<?php
							if(have_posts()): ?>
							<div class="c-article-list">
								<?php
									while(have_posts()):
										the_post();
										$category = get_the_category();
										$cat_name = $category[0]->cat_name;
								?>

									<article class="c-article-item js-animate js-fade-in-up">
										<a href="<?= esc_url( get_permalink() ); ?>" class="c-article-link">
											<figure class="c-article-figure">
												<?php
													if(has_post_thumbnail()):?>
														<?php
															the_post_thumbnail('medium',array(
															'class' => 'c-article-figure-img',
															'alt' => get_the_title(),
														)); ?>
													<?php else: ?>
														<img class="c-article-figure-img" src="<?= get_template_directory_uri(); ?>/img/noimage.png" alt="">
													<?php endif; ?>
											</figure>
											<div class="c-article-caption">
												<div class="c-article-meta">
													<div class="c-article-cat"><?=$cat_name;?></div>
													<time class="c-article-time" datetime="<?php the_time('Y.n.j');?>"><?php the_time('Y.n.j'); ?></time>
												</div>
												<h4 class="c-article-ttl"><?php the_title(); ?></h4>
												<p class="c-article-excerpt"><?= get_the_excerpt(); ?></p>
											</div>
										</a>
									</article>

								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						<?php endif; ?>

						<?php	if(function_exists( "pagination" )){
								pagination( $additional_loop->max_num_pages );
							}
						?>

					</main>

					<?php get_sidebar(); ?>
				</div>

			</article>
		</div>

<?php get_footer(); ?>
