$(function() {

	if (linkType === 'history') {

		/*
		* linkType => 'history'
		* 상담 내역.
		*/

		$(".menuHistoryNow").click(function(){
			$("#historyNow").css('display', '');
			$("#historyLog").css('display', 'none');
		});

		$(".menuHistoryLog").click(function(){
			$("#historyNow").css('display', 'none');
			$("#historyLog").css('display', '');
		});

		$('#orderHistoryCounseling').data('options', $('#orderHistoryCounseling option'));
		historyDateLength = $('#orderHistoryCounting option').length;

		$('#orderHistoryCounting option').css('display', '');

		for (var countV = 0; countV <= historyDateLength; countV++) {

			if ($('#orderHistoryCounting option:eq(' + countV + ')').val() != $('#orderHistoryCounseling option:selected').val()) {
				$('#orderHistoryCounting option:eq(' + countV + ')').css('display', 'none');
			}

		}

		$('#orderHistoryCounseling').change(function(){
			$('#orderHistoryCounting option').css('display', '');

			if ($('#orderHistoryCounseling option:selected').val() == 'All') {

				ajax_request('/oauth/counseling/texttime/history/index.php?no=' + counselingNo + '&status=' + userStatus);

			} else {

				for (var countV = 0; countV <= historyDateLength; countV++) {

					if ($('#orderHistoryCounting option:eq(' + countV + ')').val() != $('#orderHistoryCounseling option:selected').val()) {
						if ($('#orderHistoryCounting option:eq(' + countV + ')').val() != 'All') {
							$('#orderHistoryCounting option:eq(' + countV + ')').css('display', 'none');
						}
					}

				}

			}


		});

		$('#orderHistoryCounting').change(function(){

			var splitString = $('#orderHistoryCounting option:selected').html();
			var splitdate = splitString.split(' - ');

			if ($('#orderHistoryCounting option:selected').val() == 'All') {

				var splitString = $('#orderHistoryCounting option:eq(1)').html();
				var splitdate = splitString.split(' - ');

				var lastString = $('#orderHistoryCounting option:eq(' + (historyDateLength - 1) + ')').html();
				var lastDate = lastString.split(' - ');

				ajax_request('/oauth/counseling/texttime/history/index.php?no=' + counselingNo + '&status=' + userStatus + '&from=' + splitdate[0] + '&to=' + lastDate[0]);

			} else {

				var splitString = $('#orderHistoryCounting option:selected').html();
				var splitdate = splitString.split(' - ');

				ajax_request('/oauth/counseling/texttime/history/index.php?no=' + counselingNo + '&status=' + userStatus + '&from=' + splitdate[0] + '&to=' + splitdate[0]);

			}

		});

	} else if (linkType === 'schedule') {

		/*
		* linkType => 'schedule'
		* 실시간 상담 예약 내역.
		*/

		// 날짜 선택
		$("#datepicker1, #datepicker2").datepicker({
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			yearSuffix: '년'
		});

		// 조회 날짜 변경 시
		$("#datepicker1, #datepicker2").change(function(){

			if (($('#datepicker1').val() == "") || ($('#datepicker2').val() == "")) {
				$(".subject").css('display', '');
				$(".content").css('display', '');
			} else {
				$(".content").css('display','none');

				var textValue = $(".content[name]");

				if (userStatus === 'client') {

					for (var i = 0; i < textValue.length; i++) {

						var textValueDate = $(textValue[i]).attr('name');

						if (textValueDate >= $('#datepicker1').val()) {
							if (textValueDate <= $('#datepicker2').val()) {
								$(textValue[i]).css('display', '');
							}
						}

					}

				} else {

					for (var i = 0; i < textValue.length; i++) {

						var textValueDate = $(textValue[i]).attr('name').split('/');

						if (textValueDate[1] >= $('#datepicker1').val()) {
							if (textValueDate[1] <= $('#datepicker2').val()) {
								$(textValue[i]).css('display', '');
							}
						}

					}
				}

			}

		});

	} else {

		/*
		* linkType => ''
		* 내 정보.
		*/

		if (signType === 'NORMAL') {
			$("p.tab_pw").css('display', 'block');
		}

		$("#withdrawalPopBtn").click(function(){
			$(".opacityBg").fadeIn();
			$(".withdrawalAgree").fadeIn();
		});

		$(".withdrawalAgree img").click(function(){
				$(".withdrawalAgree").fadeOut();
				$(".opacityBg").fadeOut();
		});

		$(".withdrawalAgree .withdrawalBtn").click(function(){

			if ($("input[type=checkbox][name=withdrawal_terms]").is(":checked")) {

				if (signType === 'NORMAL') {
					var userPW = $("input[type=password][name=user_pw]").val();

					if (!userPW) {
						alert("기존 패스워드를 입력해주세요.");
						return false;
					}
				} else {
					var userPW = '';
				}

				$.ajax({
					url: "/oauth/sign/",
					type: "POST",
					cache: false,
					timeout : 30000,
					contentType: "application/json; charset=UTF-8",
					dataType: "json",
					data: JSON.stringify(
						{
							"id":userID,
							"pw":userPW,
							"type":"withdrawal"
						}
					),
					success: function(data) {
						if (data.result == 'Y') {
							alert(data.msg);
							location.href = '/auth/sign_out.php';
						} else {
							alert(data.msg);
						}
					}
				});
			} else {
				alert("탈퇴 여부에 동의해주세요.");
				return false;
			}

		});

	}
});

