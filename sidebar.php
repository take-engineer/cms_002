<aside class="l-blog-aside js-animate js-fade-in-up">

	<div class="c-gadget">
		<h4 class="c-gadget-ttl">CATEGORY</h4>
		<ul class="c-gadget-items">
			<?php
				$terms = get_terms('category');
				foreach($terms as $term): ?>
					<li class="c-gadget-item"><a href="<?= get_term_link($term); ?>" class="c-gadget-item-link"><?= $term->name; ?></a></li>
				<?php endforeach; ?>
		</ul>
	</div>

	<div class="c-gadget c-gadget-article">
		<h4 class="c-gadget-ttl">NEW ARTICLE</h4>
		<div class="c-gadget-article-list">
		<?php
		$args = array(
			'posts_per_page' => 3,
		);
		$wp_query = new WP_Query($args);
		while(have_posts( )): the_post();
		?>
			<article class="c-gadget-article-item">
				<a href="<?php the_permalink(); ?>" class="c-gadget-article-link">
					<figure class="c-gadget-article-figure">
						<?php if(has_post_thumbnail()):?>
							<?php
								the_post_thumbnail('medium',array(
									'class' => 'c-gadget-article-figure-img',
									'alt' => get_the_title(),
								)); ?>
						<?php else: ?>
							<img class="c-gadget-article-figure-img" src="<?= get_template_directory_uri(); ?>/img/noimage.png" alt="">
						<?php endif; ?>
					</figure>
					<div class="c-gadget-article-caption">
						<h5 class="c-gadget-article-ttl"><?php the_title(); ?></h5>
					</div>
				</a>
			</article>
		<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>

	<div class="c-gadget c-gadget-archive">
		<h4 class="c-gadget-ttl">ARCHIVE</h4>
		<ul class="c-gadget-items">
			<?php wp_get_archives(); ?>
		</ul>
	</div>
</aside>
