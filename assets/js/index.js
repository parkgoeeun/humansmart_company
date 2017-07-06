/*****************************************
* For PC Main Script
/****************************************/
var left_menu_1 = "#left_menu_1";
var left_menu_2 = "#left_menu_2";
var left_menu_3 = "#left_menu_3";
var left_menu_4 = "#left_menu_4";
var left_menu_5 = "#left_menu_5";
var left_menu_6 = "#left_menu_6";
var left_menu_7 = "#left_menu_7";
var left_menu_8 = "#left_menu_8";
// var left_menu_9 = "#left_menu_9";

function SectionResize () {
	// Setting Width of Left Menu (icon).
	// $('#left_menu').css('width', '3%');

	// Setting Left Padding of Section for Main Element
	var tmp_padding_left = $('#top_logo_').width() + 'px';
	$("#section6").css('padding-left', tmp_padding_left);

	// // Setting Width of Left Menu (icon).
	var tmp_width = $('#top_logo_').width() + 'px';
	$('#left_menu').css('width', tmp_width);

	// Setting Left Padding of Section for Main Element
	var tmp_padding_left = $('#top_logo_').width() + 'px';
	$(".section").css('padding-left', tmp_padding_left);

	// var tmp_height_menu = $('#header_mobile').height() + 'px';
	// $('#header_mobile .header_right').css('line-height', tmp_height_menu);
}

