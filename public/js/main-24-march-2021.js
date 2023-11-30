jQuery.noConflict();
(function($){
    // Add IE class to body
    function isIE() {
      return !!window.navigator.userAgent.match(/MSIE|Trident/);
    }
    if(isIE()){
        $('body').addClass('isIE');
    }
    // Add IE class to body
	$(document).ready(function(){
	    $(".hamburger_menu_nf a").on('click', function(){
	    	var stickyHeight = $('.sticky-div').outerHeight();
	    	$(".nav-overlay-nf").css({'top':stickyHeight});
			$(".nav-overlay-nf").fadeToggle(200, function(){
				
			});
			$(this).toggleClass('btn-open').toggleClass('btn-close');
            if($(this).hasClass('btn-close')) {
                $(this).html('<i class="fa fa-times"></i>');
            }
            if($(this).hasClass('btn-open')) {
                $(this).html('<i class="fas fa-bars"></i>');
            }
		});

	   	header = document.querySelector(".primary-header"); 
	   	stickyElem = document.querySelector(".sticky-div"); 
	   	mega = document.querySelector(".nav-overlay-nf"); 

		/* Gets the amount of height 
		of the element from the 
		viewport and adds the 
		pageYOffset to get the height 
		relative to the page */ 
		
		stickyElemBottom = stickyElem.getBoundingClientRect().bottom;
		stickyElemPos = stickyElem.getBoundingClientRect().bottom + window.pageYOffset; 
		currStickyPos = header.getBoundingClientRect().bottom + window.pageYOffset + 50; 

		window.onscroll = function() { 

			/* Check if the current Y offset 
			is greater than the position of 
			the element */ 
			stickyElemPos2 = stickyElem.getBoundingClientRect().bottom + window.pageYOffset; 
			stickyElemPos3 = stickyElem.getBoundingClientRect().bottom;
			if (window.pageYOffset < currStickyPos && window.pageYOffset > stickyElemBottom) { 
				mega.style.top = '-'+stickyElemPos2+'px';
			} else {
				mega.style.top = stickyElemPos3+'px';
			}

			if (window.pageYOffset > currStickyPos) { 
				stickyElem.classList.add("is-sticky");
				stickyElem.classList.add("shadow-sm");
				mega.classList.add("is-sticky-enabled");
				 
			} else { 
				stickyElem.classList.remove("is-sticky");
				stickyElem.classList.remove("shadow-sm");
				mega.classList.remove("is-sticky-enabled");
			} 
		}

	});


    var SETTINGS = {
        navBarTravelling: false,
        navBarTravelDirection: "",
    	 navBarTravelDistance: 150
    }

    document.documentElement.classList.remove("no-js");
    document.documentElement.classList.add("js");

    // Out advancer buttons
    var pnAdvancerLeft = document.getElementById("pnAdvancerLeft");
    var pnAdvancerRight = document.getElementById("pnAdvancerRight");

    var pnProductNav = document.getElementById("pnProductNav");
    var pnProductNavContents = document.getElementById("pnProductNavContents");

    pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));

    // Handle the scroll of the horizontal container
    var last_known_scroll_position = 0;
    var ticking = false;

    function doSomething(scroll_pos) {
        pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
    }

    pnProductNav.addEventListener("scroll", function() {
        last_known_scroll_position = window.scrollY;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                doSomething(last_known_scroll_position);
                ticking = false;
            });
        }
        ticking = true;
    });


    pnAdvancerLeft.addEventListener("click", function() {
    	// If in the middle of a move return
        if (SETTINGS.navBarTravelling === true) {
            return;
        }
        // If we have content overflowing both sides or on the left
        if (determineOverflow(pnProductNavContents, pnProductNav) === "left" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
            // Find how far this panel has been scrolled
            var availableScrollLeft = pnProductNav.scrollLeft;
            // If the space available is less than two lots of our desired distance, just move the whole amount
            // otherwise, move by the amount in the settings
            if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
                pnProductNavContents.style.transform = "translateX(" + availableScrollLeft + "px)";
            } else {
                pnProductNavContents.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
            }
            // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
            pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
            // Update our settings
            SETTINGS.navBarTravelDirection = "left";
            SETTINGS.navBarTravelling = true;
        }
        // Now update the attribute in the DOM
        pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
    });

    pnAdvancerRight.addEventListener("click", function() {
        // If in the middle of a move return
        if (SETTINGS.navBarTravelling === true) {
            return;
        }
        // If we have content overflowing both sides or on the right
        if (determineOverflow(pnProductNavContents, pnProductNav) === "right" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
            // Get the right edge of the container and content
            var navBarRightEdge = pnProductNavContents.getBoundingClientRect().right;
            var navBarScrollerRightEdge = pnProductNav.getBoundingClientRect().right;
            // Now we know how much space we have available to scroll
            var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
            // If the space available is less than two lots of our desired distance, just move the whole amount
            // otherwise, move by the amount in the settings
            if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
                pnProductNavContents.style.transform = "translateX(-" + availableScrollRight + "px)";
            } else {
                pnProductNavContents.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
            }
            // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
            pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
            // Update our settings
            SETTINGS.navBarTravelDirection = "right";
            SETTINGS.navBarTravelling = true;
        }
        // Now update the attribute in the DOM
        pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
    });

    pnProductNavContents.addEventListener(
        "transitionend",
        function() {
            // get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
            var styleOfTransform = window.getComputedStyle(pnProductNavContents, null);
            var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
            // If there is no transition we want to default to 0 and not null
            var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
            pnProductNavContents.style.transform = "none";
            pnProductNavContents.classList.add("pn-ProductNav_Contents-no-transition");
            // Now lets set the scroll position
            if (SETTINGS.navBarTravelDirection === "left") {
                pnProductNav.scrollLeft = pnProductNav.scrollLeft - amount;
            } else {
                pnProductNav.scrollLeft = pnProductNav.scrollLeft + amount;
            }
            SETTINGS.navBarTravelling = false;
        },
        false
    );

    // Handle setting the currently active link
    pnProductNavContents.addEventListener("click", function(e) {
    	var links = [].slice.call(document.querySelectorAll(".pn-ProductNav_Link"));
    	links.forEach(function(item) {
    		item.setAttribute("aria-selected", "false");
    	})
    	e.target.setAttribute("aria-selected", "true");
    })

    function determineOverflow(content, container) {
        var containerMetrics = container.getBoundingClientRect();
        var containerMetricsRight = Math.floor(containerMetrics.right);
        var containerMetricsLeft = Math.floor(containerMetrics.left);
        var contentMetrics = content.getBoundingClientRect();
        var contentMetricsRight = Math.floor(contentMetrics.right);
        var contentMetricsLeft = Math.floor(contentMetrics.left);
    	 if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
            return "both";
        } else if (contentMetricsLeft < containerMetricsLeft) {
            return "left";
        } else if (contentMetricsRight > containerMetricsRight) {
            return "right";
        } else {
            return "none";
        }
    }

    var $player = $(".video-player"),
        $video = $(".video-player video"),
        $video_iframe = $('.movie-preview iframe');
    var newWidth = $player.width(),
        iframewidth = $('.movie-preview').width();
    $video.width(newWidth).height(newWidth * 0.5625);
    $video_iframe.width(iframewidth).height(iframewidth * 0.5625);
    $('.tracks').height($player.height());
    $(window).resize(function() {
        newWidth = $player.width();
        niframewidth = $('.movie-preview').width();
        $video_iframe.width(niframewidth).height(niframewidth * 0.5625);
        $video.width(newWidth).height(newWidth * 0.5625);
        $('.tracks').height($player.height());
    }).resize();

    var $takeover = $(".takeover"),
        $takeoverarticle = $(".takeover article");

    $.fn.isInViewport = function() {
        var $this = $(this);
        var stickers_width = $this.parent().width();
        var left_of_element = $this.offset().left;
        var right_of_element = left_of_element + $this.width();
        return 0 <= left_of_element && right_of_element <= stickers_width;
    };
    if($('.image-slider').length) {
    var swiper = new Swiper('.image-slider', {
          pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
    }  
    $(document).ready(function(){

        $('.sub-menu').each(function(){
            var sub = $(this);
            var subH = sub.parent().height();
            var subId = sub.data('id');
            var count = 0;
            if($(window).width() < 992){
                $('#'+subId).css({'top':subH+'px'});
                sub.find('li').each( function () {
                    if(!$(this).isInViewport()) {
                        $(this).detach().appendTo('#'+subId);
                        count++;
                    }
                });
                var dots = '<a href="javascript:void(0);" class="toggle-mobile-sub-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                $('#'+subId).css({'top':subH+'px'});
                if(!sub.find('.toggle-mobile-sub-menu').length)
                   { if(count > 0) $(dots).appendTo(sub);}
            }
        });
        if($('.cinema-location-filter').length){
            if($('.cinema-location').length){
               // $('.cinema-location').removeClass('active');;
            }
            var cinema = $('.cinema-location-filter');
            cinema.each(function(){
                if($(this).hasClass('active')){
                    var cinema_active = $(this).data('target');
                    if(cinema_active == 'all'){
                        $('.cinema-location').animate({opacity: 1}, function(){
                           // $('.cinema-location').addClass('active');
                        }).end();
                    } else {
                        $('.'+cinema_active).animate({opacity: 1}, function(){
                            $('.'+cinema_active).addClass('active');
                        }).end();
                    }
                }
            });
            $(document).on('click','.cinema-location-filter', function(){
                $('.cinema-location-filter').removeClass('active');
                $('.cinema-location').animate({opacity: 0}, function(){
                   // $('.cinema-location').removeClass('active');
                }).end();
                $(this).addClass('active');
                var new_cinema_active = $(this).data('target');
                if(new_cinema_active == 'all'){
                    $('.cinema-location').animate({opacity: 1}, function(){
                        $('.cinema-location').addClass('active');
                    }).end();
                } else {
                    $('.'+new_cinema_active).animate({opacity: 1}, function(){
                        $('.'+new_cinema_active).addClass('active');
                    }).end();
                }
            });

        }
        if($('.movie-language-filter').length){
            if($('.movie-language').length){
                $('.movie-language').removeClass('active');
            }
            var movie_language = $('.movie-language-filter');
            movie_language.each(function(){
                if($(this).hasClass('active')){
                    var movie_language_active = $(this).data('target');
                    $('.'+movie_language_active).animate({opacity: 1}, function(){
                        $('.'+movie_language_active).addClass('active');
                    }).end();
                }
            });
            $(document).on('click','.movie-language-filter', function(){
                $('.movie-language-filter').removeClass('active');
                $(this).addClass('active');
                $('.movie-language').animate({opacity: 0}, function(){
                    $('.movie-language').removeClass('active');
                }).end();
                var new_movie_language = $(this).data('target');
                $('.'+new_movie_language).animate({opacity: 1}, function(){
                    $('.'+new_movie_language).addClass('active');
                }).end();
            });

        }
        $(document).on('click','.photo-gallery .image-nav a', function(e){
            e.preventDefault();
            var $this = $(this);
            var $photo_gallery = $('.photo-gallery .image-thumbnail img')
            
            var target_img = $this.data('target-img');
            var target = $this.parent().parent().find('.fps-item-single img');
            if ($photo_gallery.length){
                $photo_gallery.animate({opacity: 0}, function(){
                    $photo_gallery.attr("src",target_img);
                });
                $photo_gallery.animate({opacity: 1}, 300)
            }
        });
            
        if($('.gallery-thumbs').length){
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 20,
                slidesPerView: 4,
                loop: true,
                freeMode: true,
                loopedSlides: 5, //looped slides should be the same
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });
        }
        if($('.gallery-top').length){
            var galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                loopedSlides: 5, //looped slides should be the same
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: galleryThumbs,
                },
            });
        }
         /* var thisSwiper = [], thisThumb = [];
		 $('.photo-slider').each(function(i) {
		   var this_ID_thumb = $(this).find('.gallery-thumbs').attr('id');
		   var this_ID_top = $(this).find('.gallery-top').attr('id');
		   console.log(this_ID_thumb);
		   console.log(this_ID_top);
		    thisThumb[i] = new Swiper('#'+this_ID_thumb, {
	                spaceBetween: 20,
	                slidesPerView: 4,
	                loop: true,
	                freeMode: true,
	                loopedSlides: 5, //looped slides should be the same
	                watchSlidesVisibility: true,
	                watchSlidesProgress: true,
	            });

		   thisSwiper[i] = new Swiper('#'+this_ID_top, {
	                spaceBetween: 20,
	                loop: true,
	                autoplay: {
	                    delay: 2500,
	                    disableOnInteraction: false,
	                },
	                loopedSlides: 5, //looped slides should be the same
	                navigation: {
	                    nextEl: '#'+this_ID_top + ' .swiper-button-next',
	                    prevEl: '#'+this_ID_top + ' .swiper-button-prev',
	                },
	                thumbs: {
	                    swiper: thisThumb[i],
	                },
	            });

		   
		 }); */

        

    });
    
    $(window).resize(function() {
        
        var newWidth = $takeover.width();
        $takeoverarticle.width(newWidth).height(newWidth * 0.75);
        $('.sub-menu').each(function(){
            var sub = $(this);
            var subH = sub.parent().height();
            var subId = sub.data('id');
            var count = 0;
            if($(window).width() < 992){
                $('#'+subId).css({'top':subH+'px'});
                sub.find('li').each( function () {
                    if(!$(this).isInViewport()) {
                        $(this).detach().appendTo('#'+subId);
                        count++;
                    }
                });
                var dots = '<a href="javascript:void(0);" class="toggle-mobile-sub-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                $('#'+subId).css({'top':subH+'px'});
                 if(!sub.find('.toggle-mobile-sub-menu').length)
                   { if(count > 0) $(dots).appendTo(sub);}
            } else {
                $('.toggle-mobile-sub-menu').remove();
                $('#'+subId +' li').each( function () {
                    $(this).detach().appendTo(sub);
                });
            }
        });
    }).resize();

    $(document).on('click', '.toggle-mobile-sub-menu', function() {
        var thistarget = $(this).parent().parent().find('.mobile-sub-menu');
        $(thistarget).fadeToggle(200, function(){});
    });

    function getDocHeight(doc) {
        doc = doc || document;
        var body = doc.body, html = doc.documentElement;
        var height = Math.max( body.scrollHeight, body.offsetHeight, 
            html.clientHeight, html.scrollHeight, html.offsetHeight );
        return height;
    }

    function setIframeHeight(id) {
        var ifrm = document.getElementById(id);
        console.log(ifrm.contentWindow);
        var doc = ifrm.contentWindow.document? ifrm.contentWindow.document: ifrm.contentDocument;

        ifrm.style.visibility = 'hidden';
        ifrm.style.height = "10px"; 
        ifrm.style.height = getDocHeight( doc ) + 4 + "px";
        ifrm.style.visibility = 'visible';
    }
    if($('#ifrm').length){
        document.getElementById('ifrm').onload = function() { 
            setIframeHeight(this.id);
        }
    }


})(jQuery)

