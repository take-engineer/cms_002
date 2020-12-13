<?php get_header(); ?>

<div class="l-main">
	<article class="l-subpage">

		<?php get_template_part( 'parts/headline' ); ?>

		<div class="l-blog-single">
			<div class="l-blog-single-main-wrap">
				<main class="l-blog-single-main">

				<?php if(have_posts()):?>
					<?php while(have_posts()): the_post();?>

						<article class="p-portfolio-single">
							<div class="p-portfolio-single-meta">
								<p class="p-portfolio-single-meta-item">
									<time class="p-portfolio-single-meta-date" datatime="<?php the_time('Y.n.j');?>"><?php the_time('Y.n.j');?></time>
								</p>
								<p class="p-portfolio-single-meta-item">
									<span class="p-portfolio-single-meta-cat"><?php my_the_post_category( true ); ?></span>
								</p>
							</div>
							<h1 class="p-portfolio-single-ttl"><?php the_title(); ?></h1>

							<figure class="p-portfolio-single-eyecatch">
								<?php
									if(has_post_thumbnail()):?>
										<?php
											the_post_thumbnail('large',array(
											'class' => 'p-portfolio-single-eyecatch-img',
											'alt' => get_the_title(),
										)); ?>
									<?php else: ?>
										<img class="p-portfolio-single-eyecatch-img" src="<?= get_template_directory_uri(); ?>/img/noimage.png" alt="">
									<?php endif; ?>
							</figure>
							<div class="p-portfolio-single-content"><?php the_content(); ?></div>
						</article>

					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>


			</main>

			<?php
				$prev_text = '<i class="fas fa-angle-left"></i> 前の記事';
				$next_text = '次の記事 <i class="fas fa-angle-right"></i>';
				$list_text = '記事一覧';
				$prevpost = get_adjacent_post(true, '', true); //前の記事
				$nextpost = get_adjacent_post(true, '', false); //次の記事
				if( $prevpost or $nextpost ){ //前の記事、次の記事いずれか存在しているとき
			?>

				<nav class="c-single-pagination">
					<ul class="c-single-pagination-list">
						<?php
							if ( $prevpost ) { //前の記事が存在しているとき
								echo '<li class="c-single-pagination-item is-prev"><a class="c-single-pagination-link" href="' . get_permalink($prevpost->ID) . '">' . $prev_text . '</a></li>';
							} /*else { //前の記事が存在しないとき
								echo '<div><a class="c-single-pagination-link" href="' . network_site_url('/') . '">一覧へ戻る</a></div>';
							}*/
							echo '<li class="c-single-pagination-item"><a class="c-single-pagination-link" href="../">' . $list_text . '</a></li>';
							if ( $nextpost ) { //次の記事が存在しているとき
								echo '<li class="c-single-pagination-item is-next"><a class="c-single-pagination-link" href="' . get_permalink($nextpost->ID) . '">' . $next_text . '</a></li>';
							} /* else { //次の記事が存在しないとき
								echo '<div><a class="c-single-pagination-link" href="' . network_site_url('/') . '">TOPへ戻る</a></div>';
							}*/
						?>
					</ul>
				</nav>
			<?php } ?>
		</div>

		<?php get_sidebar(); ?>

		</div>

	</article>
</div>

<?php get_footer(); ?>
