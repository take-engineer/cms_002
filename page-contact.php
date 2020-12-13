<?php
/*
Template Name: CONTACT
*/
?>

<?php get_header(); ?>
		<main class="l-main">
			<article class="l-subpage">

				<?php get_template_part( 'parts/headline' ); ?>

				<section class="p-contact">
					<div class="p-contact-article">

						<?php if (have_posts()) :
							while (have_posts()) : // 内容のループ
								the_post();
								the_content();
							endwhile;
						endif; ?>

					</div>
				</section>

			</article>
		</main>

<?php get_footer(); ?>
