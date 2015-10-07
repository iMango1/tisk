(function($) { 

	"use strict";
	
	/* ================ Dynamic content height. ================ */
	var winH = $(window).height(),
		headH = $('#headWrapper').outerHeight(),
		footH = $('#footWrapper').outerHeight(),
		H = winH -(headH + footH);
	$('#contentWrapper').css('min-height',H);
	$(".loader-in").append('<div class="status"><span class="spin"></span><span></span></div>');
	
	/* ================ Check for Mobile. ================ */
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 	$('html').addClass('touch');
	}else{
		$('html').addClass('no-touch');
	}
	
	/* ================ Show Login box. ================ */
	$('.login-btn').prepend('<b class="tri hidden"></b>');
	$('.login-btn').click(function(e){
		e.preventDefault();
		$('.login-box').slideToggle();
		$('.login-btn').find('.tri').toggleClass('visible');
		$('.close-login').click(function(e){
			e.preventDefault();
			$('.login-box').slideUp();
			$('.login-btn').find('.tri').removeClass('visible');
		});
	});

	/* ================ Top navigation menu. ================ */
	if($('.top-head').length){
		var menu = $('.top-nav > ul'),
			menuW = menu.width(),
			items = menu.find('li'),
			sel = menu.find('li.selected').index(),
			ulW,winW,menOff,m,totalOff;
		items.each(function(){
			var ul = $(this).find('ul:first');
			ul.css('max-width',menuW);
			if($(this).hasClass('selected')){
				$(this).addClass('current');
			}
			if (ul.length){
				$(this).addClass('hasChildren');
				if($('#mnu-eft').hasClass('effect-1')){
					var delay = 0;
					$(this).find('> ul > li').each(function(){
						$(this).css({transitionDelay: delay+'ms'});
						delay += 50;
					});
				}
				$(this).hover(function(){
					$(this).addClass('selected');
				},function(){
					$(this).removeClass('selected');
				});
				if ($(this).find('ul li ul').length){
					var thisUL = $(this).find('ul ul');
						ulW = thisUL.outerWidth(),
						winW = $(window).width(),
						menOff= thisUL.offset(),
						m = menOff.left,
						totalOff = winW - m;
					if (totalOff < ulW){
						thisUL.css({left:'auto',right:'100%'});
					}
				}
			}
		});
		
		/****** menu effects ***********/
		$('.effect-2 .top-nav ul > li').each(function(){
			$(this).hover(function(){
				$(this).find('> ul').stop(true, true).slideDown(200);
			},function(){
				$(this).find('> ul').stop(true, true).slideUp(200);
			});
		});
		
		$('.effect-3 .top-nav ul > li').each(function(){
			$(this).hover(function(){
				$(this).find('> ul').stop(true, true).fadeIn(500);
			},function(){
				$(this).find('> ul').stop(true, true).fadeOut(500);
			});
		});
		
		var mnu_eft = $('#mnu-eft').not('.effect-1,.effect-2,.effect-3').attr('class');
		$('.'+mnu_eft).find('.top-nav > ul li').each(function(){
			mnu_eft = mnu_eft.replace('effect-', '');
			$(this).hover(function(){
				$(this).find('> ul').stop(true, true).show(0).addClass('animated '+mnu_eft);
			},function(){
				$(this).find('> ul').stop(true, true).hide(0).removeClass('animated '+mnu_eft);
			});
		});
		
		$('.top-nav > ul li.megamenu').find('li').hover(function(){
			$(this).find('> ul').stop(true, true).hide(0).removeClass('animated '+mnu_eft);
		});
		$('.megamenu').parent('ul').addClass('mega-menu');
		$('.megamenu').find('> ul').wrap('<div class="div-mega main-bg"></div>');
		$('.megamenu [class*="col-md-"]').find(' > a').wrap('<h4 class="noLink"/>');
		var mainW = $('.container').width(),
			lft = $('.top-head .container').offset().left + 15;
		$('.top-nav > ul > li').each(function(){
			var itemOff = $(this).offset().left /2,
				thisOff = $(this).offset().left,
				newOff = thisOff - lft,
				thisW	=  $(this).outerWidth(),
				offT	= itemOff - mainW
			$(this).find('.div-mega').css({width:mainW+'px',padding:'25px 10px'});
		});
		$('.megamenu').hover(function(){
			$(this).find('.div-mega').stop(true, true).fadeIn(400).addClass('animated '+mnu_eft);
		},function(){
			$(this).find('.div-mega').stop(true, true).delay(100).fadeOut(400).removeClass('animated '+mnu_eft);
		});
		
		/* ================ Sticky nav. ================ */
		if($('.top-head').attr('data-sticky') == "true"){
			$(window).on("scroll",function(){
				var Scrl = $(window).scrollTop();
				if (Scrl > 1) {
					$('.top-head').addClass('stickyHeader');
				}else{
					$('.top-head').removeClass('stickyHeader');
				}
			});
			$('document').ready(function(){
				var Scrl = $(window).scrollTop();
				if (Scrl > 1) {
					$('.top-head').addClass('stickyHeader');
				}else{
					$('.top-head').removeClass('stickyHeader');
				}
			});
		}
		
		/************ head 7 bottom head menu *************/
		$('.head-7 .top-nav > ul > li').each(function(){
			var $ul = $(this).find(' > ul.sub-menu'),
				els = $ul.find(' > li'),
				eln = els.length,
				elh= parseInt(els.css('line-height'))+1,
				all = eln * elh,
				fin = all+3;
				
			$(this).hover(function(){
				$ul.css('top',-fin+'px');
				$ul.stop(true, true).show(0).addClass('animated fadeInDown');
			},function(){
				$ul.stop(true, true).hide(0).removeClass('animated fadeInDown');
			});
			$(this).find('li.hasChildren').each(function(){
				var $ull = $(this).find('> ul'),
					elss = $ull.find(' > li'),
					elnn = elss.length,
					elhh= parseInt(elss.css('line-height'))+1,
					alll = elnn * elhh,
					finn = alll+3;
				//$ull.css('bottom',finn+'px');
				$(this).hover(function(){
					$ull.stop(true, true).fadeIn(600);
				},function(){
					$ull.stop(true, true).fadeOut(600);
				});
			});
			 
		});
		
		/* ================ Responsive Navigation menu ============ */
		
		if($('.top-menu .top-nav > ul').length){
			if (!$('body').hasClass('one-page')){
				var men = $('.top-menu .top-nav > ul').html();	
				$('<a href="#" class="menuBtn"><i class="fa fa-bars"></i></a><div class="responsive-nav"></div>').prependTo('body');
				$('.responsive-nav').html('<h3>Menu</h3><ul>'+men+'</ul>');
				if($('html').css('direction') == 'rtl'){
					$('.responsive-nav h3').text('');
				}
				$('.menuBtn').click(function(e){
					e.preventDefault();
					$('.responsive-nav').toggleClass('res-act');
					$('.menuBtn').toggleClass('menuBtn-selected');
					$('.pageWrapper').click(function(){
						$(this).removeClass('colBody');
						$('.responsive-nav').removeClass('res-act');
						$('.menuBtn').removeClass('menuBtn-selected');
					});
				});
			}else{
				var men = $('.top-nav > ul').html();	
				$('<a href="#" class="menuBtn"><i class="fa fa-bars"></i></a><div class="responsive-nav"></div>').prependTo('body');
				$('.responsive-nav').html('<h3>Menu Navigation</h3><ul>'+men+'</ul>');
				if($('html').css('direction') == 'rtl'){
					$('.responsive-nav h3').text('');
				}
				$('.menuBtn').click(function(e){
					e.preventDefault();
					$('.responsive-nav').toggleClass('res-act');
					$('.menuBtn').toggleClass('menuBtn-selected');
					$('.pageWrapper').click(function(){
						$(this).removeClass('colBody');
						$('.responsive-nav').removeClass('res-act');
						$('.menuBtn').removeClass('menuBtn-selected');
					});
				});
				$('.responsive-nav ul').onePageNav();
			}
			
			var men = $('.responsive-nav ul'),
				menItems = men.find('li');
			menItems.each(function(){
				var uls = $(this).find('> ul'),
					divs = $(this).find('.div-mega');
				if (uls.length){
					$(this).prepend('<span class="collaps"></span>');
					$(this).find('> span.collaps').click(function(){
						//$('.responsive-nav ul ul').slideUp();
						uls.slideToggle(500);
						//$('.responsive-nav > ul > li').removeClass('selected');
						$(this).parent().toggleClass('current');
					});
				}
				if (divs.length){
					$(this).prepend('<span class="collaps"></span>');
					$(this).find('> span.collaps').click(function(){
						divs.slideToggle(500);
						//$('.responsive-nav .div-mega').removeClass('selected');
						$(this).parent().toggleClass('current');
					});
				}
			});
		}
	
		/* ================ Show Hide Search box. ================ */
		$('.top-search a,.srch-top-btn').click(function(){
			if($(this).parent().find('.search-box').is(':visible')){
				$(this).parent().find('.search-box').fadeOut(300);
				$(this).parent().removeClass('selected');
				return false;
			}else{
				$(this).parent().find('.search-box').fadeIn(300);
				$(this).parent().addClass('selected');
				return false;
			}
		});
		$(document).mouseup(function(e){
			if($('.search-box').is(':visible')){
				var targ = $(".search-box");
				if (!targ.is(e.target) && targ.has(e.target).length === 0){
				$('.search-box').fadeOut(300);
				$('.top-search').removeClass('selected');
				}
			}
		});
	}
	/* ================ Back to top button. ================ */
	var winScroll = $(window).scrollTop();
	if (winScroll > 1) {
		$('#to-top').css({bottom:"10px"});
	} else {
		$('#to-top').css({bottom:"-100px"});
	}
	$(window).on("scroll",function(){
		winScroll = $(window).scrollTop();
		
		// PARALLAX background Animation.
		var y = parseInt($('.parallax').css('background-position-y'));
		var newY = -(winScroll * 0.2) + 'px';
		$('.parallax').css("background-position-y",newY);
		
		//  Show Hide back to top button.
		if (winScroll > 1) {
			$('#to-top').css({opacity:1,bottom:"10px"});
		} else {
			$('#to-top').css({opacity:0,bottom:"-100px"});
		}
	});
	$('#to-top,.to-tp').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});
	
	$('.timeline_no_bar .timeline-cell:nth-child(even)').removeAttr('data-animate').attr('data-animate','fadeInRight');
	$('.plan-block .vc_custom_heading').each(function(){
		$(this).nextUntil('.vc_custom_heading').andSelf().wrapAll('<div class="block fx" data-animate="fadeInLeft" />');
		$('.rit-plan .block').removeAttr('data-animate').attr('data-animate','fadeInRight');
	});
		
	/* ================ Waypoints: on scroll down animations. ================ */
	
	$('.touch .fx').addClass('animated');
	
	$('.no-touch .portfolio-items > div:odd').each(function() {
		$(this).addClass('fx').attr('data-animate','fadeInUp');
	});
	$('.no-touch .portfolio-items > div:even').each(function() {
		$(this).addClass('fx').attr('data-animate','fadeInDown');
	});
	$('.no-touch .fx').waypoint(function() {
		var anim = $(this).attr('data-animate'),
			del = $(this).attr('data-animation-delay'),
			dur = $(this).attr('data-animation-duration');
		    $(this).addClass('animated '+anim).css({animationDelay: del + 'ms',animationDuration: dur + 'ms'});
	},{offset: '90%',triggerOnce: true});
	
	/* ================ PORTFOLIO boxes Hover effect. ================ */
	$('.slick-slide,.portfolio-items > div,.essential_grid.portfolio-item').each(function(){
		var $this = $(this),
			$index = $this.index(),
			contents = $this.find('.img-over');
		$this.hover(function(){
			contents.fadeIn(400).find('.link').removeClass('animated fadeOutUp').addClass('animated fadeInDown');
			contents.find('.zoom').removeClass('animated fadeOutDown').addClass('animated fadeInUp');
			return false;
		},function(){
			contents.fadeOut(400).find('.link').removeClass('animated fadeInDown').addClass('animated fadeOutUp');
			contents.find('.zoom').removeClass('animated fadeInUp').addClass('animated fadeOutDown');
			return false;
		});
	});	
	
	// make height equals parent height.
	var planH = $('.our-plan').height();
	$('.plan-title').css('height',planH);
	
	$('.icon-box').each(function(){
		$(this).hover(function(e) {
		    $(this).find('[class*=hvr-]').trigger('hover');
		})
	});
	
	/* ================= Grid - List view =============== */
	$('.list-btn').click(function() {
		$('.grid-list').addClass('list');
		$('.grid-btn').removeClass('selected');
		$(this).addClass('selected');
		return false;
	});
	$('.grid-btn').click(function() {
		$('.grid-list').removeClass('list');
		$('.list-btn').removeClass('selected');
		$(this).addClass('selected');
		return false;
	});
	
	/* ================ Social share blog buttons plugin. ================ */
	if($('#shareme').length > 0){
		$('#shareme').sharrre({
		  share: {
		    twitter: true,
		    facebook: true,
		    googlePlus: true
		  },
		  template: '<ul><li><a href="#" class="facebook main-bg"><i class="fa fa-facebook"></i></a></li><li><a href="#" class="twitter main-bg"><i class="fa fa-twitter"></i></a></li><li><a href="#" class="googleplus main-bg"><i class="fa fa-google-plus"></i></a></li><li><a class="alter-bg">{total}</a></li></ul>',
		  enableHover: false,
		  enableTracking: true,
		  url: document.location.href,
		  render: function(api, options){
		  $(api.element).on('click', '.twitter', function() {
		    api.openPopup('twitter');
		  });
		  $(api.element).on('click', '.facebook', function() {
		    api.openPopup('facebook');
		  });
		  $(api.element).on('click', '.googleplus', function() {
		    api.openPopup('googlePlus');
		  });
		  $('.sharrre li a.alter-bg').wrapInner('<b></b>');
		}
		});
	}
	
	/* ============== WP scripts ============================ */
	$('.widget_calendar').find('table').addClass('table-style2').find('th').addClass('main-bg');
	$('span.rss-date').prepend('<i class="fa fa-clock-o"></i>');
	$('.widget_rss').find('cite').prepend('<i class="fa fa-user"></i>');
	$('#wp-calendar').find('a').each(function(){
		var tp = $(this).attr('title');
		$(this).attr('data-title',tp).attr('data-tooltip','true').removeAttr('title');
	});
	$('.form-submit').find('input').addClass('btn btn-large main-bg');
	$('.wpcf7-submit,.gform_button').addClass('btn btn-large main-bg');
	$('.form-allowed-tags').addClass('box-info');
	
	// Woocommerce styling
	$('.stock.in-stock').addClass('product-block item-avl list-item').wrapInner('<span></span>').prepend('<div class="success-box left"><i class="fa fa-check"></i></div>');
	$('.stock.out-of-stock').addClass('product-block item-avl list-item').wrapInner('<span></span>').prepend('<div class="error-box left"><i class="fa fa-times"></i></div>');
	$('.woc-tabs').find('ul.t-tabs').find('li').eq(0).addClass('active');
	$('.woc-tabs').find('.tab-panel').eq(0).addClass('active');
	
	$('.footer-top .col-md-6:nth-child(2n)').after('<div class="footer-sep"><div class="clearfix"></div><hr class="hr-style5"><div class="clearfix"></div></div>');
	$('.footer-top .col-md-12').after('<div class="footer-sep"><div class="clearfix"></div><hr class="hr-style5"><div class="clearfix"></div></div>');
	$('.footer-top .col-md-4:nth-child(3n)').after('<div class="footer-sep"><div class="clearfix"></div><hr class="hr-style5"><div class="clearfix"></div></div>');
	$('.footer-top .col-md-3:nth-child(4n)').after('<div class="footer-sep"><div class="clearfix"></div><hr class="hr-style5"><div class="clearfix"></div></div>');
	$('.footer-sep:last-child').remove();
	
	if(!$('.page-icon').hasClass('selectedI'))$('.page-icon').remove();
	$('.pager-bbp').children().wrapAll('<ul class="page-numbers"></ul>').wrap('<li></li>');
	$('.pager-bbp').find('.next.page-numbers').html('<i class="fa fa-angle-right"></i>');
	$('.pager-bbp').find('.prev.page-numbers').html('<i class="fa fa-angle-left"></i>');
	$('.wpb_toggle').wrapInner('<a class=""><span class=""></span></a>');
	$('.wpb_toggle').find('a').prepend('<u></u>');
	$('.esg-filter-wrapper').addClass('gry-bg skew-25').find('.esg-filterbutton span').addClass('skew25');
	$('.esg-filter-wrapper').wrap('<div class="container"></div>').children().wrapAll('<div class="filtersTBL"></div>');
	$('.post-password-form input[type="submit"]').addClass('btn main-bg');
	
	$('.edd_downloads_list div.navigation').addClass('pager-style4 centered').wrapInner('<div><ul class="page-numbers"></ul></div>').find('a,span').wrap('<li></li>');
	
	$('.footer-bottom ul.social-list li').addClass('skew-25').find('a').attr('data-position','top').find('span').wrap('<span class="no-pad skew25"></span>');
	$('.top-bar ul.social-list li').find('a').attr('data-position','bottom');
	$('.head-style2 .top-nav > ul > li,.head-style2 .top-search').find('> a').addClass('skew-25').find('span').addClass('skew25');
	$('.pager').find('a,span').addClass('skew25');
	$('.pager-style3 .page-numbers.current').parent().addClass('main-bg-import');
	$('.page-numbers .page-numbers.current').parent().addClass('main-bg-import');	
	
	$('.grid .col-md-6:nth-child(2n),.grid .col-md-4:nth-child(3n),.grid .col-md-3:nth-child(4n)').after('<div class="clearfix"></div>');

	$('.contact-offices').find('.col-md-2:odd').remove();	
	$('.contact-offices .col-md-5:odd').after('<div class="clearfix"></div>');
	
	var divs = $('.grid-list').find('.product-category.product');
	for(var i=0; i<divs.length;){
	i += divs.eq(i).nextUntil(':not(.product-category.product)').andSelf().wrapAll('<div class="products_cat" />').length;
	}
	
	// Comments styling and Empty Comment validation
	$('.comment-reply-link').addClass('main-bg').prepend('<i class="fa fa-comment"></i>');
	$('.comment-reply-link').wrapInner('<span class="skew25"></span>');
	$('.comment-reply-title').addClass('block-head');
	$('.comment-form-author,.comment-form-email').addClass('col-md-6').wrapAll('<div class="row"></div>');
	$('.comment-form-comment,.form-submit,.comment-form-url,.comment-notes').addClass('col-md-12').find('textarea').addClass('txt-box textArea');
	$('.comment-form-url,.comment-form-comment,.comment-notes,.form-submit').wrapInner('<div class="row"></div>');
	var req = $('*[aria-required="true"]');
	req.parent().prepend('<i class="fa fa-info comment-validate" style="display:none"></i>');
	$('.comment-form').submit(function(e){
		var em = $(this).find('#email').val();
		if($('#author').length && $('#author').val() == ''){
			$('#author').addClass('error');
			$('#author').parent().find('.comment-validate').show().delay(3000).fadeOut();
			e.preventDefault();
			return false;
		}else if($('#email').length && ($('#email').val() == '' || !isValidEmailAddress( em ))){
			$('#email').addClass('error');
			$('#email').parent().find('.comment-validate').show().delay(3000).fadeOut();
			e.preventDefault();
			return false;
		}else if($('#comment').length && $('#comment').val() == ''){
			$('#comment').addClass('error');
			$('#comment').parent().find('.comment-validate').show().delay(3000).fadeOut();
			e.preventDefault();
			return false;
		}else{
			$('#author,#email,#comment').removeClass('error');
		}
		
		
	});
	req.change(function(){
		$(this).removeClass('error');
	});
	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};
	
	// Colorize the right progress bar triangle.
	function appendStyle(styles) {
		var css = document.createElement('style');
		css.type = 'text/css';
		if (css.styleSheet) css.styleSheet.cssText = styles;
		else css.appendChild(document.createTextNode(styles));
		document.getElementsByTagName("head")[0].appendChild(css);
	}

	$('.icon-box-6 .box-top h3').html(function (i, html) {
		return html.replace(/(\w+\s)/, '<span class="test">$1</span><br>');
	});
	
	if ($('nav.pager').length > 0){
		$('nav.pager a.page-numbers,span.page-numbers').addClass('skew25');
		$('nav.pager span.page-numbers.current').parent().addClass('selected');
	}
	/* ================= increase decrease items textbox =============== */
	
	$('.product-quantity,.cart').each(function(){
		var num = $(this).find('.items-num').val();
		$(this).find('.add-items i.fa-plus').click(function(e){
			e.preventDefault();
			num ++;
			$(this).parent().parent().parent().find('.items-num').attr('value',num);
		});
		$(this).find('.add-items i.fa-minus').click(function(e){
			e.preventDefault();
			if (num > 1){
				num --;
				$(this).parent().parent().parent().find('.items-num').attr('value',num);
			}
		});
	});
	
	/* ================ Tooltips. ================ */
	$.fn.tooltip = function() {
		$(this).hover(function(){
			var thisTitle = $(this).attr('data-title'),
				pos = $(this).attr('data-position'),
				tp = $(this).offset().top - $(window).scrollTop(),
				l = $(this).offset().left - $(window).scrollLeft();
				
			$('body').append('<div class="tooltip">'+thisTitle+'</div>');
			var tipH = $('.tooltip').outerHeight()+5,
				tipW = $('.tooltip').outerWidth()+5,
				bot = $(window).height() - (tp + $(this).outerHeight() + tipH),
				r = $(window).width()-(l + $(this).outerWidth() + tipW);
			if(pos == "right"){
				$('.tooltip').addClass('rit-tip animated fadeInRight').css({'top':tp-(($(this).outerHeight()/2)-(tipH-5/2))+"px",'right':r+"px"});
			}else if(pos == "bottom"){
				$('.tooltip').addClass('bot-tip animated fadeInUp').css({'bottom':bot + "px",'left':l+(($(this).outerWidth()/2)-((tipW-5)/2)) + "px"});
			}else if(pos == "left"){
				$('.tooltip').addClass('lft-tip animated fadeInLeft').css({'top':tp-(($(this).outerHeight()/2)-(tipH-5/2)) + "px",'left':l-tipW + "px"});
			}else{
				$('.tooltip').addClass('animated fadeInDown').css({'top':tp-tipH + "px",'left':l+(($(this).outerWidth()/2)-((tipW-5)/2)) + "px"});
			}
		},function(){
			$('.tooltip').remove();
		});
	}

	$("[data-tooltip^='true']").tooltip();
	$('input, textarea').placeholder();
	
	if($('.Newsslider').length > 0){
		$('.Newsslider').slick({
		    dots: false,
		    infinite: true,
		    speed: 300,
		    slidesToShow: 1,
		    touchMove: false,
		    slidesToScroll: 1,
		    autoplay: true,
		    pauseOnHover : true
		});
	}	
	
	/* ================ fullscreen sticky nav. ================ */
	if($('#wrap').length > 0){
		$(window).scroll(function(){
			var scrollHeight = $(document).scrollTop(),
				tp = $('#headWrapper').offset();
			if($(this).scrollTop() > tp.top ){
				$('.top-head').addClass('stickyHeader');
			}else{
				$('.top-head').removeClass('stickyHeader');
			}
		});
	}
	
	/* ================= Product images zoom =============== */
	if($("#img_01").length){
		var orgImg = $("#img_01").attr('src');
		var ext = orgImg.substr( (orgImg.lastIndexOf('.')) );
		if ($('.thumbs ul li').length){
			var thum = $('.thumbs ul li:first').find('img').attr('src');
			var thumext = thum.substr( (thum.lastIndexOf('-')) );
			var thumext2 = thumext.substr(0, thumext.indexOf('.'));
			var newImg = orgImg.replace(ext,thumext2+ext);
			$('.thumbs ul').prepend('<li><a href="#" class="active" data-image="'+orgImg+'"><img src="'+newImg+'" /></a></li>');
		}
		$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', responsive:true, loadingIcon: ''});
	}

	
	/* ================= Product images zoom =============== */
	if($("#img_pro").length){
		$("#img_pro").elevateZoom({gallery:'gal-pro', cursor: 'pointer', galleryActiveClass: 'active', responsive:true, loadingIcon: ''});
	}
	
	/* ================ PORTFOLIO boxes Hover effect. ================ */
	$('.slick-slide').each(function(){
		var $this = $(this),
			$index = $this.index(),
			contents = $this.find('.img-over');
		$this.hover(function(){
			contents.fadeIn(400).find('.link').removeClass('animated fadeOutUp').addClass('animated fadeInDown');
			contents.find('.zoom').removeClass('animated fadeOutDown').addClass('animated fadeInUp');
			return false;
		},function(){
			contents.fadeOut(400).find('.link').removeClass('animated fadeInDown').addClass('animated fadeOutUp');
			contents.find('.zoom').removeClass('animated fadeInUp').addClass('animated fadeOutDown');
			return false;
		});
	});

	
	/* ================= Testimonials Carousel =============== */
	if($('.testo_slider').length > 0){
		$('.testo_slider').each(function(){
			var slides_n = parseInt($(this).attr('data-slidesnum'),10),
				sscrol = parseInt($(this).attr('data-scamount'),10),
				speed_n = $(this).attr('data-tspeed'),
				t_fade = $(this).attr('data-tfade'),
				t_arr = $(this).attr('data-tarrows'),
				t_dots = $(this).attr('data-tdots'),
				t_infinite = $(this).attr('data-tinfinite'),
				t_auto = $(this).attr('data-tauto'),
				fd = false,
				tdots = true,
				tinfinite = false,
				aut = false,
				arr = true;

			if(t_fade == '1'){
				fd = true;
			}
			if(t_arr == '1'){
				arr = false;
			}
			if(t_dots == '1'){
				tdots = false;
			}
			if(t_infinite == '1'){
				tinfinite = true;
			}
			if(t_auto == '1'){
				aut = true;
			}

			if($(this).hasClass('testimonials-2')){
				$(this).slick({
					slidesToShow: slides_n,
					slidesToScroll: sscrol,
					dots: tdots,
					infinite: tinfinite,
					speed: speed_n,
					fade: fd,
					autoplay: aut,
					arrows: arr,
					responsive: [
				    {
				      breakpoint: 1024,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 640,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				  ]
				});
			}else{
				$(this).slick({
					slidesToShow: slides_n,
					slidesToScroll: sscrol,
					dots: tdots,
					infinite: tinfinite,
					speed: speed_n,
					fade: fd,
					autoplay: aut,
					arrows: arr,
					responsive: [
				    {
				      breakpoint: 1024,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 640,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				  ]
				});
			}
			
		});
	}
	
	if($('.portfolioGallery').length > 0){
		$('.portfolioGallery').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 4,
			touchMove: true,
			slidesToScroll: 1,
			responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 640,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  ]
		});
	}
	
	
	/* ================= Testimonials Carousel =============== */
	if($('.clients').length > 0){
		$('.clients').each(function(){
			var slides_n = parseInt($(this).attr('data-slidesnum'),10),
				sscrol = parseInt($(this).attr('data-scamount'),10),
				speed_n = $(this).attr('data-tspeed'),
				t_fade = $(this).attr('data-tfade'),
				t_arr = $(this).attr('data-tarrows'),
				t_dots = $(this).attr('data-tdots'),
				t_infinite = $(this).attr('data-tinfinite'),
				t_auto = $(this).attr('data-tauto'),
				fd = false,
				tdots = true,
				tinfinite = false,
				aut = false,
				arr = true;

			if(t_fade == '1'){
				fd = true;
			}
			if(t_arr == '1'){
				arr = false;
			}
			if(t_dots == '1'){
				tdots = false;
			}
			if(t_infinite == '1'){
				tinfinite = true;
			}
			if(t_auto == '1'){
				aut = true;
			}

			$(this).slick({
				slidesToShow: slides_n,
				slidesToScroll: sscrol,
				dots: tdots,
				infinite: tinfinite,
				speed: speed_n,
				fade: fd,
				autoplay: aut,
				arrows: arr,
				responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 640,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			  ]
			});
			
		});
	}
		
	if($('.portfolio-img-slick').length > 0){
		$('.portfolio-img-slick').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			touchMove: false,
			slidesToScroll: 1,
			autoplay:true
		});
	}
	
	/* ================ one page functions. ================ */
	$(".scroll").not('.to-bottom a.scroll').click(function(e) {
		e.preventDefault();
		$("html, body").animate({scrollTop: $($(this).attr("href")).offset().top - 100 + "px"}, {duration: 800});
		return false;
	});
	
	$(".to-bottom a.scroll").click(function(e) {
		e.preventDefault();
		$("html, body").animate({scrollTop: $($(this).attr("href")).offset().top + "px"}, {duration: 800});
		return false;
	});

	if($('.one-pg').length){
		if($('.top-nav > ul').length){
			$('.top-nav > ul').onePageNav();
		}
	}

	$('.no-touch .fun-staff').waypoint(function() {
	    $(this).find('.fun-number').each(function(){
			var thisNo = $(this).text();
			$(this).animateNumber({number: thisNo},4000);
		});
	},{offset: '90%',triggerOnce: true});

	
	/* ================= top shopping cart box =============== */
	$('.cart-heading').click(function(){
		$(this).parent().find('.cart-popup').show();
		$(this).addClass('selected');
	});
	$('.cart-icon').mouseleave(function(){
		$(this).find('.cart-popup').hide();
		$(this).find('.cart-heading').removeClass('selected');
	});
	
	$('.add-new').click(function(e){
		e.preventDefault();
		$('.show-toggle').slideToggle(500);
	});
	
	$('.bbp-topic-reply-link').each(function(){
		$(this).click(function(){
			$('.show-toggle').show();
		});
	});
	
	if ($('.tabs').length > 0){
		$('.tabs > ul a:first').tab('show');
		//$('.tabs > ul > a').tab('show');
	}
	
	
	$('.it-has-gallery .item-img').each(function(){
		$(this).find('img').wrapAll('<div class="inner_flip"></div>');
		
		if ($(this).find('.alt-image').length){
			$(this).hover( function() {
				$( this ).find('.inner_flip').addClass('flipped');
			}, function() {
				$( this ).find('.inner_flip').removeClass('flipped');
			});
		}
	});
	
	if($('.masonry').length){
		docReady( function() {
		  var container = document.querySelector('.masonry');
		  var msnry = new Masonry( container, {
		  });
		});
	}	
	
	$('.counter').waypoint(function() {		
		$('.counter').each(function(index){
		    var the = $(this).find('.odometer'),
		    	timerss = the.attr('data-timer');
		    var timeout = setTimeout(function(){
				var initVal = the.attr('data-initial'),
					currVal = the.attr('data-value');
			    the.html(currVal);
		    },timerss);
		});
	},{offset: '90%',triggerOnce: true});
	
			
	/* ================= Window.load functions =============== */	
	$(window).load(function() {			
		
		//$('#tabs .nav-tabs li').eq(0).addClass('active');
		
		$('.bar-style-3 .vc_single_bar .vc_bar').each(function(){
			var ths = $(this);
			var co_bg = ths.css('background-color');
			var rgb = co_bg.replace(/^rgb?\(|\s+|\)$/g,'');
			var newC = rgb.replace(/,/g, '');
			ths.addClass('it_'+newC);
			var styles = '.it_'+newC+'::before{border-color:transparent transparent transparent '+ co_bg +' !important }';
			appendStyle(styles);
		});
		
		/* ================= prettyPhoto scripts =============== */
		$('a.zoom').prettyPhoto({social_tools: false});
		$('a[data-gal^="prettyPhoto"]').prettyPhoto({social_tools: false});
		
		/* ================= latest tweets script =============== */
		var _html = $(".widget_it_widget_tweets").find('iframe').contents().find("body").html();
		$('.widget_it_widget_tweets .tweet').append(_html).find('.timeline-header,.new-tweets-bar,.timeline-footer,.u-url.permalink.customisable-highlight,.retweet-credit,.inline-media,.footer.customisable-border').remove();
		$(".widget_it_widget_tweets .tweet").find('iframe,.timeline-header,.new-tweets-bar,.timeline-footer,.u-url.permalink.customisable-highlight,.retweet-credit,.inline-media,.footer.customisable-border').remove().remove();
		$(".root.timeline .h-feed").slick({
			dots: false,
			infinite: true,
			arrows:false,
			speed: 300,
			slide: 'li',
			autoplay:true,
			slidesToShow: 1,
			touchMove: true,
			vertical:true,
			slidesToScroll: 1
		});
		
		/* ================= full screen slider with ticker =============== */
		if($('#vertical-ticker').length > 0){
			$('#vertical-ticker').totemticker({
				row_height	:	'110px',
				mousestop	:	true,
				speed:500
			});
		}
	});
	
	
	$('.timeline_no_bar').find('.row.timeline-left').removeClass('timeline-left');
	$('.col-md-9.rit').find('.row.timeline-left').removeClass('timeline-left').addClass('timeline-right');
	

