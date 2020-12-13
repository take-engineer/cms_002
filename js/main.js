// 100vhをios safariでもキレイに表示させる
$(function () {
	var wHeight = $(window).height();
	$(".p-home-section, .p-portfolio-single-bg, .p-portfolio-single-overlay").height(wHeight);
});
$(window).resize(function () {
	var wHeight = $(window).height();
	$(".p-home-section, .p-portfolio-single-bg, .p-portfolio-single-overlay").height(wHeight);
})

/*------------------------------------------------------------------------
//	ローダー
------------------------------------------------------------------------*/
$(window).on("load", function () {
  setTimeout(function () {
    $(".js-loading").addClass("is-loaded");
  }, 300);
  setTimeout(function () {
    if (!$(".js-loading").hasClass("is-loaded")) {
      $(".js-loading").addClass("is-loaded");
    }
  }, 5000);
});

/*------------------------------------------------------------------------
//	ハンバーガーメニュー＆背景固定
------------------------------------------------------------------------*/
var state = false;
$(".p-hum").on("click touch", function () {
  $(".p-hum-line, .p-hum-wrap").toggleClass("js-open");
	$(".p-hum-gnav").fadeToggle(200);
  if (state == false) {
		$("body").addClass("is-fixed");
    state = true;
  } else {
		$("body").removeClass("is-fixed");
    state = false;
  }
});
//メニュークリック時、ハンバーガーメニューを閉じる
$(".p-hum-gnav-link").click(function () {
  $(".p-hum").trigger('click');
});

/*------------------------------------------------------------------------
//	スライダー
------------------------------------------------------------------------*/
//スライド
function mySlider(slider) {
  var swiper = new Swiper(slider, {
    loop: true,
    speed: 800,
    effect: "fade", //slide,fade,cube,coverflow,flip
    autoplay: {
      delay: 3000,
			disableOnInteraction: false, //スワイプされたら自動再生停止
			// reverseDirection: true,	//逆向き再生　左から右
    },
    // freeMode: true,
    loopPreventsSlide: false,
		// loopAdditionalSlides: 100, //クローンの数
		// allowTouchMove: false,	//スワイプ無効
		initialSlide: 2,	//最初のスライドを指定
		// spaceBetween: 15,	//スライド間の距離
  });
}

$(function () {
  //mv
  if ($(".slider1 .swiper-slide").length > 1) {
    mySlider(".slider1");
  }
  // //about
  // if ($(".slider2 .swiper-slide").length > 1) {
  //   mySlider(".slider2");
  // }
  // //portfolio
  // if ($(".slider3 .swiper-slide").length > 1) {
  //   mySlider(".slider3");
  // }
});

/*------------------------------------------------------------------------
//	アニメーション,発火系
------------------------------------------------------------------------*/
//メーターアニメーション　一度だけ発火用フラグ
var meter_flag = false;
console.log(meter_flag);

$(window).on("load scroll", function () {
  $(".js-animate").not($(".js-change-color")).each(function () {
    var objPos = $(this).offset().top; //対象の画面上部からの距離
    var scroll = $(window).scrollTop(); //スクロールの量
    var windowHeight = $(window).height(); //ウィンドウの高さ
    if (scroll > objPos - windowHeight / 1.13) {
			$(this).addClass("is-animated");
			// if (!meter_flag) {
			// 	meter_flag = true;
			// 	console.log(meter_flag);
			// 	$(this).trigger('cssClassAdd');
			// }
		} /* else if (scroll < objPos - windowHeight) {
			$(this).removeClass("is-animated");
    } */
	});

	if (!meter_flag) {
		if ($(".js-meter-progress").hasClass('is-animated')){
			// $(".js-meter-progress").hasClass('is-animated',function () {
			var objPos = $(".js-meter-progress").offset().top; //対象の画面上部からの距離
			var scroll = $(window).scrollTop(); //スクロールの量
			var windowHeight = $(window).height(); //ウィンドウの高さ
			if (scroll > objPos - windowHeight / 1.13) {
				$(".js-meter-progress").addClass("is-animated");
				// if (!meter_flag) {
				console.log(meter_flag);
				$(".js-meter-progress").trigger('cssClassAdd');
				meter_flag = true;
				// }
			} else if (scroll < objPos - windowHeight) {
				$(".js-meter-progress").removeClass("is-animated");
			}
			// });
		}
	}

	// ↓mix-brend-modeに変更
	//
	//要素が対象エリアに入ったらカラーチェンジ
	// if (document.URL.match(/portfolio_post/)) {	//ポートフォリオ詳細ページなら
	// 	$(".js-change-color").not($(".js-animate")).each(function () {
	// 		var objTop = $(this).offset().top; //対象の画面上部からの距離
	// 		var objMiddle = $(this).height() / 2 + objTop; //対象の高さ中央
	// 		var areaTop = $(".p-portfolio-single-article").offset().top; //対象エリア
	// 		if (objMiddle > areaTop) {
	// 			$(this).addClass("is-changed");
	// 		} else {
	// 			$(this).removeClass("is-changed");
	// 		}
	// 	});
	// }
});