/* Sample Soundcloud can be replaced */
var _extends=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(t[o]=n[o])}return t},_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};!function(t,e){"object"===("undefined"==typeof exports?"undefined":_typeof(exports))&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.LazyLoad=e()}(this,function(){"use strict";var n={elements_selector:"img",container:document,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",class_loading:"litespeed-loading",class_loaded:"litespeed-loaded",class_error:"error",load_delay:0,callback_load:null,callback_error:null,callback_set:null,callback_enter:null,callback_finish:null,to_webp:!1},s="data-",r="was-processed",o="ll-timeout",a="true",c=function(t,e){return t.getAttribute(s+e)},i=function(t,e,n){var o=s+e;null!==n?t.setAttribute(o,n):t.removeAttribute(o)},l=function(t){return c(t,r)===a},u=function(t,e){return i(t,o,e)},d=function(t){return c(t,o)},f=function(t,e){var n,o="LazyLoad::Initialized",s=new t(e);try{n=new CustomEvent(o,{detail:{instance:s}})}catch(t){(n=document.createEvent("CustomEvent")).initCustomEvent(o,!1,!1,{instance:s})}window.dispatchEvent(n)};var _=function(t,e){return e?t.replace(/\.(jpe?g|png)/gi,".webp"):t},t="undefined"!=typeof window,v=t&&!("onscroll"in window)||/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),e=t&&"IntersectionObserver"in window,h=t&&"classList"in document.createElement("p"),b=t&&!1,g=function(t,e,n,o){for(var s,r=0;s=t.children[r];r+=1)if("SOURCE"===s.tagName){var a=c(s,n);m(s,e,a,o)}},m=function(t,e,n,o){n&&t.setAttribute(e,_(n,o))},p={IMG:function(t,e){var n=b&&e.to_webp,o=e.data_srcset,s=t.parentNode;s&&"PICTURE"===s.tagName&&g(s,"srcset",o,n);var r=c(t,e.data_sizes);m(t,"sizes",r);var a=c(t,o);m(t,"srcset",a,n);var i=c(t,e.data_src);m(t,"src",i,n)},IFRAME:function(t,e){var n=c(t,e.data_src);m(t,"src",n)},VIDEO:function(t,e){var n=e.data_src,o=c(t,n);g(t,"src",n),m(t,"src",o),t.load()}},y=function(t,e){var n,o,s=e._settings,r=t.tagName,a=p[r];if(a)return a(t,s),e._updateLoadingCount(1),void(e._elements=(n=e._elements,o=t,n.filter(function(t){return t!==o})));!function(t,e){var n=b&&e.to_webp,o=c(t,e.data_src),s=c(t,e.data_bg);if(o){var r=_(o,n);t.style.backgroundImage='url("'+r+'")'}if(s){var a=_(s,n);t.style.backgroundImage=a}}(t,s)},w=function(t,e){h?t.classList.add(e):t.className+=(t.className?" ":"")+e},E=function(t,e){t&&t(e)},L="load",I="loadeddata",O="error",k=function(t,e,n){t.addEventListener(e,n)},A=function(t,e,n){t.removeEventListener(e,n)},C=function(t,e,n){A(t,L,e),A(t,I,e),A(t,O,n)},z=function(t,e,n){var o,s,r=n._settings,a=e?r.class_loaded:r.class_error,i=e?r.callback_load:r.callback_error,c=t.target;o=c,s=r.class_loading,h?o.classList.remove(s):o.className=o.className.replace(new RegExp("(^|\\s+)"+s+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,""),w(c,a),E(i,c),n._updateLoadingCount(-1)},N=function(n,o){var t,e,s,r=function t(e){z(e,!0,o),C(n,t,a)},a=function t(e){z(e,!1,o),C(n,r,t)};s=a,k(t=n,L,e=r),k(t,I,e),k(t,O,s)},x=["IMG","IFRAME","VIDEO"],M=function(t,e,n){R(t,n),e.unobserve(t)},S=function(t){var e=d(t);e&&(clearTimeout(e),u(t,null))};function R(t,e,n){var o=e._settings;!n&&l(t)||(E(o.callback_enter,t),-1<x.indexOf(t.tagName)&&(N(t,e),w(t,o.class_loading)),y(t,e),i(t,r,a),E(o.callback_set,t))}var j=function(t){return t.isIntersecting||0<t.intersectionRatio},T=function(t,e){this._settings=_extends({},n,t),this._setObserver(),this._loadingCount=0,this.update(e)};return T.prototype={_manageIntersection:function(t){var e,n,o,s,r,a=this._observer,i=this._settings.load_delay,c=t.target;i?j(t)?(e=c,n=a,s=(o=this)._settings.load_delay,(r=d(e))||(r=setTimeout(function(){M(e,n,o),S(e)},s),u(e,r))):S(c):j(t)&&M(c,a,this)},_onIntersection:function(t){t.forEach(this._manageIntersection.bind(this))},_setObserver:function(){var t;e&&(this._observer=new IntersectionObserver(this._onIntersection.bind(this),{root:(t=this._settings).container===document?null:t.container,rootMargin:t.thresholds||t.threshold+"px"}))},_updateLoadingCount:function(t){this._loadingCount+=t,0===this._elements.length&&0===this._loadingCount&&E(this._settings.callback_finish)},update:function(t){var e=this,n=this._settings,o=t||n.container.querySelectorAll(n.elements_selector);this._elements=Array.prototype.slice.call(o).filter(function(t){return!l(t)}),!v&&this._observer?this._elements.forEach(function(t){e._observer.observe(t)}):this.loadAll()},destroy:function(){var e=this;this._observer&&(this._elements.forEach(function(t){e._observer.unobserve(t)}),this._observer=null),this._elements=null,this._settings=null},load:function(t,e){R(t,this,e)},loadAll:function(){var e=this;this._elements.forEach(function(t){e.load(t)})}},t&&function(t,e){if(e)if(e.length)for(var n,o=0;n=e[o];o+=1)f(t,n);else f(t,e)}(T,window.lazyLoadOptions),T}),function(e,t){"use strict";function n(){t.body.classList.add("litespeed_lazyloaded")}function a(){d=new LazyLoad({elements_selector:"[data-lazyloaded]",callback_finish:n}),o=function(){d.update()},e.MutationObserver&&new MutationObserver(o).observe(t.documentElement,{childList:!0,subtree:!0,attributes:!0})}var d,o;e.addEventListener?e.addEventListener("load",a,!1):e.attachEvent("onload",a)}(window,document);

