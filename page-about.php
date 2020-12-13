<?php
/*
Template Name: ABOUT
*/
?>

<?php get_header(); ?>

		<main class="l-main">
			<article class="l-subpage">

				<?php get_template_part( 'parts/headline' ); ?>

				<?php if(have_rows('about_profile')):?>
					<section class="p-about-profile">

						<?php while(have_rows('about_profile')): the_row();?>
							<div class="p-about-profile-col-left">
								<h2 class="p-about-profile-ttl"><?php the_sub_field('profile_ttl');?></h2>
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
								<h2 class="p-about-hobby-ttl -right"><?php the_sub_field('hobby_ttl');?></h2>
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
							<h2 class="p-about-skill-ttl"><?php the_sub_field('skill_ttl');?></h2>
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
		</main>

<?php get_footer(); ?>
