(function($) { 
	
	"use strict";
	$('div[id^="it_meta_"]').wrapAll('<div class="postbox it_metas"><div id="tabs-container" class="cust-tabs inside"><div class="tab"></div></div></div>');
	$('.cust-tabs').prepend('<ul class="tabs-menu"></ul>');
	$('div[id^="it_meta_"]').each(function(){
		var tabscont = $(this).find('h3.hndle span').text();
		var tabID = $(this).attr('id');
		$(this).removeAttr('class').addClass('tab-content').find('.handlediv').remove();
		$('.tabs-menu').append('<li><a href="#'+tabID+'">'+tabscont+'</a></li>');
	});
	$(".tabs-menu").find('li').eq(0).addClass('current');
	$('.tab-content').eq(0).css('display','block');
	$('.it_metas').prepend('<h4 class="metas_title">'+$('.page_settings_title').eq(0).text()+'</h4><div class="handlediv" title="Click to toggle"><br></div>');
	
	$(".tabs-menu a").click(function(e) {
		e.preventDefault();
		$(this).parent().addClass("current");
		$(this).parent().siblings().removeClass("current");
		var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
	});
	var myOptions = {
	    defaultColor: false,
	    change: function(event, ui){
	    	var hexcolor = $( this ).wpColorPicker( 'color' );
	    	$(this).parent().parent().parent().find('.hexa-color').attr('value',hexcolor);
	    },
	    clear: function() {
	    	$(this).parent().parent().parent().find('.hexa-color').attr('value','');
	    },
	    hide: true,
	    palettes: true
	}
	$('.color-field').wpColorPicker(myOptions);
	
	
	$('#chck_video_bg').change(function(){
		expcol();
	});
	
	function expcol(){
		$('.upload_video').each(function(){
			$(this).parent().addClass('video_section');
		});
		$('.video_section').wrapAll('<div class="videos-collapse"></div>');
		var checkb = $('#chck_video_bg');
		if(checkb.is(':checked')){
			$('.videos-collapse').slideDown();
		}else{
			$('.videos-collapse').slideUp();
		}
	}
	$(window).load(function(){
		$('.color-field').each(function(){
			var thisColor = $(this).attr('value');
			$(this).parent().prev('.wp-picker-open').css('background-color',thisColor);
		});
		$('.color-chooser').wpColorPicker();
		expcol();
	});
	
	
	$('.head-7-banner').each(function(){
		$(this).parent().parent().css('display','none');
	});
	
	$('#meta_header_style').change(function(){
        if($('#meta_header_style').val() == 'header-7') {
            $('.head-7-banner').parent().parent().slideDown(); 
        } else {
            $('.head-7-banner').parent().parent().slideUp(); 
        } 
    });
    
    if($('#meta_header_style').val() == 'header-7') {
        $('.head-7-banner').parent().parent().slideDown(); 
    } else {
        $('.head-7-banner').parent().parent().slideUp(); 
    }	
    if($('#sidebarssssss-0').length > 0){
	    $('#sidebarssssss-0').parent().remove();
	    $('#sidebar-1').parent().removeClass('closed');
    }

})(jQuery);

