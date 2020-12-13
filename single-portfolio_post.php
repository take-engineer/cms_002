<?php get_header(); ?>

<div class="l-main">
	<article class="l-subpage">

		<?php /* get_template_part( 'parts/headline' ); */?>

		<div class="p-portfolio-single">
			<main class="p-portfolio-single-main">

				<?php	if(have_posts()): ?>
					<?php	while(have_posts()): the_post(); ?>

						<article class="p-portfolio-single">

							<div class="p-portfolio-single-pagetop">
								<div class="p-portfolio-single-bg pc" style="background-image:url(<?php the_field('portfolio_mv'); ?>)"></div>
								<div class="p-portfolio-single-bg sp" style="background-image:url(<?php the_field('portfolio_mv_sp'); ?>)"></div>
								<div class="p-portfolio-single-overlay">

								<figure class="p-portfolio-single-head-figure">
									<img src="<?php the_field('portfolio_mv'); ?>" class="p-portfolio-single-head-img pc">
									<img src="<?php the_field('portfolio_mv_sp'); ?>" class="p-portfolio-single-head-img sp">
									<figcaption class="p-portfolio-single-headline">
										<h1 class="p-portfolio-single-ttl">
											<span class="p-portfolio-single-ttl-main"><?php the_field('portfolio_ttl'); ?></span>
											<span class="p-portfolio-single-ttl-sub"><?php the_field('portfolio_ttl_sub'); ?></span>
										</h1>
									</figcaption>
								</figure>


									<?php /*
										<a href="#overview" class="c-arrow-down js-change-color js-hover"></a>
									*/ ?>
								</div>

								<div class="c-scroll">
									<div class="c-scroll-arrow"></div>
								</div>
							</div>

							<section class="p-portfolio-single-article" id="overview">
								<div class="p-portfolio-single-overview">
									<p class="p-portfolio-single-desc"><?php the_field('portfolio_overview'); ?></p>
									<p class="p-portfolio-single-role">ROLE：<?php the_field('portfolio_role'); ?></p>
									<?php if(get_field('portfolio_url_txt')): ?>
										<div class="c-btn p-portfolio-single-btn">
											<a href="<?php the_field('portfolio_url'); ?>" class="c-btn-body p-portfolio-single-btn-link" target="_blank" rel="nofollow noopener"><?php the_field('portfolio_url_txt'); ?></a>
										</div>
									<?php endif; ?>
								</div>
								<?php if(have_rows('portfolio_screen')):?>
									<div class="p-portfolio-single-screen">
										<ul class="p-portfolio-single-screen-list">
											<?php while(have_rows('portfolio_screen')): the_row(); ?>
											<li class="p-portfolio-single-screen-item">
												<img src="<?php the_sub_field('img');?>" alt="" class="p-portfolio-single-screen-img">
											</li>
											<?php endwhile; ?>

											<?php if(have_rows('portfolio_screen_sp')):?>
												<?php while(have_rows('portfolio_screen_sp')): the_row(); ?>
												<li class="p-portfolio-single-screen-item-sp">
													<img src="<?php the_sub_field('img');?>" alt="" class="p-portfolio-single-screen-img">
												</li>
												<?php endwhile; ?>
											<?php endif; ?>
										</ul>
									</div>
								<?php endif; ?>
							</section>

						</article>

					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</main>

			<?php
				$current_post = $post->ID;
				$args = array(
					'paged' => get_query_var('paged'),
					'post_type' => 'portfolio_post',
					'post__not_in' => array($current_post),
				);
				$wp_query = new WP_Query($args);

				if($wp_query->have_posts()): ?>
				<div class="p-portfolio-single-nav">
					<div class="p-portfolio-single-nav-ttl">Other Portfolios</div>
					<ul class="p-portfolio-single-nav-list">
						<?php
							while($wp_query->have_posts()):
								$wp_query->the_post();
						?>
							<article class="p-portfolio-single-nav-item js-animate js-fade-in">
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
										<h4 class="p-portfolio-ttl"><?php the_title(); ?></h4>
									</div>
								</a>
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</ul>
				</div>

			<?php endif; ?>
		</div>

	</article>
</div>

<?php get_footer(); ?>
