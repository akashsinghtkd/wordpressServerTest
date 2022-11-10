(function($) {
	"use strict";
	/* Add Click On Ipad */
	$(window).resize(function(){
		var $width = $(this).width();
		if( $width < 1199 ){
			$( '.primary-menu .nav .dropdown-toggle'  ).each(function(){
				$(this).attr('data-toggle', 'dropdown');
			});
		}
	});
	$(window).load(function() {
		/* Masonry Blog */
		$('body').find('.grid-blog').isotope({ 
			layoutMode : 'masonry'
		});
	});
	
	$('.phone-icon-search').on('click', function(){
			$('.top-search').toggle("slide");
	});
		
	$('ul.orderby.order-dropdown li ul').hide(); 
    $("ul.order-dropdown > li").each( function(){
			$(this).hover( function() {
				$(this).find( '> ul' ).stop().fadeIn("fast");
			}, function() {
					$(this).find( '> ul' ).stop().fadeOut("fast");
			});
		});
	
	/*
	**  show menu mobile
	*/
	$(window).resize(function(){
		var $width = $(this).width();
		if( $width < 767 ){
			$(window).scroll(function(){
				  var scrollTop = $(window).scrollTop();
				  if( scrollTop > 60){
					$('.header-mobile-style1 .search-sticky').addClass("now"); 
				  }else{
					  	$('.header-mobile-style1 .search-sticky').removeClass("now"); 
				  }
			});
		}
	});
	$('.header-menu-categories .open-menu').on('click', function(){
			$('.main-menu').toggleClass("open");
	});
	
	$('.header-mobile-style2 .header-search a .fa-search').on('click', function(){
			$('.header-mobile-style2 .header-search ').toggleClass("open");
	});
	
	$('.header-mobile-style1 .search-sticky a .icon-menu-top').on('click', function(){
			$('.header-mobile-style1 .search-sticky').toggleClass("open");
	});
	
	$('.footer-mstyle1 .footer-menu .footer-search a').on('click', function(){
			$('.footer-mstyle1 .top-form.top-search').toggleClass("open");
	});
	
	$('.footer-mstyle1 .footer-menu .footer-more a').on('click', function(){
			$('.menu-item-hidden').toggleClass("open");
	});
	
	/*
	** js mobile
	*/
	
	$('.single-product.mobile-layout .social-share .title-share').on('click', function(){
			$('.single-product.mobile-layout .social-share').toggleClass("open");
	});
	$('.single-post.mobile-layout .social-share .title-share').on('click', function(){
			$('.single-post.mobile-layout .social-share').toggleClass("open");
	});

	$('.single-post.mobile-layout .social-share.open .title-share').on('click', function(){
			$('.single-post.mobile-layout .social-share').removeClass("open");
	});
	
	$('.products-nav .filter-product').on('click', function(){
			$('.products-wrapper .filter-mobile').toggleClass("open");
			$('.products-wrapper').toggleClass('show-modal');
	});
	
	$('.products-nav .filter-product').on('click', function(){
		if( $( ".products-wrapper .products-nav .filter-product" ).not( ".filter-mobile" ) ){
			$('.products-wrapper').removeClass('show-modal');
		}	
	});
	
	$('.mobile-layout .vertical_megamenu .resmenu-container .navbar-toggle').on('click', function(){
			$('.mobile-layout .body-wrapper .container').toggleClass('open');
	});
	
	$('.mobile-layout header .vertical_megamenu .resmenu-container').on('click', function(){
			$(this).removeClass('resmenu-container-sidebar');
	});
	
	$('.mobile-layout .back-history').on('click', function(){
			window.history.back();
	});
	
	$('.footer-mstyle2 .footer-container .footer-open').on('click', function(){
		$('.footer-mstyle2').toggleClass('open');
	});
	
	$(document).ready(function(){
		/* Quickview */
		$('.fancybox').fancybox({
			'width'    : 997,
			'height'   : 500,
			'autoSize' : false,
			afterShow: function() {
				$(' .share ').on('click', function() {
					$(' .social-share ').toggle( "slow" );
				});
				$( '.quickview-container .product-images' ).each(function(){
					var $id = this.id;
					var $rtl = $('body').hasClass( 'rtl' );
					var $img_slider = $( '#' + $id + ' .product-responsive');
					var $thumb_slider = $( '#' + $id + ' .product-responsive-thumbnail' )
					$img_slider.slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						fade: true,
						arrows: false,
						rtl: $rtl,
						asNavFor: $thumb_slider
					});
					$thumb_slider.slick({
						slidesToShow: 3,
						slidesToScroll: 1,
						asNavFor: $img_slider,
						arrows: true,
						focusOnSelect: true,
						rtl: $rtl,
						responsive: [				
							{
							  breakpoint: 360,
							  settings: {
								slidesToShow: 2    
							  }
							}
						  ]
					});

					var el = $(this);
					setTimeout(function(){
						el.removeClass("loading");						
					}, 1000);
				});
			}
		});
		/* Slider Image */
		$( '.product-images' ).each(function(){
			var $id 			= this.id;
			var $rtl 			= $('body').hasClass( 'rtl' );
			var video_link 		= $(this).data('video');
			var $vertical		= $(this).data('vertical');
			var $img_slider 	= $( '#' + $id + ' .product-responsive');
			var $thumb_slider 	= $( '#' + $id + ' .product-responsive-thumbnail' );
			var $number_large	= ( $vertical == false ) ? 4 : 4;
			$img_slider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				rtl: $rtl,
				asNavFor: $thumb_slider
			});
			$thumb_slider.slick({
				slidesToShow: $number_large        ,
				slidesToScroll: 1,
				asNavFor: $img_slider,
				arrows: true,
				focusOnSelect: true,
				rtl: $rtl,
				vertical: $vertical,
				verticalSwiping: $vertical,
				responsive: [				
					{
					  breakpoint: 360,
					  settings: {
						slidesToShow: 2    
					  }
					}
				  ]
			});

			var el = $(this);
			setTimeout(function(){
				el.removeClass("loading");
			}, 1000);
			if( video_link != '' ) {
				$img_slider.append( '<button data-type="popup" class="featured-video-button fa fa-video-camera" data-video="'+ video_link +'"></button>' );
			}
		});
		$( '.sw-woo-tab-style3' ).each(function(){
			var el = $(this);
			setTimeout(function(){
				el.removeClass("loading");
			}, 1000);			
		});
		
	});

