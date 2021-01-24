(function($){
//   all ------------------

function initBalkon() {
    "use strict";
    //   loader ------------------
    $(".loader-holder").fadeOut(500, function() {
        $("#main-theme").animate({
            opacity: "1"
        }, 500);
    });
    //   Background image ------------------
    var a = $(".bg");
    a.each(function(a) {
        if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
    });
    //   css ------------------
    function d() {
        $(".alt").each(function() {
            $(this).css({
                "margin-top": -$(this).height() / 2 + "px"
            });
        });
        var fthei = $(".content-footer").outerHeight(true);
        if(fthei > $(window).height() - 70) {
            $(".content-footer").addClass('content-footer-relative');
            $(".height-emulator").css({
                height: 0
            });
        }else{
            $(".height-emulator").css({
                height: fthei
            });
            $(".content-footer").removeClass('content-footer-relative');
        }
    }
    d();
    $(window).on("resize", function() {
        d();
    });
        //   scrollToFixed------------------
    if ($(".fixed-bar").outerHeight(true) < $(".post-container").outerHeight(true)) {
        $(".fixed-bar").addClass("fixbar-action");
        $(".fixbar-action").scrollToFixed({
            minWidth: 1064,
            marginTop: function() {
                var a = $(window).height() - $(".fixed-bar").outerHeight(true) - 100;
                if (a >= 0) return 20;
                return a;
            },
            removeOffsets: true,
            limit: function() {
                var a = 100000000;
                if($(".limit-box").length) a = $(".limit-box").offset().top - $(".fixed-bar").outerHeight() - 70;
                return a;
            }
        });
    } else $(".fixed-bar").removeClass("fixbar-action");
    $(".fixed-filter").scrollToFixed({
        minWidth: 1224,
        zIndex: 12,
        marginTop: 110,
        limit: function() {
            var a = 100000000;
            if($(".limit-box").length) a = $(".limit-box").offset().top - $(".fixed-filter").outerHeight(true) - 70;
            
            return a;
        }
    });
    $(".sroll-nav-container").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 110,
        removeOffsets: true,
        limit: function() {
            var a = 100000000;
            if($(".limit-box").length)  a = $(".limit-box").offset().top - $(".sroll-nav-container").outerHeight(true) - 90;
            return a;
        }
    });
    //   Isotope------------------
    function e() {
        if($('.post-gallery-items').length){
            $(".post-gallery-items").each(function(){
                var $that = $(this);
                $that.isotope({
                    itemSelector: ".post-gallery-item",
                    percentPosition: true,
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        columnWidth: ".post-grid-sizer",
                    },
                    transformsEnabled: true,
                    transitionDuration: "700ms",
                });
                $that.imagesLoaded(function() {
                    $that.isotope("layout");
                });
            });
        }
        if ($(".gallery-items").length) {
            $(".gallery-items").each(function(){
                var $that = $(this),
                    active_filter = $('.gallery-filters .gallery-filter:first-child').attr("data-filter");
                $that.isotope({
                    itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three,.gallery-item-full",
                    percentPosition: true,
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                    },
                    transformsEnabled: true,
                    transitionDuration: "700ms",
                    filter : active_filter
                });
                $that.imagesLoaded(function() {
                    $that.isotope("layout");
                });
                $(".gallery-filters").on("click", "a.gallery-filter", function(b) {
                    b.preventDefault();
                    var c = $(this).attr("data-filter"), d = $(this).text();
                    $that.isotope({
                        filter: c
                    });
                    $(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                    $(this).addClass("gallery-filter-active");
                });
                $that.isotope("on", "layoutComplete", function(a, b) {

                    var c = a.length;
                    $(".num-album").html(c);
                    

                });

                $that.on( 'arrangeComplete', function( event, filteredItems ) {
                    initLightGallery();
                } );

                /*infinite scroll*/

                var win = jQuery(window);

                var in_scroll_progress = false;

                var scroll_offset = 0;

                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    /*check for gallery */
                    if(jQuery('.gallery-load-more').length){

                        if(jQuery('.gallery-load-more').scrollTop()){
                            var compare_pos = jQuery('.gallery-load-more').scrollTop();
                        }else{
                            var lm_anchor_pos = jQuery('.gallery-load-more').offset() ;
                            var compare_pos = lm_anchor_pos.top;
                        }

                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {
                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.gallery-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                if(remain == 'yes'){
                                    var grid_hoder = lm_btn.closest('.balkon_images_gallery_wrap').children('.gallery-items');
                                    var ajaxurl = grid_hoder.data('lm-request');
                                    var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'balkon_lm_gal',lmore_items:3,images:'',loaded:10};
                                    
                                    lm_btn.closest('.gallery-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };
                                    

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            
                                            lm_btn.closest('.gallery-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){
                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.gallery-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                $that.isotope();
                                               
                                                $that.isotope( 'insert', jQuery(d.content) );
                                                
                                                $that.imagesLoaded(function() {
                                                    $that.isotope("layout");
                                                });

                                                if(d.is_remaining == 'no'){
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.gallery-lmore-holder').remove();
                                                    
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });//end ajax


                                }//end remain
                                    
                            }//end in_scroll_progress
                        }//end compare position
                    }
                    /*check for portfolio */
                    if(jQuery('.folio-load-more').length){
                        

                        if(jQuery('.folio-load-more').scrollTop()){
                            var compare_pos = jQuery('.folio-load-more').scrollTop();
                        }else{
                            var lm_btn_pos = jQuery('.folio-load-more').offset() ;
                            var compare_pos = lm_btn_pos.top;
                        }

                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {

                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.folio-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                var grid_hoder = lm_btn.closest('.folio-grid-folios-wrap').children('.gallery-items');
                                var ajaxurl = grid_hoder.data('lm-request');
                                var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'balkon_lm_folio',lmore_items:3};

                                if(remain === 'yes'){

                                    lm_btn.closest('.folio-grid-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            lm_btn.closest('.folio-grid-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){
                                                

                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.folio-grid-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                
                                                $that.isotope();
                                                $that.isotope( 'insert', jQuery(d.content) );
                                                
                                                $that.imagesLoaded(function() {
                                                    $that.isotope("layout");

                                                    initparallax();
                                                    initPartcile();

                                                    

                                                });

                                                var j = jQuery(".gallery-item").length;
                                                jQuery(".all-album").html(j);

                                                

                                                if(d.is_remaining == 'no'){
                            
                                                    
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.folio-grid-lmore-holder').remove();
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });

                                    

                                }

                            }
                        }
                    }

                    
                });
                /*infinite scroll - end */

            });
        }
    }
    var f = $(".gallery-item").length;
    $(".all-album , .num-album").html(f);
    e();

    //   lightGallery------------------
    $(".image-popup").lightGallery({
        selector: "this",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        counter: false
    });
    var $o;
    $(".lightgallery").each(function(){
        $o = $(this);
        var p = $o.data("looped");
        if( $o.data('lightGallery') != undefined){
            $o.data('lightGallery').destroy(true);
        }
        $o.lightGallery({
            selector: ".lightgallery a.popup-image , .lightgallery  a.popgal",
            cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
            download: false,
            loop: false
        });
    });
    //   Swiper------------------
    if ($(".slider-wrap").length > 0) {
        $(".slider-wrap").each(function(){
            var $that = $(this);
            var loopSlides = $that.find('.swiper-slide').length;
            var options = $that.data('opts')? $that.data('opts') : {loop:true,direction: 'horizontal',speed: 1000} ;
            options.scrollbar = ".swiper-scrollbar"
            options.slidesPerView = 'auto'
            options.loopedSlides = loopSlides
            options.centeredSlides = false
            options.spaceBetween = 20
            options.grabCursor = true
            options.freeMode = true //If true then slides will not have fixed positions
            options.scrollbarHide = false
            options.nextButton = ".swiper-button-next"
            options.prevButton = ".swiper-button-prev"

            var g = new Swiper( $that.children('.swiper-container') , options);

            $o.on("onBeforeNextSlide.lg", function(a) {
                g.slideNext();
                return false;
            });
            $o.on("onBeforePrevSlide.lg", function(a) {
                g.slidePrev();
                return false;
            });
        });
        
    }
    if ($(".fs-gallery-wrap").length > 0) {
        $(".fs-gallery-wrap").each(function(){
            var $that = $(this);
            var options = $that.data('opts')? $that.data('opts') : {loop:true,direction: 'horizontal',speed: 1000,autoplay: 5000} ;
            options.autoplayDisableOnInteraction = false
            options.pagination = ".swiper-pagination"
            options.paginationClickable = true
            options.grabCursor = true
            options.paginationBulletRender = function(a, b, c) {
                return '<span class="' + c + '">' + (b + 1) + "</span>";
            }
            options.nextButton = ".swiper-button-next"
            options.prevButton = ".swiper-button-prev"
            var j = new Swiper( $that.children('.swiper-container') , options);
            k();
            j.on("onSlideChangeStart", function() {
                l();
            });
            j.on("onSlideChangeEnd", function() {
                k();
            });
            function k() {
                $(".slide-progress").css({
                    width: "100%",
                    transition: "width 5000ms"
                });
            }
            function l() {
                $(".slide-progress").css({
                    width: 0,
                    transition: "width 0s"
                });
            }
        });
        
    }
    if ($(".single-slider").length > 0) {
        $(".single-slider").each(function(){
            var $that = $(this);
            var options = $that.data('opts')? $that.data('opts') : {loop:true,direction: 'horizontal',speed: 1000} ;
            options.pagination = ".swiper-pagination"
            options.paginationType = "fraction"
            options.grabCursor = true
            options.autoHeight = true
            options.nextButton = ".swiper-button-next"
            options.prevButton = ".swiper-button-prev"

            var m = new Swiper( $that.children('.swiper-container') , options);
        });
        
    }
    
    
    
    $(".filter-button").on("click", function() {
        $(".hid-filter").slideToggle(500);
    });
    $(".show-exfilter").on("click", function(a) {
        a.preventDefault();
        $(".product-mainfilter").slideToggle(500);
    });
    //   appear------------------ 
    $(".stats").appear(function () {
        $(".num").countTo();
    });
    $(".balkon_circle-progress").appear(function(){
        var $that = $(this),
            unit = $that.data('unit'),
            color = $that.data('color'),
            width = $that.data('width'),
            lwidth = $that.data('lwidth'),
            $chart = $that.children('.chart');
        $chart.easyPieChart({
            barColor: color,
            trackColor: "#eee",
            scaleColor: "#eee",
            size: width,
            lineWidth: lwidth,
            lineCap: "butt",
            onStep: function(a, b, c) {
                $(this.el).find(".percent").text(Math.round(c) + unit);
            }
        });
    });
    
    //   share------------------
    var r = $(".share-wrapper");
    function s() {
        A();
        r.animate({
            right: 0
        }, 500);
        r.removeClass("isShare");
    }
    function t() {
        r.animate({
            right: "-130px"
        }, 500);
        r.addClass("isShare");
    }
    $(".show-share").on("click", function() {
        if (r.hasClass("isShare")) s(); else t();
    });

    var shs = eval(jQuery(".share-container").attr("data-share"));
    if(shs){
        jQuery(".share-container").share({
            networks: shs
        });
    }

    //   tabs------------------
    $(".tabs-menu a").on("click", function(a) {
        a.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var b = $(this).attr("href");
        $(".tab-content").not(b).css("display", "none");
        $(b).fadeIn();
    });
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function() {
        var a = 70;
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    //   to top------------------
    $(".to-top").on("click", function(a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    //   show hide------------------
    $(".show-cart").on("click", function() {
        $(".cart-overlay").fadeIn(400);
        $(".cart-modal").animate({
            right: 0
        }, 400);
        return false;
    });
    $(".cart-overlay , .close-cart").on("click", function() {
        $(".cart-overlay").fadeOut(400);
        $(".cart-modal").animate({
            right: "-350px"
        }, 400);
        return false;
    });
    //   Video------------------
    $(".background-youtube").each(function(){
        var $that   = $(this),
            vid     = $that.data('vid'),
            mt     = $that.data('mt'),
            ql     = $that.data('ql') ? $that.data('ql') : 'highres',
            pos     = $that.data('pos'),
            ftb     = $that.data('ftb'),
            rep     = $that.data('rep');

        $that.YTPlayer({
            fitToBackground: ftb,
            videoId: vid,
            pauseOnScroll: pos,
            mute: mt,
            repeat : rep,
            //ratio: 16 / 9,// 4/3
            callback: function() {
                var a = $that.data("ytPlayer").player;
                a.setPlaybackQuality(ql);//small,medium,large,hd720,hd1080,highres,default
            },
        });
    });
    $(".background-vimeo").each(function(){
        var $that       = $(this),
            options     = $that.data('opts') ? $that.data('opts') : {video: '97871257',quality: '1080p',mute: '1'};
        var url         = '//player.vimeo.com/video/' + options.video;
        if(options.mute == '1') url +='?background=1&quality='+options.quality+'&loop='+options.loop;
        else url += '?autoplay=1&quality='+options.quality+'&loop='+options.loop;
        $that.append('<iframe src="' + url + '"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');

    });
    $(".video-holder").height($(".media-container").height());
    if ($(window).width() > 1024) {
        if ($(".video-holder").length > 0) if ($(".media-container").height() / 9 * 16 > $(".media-container").width()) {
            $(".background-vimeo iframe ").height($(".media-container").height()).width($(".media-container").height() / 9 * 16);
            $(".background-vimeo iframe ").css({
                "margin-left": -1 * $("iframe").width() / 2 + "px",
                top: "-75px",
                "margin-top": "0px"
            });
        } else {
            $(".background-vimeo iframe ").width($(window).width()).height($(window).width() / 16 * 9);
            $(".background-vimeo iframe ").css({
                "margin-left": -1 * $("iframe").width() / 2 + "px",
                "margin-top": -1 * $("iframe").height() / 2 + "px",
                top: "50%"
            });
        }
    } else if ($(window).width() < 760) {
        $(".video-holder").height($(".media-container").height());
        $(".background-vimeo iframe ").height($(".media-container").height());
    } else {
        $(".video-holder").height($(".media-container").height());
        $(".background-vimeo iframe ").height($(".media-container").height());
    }
    $(".video-container").css("width", $(window).width() + "px");
    $(".video-container ").css("height", parseInt(720 / 1280 * $(window).width()) + "px");
    if ($(".video-container").height() < $(window).height()) {
        $(".video-container ").css("height", $(window).height() + "px");
        $(".video-container").css("width", parseInt(1280 / 720 * $(window).height()) + "px");
    }
    //   show hede------------------
    $(".menubutton").on("click", function() {
        $(".top-bar-menu").slideToggle(300);
    });
    $(".cat-button").on("click", function() {
        $(".category-nav-inner ul").slideToggle(300);
    });
    // $(".product-cat-mains").matchHeight();
    $(".fixed-search form input").on("keypress change", function(a) {
        var b = $(this).val();
        $(".dublicated-text").text(b);
    });
    var x = $(".show-fixed-search"), y = $(".fixed-search");
    function z() {
        x.removeClass("vissearch");
        y.fadeIn(300);
        t();
    }
    function A() {
        x.addClass("vissearch");
        y.fadeOut(300);
    }
    x.on("click", function() {
        if ($(this).hasClass("vissearch")) z(); else A();
    });
    $(".search-form-bg").on("click", function() {
        A();
    });
    $(".blog-btn").on("click", function() {
        $(this).parent(".blog-btn-filter").find("ul").slideToggle(500);
        return false;
    });
    $(".scroll-nav").addClass("black-bg");
    //   Window scroll------------------
    $(window).on("scroll", function() {
        $("section").each(function() {
            var a = $(this);
            var sn = $(".scroll-nav");
            var b = a.position().top - $(window).scrollTop();
            if (b <= 0) {
                $("section").removeClass("current2");
                a.addClass("current2");
            } else {
                a.removeClass("current2");
                sn.removeClass("black-bg");
            }
            if ($(".current2").hasClass("parallax-section"))sn.addClass("black-bg"); else sn.removeClass("black-bg");
        });
    });
    $('.balkon-sbmenu').each(function(){
        $(this).menu();
    });
    $(".scroll-init  ul ").singlePageNav({
        filter: ":not(.external)",
        updateHash: false,
        offset: 70,
        threshold: 120,
        speed: 1200,
        currentClass: "act-scrlink"
    });
    $(".scroll-init ul.balkon_onepage-sidebar-nav a").on("click", function() {
      setTimeout(function() {
       C();
       }, 1500);
    });
    //   Sidebar menu------------------
    var sbo = $(".sb-overlay "),
        sbm = $(".sidebar-menu"),
        sbmb = $(".sb-menu-button");
    function B() {
        sbo.fadeIn(300);
        sbm.animate({
            right: 0
        });
        sbmb.removeClass("vis-m");
    }

    

    function C() {
        sbm.animate({
            right: "-470px"
        });
        sbo.fadeOut(300);
        sbmb.addClass("vis-m");
    }
    sbo.on("click", function() {
        C();
    });
    sbmb.on("click", function() {
        if ($(this).hasClass("vis-m")) B(); else C();
    });
    $(".nav-button-wrap").on("click", function() {
        $(".nav-holder").slideToggle(500);
    });
    var D = function() {
        $(".box-item").on("touchstart", function() {
            $(this).trigger("hover");
        }).on("touchend", function() {
            $(this).trigger("hover");
        });
    };
    D();
    // team  ------------------
    $(".team-box").on({
        mouseenter: function () {
        $(this).find("ul.team-social").fadeIn();
        $(this).find(".team-social a").each(function(a) {
            var b = $(this);
            setTimeout(function() {
                b.animate({
                    opacity: 1,
                    top: "0"
                }, 400);
            }, 150 * a);
        });
    },
     mouseleave: function () {
        $(this).find(".team-social a").each(function(a) {
            var b = $(this);
            setTimeout(function() {
                b.animate({
                    opacity: 0,
                    top: "50px"
                }, 400);
            }, 150 * a);
        });
        setTimeout(function() {
            $(this).find("ul.team-social").fadeOut();
        }, 150);
          }
    });
    
     if ($(window).width() < 1064) {
         $(".nav-holder nav li").on("click", function() {
             $(this).find("ul").toggleClass("visul");           
         });
         $(".nav-holder nav li ul").parent("li").addClass("lidec")
      } 
    
    /*init instagram feed */
    if(jQuery('.cththemes-instafeed').length){
        jQuery('.cththemes-instafeed').each(function(){
            var clientID = jQuery(this).data('client');
            var accessToken = jQuery(this).data('access');
            var limit = jQuery(this).data('limit');
            var get = jQuery(this).data('get');
            var getval = jQuery(this).data('getval');
            var res = jQuery(this).data('res');
            var target = jQuery(this).find('.cththemes-instafeed-ul').attr('id');
            
            var instafeed_ops = {
                    get: get,
                    target: target,
                    resolution: res,// thumbnail | low_resolution 
                    template: '<li><a href="{{link}}"><img src="{{image}}" alt="{{caption}}"/></a></li>',
                    limit: limit,
                    error: function(err){
                        console.log(err);
                    }
            } ;
            if(clientID != '') {
                instafeed_ops.clientID = clientID;
            }
            if(accessToken != '') {
                instafeed_ops.accessToken = accessToken; 
            }
            if(get == 'tagged'){
                instafeed_ops.tagName = getval;
            }else if(get == 'user'){
                instafeed_ops.userId = getval;
            }
            var feed = new Instafeed(instafeed_ops);
            feed.run();
        });
    }
    
}

function initparallax() {
    var a = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
    if (null == trueMobile) {
        var b = new Scrollax();
        b.reload();
        b.init();
    }
    if (trueMobile) $(".background-video").remove();
}

function initPartcile(){
    if($(".partcile-dec").length){
        $(".partcile-dec").each(function(){
            var $part = $(this);
            var n = $part.data('count');
            var c = $part.data('color');
            $part.jParticle({
                background: "rgba(255,255,255,0.01)",
                color: c,
                particlesNumber: n,
                particle: {
                    speed: 20
                }
            });
        });
    }
}
function initLightGallery(){
    $(".lightgallery").each(function(){
        var $o = $(this), p = $o.data("looped");
        if( $o.data('lightGallery') != undefined){
            $o.data('lightGallery').destroy(true);
        }
        $o.lightGallery({
            selector: ".lightgallery .gallery-item:not([style*='display: none']) a.popup-image",
            cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
            download: false,
            loop: false
        });
    });
}



$(function() {
    initBalkon();
    initparallax();
    initPartcile();

            
    if($('body').is('.balkon-dark')){
        if($('img.balkon-logo').length){
            var imgsrc = $('img.balkon-logo').attr('src');
            var last = imgsrc.lastIndexOf('logo.png');
            if(last != -1){
                $('img.balkon-logo').attr('src', imgsrc.substring(0,last)+'logo_dark.png' );//+ '?' + Math.random());
            }
        }
        if($('img.balkon-sublogo').length){
            var imgsrc = $('img.balkon-sublogo').attr('src');
            var last = imgsrc.lastIndexOf('logo.png');
            if(last != -1){
                $('img.balkon-sublogo').attr('src', imgsrc.substring(0,last)+'logo_dark.png' );//+ '?' + Math.random());
            }
        }
        if($('.demo-footer-logo .widget_media_image img').length){
            var imgsrc = $('.demo-footer-logo .widget_media_image img').attr('src');
            var last = imgsrc.lastIndexOf('logo-300x61.png');
            if(last != -1){
                $('.demo-footer-logo .widget_media_image img').attr('srcset', imgsrc.substring(0,last)+'logo_dark.png' ).attr('src', imgsrc.substring(0,last)+'logo_dark.png' );//+ '?' + Math.random());
            }
        }
    }
    if($('.landing-wrapper').length){
        $('.landing-wrapper .content-wrap').on("scroll",function() {
            $(".demo-list").each(function() {
                var a = $(this);
                var sn = $("body");
                var b = a.position().top - $(window).scrollTop();
                if (b <= 0) {
                    if ($(".demo-list").hasClass("black-bg")) sn.addClass("black-bg"); else sn.removeClass("black-bg");
                } else {
                    sn.removeClass("black-bg");
                }
                
            });
        });
    }
    

});
})(jQuery);
