<?php get_header(); ?>

		<main class="l-main">
			<article class="l-home">
				<header class="p-main-header">
					<div class="p-home-section">
						<div class="p-home-section-container">

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide slide01"><img class="swiper-slide-img" src="<?= get_template_directory_uri(); ?>/img/keyvisual_1.jpg" alt=""></div>
									<div class="swiper-slide slide02"><img class="swiper-slide-img" src="<?= get_template_directory_uri();?>/img/keyvisual_2.jpg" alt=""></div>
									<div class="swiper-slide slide03"><img class="swiper-slide-img" src="<?= get_template_directory_uri();?>/img/keyvisual_3.jpg" alt=""></div>
								</div>
							</div>

							<h2 class="p-home-section-ttl">
								PURSUIT OF<br>
								TECHNOLOGY
								<div class="p-home-section-ttl-small">
								</div>
							</h2>

						</div>
						<div class="c-scroll">
							<p class="c-scroll-txt">SCROLL</p>
							<div class="c-scroll-arrow"></div>
						</div>
					</div>
				</header>

				<section class="p-home-blog js-animate js-fade-in-up">

					<div class="p-home-blog-inner">
						<h3 class="p-section-ttl">お知らせ<span class="p-section-ttl-sub">Information</span></h3>

						<ul class="p-home-blog-list">
							<li class="p-home-blog-item">
								<a href="single.html" class="p-home-blog-link">
									<div class="p-home-blog-caption">
										<div class="p-home-blog-meta">
											<time datetime="2020-04-02" class="p-home-blog-time">2020.04.02</time>
											<div class="p-home-blog-category">
												<ul>
													<li>お知らせ</li>
												</ul>
											</div>
										</div>
										<h4 class="p-home-blog-ttl">ホームページを作成しました。</h4>
									</div>
								</a>
							</li>
							<li class="p-home-blog-item">
								<a href="" class="p-home-blog-link">
									<div class="p-home-blog-caption">
										<div class="p-home-blog-meta">
											<time datetime="2020-04-02" class="p-home-blog-time">2020.04.02</time>
											<div class="p-home-blog-category">
												<ul>
													<li>お知らせ</li>
												</ul>
											</div>
										</div>
										<h4 class="p-home-blog-ttl">ホームページを作成しました。</h4>
									</div>
								</a>
							</li>
							<li class="p-home-blog-item">
								<a href="" class="p-home-blog-link">
									<div class="p-home-blog-caption">
										<div class="p-home-blog-meta">
											<time datetime="2020-04-02" class="p-home-blog-time">2020.04.02</time>
											<div class="p-home-blog-category">
												<ul>
													<li>お知らせ</li>
												</ul>
											</div>
										</div>
										<h4 class="p-home-blog-ttl">ホームページを作成しました。</h4>
									</div>
								</a>
							</li>
						</ul>

						<div class="c-btn">
							<a href="" class="c-btn-txt">VIEW</a>
						</div>

					</div>

				</section>

				<section class="p-home-about js-animate js-fade-in-up">
					<h3 class="p-section-ttl">会社情報<span class="p-section-ttl-sub">About</span></h3>
					<div class="c-btn -white">
						<a href="" class="c-btn-txt">VIEW</a>
					</div>
				</section>
				<section class="p-home-facility js-animate js-fade-in-up">
					<h3 class="p-section-ttl">設備紹介<span class="p-section-ttl-sub">facility</span></h3>
					<div class="c-btn -white">
						<a href="" class="c-btn-txt">VIEW</a>
					</div>
				</section>
				<section class="p-home-recruit js-animate js-fade-in-up">
					<h3 class="p-section-ttl">採用情報<span class="p-section-ttl-sub">Recruit</span></h3>
					<div class="c-btn -white">
						<a href="" class="c-btn-txt">VIEW</a>
					</div>
				</section>
				<section class="p-home-contact js-animate js-fade-in-up">
					<h3 class="p-section-ttl">お問い合わせ<span class="p-section-ttl-sub">Contact</span></h3>
					<p class="p-section-txt">グラインディング株式会社へのお問い合わせは<br class="pc">下記よりお願いいたします。</p>
					<div class="c-btn -white">
						<a href="" class="c-btn-txt">VIEW</a>
					</div>
				</section>

			</article>
		</main>

<?php get_footer() ;?>
