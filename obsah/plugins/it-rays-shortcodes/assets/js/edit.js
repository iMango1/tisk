(function($) { 
	
	"use strict";
	$(".anim-deldu").hide();
	show_hide_anim();
	show_hide_tes();
	show_hide_cl();
	$(".anim-class select").change(function(){
	    show_hide_anim();
	});
	
	function show_hide_anim(){
	    if($(".anim-class select").val() == ""){
	           $(".anim-deldu").hide();
	    }else{
	        $(".anim-deldu").show();
	    }
	}
	
	$(".them-color").hide();
	show_hide_col();
	
	$(".col-class select").change(function(){
	    show_hide_col();
	});
	
	function show_hide_col(){
	    if($(".col-class select").val() != "custom"){
	           $(".them-color").hide();
	    }else{
	        $(".them-color").show();
	    }
	}
	
	
	$("select.block_style").change(function(){
	    show_hide_tes();
	});
	
	function show_hide_tes(){
	    if($("select.block_style").val() == "5"){
	        $(".t_slides").hide();
	    }else{
	        $(".t_slides").show();
	    }
	}
	
	$("select.cl_style").change(function(){
	    show_hide_cl();
	});
	
	function show_hide_cl(){
	    if($("select.cl_style").val() != "4"){
	           $(".c_slides").hide();
	    }else{
	        $(".c_slides").show();
	    }
	}
	
	/* ================ Checkbox Styling. ================ */
    /*var checkBox = $('.checkbox');
    $(checkBox).each(function(){
        $(this).wrap( "<span class='custom-checkbox'></span>" );
        if($(this).is(':checked')){
            $(this).parent().addClass("selected");
            //$(this).attr('value','1');
        }
    });
    $(checkBox).click(function(){
        $(this).parent().toggleClass("selected");
        if ( $(this).is(':checked')){
        	$(this).attr('value','1');
        }else{
        	$(this).attr('value','0');
        }
    });
	$('.custom-checkbox').append('<div class="switcher"/>');*/

})(jQuery);
