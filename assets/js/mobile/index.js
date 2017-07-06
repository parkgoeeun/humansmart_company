'use strict';

$(document).ready(function() {

	$('.flexslider').flexslider({animation: "slide"});

	var tmp_height_menu = $('#header_mobile').height() + 'px';
	$('#header_mobile .header_right').css('line-height', tmp_height_menu);

	$(".counseling_tab").click(function(event){
		$('html,body').animate({scrollTop:$(this.hash).offset().top - 120}, 1000);
	});

	$(".pageStard_tab").click(function(event){
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
	});

	var jbOffset = $('.mobile_menu').offset();

	$(window).scroll(function(){
		if ($(document).scrollTop() > jbOffset.top) {
			$('.mobile_menu').addClass('menuFixed');
		} else {
			$('.mobile_menu').removeClass('menuFixed');
		}
	});

	$(".returnSign").click(function() {

		var form_data = {
			message: $("#main_message").val(),
			is_ajax: 1
		};

		$.ajax({
			type: "POST",
			url: "/auth/sign/checkMsg.php",
			data: form_data,
			success: function(data){
			$("#message_check").html(data);
			}
		});

		LoginChk();
	});

	// $("#mobileEnd").click(function(){
	// 	$("#mobilePromotionPop").css('display', 'none');
	// });

});