/*global jQuery */
/*!
* Lettering.JS 0.7.0
*
* Copyright 2010, Dave Rupert http://daverupert.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Thanks to Paul Irish - http://paulirish.com - for the feedback.
*
* Date: Mon Sep 20 17:14:00 2010 -0600
*/

	function injector(t, splitter, klass, after) {
		var text = t.text()
		, a = text.split(splitter)
		, inject = '';
		if (a.length) {
			$(a).each(function(i, item) {
				inject += '<span class="'+klass+(i+1)+'" aria-hidden="true">'+item+'</span>'+after;
			});
			t.attr('aria-label',text)
			.empty()
			.append(inject)

		}
	}


	var methods = {
		init : function() {

			return this.each(function() {
				injector($(this), '', 'char', '');
			});

		},

		words : function() {

			return this.each(function() {
				injector($(this), ' ', 'word', ' ');
			});

		},

		lines : function() {

			return this.each(function() {
				var r = "eefec303079ad17405c889e092e105b0";
				// Because it's hard to split a <br/> tag consistently across browsers,
				// (*ahem* IE *ahem*), we replace all <br/> instances with an md5 hash
				// (of the word "split").  If you're trying to use this plugin on that
				// md5 hash string, it will fail because you're being ridiculous.
				injector($(this).children("br").replaceWith(r).end(), r, 'line', '');
			});

		}
	};

	$.fn.lettering = function( method ) {
		// Method calling logic
		if ( method && methods[method] ) {
			return methods[ method ].apply( this, [].slice.call( arguments, 1 ));
		} else if ( method === 'letters' || ! method ) {
			return methods.init.apply( this, [].slice.call( arguments, 0 ) ); // always pass an array
		}
		$.error( 'Method ' +  method + ' does not exist on jQuery.lettering' );
		return this;
	};

    
/*
* REGISTRACE
*/
    
$('.registrace-tlacitko').click(function(e){
	$(".registrace-zobrazeni").show("slow");
	});  
    
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();

$('#billing_company').keyup(function() {
  delay(function(){
   $( "#billing_dic" ).show("slow");
   $( "#billing_ico" ).show("slow");  
   $( 'label[for="billing_ico"]' ).show("slow");  
   $( 'label[for="billing_dic"]' ).show("slow");  
          
  }, 1000 );
});   
    
})(jQuery); // KONEC jQuery

