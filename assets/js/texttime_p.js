	'use strict';

	window.onload = function(){
		setTimeout("ChangeDivScroll()", 1000);
	}

	// 일대일 채팅 스크롤 하단으로 내리기
    function ChangeDivScroll() {
	    var divChatPanel = document.getElementById("chatLog");
	    document.getElementById("chatLog").scrollTop = document.getElementById("chatLog").scrollHeight;
	}

	/**********************************************
	* 자동 저장 24시간제 시간 기록 함수
	***********************************************/
	function convert12H(time, options) {

		/************************************************************************
		* 24시간 형식을 12시간 형식으로 변환한다.
		* validation 미구현
		*
		* @params time {String} HH:MM 형식의 시간
		* @params options {Object}
		*          ampmLabel {Array} 오전, 오후 레이블. 기본 값은 [ '오전', '오후' ]
		* @return {String} 24시간 형식의 HH:MM 시간 문자열
		*************************************************************************/

	    var _ampmLabel = (options && options.ampmLabel) || [ '오전', '오후' ];
	    var _timeRegExFormat = /^([0-9]{2}):([0-9]{2})$/;

	    var _timeToken = time.match(_timeRegExFormat);

	    if (typeof _timeRegExFormat === 'undefined') { return null; }

	    var _intHours = parseInt(_timeToken[1]);
	    var _intMinutes = parseInt(_timeToken[2]);
	    var _strHours12H = ('0' + (_intHours == 12 ? 12 : _intHours % 12)).slice(-2);

	    return _ampmLabel[parseInt(_intHours / 12)] + ' ' + _strHours12H + ':' + _intMinutes;
	}

	/**********************************************
	* 메모 남겼을 때
	***********************************************/
	document.getElementById("profileMemo").addEventListener("blur", savingMemo, true);
    document.getElementById("counselingMemo").addEventListener("blur", savingCounseling, true);

	function savingMemo() {

		var now = new Date();

		var hour = now.getHours(); if (("" + hour).length  == 1) { hour  = "0" + hour;  }
		var min = now.getMinutes(); if (("" + min).length  == 1) { min  = "0" + min;  }
		var now_time = hour + ":" + min;

    	if ($('#info_job').val() == '기타') {
    		var info_job = $('#info_job_etc').val();
    	}else{
    		var info_job = $('#info_job').val();
    	}

		/* 메모 데이터 저장 */
        var form_data_memo = {
        	type: 'memo',
        	sex: $('#info_sex').val(),
        	age: $('#info_age').val(),
        	job: info_job,
        	counselingExp: $('#info_abroad').val(),
			hospitalExp: $('#info_hospital').val(),
        	client: $('#info_client').val(),
            is_ajax: 1
        };

        $.ajax({
            type: "POST",
            url: "manage_.php",
            data: form_data_memo,
            success : function(data){
				var now_time = convert12H('' + hour + ':' + min + '');
        		document.getElementById("save_status1").innerHTML = "자동 저장 완료 (" + now_time + ")";
            }
        });
    }

    function savingCounseling() {

		var now = new Date();

		var hour = now.getHours(); if (("" + hour).length  == 1) { hour  = "0" + hour;  }
		var min = now.getMinutes(); if (("" + min).length  == 1) { min  = "0" + min;  }
		var now_time = hour + ":" + min;

		/* 메모 데이터 저장 */
        var form_data_diary = {
        	type: 'diary',
        	no: $('#no').val(),
            counseling: $('#counseling').val(),
            is_ajax: 1,
        };

        $.ajax({
            type: "POST",
            url: "manage_.php",
            data: form_data_diary,
            success : function(data){
				var now_time = convert12H('' + hour + ':' + min + '');
        		document.getElementById("save_status2").innerHTML = "자동 저장 완료 (" + now_time + ")";
            }
        });
    }

	/******************************
	* 고정 메뉴 관련 스크립트.
	******************************/
	var counselingMenu1 = "#counseling_menu_1";
	var counselingMenu2 = "#counseling_menu_2";
	var counselingMenu3 = "#counseling_menu_3";
	var counselingMenu4 = "#counseling_menu_4";
	var counselingMenu5 = "#counseling_menu_5";
	// var counselingMenu6 = "#counseling_menu_6";
	var counselingMenu7 = "#counseling_menu_7";

	function menuInit() {
		$(counselingMenu1).attr('src', '/assets/img/of_texttime/menuClient.png');
		$(counselingMenu2).attr('src', '/assets/img/of_texttime/menuHistory.png');
		$(counselingMenu3).attr('src', '/assets/img/of_texttime/menuMemo.png');
		$(counselingMenu4).attr('src', '/assets/img/of_texttime/menuStart.png');
		$(counselingMenu5).attr('src', '/assets/img/of_texttime/menuAuto.png');
		// $(counselingMenu6).attr('src', '/assets/img/of_texttime/menuInfo.png');
		$(counselingMenu7).attr('src', '/assets/img/of_texttime/menuReservation.png');
	}

	$(counselingMenu1).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuClient_.png');

		$("#mypage_page1").css("display", "block");
		$("#mypage_page5, #mypage_page2, #mypage_page4, #mypage_page3, #mypage_page7").css("display", "none");
	});

	$(counselingMenu2).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuHistory_.png');

		$("#mypage_page2").css("display", "block");
		$("#mypage_page5, #mypage_page1, #mypage_page4, #mypage_page3, #mypage_page7").css("display", "none");
	});

	$(counselingMenu3).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuMemo_.png');

		$("#mypage_page3").css("display", "block");
		$("#mypage_page5, #mypage_page1, #mypage_page4, #mypage_page2, #mypage_page7").css("display", "none");
	});

	$(counselingMenu4).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuStart_.png');

		$("#mypage_page4").css("display", "block");
		$("#mypage_page5, #mypage_page1, #mypage_page3, #mypage_page2, #mypage_page7").css("display", "none");
	});

	$(counselingMenu5).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuAuto_.png');

		$("#mypage_page5").css("display", "block");
		$("#mypage_page2, #mypage_page1, #mypage_page4, #mypage_page3, #mypage_page7").css("display", "none");
	});

	$(counselingMenu7).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuReservation_.png');

		$("#mypage_page7").css("display", "block");
		$("#mypage_page2, #mypage_page1, #mypage_page4, #mypage_page3, #mypage_page5").css("display", "none");
	});
	/*****************************/

	/******************************
	* 상담일지 작성 부분 변경
	******************************/
	// $("#mypage_form").change(function() {
	// 	var selected = $(this).val();
	//
	// 	if (selected == 'inform_b') {
	// 		document.getElementById("problem").style.display = 'none';
	// 		document.getElementById("inform").style.display = 'block';
	// 		document.getElementById("counseling").style.display = 'none';
	// 	} else if (selected == 'problem_b') {
	// 		document.getElementById("problem").style.display = 'block';
	// 		document.getElementById("inform").style.display = 'none';
	// 		document.getElementById("counseling").style.display = 'none';
	// 	} else if (selected == 'counseling_b') {
	// 		document.getElementById("problem").style.display = 'none';
	// 		document.getElementById("inform").style.display = 'none';
	// 		document.getElementById("counseling").style.display = 'block';
	// 	}
	// });
	/*****************************/

	$(document).ready(function() {

		$(counselingMenu1).click();

		// 사이드 메뉴 가로 길이 설정
		var sideMenuWidth = ($("#counseling_profile").width() + 0.5) + 'px';
		$("#counseling_menu").css("left", sideMenuWidth);

		$("#messageSendBox").change(function(){
	    	$("#messageSendBox").css('height', '12%');
	    });

		// 이모티콘 목록 박스 열기/닫기.
		$("#emotion_tab").click(function(){
			if ($("#emotion_box").css("display") === "none") {
				$("#emotion_box").fadeIn();
				$("#emotion_tab").prop('src', '/assets/img/of_emotion/emotion_on.png');
			} else {
				$("#emotion_box").fadeOut();
				$("#emotion_tab").prop('src', '/assets/img/of_emotion/emotion_off.png');
			}
		});

		// 이모티콘 삽입.
		$(".emotion").click(function(){
			var emojiID = $(this).prop('id');
			$("#messageSendBox").html($("#messageSendBox").html() + "<img src='/assets/img/of_emotion/" + emojiID + ".png' style='height:20px;vertical-align:bottom;'/>");
		});

		// 이모티콘 위치 설정.
		$("#emotion_box").css('bottom', $("#messageSendBox").height() + 15);
		$("#emotion_box").css('left', $("#emotion_tab").offset().left - 243);

		$("#messageSendBox").keyup(function(){
			$("#emotion_box").css('bottom', $("#messageSendBox").height() + 15);
		});

    	if ($('#info_job').val() == '기타') {
    		$('#info_job_etc').css('display', 'block');
    	} else {
    		$('#info_job_etc').css('display', 'none');
    	}

		$("#info_job").change(function() {
	    	if ($('#info_job').val() == '기타') {
	    		$('#info_job_etc').css('display', 'block');
	    	} else {
	    		$('#info_job_etc').css('display', 'none');
	    	}
	    });

	});

	$(window).on('resize',function(){
		// 사이드 메뉴 가로 길이 설정
		var sideMenuWidth = ($("#counseling_profile").width() + 0.5) + 'px';
		$("#counseling_menu").css("left", sideMenuWidth);
	});

	function retImoji (MessageText)
	{
		// 이모티콘 치환.
		MessageText = MessageText.split('[감동]').join('<img src="/assets/img/of_emotion/emotion1_.png" class="imoji_sm">');
		MessageText = MessageText.split('[화남]').join('<img src="/assets/img/of_emotion/emotion2_.png" class="imoji_sm">');
		MessageText = MessageText.split('[공포]').join('<img src="/assets/img/of_emotion/emotion4_.png" class="imoji_sm">');
		MessageText = MessageText.split('[고마움]').join('<img src="/assets/img/of_emotion/emotion3_.png" class="imoji_sm">');
		MessageText = MessageText.split('[궁금]').join('<img src="/assets/img/of_emotion/emotion5_.png" class="imoji_sm">');
		MessageText = MessageText.split('[기쁨]').join('<img src="/assets/img/of_emotion/emotion6_.png" class="imoji_sm">');
		MessageText = MessageText.split('[놀람]').join('<img src="/assets/img/of_emotion/emotion7_.png" class="imoji_sm">');
		MessageText = MessageText.split('[슬픔]').join('<img src="/assets/img/of_emotion/emotion8_.png" class="imoji_sm">');
		MessageText = MessageText.split('[사랑]').join('<img src="/assets/img/of_emotion/emotion9_.png" class="imoji_sm">');
		MessageText = MessageText.split('[눈물]').join('<img src="/assets/img/of_emotion/emotion10_.png" class="imoji_sm">');
		MessageText = MessageText.split('[안녕]').join('<img src="/assets/img/of_emotion/emotion11_.png" class="imoji_sm">');
		MessageText = MessageText.split('[잘자]').join('<img src="/assets/img/of_emotion/emotion12_.png" class="imoji_sm">');
		MessageText = MessageText.split('[최고]').join('<img src="/assets/img/of_emotion/emotion13_.png" class="imoji_sm">');
		MessageText = MessageText.split('[쿨쿨]').join('<img src="/assets/img/of_emotion/emotion14_.png" class="imoji_sm">');

		return MessageText;
	}

	/*
	* Socket.io
	*/
	if ((location.host === 'trost.co.kr') || (location.host === 'www.trost.co.kr')) {
		var socket = io.connect('https://trost.co.kr:8763');
	} else if ((location.host === 'localhost:8888') || (location.host === 'www.localhost:8888')) {
		var socket = io.connect('http://localhost:8763');
	} else {
		var socket = io.connect('http://' + location.host + ':8763');
	}

	var counselingEl = $("#counseling_chat_");

	socket.on('connect', function(){
		$(".loader").css('display', 'block');
		$(".opacityBg").css('display', 'block');

		socket.emit('enterCounseling', 'partner', clientID, partnerID, counselingNo, 'pc');
	});

	socket.on('reloadMessage', function () {
		$.each($(".p_p").toArray(), function(key, newMessage) {
			var string = $(this).text();
			var newString = string.toString().split('/');
			$(this).text(newString[0] + " / 읽음");
		});
	});

	socket.on('loadMessage', function (messageRows) {

		messageRows.reverse();
		var lastMsgKey = Number (messageRows.length - 1);

		$.each(messageRows, function(key, value) {
			var MessageText = value.log;

			MessageText = value.log.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
			MessageText = retImoji(MessageText);

			if (value.log_from === 'client') {
				counselingEl.prepend("<tr class='" + value.no + "'><td class='chat_log_c'><img src='/assets/img/texttime_icon.png' class='c_profile_img'/><span class='c_profile_name'>" + clientName + "</span><table class='chat_log_c_'><tr><td style='padding:16px 12px;'> " + MessageText + " </td></tr></table><p class='c_p'>" + value.time_message + "</p></td></tr>");
			} else if (value.log_from === 'partner') {

				if (messageRows[lastMsgKey].historyClient !== 0) {

					if (value.no > messageRows[lastMsgKey].historyClient) {
						value.time_message = value.time_message + ' / 안 읽음';
					} else {
						value.time_message = value.time_message + ' / 읽음';
					}

				} else {
					value.time_message = value.time_message + ' / 읽음';
				}

				counselingEl.prepend("<tr class='" + value.no + "'><td class='chat_log_p'><table class='chat_log_p_'><tr><td style='padding:16px 12px;'> " + MessageText + " </td></tr></table><div id='p_circle'></div><p class='p_p'>" + value.time_message + "</p></td></tr>");
			} else if (value.log_from === 'trost') {
				counselingEl.prepend("<tr class='" + value.no + "'><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + MessageText + "</td></tr></table></td></tr>");
			}

			loadLastMsgNo = value.no;

			if (!scrollMsgLoad) {
				ChangeDivScroll();
			}
		});

		$(".loader").css('display', 'none');
		$(".opacityBg").css('display', 'none');
	});

	socket.on('loadNewMessage', function (messageRows) {
		var MessageText = messageRows.message;

		MessageText = messageRows.message.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
		MessageText = retImoji(MessageText);

		if (messageRows.senderStatus === 'client') {
			$("#counseling_chat_").append("<tr><td class='chat_log_c'><img src='/assets/img/texttime_icon.png' class='c_profile_img'/><span class='c_profile_name'>" + clientName + "</span><table class='chat_log_c_'><tr><td style='padding:16px 12px;'> " + MessageText + " </td></tr></table><p class='c_p'>" + messageRows.time_message + "</p></td></tr>");
		} else if (messageRows.senderStatus === 'partner') {
			messageRows.time_message = messageRows.time_message + ' / 안 읽음';
			$("#counseling_chat_").append("<tr><td class='chat_log_p'><table class='chat_log_p_'><tr><td style='padding:16px 12px;'> " + MessageText + " </td></tr></table><div id='p_circle'></div><p class='p_p'>" + messageRows.time_message + "</p></td></tr>");
		} else if (messageRows.senderStatus === 'trost') {
			$("#counseling_chat_").append("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + MessageText + "</td></tr></table></td></tr>");
		}

		ChangeDivScroll();
	});

	socket.on('messageTyping', function () {
		if ($("#typingID").length < 1) {
			$("#counseling_chat_").append("<tr id='typingID'><td class='chat_log_c'><img src='/assets/img/texttime_icon.png' class='c_profile_img'/><span class='c_profile_name'>" + clientName + "</span><table class='chat_log_c_'><tr><td style='padding:16px 12px;'> 작성 중 <img src='/assets/img/of_texttime/write_loading.gif' style='vertical-align:middle;margin-left:5px;width:33px;'/> </td></tr></table><p class='c_p'></p></td></tr>");
			ChangeDivScroll();

			$.each($(".p_p").toArray(), function(key, newMessage) {
				var string = $(this).text();
				var newString = string.toString().split('/');
				$(this).text(newString[0] + " / 읽음");
			});
		}
	});

	socket.on('messageStopTyping', function () {
		$("#typingID").remove();
	});
	/**/

	$('#send').click(function() {
		var MessageText = $("#messageSendBox").html();

		if (MessageText == "") {
			alert("상담 메세지를 입력해주세요.");
			return false;
		}

		// 이모티콘 치환.
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion1.png" style="height:20px;vertical-align:bottom;">').join('[감동]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion2.png" style="height:20px;vertical-align:bottom;">').join('[화남]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion4.png" style="height:20px;vertical-align:bottom;">').join('[공포]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion3.png" style="height:20px;vertical-align:bottom;">').join('[고마움]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion5.png" style="height:20px;vertical-align:bottom;">').join('[궁금]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion6.png" style="height:20px;vertical-align:bottom;">').join('[기쁨]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion7.png" style="height:20px;vertical-align:bottom;">').join('[놀람]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion8.png" style="height:20px;vertical-align:bottom;">').join('[슬픔]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion9.png" style="height:20px;vertical-align:bottom;">').join('[사랑]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion10.png" style="height:20px;vertical-align:bottom;">').join('[눈물]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion11.png" style="height:20px;vertical-align:bottom;">').join('[안녕]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion12.png" style="height:20px;vertical-align:bottom;">').join('[잘자]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion13.png" style="height:20px;vertical-align:bottom;">').join('[최고]');
		MessageText = MessageText.split('<img src="/assets/img/of_emotion/emotion14.png" style="height:20px;vertical-align:bottom;">').join('[쿨쿨]');

		$("#messageSendBox").html('');
		$("#messageSendBox").css('height', '65px');

		emotion_tab_hide();

		MessageText = strip_tags(MessageText, '<br/><br>&nbsp;');
		MessageText = MessageText.replace(/&gt;/ig, ">"); // >
		MessageText = MessageText.replace(/&lt;/ig, "<"); // <
		MessageText = MessageText.replace(/<br>/ig, "\n"); // <br>을 엔터로 변경
		MessageText = MessageText.replace(/&nbsp;/ig, " "); // 공백

		socket.emit('sendMessage', counselingNo, MessageText, 'partner', 'pc');

		if (statusTyping === 1) {
			socket.emit('messageStopTyping');
			statusTyping = 0;
		}
	});

	$($("#chatLog")).scroll(function(){
		if (msgContent.scrollTop() == 0) {
			if ((loadLastMsgNo === 1) || (loadLastMsgNo === 0)) {
				return false;
			} else {
				socket.emit('loadOldMessage', 'partner', clientID, partnerID, counselingNo, loadLastMsgNo);
				scrollMsgLoad = 1;
			}
		}
	});

	$("#MoreMessage").click(function(){
		if ((loadLastMsgNo === 1) || (loadLastMsgNo === 0)) {
			return false;
		} else {
			socket.emit('loadOldMessage', 'partner', clientID, partnerID, counselingNo, loadLastMsgNo);
			scrollMsgLoad = 1;
		}
	});

	// 이모티콘 목록 박스 닫기.
	function emotion_tab_hide() {
		$("#emotion_box").fadeOut();
		$("#emotion_tab").prop('src', '/assets/img/of_emotion/emotion_off.png');
	}

	function strip_tags (input, allowed) {
		var allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)

		var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
			commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
			return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
		});
	}

	/*
	* [메세지 작성 중(1), 작성 중지(0) 기능]
	*/
	$('#messageSendBox').bind("DOMSubtreeModified", function(){
		var tmpMessage = String ($('#messageSendBox').html());

		if (tmpMessage.length >= 5) {

			if (statusTyping === 0) {
				socket.emit('messageTyping');
				statusTyping = 1;
			}

			if (statusTyping === 1) {
				setTimeout(function(){
					if (((tmpMessage == $('#messageSendBox').html()) || ($('#messageSendBox').html().length < 5)) && (statusTyping !== 0)) {
						socket.emit('messageStopTyping');
						statusTyping = 0;
					}
				}, 2000);
			}
		}

	});
	/**/

	$(document).ready(function() {

		// 상담 시작
		$(".therapyStart").click(function(){

			var count = $(".therapyCount").val();

			if (checkTherapyState == 'Y') {
				alert("이미 실시간 상담이 진행되고 있습니다.");
			} else {

				if ((counselingNo === '') || (count === '')) {
					alert("먼저 상담 시간을 선택해주세요.");
				} else {

					var retSys = confirm("선택한 시간만큼 실시간 상담 횟수가 차감됩니다.\n실시간 상담을 시작하시겠습니까?");

					if (retSys) {

						$.ajax({
							url: "/oauth/counseling/texttime/reservation/",
							type: "POST",
							cache: false,
							timeout : 30000,
							contentType: "application/json; charset=UTF-8",
							dataType: "json",
							data: JSON.stringify(
								{
									"type":"start",
									"roomNumber": counselingNo,
									"count":count,
									"userType":usertype
								}
							),
							success: function(data) {
								if (data.result == 'Y') {
									alert(data.msg);
									window.location.reload(true);
								} else {
									alert(data.msg);
								}
							}
						});

					}

				}

			}

		});

		// 상담 종료
		$(".therapyFinish").click(function(){

			if (checkTherapyState === 'Y') {

				var retSys = confirm("진행 중인 실시간 상담이 종료되며 실시간 상담 횟수가 차감됩니다. 종료하시겠습니까?");

				if (retSys) {

					if (counselingNo === '') {
						alert("상담 정보 가져오기에 실패했습니다, 다시 시도해주세요.");
						window.location.reload(true);
					} else {

						$.ajax({
							url: "/oauth/counseling/texttime/reservation/",
							type: "POST",
							cache: false,
							timeout : 30000,
							contentType: "application/json; charset=UTF-8",
							dataType: "json",
							data: JSON.stringify(
								{
									"type":"finish",
									"roomNumber": counselingNo,
									"userType":usertype
								}
							),
							success: function(data) {
								if (data.result == 'Y') {
									alert(data.msg);
									window.location.reload(true);
								} else {
									alert(data.msg);
								}
							}
						});

					}

				}

			} else {
				alert("시작된 상담이 없습니다.");
			}

		});

		// 상담 취소
		$(".therapyCancel").click(function(){

			if (counselingNo === '') {
				alert("상담 정보 가져오기에 실패했습니다, 다시 시도해주세요.");
				window.location.reload(true);
			} else {

				var retSys = confirm("진행 중인 실시간 상담이 취소되며,\n실시간 상담 횟수가 차감되지 않습니다.\n실시간 상담을 취소하시겠습니까?");

				if (retSys) {

					$.ajax({
						url: "/oauth/counseling/texttime/reservation/",
						type: "POST",
						cache: false,
						timeout : 30000,
						contentType: "application/json; charset=UTF-8",
						dataType: "json",
						data: JSON.stringify(
							{
								"type":"cancel",
								"roomNumber": counselingNo,
								"userType":usertype
							}
						),
						success: function(data) {
							if (data.result == 'Y') {
								alert(data.msg);
								window.location.reload(true);
							} else {
								alert(data.msg);
							}
						}
					});

				}

			}

		});

		// 실시간 상담 예약.
		// $(".modifyChange").click(function(){
		//
		// 	var bookingDate = $(".modifyScheduleDate").val();
		// 	var bookingTime = $("#modifySchedule_timeFrom").val() + ":" + $("#modifySchedule_timeto").val();
		// 	var count = $("#modifySchedule_plan").val();
		//
		// 	if ((bookingDate === '') || ($("#modifySchedule_timeFrom").val() === '') || ($("#modifySchedule_timeto").val() === '') || ($("#modifySchedule_plan").val() === '')) {
		// 		alert("실시간 상담 예약 시간을 정확히 입력해주세요.");
		// 	} else {
		//
		// 		$.ajax({
		// 			url: "/oauth/counseling/texttime/reservation/",
		// 			type: "POST",
		// 			timeout : 30000,
		// 			contentType: "application/json; charset=UTF-8",
		// 			dataType: "json",
		// 			data: JSON.stringify(
		// 				{
		// 					"type":"reservation",
		// 					"roomNumber":counselingNo,
		// 					"bookingDate":bookingDate,
		// 					"bookingTime":bookingTime,
		// 					"count":count,
		// 					"userType":usertype
		// 				}
		// 			),
		// 			success: function(data) {
		// 				if (data.result == 'Y') {
		// 					alert(data.msg);
		//
		// 					var rhours = $("#modifySchedule_timeFrom option:selected").val();
		//
		// 					if (rhours > 12) {
		// 						rhours = rhours - 12;
		// 						rhours = 'PM ' + rhours
		// 					} else {
		// 						rhours = 'AM ' + rhours;
		// 					}
		//
		// 					window.location.reload(true);
		//
		// 				} else {
		// 					alert(data.msg);
		// 				}
		// 			}
		// 		});
		//
		// 	}
		//
		// });

		if (payment === 'Y') {

			$.ajax({
				url: '/oauth/counseling/texttime/reservation/',
				type: 'POST',
				timeout : 20000,
				contentType: 'application/json; charset=UTF-8',
				dataType: 'json',
				data: JSON.stringify(
					{
						"type": "refresh",
						"roomNumber": counselingNo,
						"userType": usertype
					}
				),
				success: function(data) {
					if (data.result == 'Y') {
						$(".therapyCancel").css('display', 'inline-block');
						$(".therapyStart").css('display', 'none');
						$("#therayCountSelect").css('display', 'none');

						checkTherapyState = 'Y';

						if (data.timer !== 0) {
							$("#therapyInfo").css('display', '');
							countdown("therapyTimer", 0, data.timer);
						}
					}
				}
			});

		}

		$("#messageSendBox").bind('paste',function(e){
			var el = $(this);
			setTimeout(function(){
				var text = $(el).html();

				text = strip_tags(text);
				text = text.replace(/&nbsp;/ig, " ");

				$("#messageSendBox").html(text);
			}, 100);
		});

	});

	function countdown (elementName, minutes, seconds) {
		var element, endTime, hours, mins, msLeft, time;

		function twoDigits (n) {
			return (n <= 9 ? "0" + n : n);
		}

		function updateTimer () {
			msLeft = endTime - (+new Date);
			console.log(msLeft);

			if (msLeft < 1000) {
				element.innerHTML = "00:00";

				$.ajax({
					url: "/oauth/counseling/texttime/reservation/",
					type: "POST",
					timeout : 1500,
					contentType: "application/json; charset=UTF-8",
					dataType: "json",
					data: JSON.stringify(
						{
							"type": "timeout",
							"roomNumber": counselingNo,
							"userType": usertype
						}
					),
					success: function(data) {
						if (data.result == 'Y') {
							alert("상담 시간이 종료되었습니다. 상담을 마무리하고, '종료' 버튼을 눌러주세요.");
							element.innerHTML = '<span class="exit">상담 종료</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00:00';
						} else {
							alert(data.msg);
						}
					}
				});

			} else {
				time = new Date(msLeft);
				hours = time.getUTCHours();
				mins = time.getUTCMinutes();
				element.innerHTML = '<span class="ing">상담 진행 중</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());
				setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
			}
		}

		element = document.getElementById(elementName);
		endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
		updateTimer();
	}
