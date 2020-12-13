<?php get_header(); ?>

		<main class="l-main">
			<article class="l-subpage">

				<?php get_template_part( 'parts/headline' ); ?>


				<section class="p-404">
					<h2 class="p-404-ttl">404</h2>
					<div class="p-404-txt">
						お探しのページが見つかりません。
					</div>
					<div class="c-btn">
						<a href="<?= esc_url( home_url() );?>" class="c-btn-txt">TOP PAGE</a>
					</div>
				</section>

			</article>
		</main>

<?php get_footer(); ?>
