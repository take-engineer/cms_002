<?php

/*------------------------------------------------------------------------
	テーマのセットアップ
------------------------------------------------------------------------*/
function my_setup(){
	add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
	// add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
	add_theme_support('title-tag'); // タイトルタグ自動生成
	add_theme_support(
	'html5',
	array( //HTML5でマークアップ
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		)
	);
}
add_action('after_setup_theme','my_setup');

//サイトタイトルのセパレーター - を ｜ に変更
function wp_document_title_separator( $separator ) {
  $separator = '|';
  return $separator;
}
add_filter( 'document_title_separator', 'wp_document_title_separator' );


/*------------------------------------------------------------------------
	CSSとJavaScriptの読み込み
------------------------------------------------------------------------*/
function my_script_init(){
	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/sass/css/swiper.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'fullpage', get_template_directory_uri().'/sass/css/jquery.fullpage.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'layout', get_template_directory_uri().'/sass/css/layout.css?ver'.time(), array(), '1.0.0', 'all' );
	// wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/js/swiper.js', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'fullpage', get_template_directory_uri().'/js/jquery.fullpage.min.js', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js?ver'.time(), array(), '1.0.0', 'all' );
}

// // 投稿記事画面（シングルページ)のみSNSシェアを表示する
// if(is_single()){
//     wp_enqueue_script('sns', get_template_directory_uri().'/js/sns.js?ver'.time(), array('jquery'), '1.0.0', true);
// }

add_action('wp_enqueue_scripts', 'my_script_init');