function ajax_request(url){
	// 지난 상담 내용 조회

	var xhr = new XMLHttpRequest();
	xhr.open('get', url);

	xhr.onreadystatechange = function(){
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				$(".log").html(xhr.responseText);
			}
		}
	}

	xhr.send();
}

function filter () {
	// '내담자 이름으로 검색' 기능

	if ($('#txtFilter').val() == "") {
		$(".subject").css('display', '');
		$(".content").css('display', '');
	} else {
		$(".content").css('display','none');
		$(".content[name*='" + $('#txtFilter').val() + "']").css('display','');
	}

	return false;
}

$('#orderCounseling').change(function(){

	if ($('#orderCounseling').val() == 5) {
		$(".content").css('display','');
		return false;
	}

	var date = new Date();

	var dateMonth = date.getUTCMonth() + 1;
	var dateDay = date.getUTCDate();

	if (dateMonth < 10) dateMonth = "0" + dateMonth;
	if (dateDay < 10) dateDay = "0" + dateDay;

	var FromDate = date.getUTCFullYear() + "-" + dateMonth + "-" + dateDay;

	if ($('#orderCounseling').val() == 3) var seven = date.setDate(date.getUTCDate() + 7);
	if ($('#orderCounseling').val() == 4) var month = date.setDate(date.getUTCDate() + 30);


	dateMonth = date.getUTCMonth() + 1;
	dateDay = date.getUTCDate();

	if (dateMonth < 10) dateMonth = "0" + dateMonth;
	if (dateDay < 10) dateDay = "0" + dateDay;

	var toDate = date.getUTCFullYear() + "-" + dateMonth + "-" + dateDay;

	$("#datepicker1").val(FromDate);
	$("#datepicker2").val(toDate);
	$("#datepicker1, #datepicker2").change();

});

function detailMode (numberOfRoom) {

	var form_data = {
		ModeNumber: numberOfRoom
	};

	$.ajax({
		type: "POST",
		url: "detailMode.php",
		data: form_data,
		success: function(data) {
			$("#historyLog").html(data);
		}
	});

}

// 실시간 상담 예약 변경 일자 선택
function changeDate (date) {
	$(".changeSchedule_date").val(date);
}

// '이전 화면으로 돌아가기' / '취소하기'
$(".cancelChange").click(function(){
	// 이전 화면으로 돌아가기
	$("#changeSchedule").fadeOut();
	$(".changeDate").val("");
	$(".alterDate").val("");
	$("#SchedulePrelist").val("");

	// 취소하기
	$("#modifySchedule").fadeOut();
	$(".alterDate1").val("");
	$(".alterDate2").val("");
	$(".alterDate3").val("");
	$("#SchedulePrelist1").val("");
	$("#SchedulePrelist2").val("");
	$("#SchedulePrelist3").val("");

	// 배경 투명도
	$(".opacityBg").fadeOut();

	$(".numberOfRoom").val("");
	$(".changeSchedule_date").val("");
	$("#changeSchedule_timeFrom").val("");
	$("#changeSchedule_timeto").val("");
	$("#changeSchedule_plan").val("");
});