$(document).ready(function() {

	// Setting Full SlidePage.
	$('#wrapper').fullpage({ anchors: ['1', '2', '3', '4', '5', '6', '7', '8'], css3: true, autoScrolling: true, fitToSectionDelay: 500 });
	SectionResize();

	/*****************************************
	* Change Hash of Location And Detect Event for Left Menu
	*****************************************/
	$(left_menu_1).click(function(){
		location.hash = '#1';

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title_.png');

		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_2).click(function(){
		location.hash = '#2';

		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_3).click(function(){
		location.hash = '#3';

		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});


	$(left_menu_4).click(function(){
		location.hash = '#4';

		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_5).click(function(){
		location.hash = '#5';

		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_6).click(function(){
		location.hash = '#6';

		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_7).click(function(){
		location.hash = '#7';

		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	$(left_menu_8).click(function(){
		location.hash = '#8';

		$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title_.png');

		$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
		$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
		$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
		$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
		$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
		$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
		$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
		// $(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	});

	// $(left_menu_9).click(function(){
	// 	location.hash = '#9';
	//
	// 	$(left_menu_9).attr('src', '/assets/img/of_header/left_menu_9_title_.png');
	//
	// 	$(left_menu_1).attr('src', '/assets/img/of_header/left_menu_1_title.png');
	// 	$(left_menu_2).attr('src', '/assets/img/of_header/left_menu_7_title.png');
	// 	$(left_menu_3).attr('src', '/assets/img/of_header/left_menu_2_title.png');
	// 	$(left_menu_4).attr('src', '/assets/img/of_header/left_menu_3_title.png');
	// 	$(left_menu_5).attr('src', '/assets/img/of_header/left_menu_4_title.png');
	// 	$(left_menu_6).attr('src', '/assets/img/of_header/left_menu_5_title.png');
	// 	$(left_menu_7).attr('src', '/assets/img/of_header/left_menu_6_title.png');
	// 	$(left_menu_8).attr('src', '/assets/img/of_header/left_menu_9_title.png');
	// });
	/****************************************/

	/*****************************************
	* Change Hash of Location And Detect Event for Left Menu
	*****************************************/
	var hash = location.hash;
	var hash = hash.replace('#', '');
	var hash_menu = '#left_menu_' + hash;

	$(hash_menu).click();
	/****************************************/

	/*****************************************
	* Move the Page
	*****************************************/
	$('.btn_startab').click(function(){
		$('#left_menu_2').click();
	});

	$('.btn_starta').click(function(){
		$('#left_menu_7').click();
	})

	$('.header_left img').click(function(){
		$('#left_menu_1').click();
	})
	/****************************************/

	if (location.hash == '') {
		$("#left_menu_1").click();
	}

	/*****************************************
	* Move Main Tab Arrow before click openTab Btn
	*****************************************/
	var owlWidth = $(".owl-header-slide-img").width();
	var owlHeight = $(".owl-header-slide-img").height();

	var tmpOwlleftWidth = -(owlWidth/2 + 80);
	var tmpOwlrightWidth = owlWidth/2 + 70;
	var tmpOwlHeight = -(owlHeight/2 + 40);

	// margin-left: -850px;
    // position: relative;
    // top: -180px;
	$(".nextSlideMainTab img").css({
		'margin-left':tmpOwlleftWidth,'margin-top':tmpOwlHeight
	});

	$(".prevSlideMainTab img").css('margin-left', tmpOwlrightWidth);
	$(".prevSlideMainTab img").css('margin-top', tmpOwlHeight);
	/****************************************/

	$("#openMainTab").click(function(){
		$("#owl-header").data('owlCarousel').goTo(0);
		$("#header_slide").fadeIn();
		$("#header_slide").css('z-index', '99999');

		/*****************************************
		* Move Main Tab Arrow after click openTab Btn
		*****************************************/
		var owlWidth = $(".owl-header-slide-img").width();
		var owlHeight = $(".owl-header-slide-img").height();

		var tmpOwlleftWidth = -(owlWidth/2 + 570);
		var tmpOwlrightWidth = owlWidth/2 + 70;
		var tmpOwlHeight = -(owlHeight/2 + 40);

		$(".nextSlideMainTab img").css({'margin-left':tmpOwlleftWidth});
		$(".prevSlideMainTab img").css({'margin-left':tmpOwlrightWidth});
		/****************************************/
	});

	$("#hideMainTab").click(function(){
		$("#header_slide").fadeOut();
	});

	var owlHeader = $("#owl-header");

	$(".nextSlideMainTab").click(function(){
		owlHeader.trigger('owl.prev');
	});

	$(".prevSlideMainTab").click(function(){
		owlHeader.trigger('owl.next');
	});

});

/*****************************************
* Change Hash of Location And Detect Event for Left Menu
*****************************************/
$(window).on('hashchange', function(){
	var hash = location.hash;
	var hash = hash.replace('#', '');
	var hash_menu = '#left_menu_' + hash;
	$(hash_menu).click();
});
/****************************************/

jQuery(document).ready(function($) {

	// , #section1 img
	$("#section1 .btn_starta").click(function(){$('#left_menu_3').click();});
	$("#section2 .btn_down").click(function(){$('#left_menu_4').click();});
	$("#section3 .btn_down").click(function(){$('#left_menu_5').click();});
	$("#section4 .btn_down").click(function(){$('#left_menu_6').click();});
	$("#section5 .btn_down").click(function(){$('#left_menu_7').click();});

	$("#closePopupK").click(function(){
		$("#popup_kakao").css('display', 'none');
	});

	$("#closePopupR").click(function(){
		$("#right_popup").css('display', 'none');
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

	$(".returnTherapy").click(function(){

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

		$("#counseling").submit();
	});

	$("#owl-demo").owlCarousel({ items : 2, navigation : true, slideSpeed : 300, paginationSpeed : 400, singleItem: true, autoPlay: true, autoplayTimeout: 3000, autoplayHoverPause: true });
	$("#owl-proscons").owlCarousel({ items : 5, navigation : false, slideSpeed : 300, paginationSpeed : 400, singleItem: true, autoPlay: true, autoplayTimeout: 3000, autoplayHoverPause: true });
	$("#owl-header").owlCarousel({ items : 4, navigation : true, slideSpeed : 300, paginationSpeed : 400, singleItem: true, autoPlay: true, autoplayTimeout: 3000, autoplayHoverPause: true, rewindNav: false });

	var owl = $("#owl-proscons").data('owlCarousel');

	$("#proscons_item_1").click(function(){
		owl.goTo(0);

		$("#proscons_item_1").css("opacity", "1.0");
		$("#proscons_item_2, #proscons_item_3, #proscons_item_4, #proscons_item_5").css("opacity", "0.5");
	});

	$("#proscons_item_2").click(function(){
		owl.goTo(1);

		$("#proscons_item_2").css("opacity", "1.0");
		$("#proscons_item_1, #proscons_item_3, #proscons_item_4, #proscons_item_5").css("opacity", "0.5");
	});

	$("#proscons_item_3").click(function(){
		owl.goTo(2);

		$("#proscons_item_3").css("opacity", "1.0");
		$("#proscons_item_1, #proscons_item_2, #proscons_item_4, #proscons_item_5").css("opacity", "0.5");
	});

	$("#proscons_item_4").click(function(){
		owl.goTo(3);

		$("#proscons_item_4").css("opacity", "1.0");
		$("#proscons_item_1, #proscons_item_2, #proscons_item_3, #proscons_item_5").css("opacity", "0.5");
	});

	$("#proscons_item_5").click(function(){
		owl.goTo(4);

		$("#proscons_item_5").css("opacity", "1.0");
		$("#proscons_item_1, #proscons_item_2, #proscons_item_3, #proscons_item_4").css("opacity", "0.5");
	});

	$("#promotionAlarm .alarmClose").click(function(){
		$("#promotionAlarm").css('display', 'none');
	});

	$("#promotionAlarm .closeAlarm").click(function(){
		$("#promotionAlarm").css('display', 'none');
		closeMainWin(1, 'promotionAlarm');
	});

	$("#paymentAlarm .alarmClose").click(function(){
		$("#paymentAlarm").css('display', 'none');
	});

	$("#paymentAlarm .closeAlarm").click(function(){
		$("#paymentAlarm").css('display', 'none');
		closeMainWin(1, 'paymentAlarm');
	});

	function setMainCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	    var expires = "expires="+d.toUTCString();
	    document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function closeMainWin(obj, popupTab) {
		if (popupTab == "promotionAlarm") {
			setMainCookie("promotionAlarm", "done", 1);
			$("#promotionAlarm").css('display', 'none');
			$("#paymentAlarm").css('display', 'none');
		}
	}

	if (getMainCookie("promotionAlarm") == "done") {
		$("#promotionAlarm").css('display', 'none');
	} else {
		$("#promotionAlarm").css('display', 'block');
	}

	if (getMainCookie("paymentAlarm") == "done") {
		$("#paymentAlarm").css('display', 'none');
	} else {
		$("#paymentAlarm").css('display', 'block');
	}

	function getMainCookie (name) {
		var nameOfCookie = name + "=";
		var x = 0;
		while ( x <= document.cookie.length ) {
			var y = (x+nameOfCookie.length);
			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) endOfCookie = document.cookie.length;
				return unescape( document.cookie.substring( y, endOfCookie ) );
			}
			x = document.cookie.indexOf( " ", x ) + 1;
			if ( x == 0 ) break;
		}
		return "";
	}

	// 이용 요금 안내 - 전화상담/화상상담 팝업 열기
	$(".btn_openNewApp").click(function(){
		$('#opacityApp, #opacityBg').fadeIn();
	});

	// 이용 요금 안내 - 전화상담/화상상담 팝업 닫기
	$(".btn_closeGuidePopup").click(function(){
		$('#opacityApp, #opacityBg').fadeOut();
	});

});

$(window).on('resize',function(){
	SectionResize();
});
