/****************************
* 쿠폰 조회
****************************/
$.ajax({
	url: "/oauth/counseling/texttime/ExtraModule/",
	type: "POST",
	cache: false,
	timeout : 30000,
	contentType: "application/json; charset=UTF-8",
	dataType: "json",
	data: JSON.stringify(
		{
			"ExtraModule":"coupon",
			"id":clientID,
			"type":"getCoupon"
		}
	),
	success: function(data) {
		$("#couponCountText").html(data.result.length);

		$.each(data.result, function(key, value) {

			// 텍스트/화상/전화 상담 분기 처리.
			var counselingMode = String (value.counselingMode);

			if (counselingMode.indexOf("texttime") !== -1) {

				if (value.type === 'Payment') {

					if ((partnerID !== '') && (paymentItem !== '')) {
						if (value.discountPrices.texttime.target.indexOf(paymentItem[1]) !== -1) {
							onButton = "<button class='couponSubmit True' onclick='useCoupon(\"" + value.item + "\", \"" + value.couponItem + "\", \"/service/payment/?partner=" + partnerID + "&payment=item" + paymentItem[1] + "&coupon=" + value.item + "&referer=" + value.referer + "\")'>쿠폰 사용</button>";
						} else {
							onButton = "<button class='couponSubmit False' onclick='alert(\"선택하신 쿠폰은 해당 이용권에 사용 불가능합니다.\");return false;'>쿠폰 사용</button>";
						}
					} else {
						onButton = "<button class='couponSubmit True' onclick='useCoupon(\"" + value.item + "\", \"" + value.couponItem + "\", \"/service/counseling/?partner=" + partnerID + "&payment=" + paymentItem + "&coupon=" + value.item + "&referer=" + value.referer + "\")'>쿠폰 사용</button>";
					}

					$("#couponList").append("<div class='couponPayment'><div class='couponTitle'><pre>" + value.refererTitle + "</pre><p class='couponItem'>" + value.couponItem + "</p>" + onButton + "</div><div class='couponContent'><p class='couponContent_p'>" + value.refererContent + "</p><b class='couponContent_b'>" + value.finishDate + "</b><hr class='couponContent_hr'/><p class='couponContent_p_'>" + value.refererContent_ + "</p></div></div>");

				} else if (value.type === 'ExtraService') {

					if (value.item === 'SentenceComplete') {
						onButton = "<button class='couponSubmit False' onclick='alert(\"문장완성검사는 트로스트 앱에서만 이용이 가능합니다. 스마트폰 앱스토어에서 트로스트를 검색하여 설치해주세요.\")'>쿠폰 사용</button>";
					} else {
						if (value.counselingState === 'Y') {
							onButton = "<button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 접수 상담 중에만 사용 가능합니다.\");return false;'>쿠폰 사용</button>";
						} else {
							if (value.item === 'free24') {
								if ((partnerID !== '') && (paymentItem !== '')) {
									onButton = "<button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 상담 페이지의 쿠폰함에서만 사용할 수 있습니다.\");return false;'>쿠폰 사용</button>";
								} else {
									onButton = "<button class='couponSubmit True' onclick='useCoupon(\"" + value.item + "\", \"" + value.couponItem + "\", \"/service/counseling/?partner=" + partnerID + "&payment=" + paymentItem + "&coupon=" + value.item + "&referer=" + value.referer + "\")'>쿠폰 사용</button>";
								}
							} else if ((value.item === 'free48@100') || (value.item === 'free48')) {
								if ((partnerID !== '') && (paymentItem !== '')) {
									onButton = "<button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 상담 페이지의 쿠폰함에서만 사용할 수 있습니다.\");return false;'>쿠폰 사용</button>";
								} else {
									onButton = "<button class='couponSubmit True' onclick='useCoupon(\"" + value.item + "\", \"" + value.couponItem + "\", \"/service/counseling/?partner=" + partnerID + "&payment=" + paymentItem + "&coupon=" + value.item + "&referer=" + value.referer + "\")'>쿠폰 사용</button>";
								}
							} else if (value.item === 'free168') {
								if ((partnerID !== '') && (paymentItem !== '')) {
									onButton = "<button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 상담 페이지의 쿠폰함에서만 사용할 수 있습니다.\");return false;'>쿠폰 사용</button>";
								} else {
									onButton = "<button class='couponSubmit True' onclick='useCoupon(\"" + value.item + "\", \"" + value.couponItem + "\", \"/service/counseling/?partner=" + partnerID + "&payment=" + paymentItem + "&coupon=" + value.item + "&referer=" + value.referer + "\")'>쿠폰 사용</button>";
								}
							}
						}
					}

					$("#couponList").append("<div class='couponExtraService'><div class='couponTitle'><pre>" + value.refererTitle + "</pre><p class='couponItem'>" + value.couponItem + "</p>" + onButton + "</div><div class='couponContent'><p class='couponContent_p'>" + value.refererContent + "</p><b class='couponContent_b'>" + value.finishDate + "</b><hr class='couponContent_hr'/><p class='couponContent_p_'>" + value.refererContent_ + "</p></div></div>");

				}

			} else {

				if (value.type === 'Payment') {
					$("#couponList").append("<div class='couponPayment'><div class='couponTitle'><pre>" + value.refererTitle + "</pre><p class='couponItem'>" + value.couponItem + "</p><button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 트로스트 앱에서만 사용이 가능합니다. 스마트폰 앱스토어에서 트로스트를 검색하여 설치해주세요.\")'>쿠폰 사용</button></div><div class='couponContent'><p class='couponContent_p'>" + value.refererContent + "</p><b class='couponContent_b'>" + value.finishDate + "</b><hr class='couponContent_hr'/><p class='couponContent_p_'>" + value.refererContent_ + "</p></div></div>");
				} else if (value.type === 'ExtraService') {
					$("#couponList").append("<div class='couponExtraService'><div class='couponTitle'><pre>" + value.refererTitle + "</pre><p class='couponItem'>" + value.couponItem + "</p><button class='couponSubmit False' onclick='alert(\"해당 쿠폰은 트로스트 앱에서만 사용이 가능합니다. 스마트폰 앱스토어에서 트로스트를 검색하여 설치해주세요.\")'>쿠폰 사용</button></div><div class='couponContent'><p class='couponContent_p'>" + value.refererContent + "</p><b class='couponContent_b'>" + value.finishDate + "</b><hr class='couponContent_hr'/><p class='couponContent_p_'>" + value.refererContent_ + "</p></div></div>");
				}
			}

		});
	}
});
/***************************/

