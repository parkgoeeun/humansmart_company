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
	* 고정 메뉴 관련 스크립트.
	**********************************************/
	var counselingMenu1 = "#counseling_menu_1";
	var counselingMenu2 = "#counseling_menu_2";
	var counselingMenu5 = "#counseling_menu_5";
	var counselingMenu6 = "#counseling_menu_6";

	function menuInit() {
		$(counselingMenu1).attr('src', '/assets/img/of_texttime/menuPartner.png');
		$(counselingMenu2).attr('src', '/assets/img/of_texttime/menuHistory.png');
		$(counselingMenu5).attr('src', '/assets/img/of_texttime/menuFaq.png');
		$(counselingMenu6).attr('src', '/assets/img/of_texttime/menuInfo.png');
	}

	$(counselingMenu6).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuInfo_.png');

		$("#mypage_page6").css("display", "block");
		$("#mypage_page1, #mypage_page2, #mypage_page4, #mypage_page3, #mypage_page5").css("display", "none");
	});

	$(counselingMenu1).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuPartner_.png');

		$("#mypage_page1").css("display", "block");
		$("#mypage_page2, #mypage_page3, #mypage_page4, #mypage_page5, #mypage_page6").css("display", "none");
	});

	$(counselingMenu2).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuHistory_.png');

		$("#mypage_page2").css("display", "block");
		$("#mypage_page1, #mypage_page3, #mypage_page4, #mypage_page5, #mypage_page6").css("display", "none");
	});

	$(counselingMenu5).click(function(){
		menuInit();
		$(this).attr('src', '/assets/img/of_texttime/menuFaq_.png');

		$("#mypage_page5").css("display", "block");
		$("#mypage_page1, #mypage_page2, #mypage_page4, #mypage_page3, #mypage_page6").css("display", "none");
	});
	/*********************************************/

	$(window).on('resize',function(){
		// 사이드 메뉴 가로 길이 설정
		var sideMenuWidth = ($("#counseling_profile").width() + 0.5) + 'px';
		$("#counseling_menu").css("left", sideMenuWidth);
	});

	$(document).ready(function() {

		$(counselingMenu6).click();

		// 사이드 메뉴 가로 길이 설정
		var sideMenuWidth = ($("#counseling_profile").width() + 0.5) + 'px';
		$("#counseling_menu").css("left", sideMenuWidth);

		$("#mypage_page6").css("display", "block");
		$("#mypage_page1, #mypage_page2, #mypage_page4, #mypage_page3, #mypage_page5").css("display", "none");

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

		// 이모티콘 목록 박스 닫기.
		function emotion_tab_hide() {
			$("#emotion_box").fadeOut();
			$("#emotion_tab").prop('src', '/assets/img/of_emotion/emotion_off.png');
		}

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

		$('#openAddItemCount').click(function(){
			$('.opacityBg').fadeIn();
			$('.addItemCountPopup').fadeIn();
		});

		$("#closeAddTab").click(function(){
			$(".addItemCount").fadeOut();
		});

		$("#closeAddPopup").click(function(){
			$(".addItemCountPopup, .opacityBg").fadeOut();
		});

		/*
		* 메세지 복사/붙여쓰기 시 태그/공백 제거.
		*/
		$("#messageSendBox").bind('paste',function(e){
			var el = $(this);
			setTimeout(function(){
				var text = $(el).html();

				text = strip_tags(text);
				text = text.replace(/&nbsp;/ig, " "); // 공백

				$("#messageSendBox").html(text);
			},100);
		});
		/**/

		/*
		* 첫 상담 진행 시 상담 동의서 체크.
		* 동의 완료 후에 `connectSocketio();` 진행.
		*/
		if (counselingTerms !== 'Y') {
			$(".counselingAgree").fadeIn();
			$(".opacityBg").fadeIn();
		} else {
			connectSocketio();
		}

		$(".agreebtn").click(function(){
			if ($('.counseling_terms').is(":checked") === true) {

				$.ajax({
					url: "/oauth/config/terms/",
					type: "POST",
					cache: false,
					timeout : 30000,
					contentType: "application/json; charset=UTF-8",
					dataType: "json",
					data: JSON.stringify(
						{
							"type":"counseling",
							"id":clientID
						}
					),
					success: function(data) {
						if (data.result == 'Y') {
							$(".counselingAgree").fadeOut();
							$(".opacityBg").fadeOut();

							connectSocketio();
						} else {
							alert(data.msg);
						}
					}
				});

			} else {
				alert('동의하신다면 위 체크 박스에 체크 부탁드립니다.');
			}
		});
		/**/

		/*
		* 상담 종료 후 상담 추천 여부 작성.
		* 추천 여부만 체크하고 후기를 작성하지 않는 경우를 잡기 위해 추천 여부 체크 시 바로 데이터 전송.
		*/
		// $("input:radio[name=isRecommand]").change(function(){
		// 	var isRecommandChecked = $("input:radio[name=isRecommand]:checked").val();
		//
		// 	if ((isRecommandChecked == 'Y') || (isRecommandChecked == 'N')) {
		// 		$.ajax({
		// 			url: "/oauth/user/review/",
		// 			type: "POST",
		// 			cache: false,
		// 			timeout : 30000,
		// 			contentType: "application/json; charset=UTF-8",
		// 			dataType: "json",
		// 			data: JSON.stringify(
		// 				{
		// 					"type": "texttime",
		// 					"client": clientID,
		// 					"isRecommended": isRecommandChecked,
		// 					"content": "",
		// 					"partnerID": partnerID,
		// 					"device":"WEB"
		// 				}
		// 			)
		// 		});
		// 	}
		// });
		/**/

		/*
		* 상담 종료 후 후기 작성.
		*/

		$("#sendReview").click(function()
		{
			if (!$("#textReview").val()) {
				alert("상담 후기를 작성해주세요.");
				return false;
			} else {

				var isRecommended = String ('');

				if (!$(".writeReview button.selectRecommend.select").attr('id')) {
					alert("상담을 평가해주세요.");
					return false;
				} else {
					if ($(".writeReview button.selectRecommend.select").attr('id') == '1') {
						isRecommended = 'Great';
					} else if ($(".writeReview button.selectRecommend.select").attr('id') == '2') {
						isRecommended = 'Good';
					} else if ($(".writeReview button.selectRecommend.select").attr('id') == '3') {
						isRecommended = 'Bad';
					}
				}

				$.ajax({
					url: "/oauth/user/review/",
					type: "POST",
					cache: false,
					timeout : 30000,
					contentType: "application/json; charset=UTF-8",
					dataType: "json",
					data: JSON.stringify(
						{
							"type": "texttime",
							"client": clientID,
							"partner": partnerID,
							"content": $("#textReview").val(),
							"isRecommended": isRecommended,
							"device": "WEB",
							"counselingItem": counselingItems
						}
					),success: function(data) {
						if (data.result == 'Y') {
							alert("성공적으로 리뷰가 등록되었습니다, 감사합니다.");
							reviewWriteStatus = 'Y';
						} else {
							alert("리뷰를 작성하지 못했습니다, 다시 시도해주세요");
						}
					}
				});

			}
		});
		/**/

		/*
		* 상담 종료 후 돌아가기 기능.
		*/
		$(".paymentAgain").click(function(){
			if (reviewWriteStatus === 'Y') {
				location.href = "/service/counseling/";
			} else {
				alert("리뷰를 먼저 작성해주세요.");
			}
		});

		$(".afterFinish").click(function(){
			if (reviewWriteStatus === 'Y') {
				location.href = "/service/counseling/major/chkMajor.php?process=afterFinish&noRoom=" + counselingNo + "&partner=cordpartner01";
			} else {
				alert("리뷰를 먼저 작성해주세요.");
			}
		});
		/**/

	});

	/*
	* Socket.io 이벤트 등록.
	*/
	function connectSocketio ()
	{

		if ((location.host === 'trost.co.kr') || (location.host === 'www.trost.co.kr')) {
			socket = io.connect('https://trost.co.kr:8763');
		} else if ((location.host === 'localhost:8888') || (location.host === 'www.localhost:8888')) {
			socket = io.connect('http://localhost:8763');
		} else {
			socket = io.connect('http://' + location.host + ':8763');
		}

		socket.on('connect', function()
		{
			$(".loader").css('display', 'block');
			$(".opacityBg").css('display', 'block');

			socket.emit('enterCounseling', 'client', clientID, partnerID, counselingNo, 'pc');
		});

		/*
		* 첫 시스템 메세지 애니메이션.
		*/
		if (historyClientNo === 0)
		{
			$(".b_send").css('display', 'none');

			socket.on('loadMessage', function (messageRows) {

				$(".loader").css('display', 'none');
				$(".opacityBg").css('display', 'none');

				messageRows[0].log = messageRows[0].log.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
				messageRows[0].log = retImoji(messageRows[0].log);

				messageRows[1].log = messageRows[1].log.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
				messageRows[1].log = retImoji(messageRows[1].log);

				$("#counseling_chat_").append("<tr class='sysMsgAnimation'><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td> <img src='/assets/img/of_texttime/write_loading.gif' style='vertical-align:middle;margin-left:5px;width:33px;'/> </td></tr></table></td></tr>");

				setTimeout(function(){
					$(".sysMsgAnimation").css('display', 'none');

					if (messageRows[0].log_from === 'trost') {
						$("#counseling_chat_").append("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + messageRows[0].log + "</td></tr></table></td></tr>");
					}

					$("#counseling_chat_").append("<tr class='sysMsgAnimation'><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td> <img src='/assets/img/of_texttime/write_loading.gif' style='vertical-align:middle;margin-left:5px;width:33px;'/> </td></tr></table></td></tr>");

					setTimeout(function(){
						$(".sysMsgAnimation").css('display', 'none');

						if (messageRows[1].log_from === 'trost') {
							$("#counseling_chat_").append("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + messageRows[1].log + "</td></tr></table></td></tr>");
						}
					}, 3000);

				}, 2000);

				/*
				* 시스템 메세지 이후 메세지 출력.
				*/
				setTimeout(function(){

					loadLastMsgNo = messageRows[0].no;

					$.each(messageRows, function(key, value) {

						var MessageText = value.log;

						MessageText = value.log.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
						MessageText = retImoji(MessageText);

						if (value.no > 2) {
							if (value.log_from === 'client') {
								$("#counseling_chat_").append("<tr><td class='chat_log_p'><table class='chat_log_p_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><div id='p_circle'></div><p class='p_p'>" + value.time_message + "</p></td></tr>");
							} else if (value.log_from === 'partner') {
								$("#counseling_chat_").append("<tr><td class='chat_log_c'><img src='/assets/img/of_partner/" + partnerImg + "_.png' class='p_profile_img'/><span class='p_profile_name'>" + partnerName + "</span><table class='chat_log_c_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><p class='c_p'>" + value.time_message + "</p></td></tr>");
							} else if (value.log_from === 'trost') {
								$("#counseling_chat_").append("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + MessageText + "</td></tr></table></td></tr>");
							}
						}

						// if (!scrollMsgLoad) {
						// 	ChangeDivScroll();
						// }
						$(".b_send").css('display', '');
					});

				}, 5600);
				/**/

			});

		} else {

			socket.on('loadMessage', function (messageRows) {

				$(".loader").css('display', 'none');
				$(".opacityBg").css('display', 'none');

				messageRows.reverse();

				$.each(messageRows, function(key, value) {

					var MessageText = value.log;

					MessageText = value.log.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
					MessageText = retImoji(MessageText);

					partnerName = partnerName.replace(' 상담사', '<br/>상담사');

					if (value.log_from === 'client') {
						$("#counseling_chat_").prepend("<tr><td class='chat_log_p'><table class='chat_log_p_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><div id='p_circle'></div><p class='p_p'>" + value.time_message + "</p></td></tr>");
					} else if (value.log_from === 'partner') {
						$("#counseling_chat_").prepend("<tr><td class='chat_log_c'><img src='/assets/img/of_partner/" + partnerImg + "_.png' class='p_profile_img'/><span class='p_profile_name'>" + partnerName + "</span><table class='chat_log_c_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><p class='c_p'>" + value.time_message + "</p></td></tr>");
					} else if (value.log_from === 'trost') {
						$("#counseling_chat_").prepend("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + MessageText + "</td></tr></table></td></tr>");
					}

					loadLastMsgNo = value.no;

					if (!scrollMsgLoad) {
						ChangeDivScroll();
					}
				});
			});

		}
		/**/

		socket.on('loadNewMessage', function (messageRows) {

			var MessageText = messageRows.message;

			MessageText = messageRows.message.replace(/(\r\n|\n\r|\r|\n)/g, "<br/>");
			MessageText = retImoji(MessageText);

			if ((messageRows.senderName !== '트로스트') && (messageRows.senderName !== '트로스트')) {
				messageRows.senderName = messageRows.senderName + ' 상담사';
			}

			if (messageRows.senderStatus === 'client') {
				$("#counseling_chat_").append("<tr><td class='chat_log_p'><table class='chat_log_p_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><div id='p_circle'></div><p class='p_p'>" + messageRows.time_message + "</p></td></tr>");
			} else if (messageRows.senderStatus === 'partner') {
				$("#counseling_chat_").append("<tr><td class='chat_log_c'><img src='/assets/img/of_partner/" + messageRows.senderImg + "_.png' class='p_profile_img'/><span class='p_profile_name'>" + messageRows.senderName + "</span><table class='chat_log_c_'><tr><td style='padding:17px 13px;'>" + MessageText + "</td></tr></table><p class='c_p'>" + messageRows.time_message + "</p></td></tr>");
			} else if (messageRows.senderStatus === 'trost') {
				$("#counseling_chat_").append("<tr><td class='chat_log_tc'><table class='chat_log_tc_'><tr><td>" + MessageText + "</td></tr></table></td></tr>");
			}

			ChangeDivScroll();
		});

		socket.on('messageTyping', function () {
			if ($("#typingID").length < 1) {
				$("#counseling_chat_").append("<tr id='typingID'><td class='chat_log_c'><img src='/assets/img/of_partner/" + partnerImg + "_.png' class='p_profile_img'/><span class='p_profile_name'>" + partnerName + "</span><table class='chat_log_c_'><tr><td style='padding:17px 13px;'> 작성 중 <img src='/assets/img/of_texttime/write_loading.gif' style='vertical-align:middle;margin-left:5px;width:33px;'/> </td></tr></table><p class='c_p'></p></td></tr>");
				ChangeDivScroll();
			}
		});

		socket.on('messageStopTyping', function () {
			$("#typingID").remove();
		});
	}
	/**/

	$('#send').click( function() {
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
		MessageText = MessageText.replace(/<br>/ig, "\n"); // <br>을 엔터로 변경
		MessageText = MessageText.replace(/&nbsp;/ig, " "); // 공백

		socket.emit('sendMessage', counselingNo, MessageText, 'client', 'pc');

		if (statusTyping === 1) {
			socket.emit('messageStopTyping');
			statusTyping = 0;
		}
	});

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

	// 이모티콘 치환.
	function retImoji (MessageText) {
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

	$($("#chatLog")).scroll(function(){
		if (msgContent.scrollTop() == 0) {
			if ((loadLastMsgNo === 1) || (loadLastMsgNo === 0) || (historyClientNo === 0)) {
				return false;
			} else {
				socket.emit('loadOldMessage', 'client', clientID, partnerID, counselingNo, loadLastMsgNo);
				scrollMsgLoad = 1;
			}
		}
	});

	$("#MoreMessage").click(function(){
		if ((loadLastMsgNo === 1) || (loadLastMsgNo === 0) || (historyClientNo === 0)) {
			return false;
		} else {
			socket.emit('loadOldMessage', 'client', clientID, partnerID, counselingNo, loadLastMsgNo);
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
