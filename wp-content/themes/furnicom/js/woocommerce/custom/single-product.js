/*global wc_single_product_params, PhotoSwipe, PhotoSwipeUI_Default */
jQuery( function( $ ) {

	// wc_single_product_params is required to continue.
	if ( typeof wc_single_product_params === 'undefined' ) {
		return false;
	}

	$( 'body' )
		// Tabs
		.on( 'init', '.wc-tabs-wrapper, .woocommerce-tabs', function() {
			$( '.wc-tab, .woocommerce-tabs .panel:not(.panel .panel)' ).hide();

			var hash  = window.location.hash;
			var url   = window.location.href;
			var $tabs = $( this ).find( '.wc-tabs, ul.tabs' ).first();

			if ( hash.toLowerCase().indexOf( 'comment-' ) >= 0 || hash === '#reviews' || hash === '#tab-reviews' ) {
				$tabs.find( 'li.reviews_tab a' ).click();
			} else if ( url.indexOf( 'comment-page-' ) > 0 || url.indexOf( 'cpage=' ) > 0 ) {
				$tabs.find( 'li.reviews_tab a' ).click();
			} else {
				$tabs.find( 'li:first a' ).click();
			}
		} )
		.on( 'click', '.wc-tabs li a, ul.tabs li a', function( e ) {
			e.preventDefault();
			var $tab          = $( this );
			var $tabs_wrapper = $tab.closest( '.wc-tabs-wrapper, .woocommerce-tabs' );
			var $tabs         = $tabs_wrapper.find( '.wc-tabs, ul.tabs' );

			$tabs.find( 'li' ).removeClass( 'active' );
			$tabs_wrapper.find( '.wc-tab, .panel:not(.panel .panel)' ).hide();

			$tab.closest( 'li' ).addClass( 'active' );
			$tabs_wrapper.find( $tab.attr( 'href' ) ).show();
		} )
		// Review link
		.on( 'click', 'a.woocommerce-review-link', function() {
			$( '.reviews_tab a' ).click();
			return true;
		} )
		// Star ratings for comments
		.on( 'init', '#rating', function() {
			$( '#rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );
		} )
		.on( 'click', '#respond p.stars a', function() {
			var $star   	= $( this ),
				$rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
				$container 	= $( this ).closest( '.stars' );

			$rating.val( $star.text() );
			$star.siblings( 'a' ).removeClass( 'active' );
			$star.addClass( 'active' );
			$container.addClass( 'selected' );

			return false;
		} )
		.on( 'click', '#respond #submit', function() {
			var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
				rating  = $rating.val();

			if ( $rating.length > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
				window.alert( wc_single_product_params.i18n_required_rating_text );

				return false;
			}
		} );

	// Init Tabs and Star Ratings
	$( '.wc-tabs-wrapper, .woocommerce-tabs, #rating' ).trigger( 'init' );

	/**
	 * Product gallery class.
	 */
	var ProductGallery = function( $target, args ) {
		this.$target = $target;
		this.$images = $( '.woocommerce-product-gallery__image', $target );

		// No images? Abort.
		if ( 0 === this.$images.length ) {
			this.$target.css( 'opacity', 1 );
			return;
		}

		// Make this object available.
		$target.data( 'product_gallery', this );

		// Pick functionality to initialize...
		this.zoom_enabled       = $.isFunction( $.fn.zoom ) && wc_single_product_params.zoom_enabled;
		this.photoswipe_enabled = typeof PhotoSwipe !== 'undefined' && wc_single_product_params.photoswipe_enabled;

		// ...also taking args into account.
		if ( args ) {
			this.zoom_enabled       = false === args.zoom_enabled ? false : this.zoom_enabled;
			this.photoswipe_enabled = false === args.photoswipe_enabled ? false : this.photoswipe_enabled;
		}

		// Bind functions to this.
		this.initZoom             = this.initZoom.bind( this );
		this.initPhotoswipe       = this.initPhotoswipe.bind( this );
		this.getGalleryItems      = this.getGalleryItems.bind( this );
		this.openPhotoswipe       = this.openPhotoswipe.bind( this );

		if ( this.zoom_enabled ) {
			this.initZoom();
			$target.on( 'woocommerce_gallery_init_zoom', this.initZoom );
		}

		if ( this.photoswipe_enabled ) {
			this.initPhotoswipe();
		}
	};	

	/**
	 * Init zoom.
	 */
	ProductGallery.prototype.initZoom = function() {
		var zoomTarget   = this.$images,
			galleryWidth = this.$target.width(),
			zoomEnabled  = false;

		$( zoomTarget ).each( function( index, target ) {
			var image = $( target ).find( 'img' );

			if ( image.data( 'large_image_width' ) > galleryWidth ) {
				zoomEnabled = true;
				return false;
			}
		} );

		// But only zoom if the img is larger than its container.
		if ( zoomEnabled ) {
			var zoom_options = {
				touch: false
			};

			if ( 'ontouchstart' in window ) {
				zoom_options.on = 'click';
			}

			zoomTarget.trigger( 'zoom.destroy' );
			zoomTarget.zoom( zoom_options );
		}
	};

	/**
	 * Init PhotoSwipe.
	 */
	ProductGallery.prototype.initPhotoswipe = function() {
		if ( this.zoom_enabled && this.$images.length > 0 ) {
			this.$target.find( '.product-responsive' ).prepend( '<a href="#" class="woocommerce-product-gallery__trigger">????</a>' );
			this.$target.on( 'click', '.woocommerce-product-gallery__trigger', this.openPhotoswipe );
		}
		this.$target.on( 'click', '.woocommerce-product-gallery__image a', this.openPhotoswipe );
	};

	/**
	 * Get product gallery image items.
	 */
	ProductGallery.prototype.getGalleryItems = function() {
		var $slides = this.$images,
			items   = [];

		if ( $slides.length > 0 ) {
			$slides.each( function( i, el ) {
				if( $( el ).data('type') == 'video' ){
					var item_video = '<div class="popup-video"><div class="video-wrapper"><iframe width="560" height="315" src="' + $( el ).data( 'video' ) + '" frameborder="0" allowfullscreen></iframe></div></div>';
					item = {
						html: item_video
					};
				}else{
					var img = $( el ).find( 'img' ),
					large_image_src = img.attr( 'data-large_image' ),
					large_image_w   = img.attr( 'data-large_image_width' ),
					large_image_h   = img.attr( 'data-large_image_height' ),
					item            = {
						src: large_image_src,
						w:   large_image_w,
						h:   large_image_h,
						title: img.attr( 'data-caption' ) ? img.attr( 'data-caption' ) : img.attr( 'title' )
					};
				}
				items.push( item );
			} );
		}
		console.log( items );
		return items;
	};

	/**
	 * Open photoswipe modal.
	 */
	ProductGallery.prototype.openPhotoswipe = function( e ) {
		e.preventDefault();

		var pswpElement = $( '.pswp' )[0],
			items       = this.getGalleryItems(),
			eventTarget = $( e.target ),
			clicked;

		if ( ! eventTarget.is( '.woocommerce-product-gallery__trigger' ) ) {
			clicked = eventTarget.closest( '.woocommerce-product-gallery__image' );
		} else {
			clicked = this.$target.find( '.slick-active' );
		}

		var options = {
			index:                 $( clicked ).index(),
			shareEl:               false,
			closeOnScroll:         false,
			history:               false,
			hideAnimationDuration: 0,
			showAnimationDuration: 0
		};

		// Initializes and opens PhotoSwipe.
		var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
		photoswipe.init();
		photoswipe.listen('beforeChange', function() {
			var currItem = $(photoswipe.currItem.container);
			$('.popup-video').removeClass('active');
			var currItemIframe = currItem.find('.popup-video').addClass('active');
			$('.popup-video').each(function() {
				if (!$(this).hasClass('active')) {
					$(this).attr('src', $(this).attr('src'));
				}
			});
		});
	};

	/**
	 * Function to call wc_product_gallery on jquery selector.
	 */
	$.fn.wc_product_gallery = function( args ) {
		new ProductGallery( this, args );
		return this;
	};

	/*
	 * Initialize all galleries on page.
	 */
	$( '.woocommerce-product-gallery' ).each( function() {
		$( this ).wc_product_gallery();
	} );
} );