/*------------------------------------------------------------------------
	オプションページ設定
------------------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'    => 'サイト設定',
		'menu_title'    => 'サイト設定',
		'menu_slug'     => 'theme-options',
		'capability'    => 'edit_posts',
		'parent_slug'   => '',
		'position'  => false,
		'redirect'  => false,
	));

	acf_add_options_sub_page(array( //サブページ
		'page_title'    => 'ナビゲーション設定',
		'menu_title'    => 'ナビゲーション',
		'menu_slug'     => 'theme-options-nav',
		'capability'    => 'edit_posts',
		'parent_slug'   => 'theme-options', //親ページのスラッグ
		'position'  => false,
	));

	acf_add_options_sub_page(array( //サブページ
		'page_title'    => 'お問い合わせ・CTA設定',
		'menu_title'    => 'お問い合わせ・CTA',
		'menu_slug'     => 'theme-options-cta',
		'capability'    => 'edit_posts',
		'parent_slug'   => 'theme-options', //親ページのスラッグ
		'position'  => false,
	));

	// acf_add_options_sub_page(array( //サブページ
	// 		'page_title'    => 'ヘッダー設定',
	// 		'menu_title'    => 'ヘッダー',
	// 		'menu_slug'     => 'theme-options-header',
	// 		'capability'    => 'edit_posts',
	// 		'parent_slug'   => 'theme-options', //親ページのスラッグ
	// 		'position'  => false,
	// ));

	// acf_add_options_sub_page(array(	//サブページ
	// 		'page_title'    => 'フッター設定',
	// 		'menu_title'    => 'フッター',
	// 		'menu_slug'     => 'theme-options-footer',
	// 		'capability'    => 'edit_posts',
	// 		'parent_slug'   => 'theme-options',	//親ページのスラッグ
	// 		'position'  => false,
	// ));
}


/*------------------------------------------------------------------------
	パンくずリスト
------------------------------------------------------------------------*/
function breadcrumbs( $args = array() ){
	global $post;
	$str ='';
	$defaults = array(
		'id' => "breadcrumbs",
		'home' => "HOME",	//トップページ名称
		'search' => "で検索した結果",
		'tag' => "タグ",
		'author' => "投稿者",
		'notfound' => "404 Not found",
		// 'separator' => '&nbsp;&raquo;&nbsp;'
		'separator' => '&nbsp;<i class="fas fa-angle-right"></i>&nbsp;'
	);

	$get_blog = get_page_by_path("blog");
  $get_blog_title = $get_blog->post_title;

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
		if( is_home() ) {
		echo  '<div id="'. $id .'" >'.'<ul><li>'. $home .'</li></ul></div>';
		}

		if( !is_home() && !is_admin() ){
			$str.= '<div id="'. $id .'" class="c-breadcrumbs">';
			$str.= '<ul class="c-breadcrumbs-list">';
			$str.= '<li class="c-breadcrumbs-item breadcrumb-top" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. home_url() .'/" itemprop="url"><span itemprop="title">'. $home .'</span></a></li>';
			$str.= '<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$my_taxonomy = get_query_var( 'taxonomy' );
			$cpt = get_query_var( 'post_type' );

		if( $my_taxonomy && is_tax( $my_taxonomy ) ) {
			$my_tax = get_queried_object();
			$post_types = get_taxonomy( $my_taxonomy )->object_type;
			$cpt = $post_types[0];
			$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="' .get_post_type_archive_link( $cpt ).'" itemprop="url"><span itemprop="title">'. get_post_type_object( $cpt )->label.'</span></a></li>';
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';

		if( $my_tax -> parent != 0 ) {
			$ancestors = array_reverse( get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ) );

			foreach( $ancestors as $ancestor ){
				$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_term_link( $ancestor, $my_tax->taxonomy ) .'" itemprop="url"><span itemprop="title">'. get_term( $ancestor, $my_tax->taxonomy )->name .'</span></a></li>';
				$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			}
		}
			$str.='<li class="c-breadcrumbs-item">'. $my_tax -> name . '</li>';
		}

		elseif( is_category() ) {
			$cat = get_queried_object();
			if ( $cat -> name != $get_blog_title ) {
				$str .= '<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="' . home_url() . '/blog" itemprop="url"><span itemprop="title">' . $get_blog_title . '</span></a></li>';
      }
			if( $cat -> parent != 0 ){
				$ancestors = array_reverse( get_ancestors( $cat -> cat_ID, 'category' ));
				foreach( $ancestors as $ancestor ){
					$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_category_link( $ancestor ) .'" itemprop="url"><span itemprop="title">'. get_cat_name( $ancestor ) .'</span></a></>';
					$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
				}
			}
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$str.='<li class="c-breadcrumbs-item">'. $cat -> name . '</li>';
		}

		elseif( is_post_type_archive() ) {
			$cpt = get_query_var( 'post_type' );
			$str.='<li class="c-breadcrumbs-item">'. get_post_type_object( $cpt )->label . '</li>';
		}

		elseif( $cpt && is_singular( $cpt ) ){
			$taxes = get_object_taxonomies( $cpt );
			$mytax = $taxes[0];
			$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="' .get_post_type_archive_link( $cpt ).'" itemprop="url"><span itemprop="title">'. get_post_type_object( $cpt )->label.'</span></a></li>';
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$taxes = get_the_terms( $post->ID, $mytax );
			$tax = get_youngest_tax( $taxes, $mytax );

			if( $tax -> parent != 0 ){
				$ancestors = array_reverse( get_ancestors( $tax -> term_id, $mytax ) );
				foreach( $ancestors as $ancestor ){
					$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_term_link( $ancestor, $mytax ).'" itemprop="url"><span itemprop="title">'. get_term( $ancestor, $mytax )->name . '</span></a></li>';
					$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
				}
			}
			$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_term_link( $tax, $mytax ).'" itemprop="url"><span itemprop="title">'. $tax -> name . '</span></a></li>';
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$str.= '<li class="c-breadcrumbs-item">'. $post -> post_title .'</li>';
		}

		elseif( is_single() ){
			$categories = get_the_category( $post->ID );
			$cat = get_youngest_cat( $categories );
			if ( $cat -> name != $get_blog_title ) {
				$str .= '<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="' . home_url() . '/blog" itemprop="url"><span itemprop="title">' . $get_blog_title . '</span></a></li>';
      }
			if( $cat -> parent != 0 ){
				$ancestors = array_reverse( get_ancestors( $cat -> cat_ID, 'category' ) );
			foreach( $ancestors as $ancestor ){
				$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_category_link( $ancestor ).'" itemprop="url"><span itemprop="title">'. get_cat_name( $ancestor ). '</span></a></li>';
				$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			}
		}
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_category_link( $cat -> term_id ). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$str.= '<li class="c-breadcrumbs-item">'. $post -> post_title .'</li>';
        }

		elseif( is_page() ){
			if( $post -> post_parent != 0 ){
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
				foreach( $ancestors as $ancestor ){
					$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_permalink( $ancestor ).'" itemprop="url"><span itemprop="title">'. get_the_title( $ancestor ) .'</span></a></li>';
					$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
				}
			}
			$str.= '<li class="c-breadcrumbs-item">'. $post -> post_title .'</li>';
		}

		elseif( is_date() ){
			if( get_query_var( 'day' ) != 0){
				$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_year_link(get_query_var('year')). '" itemprop="url"><span itemprop="title">' . get_query_var( 'year' ). '年</span></a></li>';
				$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
				$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_month_link(get_query_var( 'year' ), get_query_var( 'monthnum' ) ). '" itemprop="url"><span itemprop="title">'. get_query_var( 'monthnum' ) .'月</span></a></li>';
				$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
				$str.='<li class="c-breadcrumbs-item">'. get_query_var('day'). '日</li>';
		}

		elseif( get_query_var('monthnum' ) != 0){
			$str.='<li class="c-breadcrumbs-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="c-breadcrumbs-link" href="'. get_year_link( get_query_var('year') ) .'" itemprop="url"><span itemprop="title">'. get_query_var( 'year' ) .'年</span></a></li>';
			$str.='<li class="c-breadcrumbs-item">'.$separator.'</li>';
			$str.='<li class="c-breadcrumbs-item">'. get_query_var( 'monthnum' ). '月</li>';
		}

		else {
			$str.='<li class="c-breadcrumbs-item">'. get_query_var( 'year' ) .'年</li>';
		}
		}

		elseif( is_search() ) {
			$str.='<li class="c-breadcrumbs-item">「'. get_search_query() .'」'. $search .'</li>';
		}

		elseif( is_author() ){
			$str .='<li class="c-breadcrumbs-item">'. $author .' : '. get_the_author_meta('display_name', get_query_var( 'author' )).'</li>';
		}

		elseif( is_tag() ){
			$str.='<li class="c-breadcrumbs-item">'. $tag .' : '. single_tag_title( '' , false ). '</li>';
		}

		elseif( is_attachment() ){
			$str.= '<li class="c-breadcrumbs-item">'. $post -> post_title .'</li>';
		}

		elseif( is_404() ){
			$str.='<li class="c-breadcrumbs-item">'.$notfound.'</li>';
		}

		else{
			$str.='<li class="c-breadcrumbs-item">'. wp_title( '', true ) .'</li>';
		}

			$str.='</ul>';
			$str.='</div>';
		}
	echo $str;
}

