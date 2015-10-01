(function($) { 

	"use strict";
    
	/* ================ Patterns Select Functions. ================ */
	var currentVal = $('input.patterns').val();
	$('.pattern-img').each(function(){
		if ($(this).attr('src') == currentVal){
			$(this).addClass('selected-im');
		}	
	});
	
	$('.pattern-img').each(function(){
		var thisSrc = $(this).attr('src');
		$(this).click(function(){
			$('.pattern-img').removeClass('selected-im');
			$(this).addClass('selected-im');
			$('input.patterns').val(thisSrc);
		});
	});
	
	$('.date-soon').attr('readonly','readonly').attr('autocomplete','off');
	$('.date-soon').datepicker({
        dateFormat : 'yy/mm/dd'
    });
	
	// import demo data.
	var $import_true = '',
		_attachment = $('#import_data'),
    	_is_attachment  = null;

	$('.import_btn').click(function(e){
		
		e.preventDefault();
		
		$import_true = confirm('Are you sure ? This will overwrite the existing data!');
		
        if($import_true == false) return;
        
        if( _attachment.is(':checked') ) {
        	_is_attachment = true;
        }
        
        $('.noticeImp').fadeIn();
        $('.loader').html('<span class="spinner"></span>');
        $('.attachments').fadeOut();
                
        $.ajax({
            type  : 'POST',
            url   : ajaxurl,
            data  : { action: 'my_action', attachment: _is_attachment },
            success : function( data ) {              
              	$('.loader').html('');
            	$('.noticeImp').fadeOut();
            	$('.import_message').html('<div class="import_message_success">Successfully Imported</div>');
            	$('.col').addClass('hidden');
            	$('.colexp').click(function(){
		    		$(this).next().toggleClass('hidden');
		    	});
            }
        });
    });

	
	/* ================ Ajax Save Form Functions. ================ */
	
	$('body').append('<span class="msg"></span><span class="loadingDiv"></span>');
	//var newBtn = $('.btn-reset-theme').clone();
	//$('.top-reset').append(newBtn);
	
	// Reset Theme to defaults.
	var confirmtxt = $('.spconfirm').text();
	$('.btn-reset-theme').click(function(){
		return confirm(confirmtxt);
	});
	if ($('.updated.fade').length){
		$('.top-reset').css('top','72px');
	}
	var adminurl = $('.adm').text();
	function save_main_options_ajax() {
       $('.main-options-form').submit( function () {
            var b =  $(this).serialize();
            var el = $('.msg');
		 	$('.loadingDiv').show();
            $.post( adminurl +'options.php', b ).error( 
                function() {
                    el.text('Error saving data').addClass('error').fadeIn();
                    setTimeout(function () {
				        el.fadeOut();
				    }, 3000);
                }).success( function() {
                    el.text('Seccessfuly saved').addClass('success').fadeIn();
                    $('.loadingDiv').hide();
                    setTimeout(function () {
				        el.fadeOut();
				    }, 1500);
                });
                return false;    
            });
        }
 	save_main_options_ajax();
 	
	
	/* ================ Select Layout. ================ */
	if($('.layout-select').val() == ''){
	   $('.wp-picker-container').parent().nextAll().slice(0, 7).remove();
	}
	$('.sec-heading').each(function(){
		$(this).parent().find('div.lbl').remove();
	});
	
	/* ================ Radio Image Select. ================ */
	$('.radio-select').each(function(){
		if($(this).find('input.radio').attr('checked') == "checked"){
			$(this).find('img.head-img').addClass('selected-head');
		}
		var thiRad = $(this).find('input.radio').attr('value');
		var thiSrc = $(this).find('img.head-img').attr('src');
		$(this).find('img.head-img').css('display','block').attr('src',thiSrc+thiRad+'.jpg').click(function(){
			$('input.radio').removeAttr('checked');
			$(this).parent().find('input.radio').attr('checked','checked');
			$('img.head-img').removeClass('selected-head');
			$(this).addClass('selected-head');
		});
	});
    
    /* ================ Custom Skin Color DropDown List Show/Hide. ================ */
    $('.custom-colors').each(function(){
		$(this).parent().css('display','none');
	});
	
	$('.masonry-cols,.grid-cols').parent().css('display','none');
	
	$('.blog-style').change(function(){
        grid_mas();
    });
    grid_mas();
    
    function grid_mas(){
    	if($('select.blog-style').val() == 'masonry') {
    		$('.masonry-cols,.grid-cols').parent().slideUp();
            $('.masonry-cols').parent().slideDown(); 
        } else if($('select.blog-style').val() == 'grid'){
            $('.masonry-cols,.grid-cols').parent().slideUp();
            $('.grid-cols').parent().slideDown(); 
        } else{
        	$('.masonry-cols,.grid-cols').parent().slideUp();
        }
    }
    
    $('.html-txt').each(function(){
		$(this).parent().css('display','none');
	});
	
	/* ================ Top Right Bar DropDown List Show/Hide. ================ */
    $('.top-bar-right-select').change(function(){
        if($('.top-bar-right-select').val() == 'text') {
            $(this).parent().next().slideDown(); 
        } else {
            $(this).parent().next().slideUp(); 
        } 
        if($('.top-bar-right-select').val() == 'loginregister') {
	    	$('.column_login').slideDown();
	    }else if($('.top-bar-left-select').val() == 'loginregister') {
	    	$('.column_login').slideDown();
	    }else{
	    	$('.column_login').slideUp();
	    }
    });
    
    if($('.top-bar-right-select').val() == 'text') {
        $('.top-bar-right-select').parent().next().slideDown(); 
    } else {
        $('.top-bar-right-select').parent().next().slideUp(); 
    }
    
	var $children = $('.opts-ul').children('[class*="section group_"]');
	
	var classNames = $children.map(function() {
	    return this.className;
	});
	
	classNames = $.unique(classNames.get());
	
	$.each(classNames, function(i, className) {
	    var classN = className.split("_").pop();
	    $children.filter(function() {
	        return $(this).hasClass(className);
	        
	    }).wrapAll("<div class='column_"+classN+"' />");
	});
	
	
	/* ================ Top Left Bar DropDown List Show/Hide. ================ */
	$('.top-bar-left-select').change(function(){
        if($('.top-bar-left-select').val() == 'text') {
            $(this).parent().next().slideDown(); 
        } else {
            $(this).parent().next().slideUp(); 
        } 
        if($('.top-bar-left-select').val() == 'loginregister') {
	    	$('.column_login').slideDown();
	    }else if($('.top-bar-right-select').val() == 'loginregister') {
	    	$('.column_login').slideDown();
	    }else{
	    	$('.column_login').slideUp();
	    }
    });
    
    if($('.top-bar-left-select').val() == 'text') {
        $('.top-bar-left-select').parent().next().slideDown(); 
    } else {
        $('.top-bar-left-select').parent().next().slideUp(); 
    }
    
    /* ================ Accordion Show/Hide. ================ */
    $('.accordion').each(function(){
    	var $this = $(this);
    	$this.parent().removeClass('section').addClass('not-sec');
    });
    
    if($('.top-bar-left-select').val() == 'loginregister' || $('.top-bar-right-select').val() == 'loginregister') {
    	$('.column_login').slideDown();
    }else{
    	$('.column_login').slideUp();
    }
    
    $('.not-sec').each(function(){
    	$(this).nextUntil('.not-sec').wrapAll('<div class="acc-content"></div>');
    	$(this).click(function(e){
    		e.preventDefault();
    		if($(this).next('.acc-content').is(':hidden')){
	    		$('.not-sec').removeClass('selected');
	    		$(this).addClass('selected');
	    		$('.acc-content').slideUp();
	    		$(this).next('.acc-content').slideToggle(300);
	    		return false;
    		}else{
    			$(this).removeClass('selected');
    			$(this).next().slideUp();
    			return false;
    		}
    	});
    });
    
    $('.form-div').each(function(){
    	$(this).find('.not-sec').eq(0).addClass('selected').next('.acc-content').show();
    });
    
    
    /******************** Contact Offices *************************/
    
    var vll = parseInt($('.loc_txt').val(),10);
    $('.cont_locs').parent().parent().parent().find('[class*=column_]').addClass('contact-row').prepend('<h4 class="office-title">Office</h4>');
    $('.cont_locs').parent().parent().parent().append('<div class="loc_div"></div>');
    
    cont_rows();
    remove_row();
    
    $('.add_location').click(function(e){
    	e.preventDefault();
    	vll= isNaN(vll) ? 1 : vll;
   	 	vll++;
    	$('.loc_txt').val(vll);
    	$('.loc_div').append('<div class="column_'+vll+' contact-row" id="column_'+vll+'"><h4 class="office-title">Office</h4><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_location'+vll+'">Office '+vll+' Location</label><span class="description">Office '+vll+' Location.</span></div><div class="group"><input class="regular-text" type="text" id="office_location'+vll+'" name="theme_options[office_location'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_address'+vll+'">Office '+vll+' Address</label><span class="description">Office '+vll+' Address.</span></div><div class="group"><input class="regular-text" type="text" id="office_address'+vll+'" name="theme_options[office_address'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_email'+vll+'">Office '+vll+' Email</label><span class="description">Office '+vll+' Email.</span></div><div class="group"><input class="regular-text" type="text" id="office_email'+vll+'" name="theme_options[office_email'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_phone'+vll+'">Office '+vll+' Phone</label><span class="description">Office '+vll+' Phone.</span></div><div class="group"><input class="regular-text" type="text" id="office_phone'+vll+'" name="theme_options[office_phone'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_fax'+vll+'">Office FAX</label><span class="description">Office '+vll+' FAX.</span></div><div class="group"><input class="regular-text" type="text" id="office_fax'+vll+'" name="theme_options[office_fax'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_latitude'+vll+'">Latitude</label><span class="description">Office '+vll+' latitude.</span></div><div class="group"><input class="regular-text" type="text" id="office_latitude'+vll+'" name="theme_options[office_latitude'+vll+']" /></div></div><div class="section group_contact_'+vll+'"><div class="lbl"><label class="opt-lbl" for="office_longitude'+vll+'">Longitude</label><span class="description">Office '+vll+' longitude.</span></div><div class="group"><input class="regular-text" type="text" id="office_longitude'+vll+'" name="theme_options[office_longitude'+vll+']" /></div></div></div>');
    	$('body').animate({scrollTop: $('#column_'+vll).offset().top}, 500);
    	$('#column_'+vll).find('.regular-text').eq(0).focus();
    	cont_rows();
    	remove_row();
    });	
	
	function cont_rows(){
		$('.contact-row').each(function(){
			var co_title = $(this).find('.regular-text').eq(0).val();
			$(this).find('h4').html('<span>Office: </span>'+ co_title + '<a class="remove_row" href="#" title="Remove Office"><i class="fa fa-times"></i></a>');
			var co_title = $(this).find('.regular-text').eq(0).keyup(function(){
				var thVL = $(this).val();
				$(this).parent().parent().parent().find('h4').html('<span>Office: </span>'+ thVL + '<a class="remove_row" href="#" title="Remove Office"><i class="fa fa-times"></i></a>');
			});
		});
	}
	
	function remove_row(){
		$('.remove_row').each(function(){
			$(this).click(function(e){
				e.preventDefault();
				vll--;
				$('.loc_txt').val(vll);
				$(this).parent().parent().fadeOut(500).delay(500).remove();
			});
		});
	}
	
	/*********************************************/
	
    
  	if($('.color-select').val() == 'custom') {
        $('.color-select').parent().next().slideDown(); 
    } else {
        $('.color-select').parent().next().slideUp(); 
    }
	$("select.color-select").msDropdown({on:{change:function(data, ui){
		var val = data.value;
	    if(val == 'custom') {
	        $('.color-select').parent().parent().next().slideDown(); 
	    } else {
	        $('.color-select').parent().parent().next().slideUp(); 
	    } 
	}}}).data("dd");
	
	$(window).load(function(){
		
		/* ================ Add Remove Side bars. ================ */
		var bar_box = $('.bar_txt'),
		data = bar_box.val(),
		arr = data.split('|-|-|-|-|-|'),
		len = arr.length-1;
		
	    $('.add_bar').click(function(e){
	    	e.preventDefault();
	    	$('.app_div').append('<div class="side_bar"><h4>Sidebar:<span class="bar-title"></span></h4><div class="inner"><input type="hidden" class="hidVal" /><input type="text" class="regular-text added_bar" /><a class="button remove_bar" href="#">Remove</a></div></div>');
	    	added_bar_val();
	    	remove_bar();
	    });

		for ( var i = 0; i < len; i++) {
			$('.app_div').append('<div class="side_bar"><h4>Sidebar:<span class="bar-title"></span></h4><div class="inner"><input type="hidden" class="hidVal" /><input type="text" value="'+arr[i]+'" class="regular-text added_bar" /><a class="button remove_bar" href="#">Remove</a></div></div>');
		}
		
		added_bar_val();
		remove_bar();
	    
	    function added_bar_val(){
		    $('.side_bar').each(function(){
		    	var t = $(this).find('.added_bar').val(),
		    		hidInp = $(this).find('.hidVal'),
		    		hidInpV = hidInp.val();
		    	hidInp.attr('value',t);
		    	$(this).find('.bar-title').text(t);
		    	
		    	$(this).find('.added_bar').change(function(){
		    		var t2 = $(this).val();
		    		$(this).parent().parent().find('.bar-title').text(t2);
		    		hidInp.attr('value',t2);
		    	});
		    });
	    }
	    
	    $('.btnb').click(function(){
	    	var vl = new Array();
	    	$('.hidVal').each(function(){
	    		if($(this).val() != ''){
	    			vl.push($(this).val() + "|-|-|-|-|-|");
	    		}
	    	});
	    	$('.bar_txt').attr('value',vl.join(''));
	    });
	    
	    function remove_bar(){
		    $('.remove_bar').each(function(){
		    	$(this).click(function(e){
		    		e.preventDefault();
		    		$(this).prev().parent().parent().remove();
			    	var thisD = $(this).prev().val() + "|-|-|-|-|-|";	
			    	var n = $('.bar_txt').val().replace(thisD, "");
			    	$('.bar_txt').val(n);
			    	if($('.added_bar').length <= 0){
			    		$('.bar_txt').val('');
			    	}
		    	});
		    });
	    }	    
	});

})(jQuery);