var mobileHover = function () {
    $('*').on('touchstart', function () {
        $(this).trigger('hover');
    }).on('touchend', function () {
        $(this).trigger('hover');
    });
};

mobileHover();

    jQuery('.product-categories')
        .find('li:gt(5)') /*you want :gt(4) since index starts at 0 and H3 is not in LI */
        .hide()
        .end()
        .each(function(){
            if($(this).children('li').length > 5){ //iterates over each UL and if they have 5+ LIs then adds Show More...
                $(this).append(
                    $('<li><a>See more   +</a></li>')
                        .addClass('showMore')
                        .on('click',function(){
                            if($(this).siblings(':hidden').length > 0){
                                $(this).html('<a>See less   -</a>').siblings(':hidden').show(400);
                            }else{
                                $(this).html('<a>See more   +</a>').show().siblings('li:gt(5)').hide(400);
                            }
                        })
                );
            }
        });
    /*Form search iP*/




    jQuery('a.phone-icon-menu').on('click', function(){
       var temp = jQuery('.navbar-inner.navbar-inverse').toggle( "slide" );
	   $(this).toggleClass('active');
    });
	$('.furnicomtooltip').tooltip();
	/* fix accordion heading state */
	$('.accordion-heading').each(function(){
		var $this = $(this), $body = $this.siblings('.accordion-body');
		if (!$body.hasClass('in')){
			$this.find('.accordion-toggle').addClass('collapsed');
		}
	});
	

	/* twice click */
	$(document).on('click.twice', '.open [data-toggle="dropdown"]', function(e){
		var $this = $(this), href = $this.attr('href');
		e.preventDefault();
		window.location.href = href;
		return false;
	});

    $('#cpanel').collapse();

    $('#cpanel-reset').on('click', function(e) {

    	if (document.cookie && document.cookie != '') {
    		var split = document.cookie.split(';');
    		for (var i = 0; i < split.length; i++) {
    			var name_value = split[i].split("=");
    			name_value[0] = name_value[0].replace(/^ /, '');

    			if (name_value[0].indexOf(cpanel_name)===0) {
    				$.cookie(name_value[0], 1, { path: '/', expires: -1 });
    			}
    		}
    	}

    	location.reload();
    });

	$('#cpanel-form').on('submit', function(e){
		var $this = $(this), data = $this.data(), values = $this.serializeArray();

		var checkbox = $this.find('input:checkbox');
		$.each(checkbox, function() {

			if( !$(this).is(':checked') ) {
				name = $(this).attr('name');
				name = name.replace(/([^\[]*)\[(.*)\]/g, '$1_$2');

				$.cookie( name , 0, { path: '/', expires: 7 });
			}

		})

		$.each(values, function(){
			var $nvp = this;
			var name = $nvp.name;
			var value = $nvp.value;

			if ( !(name.indexOf(cpanel_name + '[')===0) ) return ;

			name = name.replace(/([^\[]*)\[(.*)\]/g, '$1_$2');

			$.cookie( name , value, { path: '/', expires: 7 });

		});

		location.reload();

		return false;

	});

	$('a[href="#cpanel-form"]').on( 'click', function(e) {
		var parent = $('#cpanel-form'), right = parent.css('right'), width = parent.width();

		if ( parseFloat(right) < -10 ) {
			parent.animate({
				right: '0px',
			}, "slow");
		} else {
			parent.animate({
				right: '-' + width ,
			}, "slow");
		}

		if ( $(this).hasClass('active') ) {
			$(this).removeClass('active');
		} else $(this).addClass('active');

		e.preventDefault();
	});
/*Product listing select box*/
	jQuery('.catalog-ordering .orderby .current-li a').html(jQuery('.catalog-ordering .orderby ul li.current a').html());
	jQuery('.catalog-ordering .sort-count .current-li a').html(jQuery('.catalog-ordering .sort-count ul li.current a').html());
/*currency Selectbox*/
	$('.currency_switcher li a').on('click', function(){
		var $current = $(this).attr('data-currencycode');
		jQuery('.currency_w > li > a').html($current);
	});
/*language*/
	$("#lang_sel ul > li > a").on({
		mouseover: function () {
			$('#lang_sel ul > li ul').css('display', 'block');
		},
		mouseleave: function () {
			$('#lang_sel ul > li ul').css('display', 'none');
		}
	});
	var $current ='';
	$('#lang_sel ul > li > ul li a').on('click',function(){
	 $current = $(this).html();
	 $('#lang_sel ul > li > a.lang_sel_sel').html($current);
	  $a = $.cookie('lang_select_atom', $current, { expires: 1, path: '/'}); 
	});
	if( $.cookie('lang_select_atom') && $.cookie('lang_select_atom').length > 0 ) {
	 $('#lang_sel ul > li > a.lang_sel_sel').html($.cookie('lang_select_atom'));
	}
	
	$('#lang_sel ul > li.icl-ar').click(function(){
		$('#lang_sel ul > li.icl-en').removeClass( 'active' );
		$(this).addClass( 'active' );
		$.cookie( 'clickboom_lang_en' , 1, { path: '/', expires: 1 });
	});
	$('#lang_sel ul > li.icl-en').click(function(){
		$('#lang_sel ul > li.icl-ar').removeClass( 'active' );
		$(this).addClass( 'active' );
		$.cookie( 'clickboom_lang_en' , 0, { path: '/', expires: -1 });
	});
	var Jiordano_Lang = $.cookie( 'clickboom_lang_en' );
	if( Jiordano_Lang == null ){
		$('#lang_sel ul > li.icl-en').addClass( 'active' );
		$('#lang_sel ul > li.icl-ar').removeClass( 'active' );
	}else{
		$('#lang_sel ul > li.icl-en').removeClass( 'active' );
		$('#lang_sel ul > li.icl-ar').addClass( 'active' );
	}
	
	jQuery(function($){
	// back to top
	$("#furnicom-totop").hide();
	$(function () {
		var wh = $(window).height();
		var whtml = $(document).height();
		$(window).scroll(function () {
			if ($(this).scrollTop() > whtml/10) {
					$('#furnicom-totop').fadeIn();
				} else {
					$('#furnicom-totop').fadeOut();
				}
			});
		$('#furnicom-totop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
			});
	});
	/* end back to top */
	}); 
	jQuery(document).ready(function(){
  jQuery('.wpcf7-form-control-wrap').on('hover', function(){
   $(this).find('.wpcf7-not-valid-tip').css('display', 'none');
  });
 });

 /*fix js */
 $('.wpb_map_wraper').on('click', function () {
    $('.wpb_map_wraper iframe').css("pointer-events", "auto");
});

$( ".wpb_map_wraper" ).on('mouseleave', function() {
  $('.wpb_map_wraper iframe').css("pointer-events", "none"); 
});
/*Remove tag p colections*/
$( ".collections .tab-content .tab-pane" ).find('p:first-child').remove();

//toggle share product detail
$(' .share ').on('click', function() {
  $(' .social-share ').toggle( "slow" );
});
	
	$(document).ready(function(){
	setTimeout(function(){
		$( '.slider-center' ).each(function(){
			var id 		= this.id;
			var height 	= $( "#" + id + ' .slick-center' ).height();
			$( "#" + id + ' .item' ).css( 'height', height );
		});
	},1000);
		
	});
/*-------------------------Show, Hidden Search-------------------------*/
$(".furnicom-top-search .widget-inner h3").on('click', function(){
	$('.top-form.top-search').slideToggle("slow");
});

$(document).ready(function(){
	$(".hot-category .list-category .item .room").each(function(i){
		var _that = $(this);
		if (i == 0){
			 _that.addClass('active');
		}else{
			_that.hover(function(){
				   $(this).addClass('active');
				   if( $('.dining-room').hasClass('active'));
						$('.dining-room').removeClass('active');
				   }, function(){
						$(this).removeClass('active');
					    $('.dining-room').addClass('active');
				   }
			);
		}
	});
});	
	
/*remove tag p*/
$( ".collections .tab-pane " ).find( "p" ).remove();

/*active search home 6*/
jQuery('.header-style6 .top-search .topsearch-entry input').focus(function(){
		jQuery('.top-search').addClass('active-search'); 
	});
	jQuery('.header-style6 .top-search .topsearch-entry input').blur(function(){
		jQuery('.top-search').removeClass('active-search'); 
	});
/*active search home 7*/
jQuery('.header-style7 .top-search .topsearch-entry input').focus(function(){
		jQuery('.top-search').addClass('active-search'); 
	});
	jQuery('.header-style7 .top-search .topsearch-entry input').blur(function(){
		jQuery('.top-search').removeClass('active-search'); 
	});

	$(window).scroll(function() {   
		if( $( 'body' ).hasClass( 'mobile-layout' ) ) {
			var scroll_top = $(window).scrollTop();
			if ( scroll_top > 0 ) {
				$(".mobile-layout #header-page").addClass("sticky-mobile");
			}else{
				$(".mobile-layout #header-page").removeClass("sticky-mobile");
			}			
		}
	});
	
	/**
	* Quickview
	**/
	if( $('body').html().match( /sw-quickview-bottom/ ) ){
		var qv_target =  $('.sw-quickview-bottom');
		$(document).on( 'click', 'button[data-type="popup"]', function(){
			var video_url = $(this).data( 'video' );
			qv_target.addClass( 'show loading' );					
			setTimeout(function(){
				qv_target.find( '.quickview-inner' ).append( '<div class="video-wrapper"><iframe width="560" height="390" src="'+ video_url +'" frameborder="0" allowfullscreen></iframe></div>' );	
				qv_target.find( '.quickview-content' ).css( 'margin-top', ( $(window).height() - qv_target.find( '.quickview-content' ).outerHeight() ) /2 );
				qv_target.removeClass( 'loading' );
			}, 1000);
		});
		
		$( '.quickview-close' ).on('click', function(){
			qv_target.removeClass( 'show' );
			qv_target.find( '.quickview-inner' ).html('');			
		});
		$(document).click(function(e) {			
			var container = qv_target.find( '.quickview-inner' );
			if ( !container.is(e.target) && container.has(e.target).length === 0 && qv_target.find( '.quickview-inner' ).html().length > 0 ){
				qv_target.removeClass( 'show' );
				qv_target.find( '.quickview-inner' ).html('');
			}
		});
	}
	
	$( '.btn-search-mobile' ).on( 'click', function(e){
		$( '.top-form.top-search' ).toggleClass('open');
		e.preventDefault();
	});
	
}(jQuery));

(function($){		
	  $('[data-toggle="tooltip"]').tooltip();
	/*Verticle Menu*/
    jQuery('.page .vertical-megamenu')
        .find(' > li:gt(4) ') 
        .hide()
        .end()
        .each(function(){
            if($(this).children('li').length > 4){ 
                $(this).append(
                    $('<li><a class="open-more-cat">View More Categories  </a></li>')
                        .addClass('showMore')
                        .on('click', function(){
                            if($(this).siblings(':hidden').length > 0){
                                $(this).html('<a class="close-more-cat">View Less Categories</a>').siblings(':hidden').show(400);
                            }else{
                                $(this).html('<a class="open-more-cat">View More Categories</a>').show().siblings('li:gt(4)').hide(400);
                            }
                        })
                );
            }
        });
	
})(jQuery);