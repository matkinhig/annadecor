/* --------- xtocky Main.js ------------- */
(function ($) {
    "use strict";
    var xtocky = {
        initialised: false,
        mobile: false,
        container: $('#portfolio-item-container'),
        blogContainer: $('#blog-item-container'),
        productsContainer: $('.products-container'),
        is_rtl: $('body,html').hasClass('rtl'),
        init: function () {

            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }

            // Call xtocky Functions
            this.preLoader();
            this.initVC_rtl();
            this.initCarousel();
            this.productHeight();
            this.intCurrency();
            this.wcQuantityAdjust();
            this.checkMobile();
            this.productCountdown();
            this.scrollToTop();
            this.searchDropFix();
            this.scrollTo();
            this.init_imageZoom();
            this.wc_varitaion_init();
            this.openswatch_init();
            this.vs_init();
            this.progressBars();
            this.inputLabelFix();
            this.tooltip();
            this.pikoAccordion();
            this.categoriesAccordion();
            this.ajaxAddToCartbtn();
            this.ajaxSearch();
            this.ajaxLogin();
            this.postLove();
            if ($.fn.lightGallery) {
                this.lightBox();
            }
            if ($.fn.counterUp) {
                this.counterup();
            }
            if ($.fn.stick_in_parent) {
                this.parent_content_sticky();
            }
            var self = this;
            self.$window = $(window);
            self.$document = $(document);

            if (typeof imagesLoaded === 'function') {
                imagesLoaded(self.container, function () {
                    self.isotopeActivate();
                    self.isotopeFilter();
                });
                // Blog Masonry
                imagesLoaded(self.blogContainer, function () {
                    self.blogMasonry();
                });
                // Porudcts Masonry
                imagesLoaded(self.productsContainer, function () {
                    self.productsMasonry();
                });
            }

        },
        initVC_rtl: function () {
            var is_rtl = $('body,html').hasClass('rtl');
            if (is_rtl) {
                window.vc_rowBehaviour = function () {
                    var $ = window.jQuery;
                    var local_function = function () {
                        /**
                         * vc row
                         */
                        var $elements = $('[data-vc-full-width="true"]');
                        $.each($elements, function (key, item) {
                            var $el = $(this);
                            var $el_full = $el.next('.vc_row-full-width');
                            var $el_wrapper = $('#page');
                            var el_margin_left = parseInt($el.css('margin-left'), 10);
                            var el_margin_right = parseInt($el.css('margin-right'), 10);
                            var offset = 0 - $el_full.offset().left - el_margin_left + $el_wrapper.offset().left;
                            var width = $el_wrapper.width();
                            if (is_rtl) {
                                $el.css({
                                    'position': 'relative',
                                    'right': offset,
                                    'box-sizing': 'border-box',
                                    'width': $el_wrapper.width()
                                });
                            } else {
                                $el.css({
                                    'position': 'relative',
                                    'left': offset,
                                    'box-sizing': 'border-box',
                                    'width': $el_wrapper.width()
                                });
                            }

                            if (!$el.data('vcStretchContent')) {
                                var padding = (-1 * offset);
                                if (padding < 0) {
                                    padding = 0;
                                }
                                var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                                if (paddingRight < 0) {
                                    paddingRight = 0;
                                }
                                $el.css({
                                    'padding-left': padding + 'px',
                                    'padding-right': paddingRight + 'px'
                                });
                            }
                            $el.attr("data-vc-full-width-init", "true");
                        });
                    };
                    /**
                     * vc paralaxrow
                     */
                    var parallaxRow = function () {
                        var vcSkrollrOptions,
                            callSkrollInit = false;
                        if (vcParallaxSkroll) {
                            vcParallaxSkroll.destroy();
                        }
                        $('.vc_parallax-inner').remove();
                        $('[data-5p-top-bottom]').removeAttr('data-5p-top-bottom data-30p-top-bottom');
                        $('[data-vc-parallax]').each(function () {
                            var skrollrSpeed,
                                skrollrSize,
                                skrollrStart,
                                skrollrEnd,
                                $parallaxElement,
                                parallaxImage;
                            callSkrollInit = true; // Enable skrollinit;
                            if ($(this).data('vcParallaxOFade') == 'on') {
                                $(this).children().attr('data-5p-top-bottom', 'opacity:0;').attr('data-30p-top-bottom',
                                    'opacity:1;');
                            }

                            skrollrSize = $(this).data('vcParallax') * 100;
                            $parallaxElement = $('<div />').addClass('vc_parallax-inner').appendTo($(this));
                            $parallaxElement.height(skrollrSize + '%');

                            parallaxImage = $(this).data('vcParallaxImage');

                            if (parallaxImage !== undefined) {
                                $parallaxElement.css('background-image', 'url(' + parallaxImage + ')');
                            }

                            skrollrSpeed = skrollrSize - 100;
                            skrollrStart = -skrollrSpeed;
                            skrollrEnd = 0;

                            $parallaxElement.attr('data-bottom-top', 'top: ' + skrollrStart + '%;').attr('data-top-bottom',
                                'top: ' + skrollrEnd + '%;');
                        });

                        if (callSkrollInit && window.skrollr) {
                            vcSkrollrOptions = {
                                forceHeight: false,
                                smoothScrolling: false,
                                mobileCheck: function () {
                                    return false;
                                }
                            };
                            vcParallaxSkroll = skrollr.init(vcSkrollrOptions);
                            return vcParallaxSkroll;
                        }
                        return false;
                    };

                    $(window).unbind('resize.vcRowBehaviour').bind('resize.vcRowBehaviour', local_function);

                    local_function();
                    parallaxRow();
                }
            }
        },
        // Init slick carousel
        initCarousel: function () {
            var is_rtl = $('body,html').hasClass('rtl');
            if (is_rtl) {
                is_rtl: true;
            }
            else {
                is_rtl: false;
            }

            $('.piko-carousel').not('.slick-initialized').slick({
                rtl: is_rtl
            });
        },
        productHeight: function() {
            $( '.tab-content.tab-open .piko-carousel .product' ).each( function() {
                    var $this = $(this);    
                    var $product = $this.outerWidth();                            
                    $( this ).imagesLoaded( function() {
                            if ( 0 != $this.height() ){
                                $this.height( $this.height() );
                            }
                        });
                    
                    
            });
        },
        preLoader: function () {
            /* preloader*/
            setTimeout(function () {
                $('#site-loading').fadeOut(300);
            }, 300);
        },
        intCurrency: function () {
            $('.currency-name').click(function () {
                var currency = $(this).data('currency');
                Cookies.set('piko_currency', currency, {
                    expires: 1,
                    path: '/'
                });
                location.reload();
            });
        },
        pikoAccordion: function () {
            $(".piko_accordion .panel").on("click", function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $(this).siblings(".panel_content").slideUp(300);
                } else {
                    $(".piko_accordion .panel").removeClass("active");
                    $(this).addClass("active");
                    $(".panel_content").slideUp(300);
                    $(this).siblings(".panel_content").slideDown(300);
                }
            });
        },
        // wc quantity process.
        wcQuantityAdjust: function () {
            var group_product = $('form.grouped_form');
            group_product.find('.input-text.qty').val('0');

            $( 'body' ).on( 'click', '.quantity .plus', function( e ) {
                var $input   = $( this ).parent().parent().find( 'input.input-text' ),
                    $quantity  = parseInt( $input.attr( 'max' ) ),
                    $step      = parseInt( $input.attr( 'step' ) ),
                    $val       = parseInt( $input.val() );
                if ( ( $quantity !== '' ) && ( $quantity <= $val + $step ) ) {
                    $( '.quantity .plus' ).css( 'pointer-events', 'none' );
                }
                if ($val + $step > $quantity) return;
                $input.val( $val + $step );

                $input.trigger( 'change' );
            });
            $( 'body' ).on( 'click', '.quantity .minus', function( e ) {
                var $input  = $( this ).parent().parent().find( 'input.input-text' ),
                    $step   = parseInt( $input.attr( 'step' ) ),
                    $val    = parseInt( $input.val() ) - $step,
                    $group = $(this).parents('form');

                if ($group.hasClass('grouped_form')) {
                    if ( $val <= 0 ) $val = 0;
                } else {
                    if ( $val < $step ) $val = $step;
                }
                $input.val( $val );
                $( '.quantity .plus' ).removeAttr( 'style' );
                $input.trigger( 'change' );
            });
        },
        checkMobile: function () {
            /* Mobile Detect*/
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                this.mobile = true;
            } else {
                this.mobile = false;
            }
        },
        categoriesAccordion: function () {
            //  Categories Accordion
            $.fn.pikoAccordionMenu = function (options) {
                var $this = $(this);

                var plusIcon = '+';
                var minusIcon = '&ndash;';

                $this.addClass('with-accordion');
                var openerHTML = '<div class="open-this">' + plusIcon + '</div>';

                $this.find('li').has('.children, .nav-sublist-dropdown').has('li').addClass('parent-level0').prepend(openerHTML);
                $this.find('.open-this').click(function () {
                    if ($(this).parent().hasClass('opened')) {
                        $(this).html(plusIcon).parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    } else {
                        $(this).html(minusIcon).parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            $('.product-categories,.widget_categories,.widget_nav_menu,.widget_pages').pikoAccordionMenu();
        },
        productCountdown: function () {
            // onsale product and comging soon
            if ($('.countdown-lastest, .count-down-time').length > 0) {
                $('.countdown-lastest, .count-down-time').each(function () {
                    var austDay = new Date($(this).data('y'), $(this).data('m') - 1, $(this).data('d'), $(this).data('h'), $(this).data('i'), $(this).data('s'));
                    $(this).countdown({
                        until: austDay,
                        layout: '<span class="countdown-row"><span class="countdown-section"><span class="countdown-amount">{dnn}</span><span class="countdown-period">' + xtocky_global_message.global.days + '</span></span><span class="countdown-section"><span class="countdown-amount">{hnn}</span><span class="countdown-period">' + xtocky_global_message.global.hours + '</span></span><span class="countdown-section"><span class="countdown-amount">{mnn}</span><span class="countdown-period">' + xtocky_global_message.global.minutes + '</span></span><span class="countdown-section"><span class="countdown-amount">{snn}</span><span class="countdown-period">' + xtocky_global_message.global.seconds + '</span></span></span>'
                    });
                });
            }
        },
        searchDropFix: function () {
            // Fix / Make Header Search form dropdown                       
            $('.header-layout-4 .search-dropdown-btn').click(function (e) {
                $(this)
                    .closest('.search-dropdown-fix')
                    .toggleClass('open');

                e.preventDefault();
                e.stopPropagation();
            });

            $('.search-dropdown-fix').click('click', function (e) {
                e.stopPropagation();
            });

            $('body').click('click', function () {
                $('.search-dropdown-fix').removeClass('open');
            });
        },
        inputLabelFix: function () {
            $('.register-form, #loginform, .login').trigger('reset');
            $('.woocommerce-shipping-fields').addClass('clearfix');
            // Fix placeholder label if input is not empty
            $('.label-overlay').find('.form-control').blur(function (e) {
                var input = $(this),
                    label = input.next('label');
                if (input.val().length !== 0) {
                    label.addClass('not-empty');
                } else {
                    label.removeClass('not-empty');
                }
            });

            $('.label-overlay')
            $(".label-overlay .input-text, .label-overlay .form-control").focus(function () { //woocommerce billing form
                $(this).prev('label, i').addClass('label');
                $(this).parents('.password-input').prev('label, i').addClass('label');
            })
            $(".input-text, .form-control").blur(function () {
                $(this).prev('label, i').removeClass('label');
                $(this).parents('.password-input').prev('label, i').removeClass('label');
            });

            $('.label-overlay').find('.input-text, .form-control').blur(function (e) { //woocommerce billing form
                var input = $(this),
                    label = input.prev('label, i');
                if (input.val().length !== 0) {
                    label.addClass('not-empty');
                } else {
                    label.removeClass('not-empty');
                }
            });

            $('.label-overlay').find('.input-text, .form-control').blur(function (e) { //for wc password
                var input = $(this),
                    label = input.parents('.password-input').prev('label, i');
                if (input.val().length !== 0) {
                    label.addClass('not-empty');
                } else {
                    label.removeClass('not-empty');
                }
            });
        },
        counterup: function () {
            $('.icon_count').counterUp({
                delay: 20,
                time: 2500
            });
        },
        tooltip: function () {
            // Bootstrap Tooltip
            if ($.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        },
        scrollBtnAppear: function () {
            if ($(window).scrollTop() >= 400) {
                $('.scroll-top').addClass('fixed');
            } else {
                $('.scroll-top').removeClass('fixed');
            }
        },
        parent_content_sticky: function () {
            if ($('.sidebar-sticky').length > 0) {
                $('.sidebar-sticky').stick_in_parent();
            }
        },
        news_popup: function () {
            var popup_closed = Cookies.set('piko_popup_closed');
            var news = $('#newsletterModal');

            $('#newsletterModal .pop-close').click(function () {
                if ($('#showagain:checked').val() == 'do-not-show')
                    Cookies.set('piko_popup_closed', 'do-not-show', {
                        expires: 1,
                        path: '/'
                    });
            })
            if (popup_closed != 'do-not-show' && $('body').hasClass('open-popup')) {
                news.addClass('in').show();
                $('body').find('.push_overlay_pop').addClass('in').show();
            }
            $('#newsletterModal .pop-close').click(function (e) {
                e.preventDefault();
                news.hide();
                $('body').find('.push_overlay_pop').removeClass('in').hide();
            });
        },
        scrollToTop: function () {
            $('.scroll-top').click(function (e) {
                $('html, body').animate({
                    'scrollTop': 0
                }, 1200);
                e.preventDefault();
            });
        },
        scrollTo: function () {
            $('.scrollto, .woocommerce-review-link').click(function (e) {
                var offset = $(this).data('offset'),
                    targetId = $(this).attr('href'),
                    target = $(targetId),
                    targetPos = offset ? (target.offset().top + offset) : target.offset().top;

                $('html, body').animate({
                    'scrollTop': targetPos
                }, 1200);
                e.preventDefault();
            });
        },
        init_imageZoom: function () {
            if ($('.piko-image-zoom').length > 0) {
                var img = $('.piko-image-zoom').each(function (index, el) {
                    $(el).zoom({
                        touch: false
                    });
                });
            }
        },
        lightBox: function () {
            /* Lightbox for portfolio items and videso and etc.. */
            $('.popup-gallery').lightGallery({
                selector: '.zoom-btn,.zoom-p, a',
                thumbnail: true,
                exThumbImage: 'data-thumb',
                thumbWidth: 80,
                thumbContHeight: 80
            });

            // Video Popup
            $('.video-gallery').lightGallery({
                selector: '.video, .open',
                counter: false
            });
            $('.modal-open').lightGallery({
                selector: '.open',
                counter: false,
                download: false,
                enableSwipe: false,
                enableDrag: false
            });
        },
        wc_varitaion_init: function (e) {
            /**
             * Sets product images for the chosen variation
             */
            $.fn.wc_variations_image_update = function (variation) {
                var $form = this,
                    $product = $form.closest('.product'),
                    $product_gallery = $product.find('.images'),
                    $gallery_img = $product.find('.piko-nav .slick-slide[data-slick-index="0"] img'),
                    $product_img_wrap = $product_gallery.find('.woocommerce-product-gallery__image, .woocommerce-product-gallery__image--placeholder').eq(0),
                    $product_img_zoom = $product_gallery.find('.woocommerce-product-gallery__image .zoomImg').eq(0),
                    $product_img = $product_img_wrap.find('.wp-post-image'),
                    $product_link = $product_img_wrap.find('a').eq(0);

                if (variation && variation.image && variation.image.src && variation.image.src.length > 1) {
                    var fullImg = $product.find('.piko-nav img[data-large_image="' + variation.image.full_src + '"]');
                    if (fullImg.length > 0) {
                        fullImg.trigger('click');
                    } else {
                        $product_img.wc_set_variation_attr('src', variation.image.full_src);
                        $product_img_zoom.wc_set_variation_attr('src', variation.image.full_src);
                        $product_img.wc_set_variation_attr('height', variation.image.full_src_h);
                        $product_img.wc_set_variation_attr('width', variation.image.full_src_w);
                        $product_img.wc_set_variation_attr('srcset', variation.image.srcset);
                        $product_img.wc_set_variation_attr('sizes', variation.image.sizes);
                        $product_img.wc_set_variation_attr('title', variation.image.title);
                        $product_img.wc_set_variation_attr('alt', variation.image.alt);
                        $product_img.wc_set_variation_attr('data-src', variation.image.full_src);
                        $product_img.wc_set_variation_attr('data-large_image', variation.image.full_src);
                        $product_img.wc_set_variation_attr('data-large_image_width', variation.image.full_src_w);
                        $product_img.wc_set_variation_attr('data-large_image_height', variation.image.full_src_h);
                        $product_img_wrap.wc_set_variation_attr('data-thumb', variation.image.src);
                        $gallery_img.wc_set_variation_attr('src', variation.image.thumb_src);
                        $product_link.wc_set_variation_attr('href', variation.image.full_src);
                    }
                } else {
                    $product_img.wc_reset_variation_attr('src');
                    $product_img_zoom.wc_reset_variation_attr('src');
                    $product_img.wc_reset_variation_attr('width');
                    $product_img.wc_reset_variation_attr('height');
                    $product_img.wc_reset_variation_attr('srcset');
                    $product_img.wc_reset_variation_attr('sizes');
                    $product_img.wc_reset_variation_attr('title');
                    $product_img.wc_reset_variation_attr('alt');
                    $product_img.wc_reset_variation_attr('data-src');
                    $product_img.wc_reset_variation_attr('data-large_image');
                    $product_img.wc_reset_variation_attr('data-large_image_width');
                    $product_img.wc_reset_variation_attr('data-large_image_height');
                    $product_img_wrap.wc_reset_variation_attr('data-thumb');
                    $gallery_img.wc_reset_variation_attr('src');
                    $product_link.wc_reset_variation_attr('href');
                }
                window.setTimeout(function () {
                    $(window).trigger('resize');
                    $form.wc_maybe_trigger_slide_position_reset(variation);
                }, 10);
            };

        },
        openswatch_init: function (e) { //openswatch update images 
            $(document.body).bind('openswatch_update_images', function (event, data) {
                var data_html = data.html;
                var productId = data.productId;

                $('#product-' + productId + ' .piko-product-imges').html(data_html);

                setTimeout(function () {
                    xtocky.initCarousel();
                    xtocky.init_imageZoom();
                    xtocky.lightBox();
                    if (typeof imagesLoaded === 'function') {
                        $('.piko-nav .attachment-shop_thumbnail').imagesLoaded(function () {
                            $('.piko-nav.slick-slider').trigger('resize');
                        });
                    }
                }, 10);
            });
            $('.product-list-color-swatch a').click(function () {
                var src = $(this).data('thumb');
                if (src != '') {
                    $(this).closest('.product').find('img.attachment-shop_catalog, img.attachment-shop_single').first().attr('src', src);
                    $(this).closest('.product').find('img.attachment-shop_catalog, img.attachment-shop_single').first().attr('srcset', src);
                }
                $(this).parent('li').addClass('open').siblings('li').removeClass('open');
            });
        },
        vs_init: function (e) { //vs update images                

            $(document.body).on('vs_update_galllery', function (event, data) {
                var data_html = data.html;
                var productId = data.productId;

                $('#product-' + productId + ' .piko-product-imges').html(data_html);

                setTimeout(function () {
                    xtocky.initCarousel();
                    xtocky.init_imageZoom();
                }, 10);
            });

            $('.vs_product_list a').on('click', function () {
                var src = $(this).data('thumb');
                if (src != '') {
                    $(this).closest('.product').find('img.attachment-shop_catalog, img.attachment-shop_single').first().attr('src', src);
                    $(this).closest('.product').find('img.attachment-shop_catalog, img.attachment-shop_single').first().attr('srcset', src);
                }
                $(this).parent('li').addClass('open').siblings('li').removeClass('open');
            });
        },
        progressBars: function () {
            var waypoints = $('.progress-animate').waypoint({
                handler: function (direction) {
                    var $this = $(this),
                        progressVal = $this.data('width');
                    $this.css({
                        'width': progressVal + '%'
                    }, 400);

                    setTimeout(function () {
                        $this.removeClass('progress-animate');
                        $this.find('.progress-text').fadeIn(400);
                    }, 400);
                },
                offset: '80%'
            })
        },
        isotopeActivate: function () {
            // Trigger for isotope plugin
            if ($.fn.isotope) {
                var container = this.container,
                    layoutMode = container.data('layoutmode');

                container.isotope({
                    itemSelector: '.portfolio-item',
                    layoutMode: (layoutMode) ? layoutMode : 'masonry',
                    percentPosition: true,
                    transitionDuration: '0.8s',
                    cellsByRow: {
                        columnWidth: '.grid-sizer',
                        rowHeight: '.grid-sizer'
                    }
                });
            }
        },
        isotopeFilter: function () {
            // Isotope plugin filter handle
            var self = this,
                filterContainer = $('#portfolio-filter');

            filterContainer.find('a').click(function (e) {
                var $this = $(this),
                    selector = $this.attr('data-filter');

                filterContainer.find('.active').removeClass('active');

                // And filter now
                self.container.isotope({
                    filter: selector,
                    transitionDuration: '0.8s'
                });

                $this.closest('li').addClass('active');
                e.preventDefault();
            });
        },
        blogMasonry: function () {
            // Trigger for isotope plugin
            if ($.fn.isotope) {
                var blogContainer = this.blogContainer;

                blogContainer.isotope({
                    itemSelector: '.entry-grid',
                    layoutMode: 'masonry',
                    transitionDuration: '0.8s'
                });
            }
        },
        productsMasonry: function () {
            // Trigger for isotope plugin
            if ($.fn.isotope) {
                var productsContainer = this.productsContainer,
                    layoutMode = productsContainer.data('layoutmode');

                productsContainer.isotope({
                    itemSelector: '.product-column',
                    layoutMode: (layoutMode) ? layoutMode : 'masonry',
                    transitionDuration: '0.8s'
                });
            }
            $('.woocommerce-review-link').click(function () {
                $('a[href$="#tab-reviews"]').parent('li').addClass('active').siblings('li').removeClass('active');
                $('#tab-reviews').addClass('active').siblings('div').removeClass('active');
            });
        },
        isotopeReinit: function (container) {
            // Recall for isotope plugin
            if ($.fn.isotope) {
                this.productsContainer.isotope('destroy');
                this.productsMasonry();
            }
        },

        // Trigger add to cart button
        ajaxAddToCartbtn: function () {
            $('.add_to_cart_button:not(.product_type_variable)').click(function () {
                var $thisbutton = $(this);
                $thisbutton.prepend('<i class="fa fa-spinner fa-pulse"></i>');

            });
            $(document.body).bind('added_to_cart', function (event, fragments, $button) {
                $button = typeof $button === 'undefined' ? false : $button;
                if (fragments === undefined || fragments["div.widget_shopping_cart_content"] === undefined)
                    return;
                if ($button) {
                    $('.add_to_cart_button').children('.fa-spinner').remove();
                }

                $(pikoAjax.show_offcanvas).addClass('open-mini-cart');
                $('#mini-cart-push, .close-cart').click(function (e) {
                    e.preventDefault();
                    $('body').removeClass('open-mini-cart');
                });
            });

        },
        ajaxSearch: function () {
            var form = $('.piko-ajax-search-form input[type="text"]'),
                request = false;

            form.keyup(function (e) {

                var thisForm = $(this).parents('.piko-ajax-search-form'),
                    results = thisForm.find('.piko-ajax-results'),
                    s = thisForm.find('input[type="text"]').val();

                if (s.length < 1) {
                    results.html('').hide();
                    return;
                }

                var cat = form.find('.chosen-container .chosen-drop li.result-selected').data('option-array-index');

                request && request.abort();

                request = $.ajax({
                    url: pikoAjax.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'xtocky_ajax_search',
                        's': s,
                        'cat': cat
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        thisForm.addClass('piko-ajax-in-action');
                        $('.loading').addClass('open').show();
                        results.hide();
                    },
                    complete: function () {
                        thisForm.removeClass('piko-ajax-in-action');
                        $('.loading').removeClass('open').hide();
                    },
                    success: function (response) {
                        results.html(response.html).show();
                    },
                    error: function () {}
                });

                $('body').click(function (event) {
                    if (!$(event.target).is('.search-form-wrapper') && $(event.target).closest('.search-form-wrapper').length) return;
                    results.hide();
                });

            });

            var h_s = $('.piko-modal-content');

            // Open search form
            $('.piko-modal-open').click(function (e) {
                e.preventDefault();
                h_s.fadeIn();
                h_s.find('.form-control').focus();
            });
            $('#piko-modal-close').click(function () {
                h_s.fadeOut();
            });
        },
        postLove: function () {
            $('.love-button').click(function () {
                var post_id = $(this).data('id');
                jQuery.ajax({
                    url: pikoAjax.ajaxurl,
                    type: 'post',
                    data: {
                        action: 'xtocky_post_love_add_love',
                        post_id: post_id
                    },
                    success: function (response) {
                        jQuery('#love-count').html(response);
                    }
                });

                return false;
            })
        },
        ajaxLogin: function () {
            //TOGOLE LOGIN & REGISTER for woopage
            $('.piko-my-account .piko-togoleform').click(function (e) {
                var formId = $(this).attr('href');
                $(this).closest('.piko-my-account-form').removeClass('show slide');
                $(formId).addClass('show slide');
                e.preventDefault();
            });
            //login show hidden
            $('.button-togole').click(function (e) {
                var $this = $(this);
                var toogleId = $this.attr('data-togole');

                if ($('#' + toogleId).is(':hidden')) {
                    $('.piko-layout-header .showing').removeClass('showing').addClass('just-hidden');
                    $('#' + toogleId).slideDown(300).addClass('showing').removeClass('just-hidden');
                    $('.piko-layout-header .just-hidden').fadeOut(300);
                    $('.button-togole').removeClass('active');
                    $this.addClass('active');
                    if ($this.is('.togole-searchform')) {
                        $('#' + toogleId).find('.search').focus();
                    }
                } else {
                    $('#' + toogleId).slideUp(300).removeClass('showing').addClass('just-hidden');
                    $this.removeClass('active');
                }
                e.preventDefault();
            });

            // Ajax login
            $('.piko-login-form').submit(function (e) {
                var $this = $(this);
                if ($this.hasClass('logging')) {
                    return false;
                }
                if (!$this.hasClass('piko-woocommerce-login-form')) { // Don't ajax with WooCommerce login form
                    var user_login = $this.find('input[name=log]').val();
                    var user_pass = $this.find('input[name=pwd]').val();
                    var rememberme = $this.find('input[name=rememberme]').is(':checked') ? 'yes' : 'no';
                    var redirect_to = $this.find('input[name=redirect_to]').val();
                    var login_nonce = $this.find('input[name="login-ajax-nonce"]').val();

                    var data = {
                        action: 'xtocky_do_login_via_ajax',
                        user_login: user_login,
                        user_pass: user_pass,
                        rememberme: rememberme,
                        redirect_to: redirect_to,
                        login_nonce: login_nonce
                    };

                    $this.addClass('logging loading');
                    if (!$('.piko-login-form .piko-loading').length) {
                        $this.prepend('<div class="piko-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
                    }

                    $.post(pikoAjax.ajaxurl, data, function (response) {

                        if ($.trim(response['is_logged_in']) == 'yes') {
                            $this.replaceWith(response['message']);

                            // Show welcome user on top menu
                            if ($('#piko-show-account').length) {
                                setTimeout(function () {
                                    $('#piko-show-account').html(response['html']);
                                }, 500);
                            }

                            // Reload page
                            location.reload(true);

                        } else {
                            $this.find('.login-message').remove();
                            $this.append(response['message']);
                        }

                        $this.removeClass('logging loading');

                    });

                    return false;
                }

            });
            //Ajax Register
            $('.piko-register-form').submit(function (e) {

                var $this = $(this);

                if ($this.hasClass('registering')) {
                    return false;
                }

                if (!$this.hasClass('theme-woocommerce-register-form')) { // Don't ajax with WooCommerce register form
                    var username = $this.find('input[name=username]').val();
                    var email = $this.find('input[name=email]').val();
                    var password = $this.find('input[name=password]').val();
                    var repassword = $this.find('input[name=confirm-password]').val();
                    var agree = $this.find('input[name=agree]').is(':checked') ? 'yes' : 'no';
                    var register_nonce = $this.find('input[name="register-ajax-nonce"]').val();

                    var data = {
                        action: 'xtocky_do_register_via_ajax',
                        username: username,
                        email: email,
                        password: password,
                        repassword: repassword,
                        agree: agree,
                        register_nonce: register_nonce
                    };

                    $this.addClass('registering loading');
                    if (!$('.theme-register-form').length) {
                        $this.prepend('<div class="piko-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
                    }

                    $.post(pikoAjax.ajaxurl, data, function (response) {

                        if ($.trim(response['register_ok']) == 'yes') {
                            $this.replaceWith(response['message']);

                            // Reload page
                            location.reload(true);
                        } else {
                            $this.find('.register-message').remove();
                            $this.append(response['message']);
                        }

                        $this.removeClass('registering loading');

                    });

                    return false;
                }

            });
        }
    };
    // Ready Event
    $(document).ready(function () {
        // Init xtocky
        xtocky.init();
        // Reinit Product Masonry/Grid on Tab change
        $('.products-tab, .products-tab-container').find('a[data-toggle=tab]').bind('shown.bs.tab', function () {
            xtocky.isotopeReinit();
        });
        $('body .yith-wcan a, .price_slider_amount .button, .woocommerce-pagination .page-numbers, .yith-wcan-instock-button,.yith-wcan-stock-on-sale, .yith-wcan-list-price-filter .yith-wcan-price-link').click(function () {
            $(document).ajaxComplete(function () {
                $(this).imagesLoaded(function () {
                    $('.products-container').isotope('destroy');
                    $('.products-container').isotope({
                        itemSelector: '.product-column',
                        layoutMode: 'fitRows'
                    });
                });
                xtocky.openswatch_init();
                xtocky.vs_init();
            });
        });

    });

    $(window).load(function () { // Load Event
        xtocky.scrollBtnAppear();
        xtocky.news_popup();
    });
    $(window).scroll(function () { // Scroll Event
        xtocky.scrollBtnAppear();
    });
    // load chosen
    $(".woocommerce-ordering select,.search-dropdown select,.input-row select").chosen({
        disable_search_threshold: 10
    });
    $(document).ajaxComplete(function () {
        $('.yith-wcan-reset-navigation.button').click(function () {
            $(document).ajaxStop(function () {
                window.location.reload();
            });
        });
        jQuery("#yith-quick-view-content select").css('display', 'block');
    });

})(jQuery);

//theme.js
;
window.xtocky = {};

function get_ajax_loading() {
    return jQuery('.xtocky-ajax-loading');
}

function get_message_box() {
    return jQuery('.xtocky-global-message');
}

function get_overlay() {
    return jQuery('.xtocky-overlay');
}

function xtocky_get_container_width() {
    var container_width = jQuery('#page_wrapper > .main > .row').innerWidth() - 30;
    if (jQuery('body').is('.header-layout-3') || jQuery('body').is('.header-layout-4')) {
        if (jQuery(window).width() > 992) {
            container_width = jQuery(window).width();
        }
    }
    return container_width;
}

function xtocky_generate_rand() {
    return Math.round(new Date().getTime() + (Math.random() * 1000));
}

function addStyleSheet(css) {
    var head, styleElement;
    head = document.getElementsByTagName('head')[0];
    styleElement = document.createElement('style');
    styleElement.setAttribute('type', 'text/css');
    if (styleElement.styleSheet) {
        styleElement.styleSheet.cssText = css;
    } else {
        styleElement.appendChild(document.createTextNode(css));
    }
    head.appendChild(styleElement);
    return styleElement;
}

// jQuery fn extend
(function (xtocky, $) {

    xtocky = xtocky || {};

    $.extend(xtocky, {
        options: {
            debug: true,
            show_sticky_header: xtocky_global_message.enable_sticky_header == '1' ? true : false,
            default_timer: 20,
            show_ajax_overlay: true,
            infiniteConfig: {
                navSelector: "div.pagination",
                nextSelector: "div.pagination a.next",
                loading: {
                    finished: function () {
                        $('.xtocky-infinite-loading').hide();
                    },
                    finishedMsg: "xx",
                    msg: $("<div class='xtocky-infinite-loading'><div></div></div>")
                }
            }
        },
        helpers: {
            is_email: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            is_cookie_enabled: function () {
                if (navigator.cookieEnabled) return true;
                // set and read cookie
                document.cookie = "cookietest=1";
                var ret = document.cookie.indexOf("cookietest=") != -1;
                // delete cookie
                document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
                return ret;
            },
            is_touch_device: function () {
                return !!('ontouchstart' in window) // works on most browsers
                    ||
                    !!('onmsgesturechange' in window); // works on ie10
            },
        }
    });

}).apply(this, [window.xtocky, jQuery]);


// jQuery fn extend
(function (xtocky, $) {
    "use strict";

    xtocky = xtocky || {};

    // Default Extend
    // Post Comment From
    $.extend(xtocky, {
        PostComment: {
            initialize: function () {
                var self = this;
                self.events();
                return self;
            },

            events: function () {
                var self = this;
                /**
                 * Comment Form
                 */
                try {
                    $('#commentform').submit(function () {
                        if ($('#commentform #author').length > 0 && $('#commentform #author').val() == '') {
                            alert(xtocky_global_message.global.comment_author);
                            $('#commentform #author').focus();
                            return false;
                        }
                        if ($('#commentform #email').length > 0 && !xtocky.helpers.is_email($('#commentform #email').val())) {
                            alert(xtocky_global_message.global.comment_email);
                            $('#commentform #email').focus();
                            return false;
                        }
                        if ($('#commentform #rating').length > 0 && $('#commentform #rating').val() == '') {
                            alert(xtocky_global_message.global.comment_rating);
                            return false;
                        }
                        if ($('#commentform #comment').length > 0 && $('#commentform #comment').val() == '') {
                            alert(xtocky_global_message.global.comment_content);
                            $('#commentform #comment').focus();
                            return false;
                        }
                    });
                } catch (ex) {
                    log_js(ex);
                }
                return self;
            }
        }
    });

    // Mega Menu
    $.extend(xtocky, {
        MegaMenu: {
            defaults: {
                menu: $('.mega-menu'),
                hoverIntentConfig: {
                    sensitivity: 2,
                    interval: 0,
                    timeout: 0
                },
                rtl: false
            },

            initialize: function (options) {

                this.$setting = $.extend(this.defaults, options);

                this.$menu = this.$setting.menu;

                this.build()
                    .events();

                return this;
            },

            IsSidebarMenu: function ($menu) {
                return $menu.closest('.mega-menu-sidebar').length;
            },
            IsRightMenu: function ($menu) {
                return false;
            },
            popupWidth: function () {
                var winWidth = $(window).width();

                if (winWidth >= xtocky_get_container_width())
                    return xtocky_get_container_width();
                if (winWidth >= 992)
                    return 940;
                if (winWidth >= 768)
                    return 720;

                return $(window).width() - 30;
            },
            build: function () {
                var self = this;

                self.$menu.each(function () {
                    var $menu = $(this);
                    var is_sidebar_menu = self.IsSidebarMenu($menu);
                    var is_right_menu = self.IsRightMenu($menu);

                    if (is_sidebar_menu) {
                        self._side_menu(self, $menu);
                    } else {
                        self._normal_menu(self, $menu);
                    }
                });

                return self;
            },
            _normal_menu: function (self, $menu) {
                var $menu_container = $menu.closest('.columns');
                var container_width = self.popupWidth();
                var offset = 0;


                if ($(window).width() >= $menu_container.width()) {
                    container_width = $menu_container.width();
                }

                if ($menu_container.length) {
                    if (self.$setting.rtl) {
                        offset = ($menu_container.offset().left + $menu_container.width()) - ($menu.offset().left + $menu.width()) + parseInt($menu_container.css('padding-right'));
                    } else {
                        offset = $menu.offset().left - $menu_container.offset().left - parseInt($menu_container.css('padding-left'));
                    }
                    offset = (offset == 1) ? 0 : offset;
                }

                var $menu_items = $menu.find('> li');

                $menu_items.each(function () {
                    var $menu_item = $(this);
                    var $popup = $menu_item.find('> .popup');
                    if ($popup.length > 0) {
                        $popup.css('display', 'block');
                        if ($menu_item.hasClass('wide')) {
                            $popup.css('left', 0);
                            var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                            var row_number = 4;

                            if ($menu_item.hasClass('col-2')) row_number = 2;
                            if ($menu_item.hasClass('col-3')) row_number = 3;
                            if ($menu_item.hasClass('col-4')) row_number = 4;
                            if ($menu_item.hasClass('col-5')) row_number = 5;
                            if ($menu_item.hasClass('col-6')) row_number = 6;

                            if ($(window).width() < 992)
                                row_number = 1;

                            var col_length = 0;
                            $popup.find('> .inner > ul > li').each(function () {
                                var cols = parseInt($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                col_length += cols;
                            });

                            if (col_length > row_number) col_length = row_number;

                            var popup_max_width = $popup.find('.inner').css('max-width');

                            var col_width = container_width / row_number;

                            if (popup_max_width != 'none' && parseInt(popup_max_width) < container_width) {

                                col_width = parseInt(popup_max_width) / row_number;
                            }

                            $popup.find('> .inner > ul > li').each(function () {
                                var cols = parseFloat($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                    $(this).css('width', (100 / col_length * cols) + '%');
                                else
                                    $(this).css('width', (100 / row_number * cols) + '%');
                            });

                            if ($menu_item.hasClass('pos-center')) { // position center
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                                $popup.css({
                                    'left': -left_position
                                });
                            } else if ($menu_item.hasClass('pos-left')) { // position left
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                $popup.css({
                                    'left': 0
                                });
                            } else if ($menu_item.hasClass('pos-right')) { // position right
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                $popup.css({
                                    'left': 'auto',
                                    'right': 0
                                });
                            } else { // position justify
                                $popup.find('> .inner > ul').width(container_width - padding);
                                if (self.$setting.rtl) {
                                    $popup.css({
                                        'right': 0,
                                        'left': 'auto'
                                    });
                                    var right_position = ($popup.offset().left + $popup.width()) - ($menu.offset().left + $menu.width()) - offset;
                                    $popup.css({
                                        'right': right_position,
                                        'left': 'auto'
                                    });
                                } else {
                                    $popup.css({
                                        'left': 0,
                                        'right': 'auto'
                                    });
                                    var left_position = $popup.offset().left - $menu.offset().left + offset;
                                    $popup.css({
                                        'left': -left_position,
                                        'right': 'auto'
                                    });
                                }
                            }
                        }
                        if (!($menu.hasClass('effect-down')))
                            $popup.css('display', 'none');

                        $menu_item.hoverIntent(
                            $.extend({}, self.$setting.hoverIntentConfig, {
                                over: function () {
                                    if (!($menu.hasClass('effect-down')))
                                        $menu_items.find('.popup').hide();
                                    $popup.show();
                                },
                                out: function () {
                                    if (!($menu.hasClass('effect-down')))
                                        $popup.hide();
                                }
                            })
                        );
                    }
                });
            },
            _side_menu: function (self, $menu) {
                var $menu_container = $menu.closest('.container');
                var container_width;
                if ($(window).width() < 992) {
                    container_width = self.popupWidth();
                } else {
                    container_width = self.popupWidth() - 45;
                    if ($menu.closest('body').hasClass('header-layout-3') || $menu.closest('body').hasClass('header-layout-4')) {
                        container_width = container_width - $menu.width() - 40;
                    }
                }

                var is_right_sidebar = self.IsRightMenu($menu);

                var $menu_items = $menu.find('> li');

                $menu_items.each(function () {
                    var $menu_item = $(this);
                    var $popup = $menu_item.find('> .popup');
                    if ($popup.length > 0) {
                        $popup.css('display', 'block');
                        if ($menu_item.hasClass('wide')) {
                            $popup.css('left', 0);
                            var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                            var row_number = 4;

                            if ($menu_item.hasClass('col-2')) row_number = 2;
                            if ($menu_item.hasClass('col-3')) row_number = 3;
                            if ($menu_item.hasClass('col-4')) row_number = 4;
                            if ($menu_item.hasClass('col-5')) row_number = 5;
                            if ($menu_item.hasClass('col-6')) row_number = 6;

                            if ($(window).width() < 992)
                                row_number = 1;

                            var col_length = 0;
                            $popup.find('> .inner > ul > li').each(function () {
                                var cols = parseInt($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                col_length += cols;
                            });

                            if (col_length > row_number) col_length = row_number;

                            var popup_max_width = $popup.find('.inner').css('max-width');
                            var col_width = container_width / row_number;
                            if ('none' !== popup_max_width && popup_max_width < container_width) {
                                col_width = parseInt(popup_max_width) / row_number;
                            }

                            $popup.find('> .inner > ul > li').each(function () {
                                var cols = parseFloat($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                    $(this).css('width', (100 / col_length * cols) + '%');
                                else
                                    $(this).css('width', (100 / row_number * cols) + '%');
                            });

                            $popup.find('> .inner > ul').width(col_width * col_length + 1);
                            if (is_right_sidebar) {
                                $popup.css({
                                    'left': 'auto',
                                    'right': $(this).width()
                                });
                            } else {
                                $popup.css({
                                    'left': $(this).width(),
                                    'right': 'auto'
                                });
                            }
                        }
                        if (!($menu.hasClass('subeffect-down')))
                            $popup.css('display', 'none');

                        $menu_item.hoverIntent(
                            $.extend({}, self.$setting.hoverIntentConfig, {
                                over: function () {
                                    if (!($menu.hasClass('subeffect-down')))
                                        $menu_items.find('.popup').hide();
                                    $popup.show();
                                    $popup.parent().addClass('open');
                                },
                                out: function () {
                                    if (!($menu.hasClass('subeffect-down')))
                                        $popup.hide();
                                    $popup.parent().removeClass('open');
                                }
                            })
                        );
                    }
                });
            },
            events: function () {
                var self = this;

                $('.header-toogle-menu-button').click(function () {
                    if ($(this).hasClass('active')) {
                        $('.header-toogle-menu-button').removeClass('active');
                    } else {
                        $('.header-toogle-menu-button').addClass('active');
                    }
                    $('.header-wrapper .mega-menu-sidebar').toggleClass('open-menu');
                });


                $(window).resize(function () {
                    self.build();
                });

                setTimeout(function () {
                    self.build();
                }, 400);

                return self;
            }
        }
    });

    // Accordion Menu
    $.extend(xtocky, {

        AccordionMenu: {

            defaults: {
                menu: $('.accordion-menu')
            },

            initialize: function ($menu) {
                this.$menu = ($menu || this.defaults.menu);

                this.events()
                    .build();

                return this;
            },

            build: function () {
                var self = this;

                self.$menu.find('li.menu-item.active').each(function () {
                    if ($(this).find('> .arrow').length)
                        $(this).find('> .arrow').trigger('click');
                });

                return self;
            },

            events: function () {
                var self = this;

                self.$menu.find('.arrow').click(function () {
                    var $parent = $(this).parent();
                    $(this).next().stop().slideToggle();
                    if ($parent.hasClass('open')) {
                        $parent.removeClass('open');
                    } else {
                        $parent.addClass('open');
                    }
                });

                $('.toggle-menu-mobile-button, #mobile_menu_wrapper_overlay, .close-menu').click(function (e) {
                    e.preventDefault();
                    $('body').toggleClass('open-mobile-menu');
                    $('.toggle-menu-mobile-button').toggleClass('remove');
                });
                $('.offcanvas .dropdowns-wrapper .header-dropdown.cart-dropdown, .offcanvas #mini-cart-push, .offcanvas .close-cart').click(function (e) {
                    e.preventDefault();
                    $('body').toggleClass('open-mini-cart');
                });
                $('.filter-trigger, .close-filter').click(function (e) {
                    e.preventDefault();
                    $('body').toggleClass('open-filter-trigger');
                });

                $(window).resize(function () {
                    if ($(window).width() > 992) {
                        $('body').removeClass('open-mobile-menu');
                    }
                })

                return self;
            }
        }

    });
    // StickyHeader
    $.extend(xtocky, {
        StickyHeader: {

            defaults: {
                header: $('.sticky-menu-header')
            },

            initialize: function ($header) {
                this.$header = ($header || this.defaults.header);
                this.sticky_height = 0;
                this.sticky_offset = 0;
                this.sticky_pos = 0;
                this.headerTopHeight = $('.header-top').outerHeight(),

                    $('#header:not(.vertical)').height($('.header-top').outerHeight() + $('.header-main').outerHeight());

                this.$header = ($header || this.defaults.header);

                if (!xtocky.options.show_sticky_header || !this.$header.length)
                    return this;

                var self = this;

                self.reset()
                    .build()
                    .events();
                return self;
            },

            build: function () {
                var self = this;

                var scroll_top = $(window).scrollTop(),
                    $this_header_sticky = self.$header;

                if (self.$header.css('position') == 'fixed') {
                    $this_header_sticky = self.$header;
                }
                if (self.$header.find('.header-main').css('position') == 'fixed') {
                    $this_header_sticky = self.$header.find('.header-main');
                }
                if (self.$header.find('.main-menu-wrap').css('position') == 'fixed') {
                    $this_header_sticky = self.$header.find('.main-menu-wrap');
                }

                if (scroll_top > self.headerTopHeight) {
                    self.$header.addClass('active-sticky');
                    $('body .header-wrapper').addClass('sticky-open');
                    $('.header-layout-6 .sticky-menu-header .columns').addClass('container-fluid');
                    $this_header_sticky.css({
                        'top': self.adminbar_height
                    });
                } else {
                    self.$header.removeClass('active-sticky');
                    $('body .header-wrapper').removeClass('sticky-open');
                    $('.header-layout-6 .sticky-menu-header .columns').removeClass('container-fluid');
                    $this_header_sticky.removeAttr('style');
                }

                return self;
            },

            reset: function () {
                var self = this;

                var $admin_bar = $('#wpadminbar');
                var height = 0;
                if ($admin_bar.length) {
                    height = $('#wpadminbar').css('position') == 'fixed' ? $('#wpadminbar').height() : 0;
                }
                self.adminbar_height = height;

                if (self.$header.closest('body').is('.header-layout-3')) {
                    self.sticky_pos = self.$header.find('.header-main').height() + self.adminbar_height;
                } else {
                    self.sticky_pos = self.$header.height() + self.adminbar_height;
                }

                self.$header.removeAttr('style');

                return self;
            },

            events: function () {
                var self = this;

                $(window).resize(function () {
                    self.reset()
                        .build();
                });

                $(window).scroll(function () {
                    self.build();
                });

                return self;
            }
        }
    });

}).apply(this, [window.xtocky, jQuery]);

(function (xtocky, $) {
    "use strict";

    function xtocky_init() {

        if (typeof xtocky.DefaultExtend !== 'undefined') {
            xtocky.DefaultExtend.initialize();
        }
        // Post Comment
        if (typeof xtocky.PostComment !== 'undefined') {
            xtocky.PostComment.initialize();
        }

        // Mega Menu
        if (typeof xtocky.MegaMenu !== 'undefined') {
            xtocky.MegaMenu.initialize();
        }

        // Mega Menu
        if (typeof xtocky.AccordionMenu !== 'undefined') {
            xtocky.AccordionMenu.initialize();
        }

        // Sticky Header
        if (typeof xtocky.StickyHeader !== 'undefined') {
            xtocky.StickyHeader.initialize();
        }

        $('.slick-slider').trigger('resize');
        setTimeout(function () {
            $('.slick-slider').trigger('resize');
        }, 200);

    }
    $(document).ready(function () {
        xtocky_init();
        $(window).bind('vc_reload', function () {
            xtocky_init();
        });
    });

}).apply(this, [window.xtocky, jQuery]);

(function ($) {
    'use strict';
    $(document).ready(function () {
        // fix header cart
        $('.dropdowns-wrapper ul:nth-of-type(2)').prev().addClass('wmpl');
        // product category archive layout
        $('.products-grid .product-container-row').prev('.product-category.product').addClass('cat-last').after('<div class="clearfix"></div>');
        // fix quick sticky menu view
        $(document).ajaxComplete(function () {
            if ($('#yith-quick-view-modal').hasClass('open')) {
                $('#yith-quick-view-modal.open').prevAll('#page').addClass('quick-product-zoom');
            }
        });
        $('.yith-quick-view-overlay, #yith-quick-view-close').click(function (e) {
            $('#yith-quick-view-modal').prevAll('#page').removeClass('quick-product-zoom');
        });

        if (xtocky.helpers.is_touch_device()) {
            $('.products .product_link').each(function () {
                $(this).closest('.product_images_wrapper').addClass('is_touch_devices');
            })
        };

    });
})(jQuery);