$(".menuCouponPayment").click(function(){
	$(".couponPayment").css('display', 'block');
	$(".couponExtraService").css('display', 'none');

	$(".menuCouponPayment").css({'border-bottom':'3px solid #FFA321', 'color':'#FFA321'});
	$(".menuCouponExtraService").css({'border-bottom':'3px solid #999999', 'color':'#999999'});
});

$(".menuCouponExtraService").click(function(){
	$(".couponPayment").css('display', 'none');
	$(".couponExtraService").css('display', 'block');

	$(".menuCouponExtraService").css({'border-bottom':'3px solid #FFA321', 'color':'#FFA321'});
	$(".menuCouponPayment").css({'border-bottom':'3px solid #999999', 'color':'#999999'});
});

function useCoupon (userItem, userReferer, userLink, userType) {

	var stringReferer = '';
	var stringItem = '';

	if (userReferer == 'FIRST') {
		stringReferer = '첫 결제자';
	} else if (userReferer == 'PAYMENT') {
		stringReferer = '재 구매자';
	} else if (userReferer == 'REVIEW') {
		stringReferer = '리뷰 작성';
	} else if (userReferer == 'cop') {
		stringReferer = '제휴 기관 쿠폰';
	} else {
		stringReferer = '트로스트 쿠폰';
	}

	if (userItem == 'A@10') stringItem = '텍스트 테라피 전 상품 10% 할인 쿠폰을 사용하시겠습니까?';
	else if (userItem == '2@30') stringItem = '텍스트 테라피 1일 상품 30% 할인 쿠폰을 사용하시겠습니까?';
	else if (userItem == 'free24') stringItem = '무료상담 30분 이용권 쿠폰을 사용하시겠습니까?';
	else if (userItem == 'free48@100') stringItem = '무료상담 1일 이용권 쿠폰을 사용하시겠습니까?';
	else if (userItem == 'free168') stringItem = '무료상담 7일 이용권 쿠폰을 사용하시겠습니까?';

	var returnValue = confirm(stringReferer + " - " + stringItem);

	if (returnValue) {
		location.href = userLink;
	}

}

function initialization() {
	$('.checkCoupon').css('display', 'none');
}

$("#guideImoji").click(function(){
	$('#guideImojiImg').css('display', '');
	$('#guideClose').css('display', '');
});

$("#guideClose").click(function(){
	$('#guideImojiImg').css('display', 'none');
	$('#guideClose').css('display', 'none');
});

function moveToPayment(message) {
	var check = confirm(message + '\n\n결제하기로 이동하시겠습니까?');

	if (check) {
		location.href = '/service/counseling/';
	}
}