function get_youngest_cat( $categories ){
	global $post;
	if(count( $categories ) == 1 ){
		$youngest = $categories[0];
	}
	else{
		$count = 0;
		foreach( $categories as $category ){
			$children = get_term_children( $category -> term_id, 'category' );
			if($children){
				if ( $count < count( $children ) ){
					$count = count( $children );
					$lot_children = $children;
					foreach( $lot_children as $child ){
						if( in_category( $child, $post -> ID ) ){
							$youngest = get_category( $child );
						}
					}
				}
			}
			else{
				$youngest = $category;
			}
		}
	}
	return $youngest;
}

function get_youngest_tax( $taxes, $mytaxonomy ){
	global $post;
	if( count( $taxes ) == 1 ){
		$youngest = $taxes[ key( $taxes )];
	}
	else{
		$count = 0;
		foreach( $taxes as $tax ){
			$children = get_term_children( $tax -> term_id, $mytaxonomy );
			if($children){
				if ( $count < count($children) ){
					$count = count($children);
					$lot_children = $children;
					foreach($lot_children as $child){
						if( is_object_in_term( $post -> ID, $mytaxonomy ) ){
							$youngest = get_term($child, $mytaxonomy);
						}
					}
				}
			}
			else{
				$youngest = $tax;
			}
		}
	}
	return $youngest;
}