/*****************************************
* 실시간 상담 예약 변경 요청 관련
*****************************************/
// 실시간 상담 예약 시간 등록 및 탭 열기
function modifySchedule (scheduleDate, timeFrom, timeCount, numberOfRoom, name) {

	if (timeCount == 1800) timeCount = ', 1회(30분)';
	else if (timeCount == 3600) timeCount = ', 2회(60분)';
	else if (timeCount == 5400) timeCount = ', 3회(90분)';
	else if (timeCount == 7200) timeCount = ', 4회(120분)';
	else timeCount = '';

	$("#modifySchedule .changeTimeTitle").html(name + "님과의 실시간 상담 예약 변경 요청");
	$("#modifySchedule .originalSchedule").html("기존 실시간 상담 예약 시간 : " + scheduleDate + " " + timeFrom + timeCount);
	$("#modifySchedule .numberOfRoom").val(numberOfRoom);

	$("#modifySchedule").fadeIn();
	$(".opacityBg").fadeIn();
}

// 실시간 상담 예약 변경 시간 작성
$("#modifySchedule .AddSchedule").click(function(){

	var date = $("#modifySchedule .changeSchedule_date").val();
	var timeFrom = $("#modifySchedule #changeSchedule_timeFrom").val();
	var timeTo = $("#modifySchedule #changeSchedule_timeto").val();
	var timeCount = $("#modifySchedule #changeSchedule_plan").val();

	if ((date === '') || (timeFrom === '') || (timeTo === '') || (timeCount === '')) {
		alert("모든 일정을 채워주시길 바랍니다.");
	} else {

		var dateDay = date.split("-");

		for (var i = 1; i <= 3; i++) {

			if ($("#modifySchedule #SchedulePrelist" + i).val() == '') {
				$("#modifySchedule #SchedulePrelist" + i).val(i + "순위: " + dateDay[0] + "년 " + dateDay[1] + "월 " + dateDay[2] + "일 " + timeFrom + "시 " + timeTo + "분 / " + timeCount + "분");
				$("#modifySchedule .alterDate" + i).val(dateDay[0] + "년 " + dateDay[1] + "월 " + dateDay[2] + "일 " + timeFrom + "시 " + timeTo + "분, " + timeCount + "분");
				break;
			}

		}

	}

});

// 실시간 상담 예약 변경 시간 초기화
$("#modifySchedule .DelSchedule1").click(function(){ $("#modifySchedule #SchedulePrelist1").val(""); $("#modifySchedule .alterDate1").val(""); });
$("#modifySchedule .DelSchedule2").click(function(){ $("#modifySchedule #SchedulePrelist2").val(""); $("#modifySchedule .alterDate2").val(""); });
$("#modifySchedule .DelSchedule3").click(function(){ $("#modifySchedule #SchedulePrelist3").val(""); $("#modifySchedule .alterDate3").val(""); });

// 실시간 상담 예약 변경 요청
$("button.modifyChange").click(function(){

	var numberOfRoom = $("#modifySchedule .numberOfRoom").val();

	var date = $("#modifySchedule .changeSchedule_date").val();
	var timeFrom = $("#modifySchedule #changeSchedule_timeFrom").val();
	var timeTo = $("#modifySchedule #changeSchedule_timeto").val();
	var timeCount = $("#modifySchedule #changeSchedule_plan").val();

	var alterDate1 = $("#modifySchedule .alterDate1").val();
	var alterDate2 = $("#modifySchedule .alterDate2").val();
	var alterDate3 = $("#modifySchedule .alterDate3").val();

	if ((alterDate1 === '') && (alterDate2 === '') && (alterDate3 === '')) {
		alert("한 개 이상 변경 요청 일정을 작성해주세요.");
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
					"type":"userModify",
					"userType":"personal",
					"bookingDate1":alterDate1,
					"bookingDate2":alterDate2,
					"bookingDate3":alterDate3,
					"roomNumber":numberOfRoom,
					"status":userStatus
				}
			),
			success: function(data) {
				if (data.result == 'Y') {
					alert(data.msg);
					// window.location.reload(true);
					$("button.cancelChange").click();
				} else {
					alert(data.msg);
				}
			}
		});

	}

});
/****************************************/

