<?php get_header(); ?>

	<main class="l-main">
		<article class="l-home">

			<?php if(have_rows('home_section__content')):?>
				<?php
					while(have_rows('home_section__content')): the_row(); $count++; ?>
					<?php if(get_sub_field('home_section__disp')):?>
						<section id="top" class="p-home-section">

							<?php if(get_sub_field('home_section__ttl')):?>
								<div class="p-home-section-catchcopy js-animate js-fade-in-right">
									<h2 class="p-home-section-ttl"><?php the_sub_field('home_section__ttl'); ?></h2>

									<?php if(get_sub_field('home_section__txt')):?>
										<p class="p-home-section-txt">
											<?php the_sub_field('home_section__txt'); ?>
										</p>
									<?php endif; ?>

									<?php if(get_sub_field('home_section__btn_disp')):?>
										<?php
											$ttl = get_sub_field('home_section__btn_txt');
											$link = get_sub_field('home_section__btn_link');
											$url = get_sub_field('home_section__btn_url');
											$target = get_sub_field('home_section__btn_target');
											$blank = 'target="_blank" rel="nofollow noopener';

											if($link || $url):
										?>
											<div class="p-home-section-btn c-btn">
												<a class="c-btn-body" href="<?php if($url){ echo $url; } elseif($link){ echo $link; } ?>" <?php if($target){ echo $blank; }?>><?=$ttl;?></a>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if(get_sub_field('home_section__article_disp')):?>
								<div class="swiper-container slider<?= $count; ?> js-animate js-gradually-in-left">
									<div class="swiper-wrapper">
									<?php
										$posts = get_posts(	array(
											'post_type' => 'portfolio_post',
											'posts_per_page' => '-1',
											'orderby' => 'DESC',
										));

										foreach($posts as $post): setup_postdata( $post );
											$category = get_the_category();
									?>
										<article class="c-article-item swiper-slide">
											<a href="<?= esc_url( get_permalink() ); ?>" class="c-article-link">
												<figure class="c-article-figure">
													<?php
														if(has_post_thumbnail()):?>
															<?php
																the_post_thumbnail('large',array(
																'class' => 'c-article-figure-img',
																'alt' => get_the_title(),
															)); ?>
													<?php else: ?>
														<img class="c-article-figure-img" src="<?= get_template_directory_uri(); ?>/img/noimage.png" alt="">
													<?php endif; ?>
												</figure>
											</a>
										</article>
									<?php endforeach; wp_reset_postdata(); wp_reset_query();?>
									</div>
								</div>

							<?php else: ?>

								<div class="swiper-container slider<?= $count; ?>">
									<div class="swiper-wrapper">
										<?php if(have_rows('home_section__img')):?>
											<?php while(have_rows('home_section__img')): the_row();?>
												<div class="swiper-slide js-animate js-gradually-in-left"><img class="swiper-slide-img" src="<?php the_sub_field('img'); ?>"></div>
											<?php endwhile; ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if($count == 1):?>
								<div class="c-scroll">
									<p class="c-scroll-txt pc">SCROLL</p>
									<div class="c-scroll-arrow"></div>
								</div>
							<?php endif; ?>

						</section>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>

			<article id="about" class="p-about">

				<h2 class="p-about-ttl c-section-ttl"><?php the_field('about_ttl');?></h2>

				<?php if(have_rows('about_profile')):?>
					<section class="p-about-profile">

						<?php while(have_rows('about_profile')): the_row();?>
							<div class="p-about-profile-col-left">
								<h3 class="p-about-profile-ttl"><?php the_sub_field('profile_ttl');?></h3>
							</div>

							<div class="p-about-profile-col-right">
								<figure class="p-about-profile-figure">
									<img src="<?php the_sub_field('profile_picture'); ?>" alt="" class="p-about-profile-figure-img">
								</figure>
								<figcaption class="p-about-profile-desc js-animate js-gradually-in-left">
									<h3 class="p-about-profile-name"><?php the_sub_field('profile_name');?></h3>
									<p class="p-about-profile-txt"><?php the_sub_field('profile_txt');?></p>
								</figcaption>
							</div>
						<?php endwhile; ?>
					</section>
				<?php endif; ?>

				<?php if(have_rows('about_hobby')): ?>
					<section class="p-about-hobby">
						<?php while(have_rows('about_hobby')): the_row();?>

							<div class="p-about-hobby-col-left">
								<h3 class="p-about-hobby-ttl"><?php the_sub_field('hobby_ttl');?></h3>
							</div>

							<div class="p-about-hobby-col-right">
								<?php if(have_rows('hobby_list')): ?>
									<ul class="p-about-hobby-list">
										<?php while(have_rows('hobby_list')): the_row();?>
											<li class="p-about-hobby-item">

												<figure class="p-about-hobby-figure">
													<img src="<?php the_sub_field('hobby_img');?>" class="p-about-hobby-img">
												</figure>
												<figcaption class="p-about-hobby-desc js-animate js-gradually-in-left">
													<p class="p-about-hobby-name"><?php the_sub_field('hobby_ttl');?></p>
													<p class="p-about-hobby-txt"><?php the_sub_field('hobby_txt');?></p>
												</figcaption>

											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif;?>
							</div>

						<?php endwhile;?>
					</section>
				<?php endif; ?>

				<?php if(have_rows('about_skill')):?>
					<section class="p-about-skill">

						<?php while(have_rows('about_skill')): the_row();?>
						<div class="p-about-skill-col-left">
							<h3 class="p-about-skill-ttl"><?php the_sub_field('skill_ttl');?></h3>
						</div>

						<div class="p-about-skill-col-right">

							<?php if(have_rows('skill_set')):?>
								<ul class="p-about-skill-list">
									<?php while(have_rows('skill_set')): the_row();?>
										<li class="p-about-skill-item">

										<?php /*
											<figure class="p-about-skill-figure">
												<img src="<?php the_sub_field('skill_img');?>" class="p-about-skill-img">
											</figure>
										*/?>

											<div class="p-about-skill-detail">
												<figcaption class="p-about-skill-figcaption">
													<p class="p-about-skill-name"><?php the_sub_field('skill_name');?></p>
												</figcaption>
												<p class="p-about-skill-experience"><?php the_sub_field('skill_experience');?></p>
											</div>

											<div class="p-about-skill-meter c-meter">
												<span class="c-meter-num"></span>
												<span class="c-meter-progress js-animate js-meter-progress" data-rate="<?php the_sub_field('skill_level');?>"></span>
											</div>

										</li>
									<?php endwhile; ?>
							<?php endif; ?>

						</div>

						<?php endwhile; ?>

					</section>
				<?php endif; ?>
			</article>

			<section id="portfolio" class="p-portfolio">
				<h2 class="p-portfolio-ttl c-section-ttl"><?php the_field('portfolio_ttl');?></h2>
				<div class="p-portfolio-article">

					<?php
						$args = array(
							'paged' => get_query_var('paged'),
							'post_type' => 'portfolio_post',
							// 'orderby' => 'date',
							// 'order' => 'DESC',
						);
						$wp_query = new WP_Query($args);

						if($wp_query->have_posts()): ?>
						<div class="p-portfolio-list">
							<?php	while($wp_query->have_posts()):	$wp_query->the_post(); ?>

								<article class="p-portfolio-item js-animate js-fade-in">
									<a href="<?= esc_url( get_permalink() ); ?>" class="p-portfolio-link">
										<figure class="p-portfolio-figure">
											<?php
												if(has_post_thumbnail()):?>
													<?php
														the_post_thumbnail('large',array(
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

							<?php endwhile; wp_reset_postdata(); wp_reset_query();?>
						</div>
					<?php endif; ?>

					<?php	/* if(function_exists( "pagination" )){
							pagination( $additional_loop->max_num_pages );
						}*/
					?>
				</div>
			</section>

			<section id="contact" class="p-contact">
				<h2 class="p-portfolio-ttl c-section-ttl"><?php the_field('contact_ttl');?></h2>
				<div class="p-contact-article">
					<?php if(get_field('contact_txt')):?>
						<p class="p-contact-txt"><?php the_field('contact_txt');?></p>
					<?php endif; ?>

					<?php if(get_field('contact_mail')):?>
						<div class="p-contact-btn c-btn js-animate js-fade-in-up">
							<a href="mailto:<?php the_field('contact_mail');?>" target="_blank" rel="nofollow noopener" class="p-contact-btn-link c-btn-body"><?php the_field('contact_mail');?></a>
						</div>
					<?php endif; ?>

				</div>
			</section>

		</article>
	</main>

<?php get_footer() ;?>