$(".js-meter-progress").bind('cssClassAdd', function () {

		var self = this;
		var rate = $(this).data("rate");
		var parent = $(this).parent();

		$({ Counter: 0 }).animate({ Counter: rate }, {
			duration: 2000,
			easing: "swing",
			step: function (now) {
				var num = Math.floor(now);
				$(self).css("width", num + "%");
				parent.find(".c-meter-num").text(num);
			}
		});
});


//矢印 hover時のトランジション変更用
$(function () {
  $(".js-hover").on("mouseover", function () {
    $(this).addClass("is-hover");
  });
  $(".js-hover").on("mouseout", function () {
    setTimeout(() => {
      $(this).removeClass("is-hover");
    }, 400);
  });
});

/*------------------------------------------------------------------------
//	スムーススクロール ページ遷移
------------------------------------------------------------------------*/
$(function () {
	var urlHash = location.hash;
  var speed = 500;
	var hHeight = $('.p-header').outerHeight();

  //ハッシュ値があればページ内スクロール
  if(urlHash) {
		//スクロールを0に戻す
    $('body,html').stop().scrollTop(0);
    setTimeout(function () {
			//ロード時の処理を待ち、時間差(500ミリ秒)でスクロール実行
      var target = $(urlHash);
      var position = target.offset().top - hHeight;
      $('body,html').stop().animate({scrollTop:position}, speed, "swing");
    }, 500);
  }
  // クリック時
  $('a[href]').click(function(e){
		var anchor = $(this),
    href = anchor.attr('href'),
    pagename = window.location.href;

    // 現在のurlのハッシュ以降を削除
    pagename = pagename.replace(/#.*/,'');

    // リンク先のurlから現在の表示中のurlを削除
    href = href.replace( pagename , '' );

    if( href.search(/^#/) >= 0 ){
			// 整形したリンクがページ内リンクの場合はページ内スクロールの対象とする
      // 通常の遷移処理をキャンセル
      e.preventDefault();

      // 前段階で整形したhrefを使用する
      // var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top - hHeight;
      $("html, body").animate({scrollTop:position}, speed, "swing");

      // ロケーションバーの内容を書き換え
      location.hash = href ;
      return false;
    }
  });
});

/*------------------------------------------------------------------------
//	フルページ　スクロールナップ
------------------------------------------------------------------------*/
// $(function () {
	// 	if ($('body').hasClass('home')) {	//トップページのみ

	// 		//ページネーションをセクションの数だけ生成
	// 		const sectionCount = $(".js-section").length;
	// 		const pagination = $('.c-fullpage-pagination');
	// 		var paginationItemHtml = '';

// 		for (let i = 0; i < sectionCount; i++) {
// 			paginationItemHtml += '<a href="#section' + (i + 1) + '" class="c-fullpage-pagination-item pagination-item' + (i + 1) + '"><span></span></a>';
// 		}
// 		pagination.html(paginationItemHtml);

// 		let flag = 1;	//状態管理用

// 		//ページネーションクリックイベント
// 		pagination.on('click', '.c-fullpage-pagination-item', function (e) {
// 			e.preventDefault();
// 			const offset = $(".c-fullpage-section" + ($(this).index() + 1)).offset().top;
// 			flag = 3;
// 			$('html, body').stop(true).animate({ scrollTop: offset }, 500, 'swing', function () {
// 				flag = 1;
// 			})
// 		});

// 		//ロード時の位置
// 		var prevPos = $(window).scrollTop();

// 		$(window).on('scroll', function () {
// 			var scroll = $(this).scrollTop();

// 			//ページネーション現在地表示
// 			for (let i = 0; i < sectionCount; i++) {
// 				const prevOffset = $('.c-fullpage-section' + (i + 1)).offset().top;

// 				if (scroll >= prevOffset - 1) {	//IE11用に-1
// 					$('.c-fullpage-pagination-item').removeClass('is-active');
// 					$('.pagination-item' + (i + 1)).addClass('is-active');
// 				}
// 			}

// 			//スクロールスナップ
// 			for (let i = 1; i < sectionCount; i++) {
// 				const prevOffset = $(".c-fullpage-section" + i).offset().top;
// 				const nextOffset = $(".c-fullpage-section" + (i + 1)).offset().top;

// 				if ((scroll > prevOffset) && (scroll < nextOffset) && (flag === 1)) {

// 					if (scroll > prevPos) {
// 						flag = 2;
// 						$('html, body').stop(true).animate({ scrollTop: nextOffset }, 500, 'swing', function () {
// 							flag = 1;
// 						});
// 					} else if (scroll < prevPos) {
// 						flag = 2;
// 						$('html, body').stop(true).animate({ scrollTop: prevOffset }, 500, 'swing', function () {
// 							flag = 1;
// 						});
// 					}
// 				}
// 			}
// 			prevPos = scroll;
// 		});
// 	}
// 	$(window).trigger('scroll');
// });