/*****************************************
* 실시간 상담 예약 변경 확정/취소 관련
*****************************************/
// 실시간 상담 예약 시간 등록 및 탭 열기
function alterSchedule (scheduleDate, timeFrom, timeCount, numberOfRoom) {

	if (timeCount == 1800) timeCount = ', 1회(30분)';
	else if (timeCount == 3600) timeCount = ', 2회(60분)';
	else if (timeCount == 5400) timeCount = ', 3회(90분)';
	else if (timeCount == 7200) timeCount = ', 4회(120분)';
	else timeCount = '';

	$("#changeSchedule .originalSchedule").html("기존 실시간 상담 예약 시간 : " + scheduleDate + " " + timeFrom + timeCount);

	$("#changeSchedule .numberOfRoom").val(numberOfRoom);
	$("#changeSchedule .changeDate").val(scheduleDate + "|" + timeFrom);

	$("#changeSchedule").fadeIn();
	$(".opacityBg").fadeIn();
}

// 실시간 상담 예약 변경 시간 작성
$("#changeSchedule .AddSchedule").click(function(){

	var date = $("#changeSchedule .changeSchedule_date").val();
	var timeFrom = $("#changeSchedule #changeSchedule_timeFrom").val();
	var timeTo = $("#changeSchedule #changeSchedule_timeto").val();
	var timeCount = $("#changeSchedule #changeSchedule_plan").val();

	if ((date === '') || (timeFrom === '') || (timeTo === '') || (timeCount === '')) {
		alert("모든 일정을 채워주시길 바랍니다.");
	} else {

		var dateDay = date.split("-");

		// 실시간 상담 예약 시간 내용 작성
		$("#changeSchedule #SchedulePrelist").val("변경 시간: " + dateDay[0] + "년 " + dateDay[1] + "월 " + dateDay[2] + "일 " + timeFrom + "시 " + timeTo + "분 / " + timeCount + "분");

		// 실시간 상담 예약 시간 값 작성
		$("#changeSchedule .alterDate").val(date + "|" + timeFrom + ":" + timeTo);
	}

});

// 실시간 상담 예약 변경 시간 초기화
$("#changeSchedule .DelSchedule").click(function(){
	$("#changeSchedule #SchedulePrelist").val("실시간 상담 예약 변경: ");
	$("#changeSchedule .alterDate").val("");
});

// 실시간 상담 예약 변경 확정
$(".alterChange").click(function(){

	var numberOfRoom = $("#changeSchedule .numberOfRoom").val();
	var modifyDate = $("#changeSchedule .changeDate").val();

	var date = $("#changeSchedule .changeSchedule_date").val();
	var timeFrom = $("#changeSchedule #changeSchedule_timeFrom").val();
	var timeTo = $("#changeSchedule #changeSchedule_timeto").val();
	var timeCount = $("#changeSchedule #changeSchedule_plan").val()*60;

	var alterDate = $(".alterDate").val();

	if ((numberOfRoom === '') || (modifyDate === '') || (date === '') || (timeFrom === '') || (timeTo === '') || (timeCount === '') || (alterDate === '')) {
		alert("변경하려고 하는 정확한 시간을 입력해주세요.");
	} else {

		$.ajax({
			url: "/oauth/counseling/texttime/reservation/",
			type: "POST",
			cache: false,
			timeout : 30000,
			contentType: "application/json; charset=UTF-8",
			dataType: "json",
			data: JSON.stringify({
					"type":"userAlter",
					"roomNumber":numberOfRoom,
					"modifyDate":modifyDate,
					"alterCount":timeCount,
					"alterDate":alterDate,
					"alterType":"texttime",
					"userType":"personal"
			}),
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

});

// 실시간 상담 예약 취소
$(".deleteChange").click(function(){

	var numberOfRoom = $("#changeSchedule .numberOfRoom").val();
	var cancelDate = $("#changeSchedule .changeDate").val();

	if ((numberOfRoom === '') || (cancelDate === '')) {
		alert("변경하려고 하는 정확한 시간을 입력해주세요.");
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
					"type":"userCancel",
					"roomNumber":numberOfRoom,
					"cancelDate":cancelDate,
					"userType":"personal"
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

});
/****************************************/