/*------------------------------------------------------------------------
	blog
------------------------------------------------------------------------*/
//カテゴリーを1つだけ表示
function my_the_post_category( $anchor = true, $id = 0 ) {
	global $post;
	//引数が渡されなければ投稿IDを見るように設定
	if ( 0 === $id ) {
		$id = $post->ID;
	}

	//カテゴリー一覧を取得
	$this_categories = get_the_category( $id );
	if ( $this_categories[0] ) {
		if ( $anchor ) { //引数がtrueならリンク付きで出力
			echo '<a href="' . esc_url( get_category_link( $this_categories[0]->term_id ) ) . '">' . esc_html( $this_categories[0]->cat_name ) . '</a>';
		} else { //引数がfalseならカテゴリー名のみ出力
			echo esc_html( $this_categories[0]->cat_name );
		}
	}
}

//サイドバーのARCHIVE　月別表記を変更
function my_archives_link($html){
  $html = str_replace('年','.',$html);
  $html = str_replace('月','',$html);
  return $html;
}
add_filter('get_archives_link', 'my_archives_link');

//ARCHIVESで出力されるHTMLにクラスを付与
// function add_class_archives_link($link_html){
// 	$link_html = preg_replace('@<li>@i', '<li class="active">', $link_html);
// 	return $link_html;
// }
// add_filter('get_archives_link', 'add_class_archives_link');

//抜粋文の文字数を変更
function my_excerpt_length($length){
	return 30;	//文字数
}
add_filter('excerpt_length', 'my_excerpt_length', 999);


//抜粋文の文末の表示を変更
function my_excerpt_more($more){
	return '...';	//変更後の表示
}
add_filter('excerpt_more', 'my_excerpt_more');


//ページネーション
function pagination( $pages = '', $range = 2 ) {

	$prev_text = '<i class="fas fa-angle-left"></i>';
	$next_text = '<i class="fas fa-angle-right"></i>';

	$showitems = ( $range * 2 ) + 1; //表示するページ数（5ページを表示）

	global $paged; //現在のページ値
	if( empty($paged) ) $paged = 1; //デフォルトのページ

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages; //全ページ数を取得
		if ( !$pages ){ //全ページ数が空の場合は1とする
			$pages = 1;
		}
	}

	if ( 1 != $pages ){ //全ページが1でない場合はページネーションを表示する
		echo '<div class="c-pagination">';
		echo '<ul class="c-pagination-list">';
		//Prev：現在のページ値が１より大きい場合は表示
		if ( $paged > 1 )echo '<li class="c-pagination-item is-prev"><a class="c-pagination-link" href='.get_pagenum_link( $paged - 1 ).'>'.$prev_text.'</a></li>';

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				//三項演算子での条件分岐
				echo( $paged == $i ) ? '<li class="c-pagination-item is-active">'.$i.'</li>':'<li class="c-pagination-item"><a class="c-pagination-link" href='.get_pagenum_link( $i ).'>'.$i.'</a></li>';
			}
		}
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ( $paged < $pages ) echo '<li class="c-pagination-item is-next"><a  class="c-pagination-link" href="'.get_pagenum_link( $paged + 1 ).'">'.$next_text.'</a></li>';
		echo '</ul>';
		echo '</div>';
	}
}
?>
