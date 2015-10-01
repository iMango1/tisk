(function($) { 
	
	"use strict";
	$(window).load(function(){
		if ($('.color-chooser').length > 0){
			$('.color-chooser').wpColorPicker();
		}
		
		load_icons();
		sidebars();
	});
	mega_menu();
	$(document).ajaxComplete(function(){
		click_icons();
		mega_menu();
	})
	
	function load_icons(){
		
		// this variable to get the template directory path.
		var themeurl = '';
		if($('#popup-css-css').length > 0){
			themeurl = $('#popup-css-css').attr('href').split('/it-framework')[0];
		}else if($('.themeURI').length > 0){
			themeurl = $('.themeURI').text();
		}
				
		$('.ico').removeClass('selectedI');
		
		// this only for theme options icon.
		var ic = $('.icon_input').val();
		$('.cust-icon').addClass(ic);
		
		$('body').append('<div class="it_add_icon"></div><div id="icon-overlay"></div>');
		var dw = parseInt($(window).width())/2,
			mw = parseInt($('.it_add_icon').width())/2,
			dh = parseInt($(window).height())/2,
			mh = parseInt($('.it_add_icon').height())/2,
			lft = dw-mw+'px',
			tp = dh-mh+'px';
		$('.it_add_icon').css({left:lft,top:tp});
		click_icons();
		$.ajax({
			type: "GET",
			url: themeurl+'/it-framework/includes/fields/icons/icons.php',
			success: function(data) {
				$('.it_add_icon').html(data);
				
				var iconSearch = $('.iconSearch'),
					iconLoad     = $('.icons_set');
				    iconSearch.keyup( function(){
				    var $this = $(this),
				        val   = $this.val(),
				        list_icon  = iconLoad.find('a');
				    list_icon.each(function() {
				      var $ico = $(this);
				      if ( $ico.data('icon').search( new RegExp(val, "i") ) < 0 ) {
				        $ico.hide();
				      } else {
				        $ico.show();
				      }
				
				    });
				});
			}
		});
	}
	
	function click_icons(){
		var icon = '';
		$('.btn_icon').click(function(e){
			e.preventDefault();
			$(this).addClass('clicked');

			// show the icon box to select from.
			$('#icon-overlay').fadeIn(200);
			$('.it_add_icon').fadeIn(300);
			/***********************************************/
			
			$('.it_add_icon .icons_set').find('i').each(function(){
				$(this).click(function(){
					$('.it_add_icon .icons_set').find('i').removeClass('selectedI');
					$(this).addClass('selectedI');
					icon = $(this).attr('class');
					return icon;
				});
			});			
			$(this).next('.icon_input').val(icon).addClass('has-icon');
			$('.close-login').click(function(e){
				e.preventDefault();
				$('.btn_icon').removeClass('clicked');
				$('#icon-overlay').fadeOut(200);
				$('.it_add_icon').fadeOut(100);
			});
			$('.use_icon a').click(function(e){
				e.preventDefault();
				$('.btn_icon.clicked').next('.icon_input').val(icon);
				$('.btn_icon.clicked').prev('.ico').removeAttr('class').addClass(icon+' ico');
				$('.ico').removeClass('selectedI');
				$('.btn_icon.clicked').addClass('hasIcon');
				$('.btn_icon').removeClass('clicked');
				$('#icon-overlay').fadeOut(200);
				$('.it_add_icon').fadeOut(100);
				$('.icon_input[value*="selectedI"]').each(function(){
					$(this).parent().find('.icon-remove').css('visibility','visible');
				});
			});
		});		
		$('.icon_input[value*="selectedI"]').each(function(){
			$(this).parent().find('.icon-remove').css('visibility','visible');
		});
		$('.icon-remove').each(function(){
			$(this).click(function(){
				$(this).prev('.icon_input').val('');
				$(this).parent().find('.ico').removeAttr('class').addClass('ico');
			});
		});
	}
	
	function mega_menu(){
		var check = $('.mega-choose .custom-checkbox');
		$('.column-choose').hide(0);
		check.each(function(){
			if ($(this).find('.on').is(':checked')) {
				$(this).addClass('selected');
				$(this).parent().parent().prev('.menu-item-bar').find('.mega-hint').show(0);
				$(this).parent().next('.column-choose').show(0);
			}else{
				$(this).removeClass('selected');
				$(this).parent().parent().prev('.menu-item-bar').find('.mega-hint').hide(100);
				$(this).parent().next('.column-choose').hide(0);
			}
			$(this).click(function(){
				$(this).find('input[type="radio"]').not(':checked').prop("checked", true);
				if ($(this).find('.on').is(':checked')) {
					$(this).addClass('selected');
					$(this).parent().parent().prev('.menu-item-bar').find('.mega-hint').show(0);
					$(this).parent().next('.column-choose').show(0);
				}else{
					$(this).removeClass('selected');
					$(this).parent().parent().prev('.menu-item-bar').find('.mega-hint').hide(0);
					$(this).parent().next('.column-choose').hide(0);
				}
			});
		});		
	}
	
	function sidebars(){
		$('.sidebar_imgs').find('.radio').each(function(){
			var thissrc = $(this).attr('data-src');
			$(this).before('<img alt="" src="'+thissrc+'" />');
			$('.radio:checked').prev('img').addClass('selected');
			$('.sidebar_imgs').find('img').each(function(){
				$(this).click(function(){
					$('.sidebar_imgs img').removeClass('selected');
					$(this).addClass('selected');
					$(this).next('.radio').attr('checked','checked');
					if($('.sidebar-right').prev().hasClass('selected') || $('.sidebar-left').prev().hasClass('selected')){
						$('.custom_side').show(0);
					}else{
						$('.custom_side').hide(0);
					}
				});
			});
			if($('.sidebar-right').prev().hasClass('selected') || $('.sidebar-left').prev().hasClass('selected')){
				$('.custom_side').show(0);
			}
		});
	}
	
	/* ================ Checkbox Styling. ================ */
    var checkBox = $('.it_checkbox');
    $(checkBox).each(function(){
        $(this).wrap( "<span class='custom-checkbox'></span>" );
        if($(this).is(':checked')){
            $(this).parent().addClass("selected");
            //$(this).attr('value','1');
        }
    });
    $(checkBox).click(function(){
        $(this).parent().toggleClass("selected");
        if ($(this).attr('value') == '1'){
        	$(this).attr('value','0');
        }else{
        	$(this).attr('value','1');
        }
    });
	$('.custom-checkbox').append('<div class="switcher"/>');
	

})(jQuery);