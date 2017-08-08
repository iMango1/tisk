(function ( $ ) {
	"use strict";

	$(function () {

   jQuery('body').on('click','.gopay_select',function(){
    var channel = jQuery(this).children('.gopay_select_input').val();
    
    var data = {
            action: 'gopay_channel_option',
            channel: channel
        }
     $.post(ajaxurl, data, function(response) {});   
    
    jQuery(this).children('.gopay_select_input').prop('checked',true);
    
   });
		
	});

}(jQuery));