	// 단위 구분자 (,) 사용.
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	function numberDelCommas(x) {
		return x.replace(/[^0-9]/g,'');
	}

	function getQueryVariable(variable) {
		var query = window.location.search.substring(1);
		var vars = query.split("&");

		for (var i=0; i<vars.length; i++) {
			var pair = vars[i].split("=");

			if (pair[0] == variable) {
				return pair[1];
			}
		}
	}

	function paymentInit()
	{
		if (firstPayment === 'Y') {
			$("#item07").prop('src', '/assets/img/of_payment/paymentItem07.png');
		} else {
			$("#item07").prop('src', '/assets/img/of_payment/paymentItem07og.png');
		}

		$("#item02").prop('src', '/assets/img/of_payment/paymentItem02og.png');
		$("#item30").prop('src', '/assets/img/of_payment/paymentItem30.png');
		$("#item90").prop('src', '/assets/img/of_payment/paymentItem90.png');
		$("#item0T").prop('src', '/assets/img/of_payment/paymentItem0T.png');

		// 1회 추가 있는 경우를 대비해 초기화.
		$(".price_discount_payment").html('1개');

		// 페이팔 버튼 뷰 세팅.
		$(".paypal-button input[type=hidden]").parents("form.paypal-button").css('display', 'none');

		// 결제 아이템 초기화.
		$(".inputPaymentMode").val('');
	}

	// 쿠폰 정보 저장
	var paymentItem = getQueryVariable("payment");
	var couponItem = getQueryVariable("coupon");
	var couponReferer = getQueryVariable("referer");
	var paymentPartner = getQueryVariable("partner");

	// 상시 '7일 첫결제' 적용을 위해 임시 변수 저장.
	var couponItem_ = '';
	var couponReferer_ = '';

	$(document).ready(function(){

		$(".inputBuyerName").val(clientName);
		$(".inputChat_log").val(roomNumber);

		$(".paymentSubmit").prop('disabled', 'disabled').css('opacity', '0.5');

		var checkedTicket = 'N';
		var counselingMode = 'texttime';

		if (couponItem) {

			$.ajax({
				url: "/oauth/counseling/texttime/ExtraModule/",type: "POST",cache: true,timeout : 3000,contentType: "application/json; charset=UTF-8",dataType: "json",
				data: JSON.stringify(
					{
						"ExtraModule":"coupon",
						"id":clientID,
						"type":"getCoupon"
					}
				),
				success: function(paymentCouponData) {

					/*
					* 결제 가격 설정.
					* 할인 상품 이름 설정.
					* 할인 테이블 표시.
					* 할인 테이블 타이틀.
					* 할인 테이틀 가격.
					* 전체 결제 가격
					*/

					$("#item02").click(function(){

						paymentInit();

						var originalPrice = '15000';
						var originalPrice_ = '15,000';

						$("#item02").prop('src', '/assets/img/of_payment/paymentItem02_og.png');
						$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck02og.png');

						$(".inputPaymentMode").val('2');
						$(".inputGoodName").val("텍스트 테라피 01일 상품권");
						$('.tableInfoPrice').html(originalPrice_ + '원');

						checkedTicket = 'Y';

						$(".paymentCheckState").css('display', 'none');
						$(".paymentInfoOfCoupon").css('display', '');
						$("#hrOfCoupon").css('display', '');
						$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
						$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item02');
						$(".inputCoupon").val('');
						$(".inputCouponReferer").val('');
						$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

						$(".paypal-button input[type=hidden][value=paypal-buynow-1]").parents("form.paypal-button").css('display', 'block');

						$.each(paymentCouponData.result, function(key, value) {

							try {

								if (couponReferer) {

									if ((couponItem === value.item) && (couponReferer === value.referer)) {
										var item = String('02');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								} else {

									if ((couponItem === value.item) && (!value.referer)) {
										var item = String('02');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								}

							} catch (err) {

								$('.tableInfoCoupon').css('display', 'none');
								$(".inputPrice").val(originalPrice);
								$('.paymentInfoOfTicketTitle').html('');
								$('.tableInfoCouponTitle').html('');
								$('.tableInfoCouponPrice').html('');
								$(".tableInfoTotalPrice").html(originalPrice_ + '원');

								$('.inputCoupon').val('');
								$('.inputCouponReferer').val('');

							}

						});

					});

					$("#item07").click(function(){

						paymentInit();

						var originalPrice = '40000';
						var originalPrice_ = '40,000';

						if (firstPayment === 'Y') {
							$("#item07").prop('src', '/assets/img/of_payment/paymentItem07_.png');
							$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07.png');
							var couponItem_ = '7@25';
							var couponReferer_ = 'FIRST';
						} else {
							$("#item07").prop('src', '/assets/img/of_payment/paymentItem07_og.png');
							$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07og.png');
						}

						$(".inputPaymentMode").val('7');
						$(".inputGoodName").val("텍스트 테라피 07일 상품권");
						$('.tableInfoPrice').html(originalPrice_ + '원');

						checkedTicket = 'Y';

						$(".paymentCheckState").css('display', 'none');
						$(".paymentInfoOfCoupon").css('display', '');
						$("#hrOfCoupon").css('display', '');
						$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
						$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item07');
						$(".inputCoupon").val('');
						$(".inputCouponReferer").val('');

						if (firstPayment === 'Y') {
							$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07.png');
						} else {
							$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07og.png');
						}

						$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

						$(".paypal-button input[type=hidden][value=paypal-buynow-7]").parents("form.paypal-button").css('display', 'block');

						try {

							/*
							* 첫 결제인 경우 쿠폰 보유 유무와 관계없이 할인율 적용.
							*/
							if ((couponItem_ === '7@25') && (couponReferer_ === 'FIRST')) {

								var item = String('07');
								var couponPrice = Number (10000);

								$('.tableInfoCoupon').css('display', '');
								$('.inputPrice').val('30000');
								$('.paymentInfoOfTicketTitle').html('- 첫 결제자 25% 할인권');
								$('.tableInfoCouponTitle').html('- 첫 결제자 25% 할인권');
								$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
								$('.tableInfoTotalPrice').html('30,000원');
								$('.inputCoupon').val('7@25');
								$('.inputCouponReferer').val('FIRST');

								return false;

							} else {

								$.each(paymentCouponData.result, function(key, value) {

									if (couponReferer) {

										if ((couponItem === value.item) && (couponReferer === value.referer)) {

											var item = String('07');
											var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

											$('.tableInfoCoupon').css('display', '');
											$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
											$('.paymentInfoOfTicketTitle').html(value.couponContent);
											$('.tableInfoCouponTitle').html(value.couponContent);
											$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
											$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
											$('.inputCoupon').val(couponItem);
											$('.inputCouponReferer').val(couponReferer);

											return false;

										}

									} else {

										if ((couponItem === value.item) && (!value.referer)) {

											var item = String('07');
											var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

											$('.tableInfoCoupon').css('display', '');
											$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
											$('.paymentInfoOfTicketTitle').html(value.couponContent);
											$('.tableInfoCouponTitle').html(value.couponContent);
											$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
											$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
											$('.inputCoupon').val(couponItem);
											$('.inputCouponReferer').val(couponReferer);

											return false;

										} else {

											$('.tableInfoCoupon').css('display', 'none');
											$(".inputPrice").val(originalPrice);
											$('.paymentInfoOfTicketTitle').html('');
											$('.tableInfoCouponTitle').html('');
											$('.tableInfoCouponPrice').html('');
											$(".tableInfoTotalPrice").html(originalPrice_ + '원');

											$('.inputCoupon').val('');
											$('.inputCouponReferer').val('');

										}

									}

								});

							}

						} catch (err) {

							$('.tableInfoCoupon').css('display', 'none');
							$(".inputPrice").val(originalPrice);
							$('.paymentInfoOfTicketTitle').html('');
							$('.tableInfoCouponTitle').html('');
							$('.tableInfoCouponPrice').html('');
							$(".tableInfoTotalPrice").html(originalPrice_ + '원');

							$('.inputCoupon').val('');
							$('.inputCouponReferer').val('');

						}

					});

					$("#item30").click(function(){

						paymentInit();

						var originalPrice = '100000';
						var originalPrice_ = '100,000';

						$("#item30").prop('src', '/assets/img/of_payment/paymentItem30_.png');

						$(".inputPaymentMode").val('30');
						$(".inputGoodName").val("텍스트 테라피 30일 상품권");
						$('.tableInfoPrice').html(originalPrice_ + '원');

						checkedTicket = 'Y';

						$(".paymentCheckState").css('display', 'none');
						$(".paymentInfoOfCoupon").css('display', '');
						$("#hrOfCoupon").css('display', '');
						$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
						$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item30');
						$(".inputCoupon").val('');
						$(".inputCouponReferer").val('');
						$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck30.png');
						$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

						$(".paypal-button input[type=hidden][value=paypal-buynow-30]").parents("form.paypal-button").css('display', 'block');

						$.each(paymentCouponData.result, function(key, value) {

							try {

								if (couponReferer) {

									if ((couponItem === value.item) && (couponReferer === value.referer)) {
										var item = String('30');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								} else {

									if ((couponItem === value.item) && (!value.referer)) {
										var item = String('30');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								}

							} catch (err) {

								$('.tableInfoCoupon').css('display', 'none');
								$(".inputPrice").val(originalPrice);
								$('.paymentInfoOfTicketTitle').html('');
								$('.tableInfoCouponTitle').html('');
								$('.tableInfoCouponPrice').html('');
								$(".tableInfoTotalPrice").html(originalPrice_ + '원');

								$('.inputCoupon').val('');
								$('.inputCouponReferer').val('');

							}

						});
					});

					// $("#item40").click(function(){
					//
					// 	paymentInit();
					//
					// 	var originalPrice = '140000';
					// 	var originalPrice_ = '140,000';
					//
					// 	$("#item40").prop('src', '/assets/img/of_payment/paymentItem40_.png');
					//
					// 	$(".inputPaymentMode").val('');
					// 	$(".inputGoodName").val("텍스트 테라피 40일 상품권");
					// 	$('.tableInfoPrice').html(originalPrice_ + '원');
					//
					// 	checkedTicket = 'Y';
					//
					// 	$(".paymentCheckState").css('display', 'none');
					// 	$(".paymentInfoOfCoupon").css('display', '');
					// 	$("#hrOfCoupon").css('display', '');
					// 	$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
					// 	$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item40');
					// 	$(".inputCoupon").val('');
					// 	$(".inputCouponReferer").val('');
					// 	$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck40.png');
					// 	$(".paymentSubmit").prop('disabled', '').css('opacity', '1');
					//
					// 	$(".paypal-button input[type=hidden][value=paypal-buynow-40]").parents("form.paypal-button").css('display', 'block');
					//
					// 	$.each(paymentCouponData.result, function(key, value) {
					//
					// 		try {
					//
					// 			if ((couponItem === value.item) && (couponReferer === value.referer)) {
					//
					// 				var item = String('40');
					// 				var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));
					//
					// 				$('.tableInfoCoupon').css('display', '');
					// 				$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
					// 				$('.paymentInfoOfTicketTitle').html(value.couponContent);
					// 				$('.tableInfoCouponTitle').html(value.couponContent);
					// 				$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
					// 				$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
					// 				$('.inputCoupon').val(couponItem);
					// 				$('.inputCouponReferer').val(couponReferer);
					//
					// 				return false;
					//
					// 			} else {
					//
					// 				$('.tableInfoCoupon').css('display', 'none');
					// 				$(".inputPrice").val(originalPrice);
					// 				$('.paymentInfoOfTicketTitle').html('');
					// 				$('.tableInfoCouponTitle').html('');
					// 				$('.tableInfoCouponPrice').html('');
					// 				$(".tableInfoTotalPrice").html(originalPrice_ + '원');
					//
					// 				$('.inputCoupon').val('');
					// 				$('.inputCouponReferer').val('');
					//
					// 			}
					//
					// 		} catch (err) {
					//
					// 			$('.tableInfoCoupon').css('display', 'none');
					// 			$(".inputPrice").val(originalPrice);
					// 			$('.paymentInfoOfTicketTitle').html('');
					// 			$('.tableInfoCouponTitle').html('');
					// 			$('.tableInfoCouponPrice').html('');
					// 			$(".tableInfoTotalPrice").html(originalPrice_ + '원');
					//
					// 			$('.inputCoupon').val('');
					// 			$('.inputCouponReferer').val('');
					//
					// 		}
					//
					// 	});
					//
					// });

					$("#item90").click(function(){

						paymentInit();

						var originalPrice = '240000';
						var originalPrice_ = '240,000';

						$("#item90").prop('src', '/assets/img/of_payment/paymentItem90_.png');

						$(".inputPaymentMode").val('90');
						$(".inputGoodName").val("텍스트 테라피 90일 상품권");
						$('.tableInfoPrice').html(originalPrice_ + '원');

						checkedTicket = 'Y';

						$(".paymentCheckState").css('display', 'none');
						$(".paymentInfoOfCoupon").css('display', '');
						$("#hrOfCoupon").css('display', '');
						$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
						$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item90');
						$(".inputCoupon").val('');
						$(".inputCouponReferer").val('');
						$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck90.png');
						$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

						$(".paypal-button input[type=hidden][value=paypal-buynow-90]").parents("form.paypal-button").css('display', 'block');

						$.each(paymentCouponData.result, function(key, value) {

							try {

								if (couponReferer) {

									if ((couponItem === value.item) && (couponReferer === value.referer)) {
										var item = String('90');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								} else {

									if ((couponItem === value.item) && (!value.referer)) {
										var item = String('90');
										var couponPrice = Number (originalPrice - numberDelCommas(value.discountPrices.texttime[item]));

										$('.tableInfoCoupon').css('display', '');
										$('.inputPrice').val(numberDelCommas(value.discountPrices.texttime[item]));
										$('.paymentInfoOfTicketTitle').html(value.couponContent);
										$('.tableInfoCouponTitle').html(value.couponContent);
										$('.tableInfoCouponPrice').html('- ' + numberWithCommas(couponPrice) + '원');
										$('.tableInfoTotalPrice').html(value.discountPrices.texttime[item] + '원');
										$('.inputCoupon').val(couponItem);
										$('.inputCouponReferer').val(couponReferer);

										return false;
									} else {
										$('.tableInfoCoupon').css('display', 'none');
										$(".inputPrice").val(originalPrice);
										$('.paymentInfoOfTicketTitle').html('');
										$('.tableInfoCouponTitle').html('');
										$('.tableInfoCouponPrice').html('');
										$(".tableInfoTotalPrice").html(originalPrice_ + '원');

										$('.inputCoupon').val('');
										$('.inputCouponReferer').val('');
									}

								}


							} catch (err) {

								$('.tableInfoCoupon').css('display', 'none');
								$(".inputPrice").val(originalPrice);
								$('.paymentInfoOfTicketTitle').html('');
								$('.tableInfoCouponTitle').html('');
								$('.tableInfoCouponPrice').html('');
								$(".tableInfoTotalPrice").html(originalPrice_ + '원');

								$('.inputCoupon').val('');
								$('.inputCouponReferer').val('');

							}

						});

					});

				}

			});

		} else {

			$("#item02").click(function(){

				paymentInit();

				var originalPrice = '15000';
				var originalPrice_ = '15,000';

				$("#item02").prop('src', '/assets/img/of_payment/paymentItem02_og.png');
				$(".inputPaymentMode").val('2');
				$(".inputGoodName").val("텍스트 테라피 01일 상품권");
				$('.tableInfoPrice').html(originalPrice_ + '원');

				checkedTicket = 'Y';

				$(".paymentCheckState").css('display', 'none');
				$(".paymentInfoOfCoupon").css('display', '');
				$("#hrOfCoupon").css('display', '');
				$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
				$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item02');
				$(".inputCoupon").val('');
				$(".inputCouponReferer").val('');

				$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck02og.png');
				$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

				$('.tableInfoCoupon').css('display', 'none');
				$(".inputPrice").val(originalPrice);
				$('.paymentInfoOfTicketTitle').html('');
				$('.tableInfoCouponTitle').html('');
				$('.tableInfoCouponPrice').html('');
				$(".tableInfoTotalPrice").html(originalPrice_ + '원');

				$('.inputCoupon').val('');
				$('.inputCouponReferer').val('');

				$(".paypal-button input[type=hidden][value=paypal-buynow-1]").parents("form.paypal-button").css('display', 'block');

			});

			$("#item07").click(function(){

				paymentInit();

				var originalPrice = '40000';
				var originalPrice_ = '40,000';

				if (firstPayment === 'Y') {
					$("#item07").prop('src', '/assets/img/of_payment/paymentItem07_.png');
				} else {
					$("#item07").prop('src', '/assets/img/of_payment/paymentItem07_og.png');
				}

				$(".inputPaymentMode").val('7');
				$(".inputGoodName").val("텍스트 테라피 07일 상품권");
				$('.tableInfoPrice').html(originalPrice_ + '원');

				checkedTicket = 'Y';

				$(".paymentCheckState").css('display', 'none');
				$(".paymentInfoOfCoupon").css('display', '');
				$("#hrOfCoupon").css('display', '');
				$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
				$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item07');
				$(".inputCoupon").val('');
				$(".inputCouponReferer").val('');

				if (firstPayment === 'Y') {
					$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07.png');
				} else {
					$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck07og.png');
				}

				$(".paymentSubmit").prop('disabled', '').css('opacity', '1');
				$('.tableInfoCoupon').css('display', 'none');
				$(".inputPrice").val(originalPrice);
				$('.paymentInfoOfTicketTitle').html('');
				$('.tableInfoCouponTitle').html('');
				$('.tableInfoCouponPrice').html('');
				$(".tableInfoTotalPrice").html(originalPrice_ + '원');

				$('.inputCoupon').val('');
				$('.inputCouponReferer').val('');

				$(".paypal-button input[type=hidden][value=paypal-buynow-7]").parents("form.paypal-button").css('display', 'block');

			});

			$("#item30").click(function(){

				paymentInit();

				var originalPrice = '100000';
				var originalPrice_ = '100,000';

				$("#item30").prop('src', '/assets/img/of_payment/paymentItem30_.png');

				$(".inputPaymentMode").val('30');
				$(".inputGoodName").val("텍스트 테라피 30일 상품권");
				$('.tableInfoPrice').html(originalPrice_ + '원');

				checkedTicket = 'Y';

				$(".paymentCheckState").css('display', 'none');
				$(".paymentInfoOfCoupon").css('display', '');
				$("#hrOfCoupon").css('display', '');
				$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
				$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item30');
				$(".inputCoupon").val('');
				$(".inputCouponReferer").val('');
				$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck30.png');
				$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

				$('.tableInfoCoupon').css('display', 'none');
				$(".inputPrice").val(originalPrice);
				$('.paymentInfoOfTicketTitle').html('');
				$('.tableInfoCouponTitle').html('');
				$('.tableInfoCouponPrice').html('');
				$(".tableInfoTotalPrice").html(originalPrice_ + '원');

				$('.inputCoupon').val('');
				$('.inputCouponReferer').val('');

				$(".paypal-button input[type=hidden][value=paypal-buynow-30]").parents("form.paypal-button").css('display', 'block');

			});

			// $("#item40").click(function(){
			//
			// 	paymentInit();
			//
			// 	var originalPrice = '140000';
			// 	var originalPrice_ = '140,000';
			//
			// 	$("#item40").prop('src', '/assets/img/of_payment/paymentItem40_.png');
			//
			// 	$(".inputPaymentMode").val('');
			// 	$(".inputGoodName").val("텍스트 테라피 40일 상품권");
			// 	$('.tableInfoPrice').html(originalPrice_ + '원');
			//
			// 	checkedTicket = 'Y';
			//
			// 	$(".paymentCheckState").css('display', 'none');
			// 	$(".paymentInfoOfCoupon").css('display', '');
			// 	$("#hrOfCoupon").css('display', '');
			// 	$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
			// 	$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item40');
			// 	$(".inputCoupon").val('');
			// 	$(".inputCouponReferer").val('');
			// 	$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck40.png');
			// 	$(".paymentSubmit").prop('disabled', '').css('opacity', '1');
			//
			// 	$('.tableInfoCoupon').css('display', 'none');
			// 	$(".inputPrice").val(originalPrice);
			// 	$('.paymentInfoOfTicketTitle').html('');
			// 	$('.tableInfoCouponTitle').html('');
			// 	$('.tableInfoCouponPrice').html('');
			// 	$(".tableInfoTotalPrice").html(originalPrice_ + '원');
			//
			// 	$('.inputCoupon').val('');
			// 	$('.inputCouponReferer').val('');
			//
			// 	$(".paypal-button input[type=hidden][value=paypal-buynow-40]").parents("form.paypal-button").css('display', 'block');
			//
			// });

			$("#item90").click(function(){

				paymentInit();

				var originalPrice = '240000';
				var originalPrice_ = '240,000';

				$("#item90").prop('src', '/assets/img/of_payment/paymentItem90_.png');

				$(".inputPaymentMode").val('90');
				$(".inputGoodName").val("텍스트 테라피 90일 상품권");
				$('.tableInfoPrice').html(originalPrice_ + '원');

				checkedTicket = 'Y';

				$(".paymentCheckState").css('display', 'none');
				$(".paymentInfoOfCoupon").css('display', '');
				$("#hrOfCoupon").css('display', '');
				$(".linkForCoupon").html("쿠폰을 선택해 사용할 수 있습니다. <span style='float:right;'>></span>");
				$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + paymentPartner + '&payment=item90');
				$(".inputCoupon").val('');
				$(".inputCouponReferer").val('');
				$(".paymentCheckImage").prop('src', '/assets/img/of_payment/paymentCheck90.png');
				$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

				$('.tableInfoCoupon').css('display', 'none');
				$(".inputPrice").val(originalPrice);
				$('.paymentInfoOfTicketTitle').html('');
				$('.tableInfoCouponTitle').html('');
				$('.tableInfoCouponPrice').html('');
				$(".tableInfoTotalPrice").html(originalPrice_ + '원');

				$('.inputCoupon').val('');
				$('.inputCouponReferer').val('');

				$(".paypal-button input[type=hidden][value=paypal-buynow-90]").parents("form.paypal-button").css('display', 'block');

			});

		}

		$("#item0T").click(function(){

			// 아이템 이미지 선택 및 초기화.
			paymentInit();
			// $("#numItemCount").val('1');

			$("#item0T").prop('src', '/assets/img/of_payment/paymentItem0T_.png');
			$('.linkForCoupon').prop('href', '/service/payment/coupon/?partner=' + partnerID + '&payment=item0T');

			// 이니시스 결제 정보.
			$(".inputPaymentMode").val('AddT' + $("#numItemCount").val());
			$(".inputGoodName").val("실시간 텍스트 테라피 " + $("#numItemCount").val() + "회 추가");
			$(".inputPrice").val(12000*$("#numItemCount").val());

			// 초기화
			$('.paymentInfoOfTicketTitle').html('');
			$('.tableInfoCoupon').css('display', 'none');
			$('.tableInfoCouponTitle').html('');
			$('.tableInfoCouponPrice').html('');
			$(".paymentCheckState").css('display', 'none');
			$(".paymentInfoOfCoupon").css('display', 'none');
			$("#hrOfCoupon").css('display', 'none');
			$(".inputCoupon").val('');
			$(".inputCouponReferer").val('');
			$(".tableInfoPrice").html("12,000원");
			$(".tableInfoTotalPrice").html(numberWithCommas((12000*$("#numItemCount").val()) + '원'));

			$(".price_discount_payment").html($("#numItemCount").val() + '개');
			$(".paymentSubmit").prop('disabled', '').css('opacity', '1');

			checkedTicket = 'Y';

			$('.price_discount').html('선택된 수량');

		});

		$("button#plusItemCount").click(function(){
			$("#item0T").click();
			var itemString = Number ($("#numItemCount").val());

			if (itemString >= 9) {
				alert("최대 9회까지 구매 가능합니다.");
			} else {
				console.log('A');
				itemString += 1;

				// 페이지 내 결제 정보 등록.
				$("#numItemCount").val(itemString);
				$(".price_discount_payment").html(itemString + '개');
				$(".tableInfoTotalPrice").html(numberWithCommas((12000*itemString) + '원'));

				// 이니시스 결제 정보 등록.
				$(".inputGoodName").val("실시간 텍스트 테라피 " + itemString + "회 추가");
				$(".inputPrice").val(12000*itemString);
				$(".inputPaymentMode").val('AddT' + itemString);
			}

			return false;
		});

		$("button#decreaseItemCount").click(function(){
			$("#item0T").click();
			var itemString = Number ($("#numItemCount").val());

			if (itemString > 1) {
				// 페이지 내 결제 정보 등록.
				$("#numItemCount").val(itemString - 1);
				$(".price_discount_payment").html($("#numItemCount").val() + '개');
				$(".tableInfoTotalPrice").html(numberWithCommas((12000*$("#numItemCount").val()) + '원'));

				// 이니시스 결제 정보 등록.
				$(".inputGoodName").val("실시간 텍스트 테라피 " + $("#numItemCount").val() + "회 추가");
				$(".inputPrice").val(12000*$("#numItemCount").val());
				$(".inputPaymentMode").val('AddT' + $("#numItemCount").val());
			}

			return false;
		});

		$('select[name=gopaymethod]').change(function(){

			$(".infoSys").css('display', 'none');

			if (checkedTicket != 'Y') {

				alert("사용 이용권을 먼저 선택해주시길 바랍니다");
				$('select[name=gopaymethod]').val('Card');
				return false;

			} else {

				if ($('select[name=gopaymethod]').val() == 'Paypal') {

					// $(".paypal-button button.large").css('display', 'block');
					// $(".paypal-button button.large").html("결제하기");

					// $(".paymentInfoOfCoupon").css('display', 'none');
					// $(".paymentSubmit").css('display', 'none');

					var hr = $("hr");
					$(hr[1]).css('display', 'none');

					// var realMoney = $('.inputPrice').val();

					// $.getJSON('//api.fixer.io/latest?symbols=USD,KRW', function(data) {
					//
					// 	var krwMoney = data.rates.KRW;
					// 	var engMoney = data.rates.USD;
					//
					// 	var item01 = Number (realMoney) + Number (realMoney/10);
					// 	var item01_ = ((item01/krwMoney)*engMoney).toFixed(2);
					//
					// 	var item07 = Number (realMoney) + Number (realMoney/10);
					// 	var item07_ = ((item07/krwMoney)*engMoney).toFixed(2);
					//
					// 	var item30 = Number (realMoney) + Number (realMoney/10);
					// 	var item30_ = ((item30/krwMoney)*engMoney).toFixed(2);

						// var item40 = Number (realMoney) + Number (realMoney/10);
						// var item40_ = ((item40/krwMoney)*engMoney).toFixed(2);

						// var item90 = Number (realMoney) + Number (realMoney/10);
						// var item90_ = ((item90/krwMoney)*engMoney).toFixed(2);

						// 환율 세팅.
						// $(".paypal-button input[type=hidden][value=paypal-buynow-1]").parents("form.paypal-button").find("input[type=hidden][name=amount]").val(item01_);
						// $(".paypal-button input[type=hidden][value=paypal-buynow-7]").parents("form.paypal-button").find("input[type=hidden][name=amount]").val(item07_);
						// $(".paypal-button input[type=hidden][value=paypal-buynow-30]").parents("form.paypal-button").find("input[type=hidden][name=amount]").val(item30_);
						// $(".paypal-button input[type=hidden][value=paypal-buynow-40]").parents("form.paypal-button").find("input[type=hidden][name=amount]").val(item40_);
						// $(".paypal-button input[type=hidden][value=paypal-buynow-90]").parents("form.paypal-button").find("input[type=hidden][name=amount]").val(item90_);

						$("#infoOfPaypal").css('display', 'block');

					// });

				// } else if ($('select[name=gopaymethod]').val() == 'Paypal') {
					/*
					* 페이팔 결제
					*/
					$(".buyerChangeInfo").attr('name', 'buyername');
					$(".buyerChangeInfo").attr('placeholder', '입금자명(필수)');
					$("input[type=hidden][name=buyername]").remove();
				} else if ($('select[name=gopaymethod]').val() == 'VBank') {
					/*
					* 무통장 입금
					*/
					$(".buyerChangeInfo").attr('name', 'buyername');
					$(".buyerChangeInfo").attr('placeholder', '입금자명(필수)');
					$("input[type=hidden][name=buyername]").remove();
				} else {
					// 휴대폰 결제 상품 유형 초기화.
					// if ($(".inputAcceptMethod").length) {
						// $(".inputAcceptMethod").remove();
					// }

					// 페이팔 내용 초기화
					// $(".paypal-button button.large").css('display', 'none');
					// $(".paymentSubmit").css('display', '');
					// $(".paymentCheckState").css('display', 'none');

					$("#item02").css('display', '');
					$("#item07").css('display', '');
					$("#item30").css('display', '');
					$("#item90").css('display', '');
					$("#item0T").css('display', '');
				}

				if ($('select[name=gopaymethod]').val() === 'VBank') {
					$("#infoOfBank").css('display', 'block');
				}

			}

		});

		/*
		* 이용권 가이드 출력.
		*/
		$("#moreGuideitem30Btn").click(function(){
			$("#moreGuideitem30Pop").fadeIn();
			$("#opacityBg").fadeIn();
			$(".moreGuideClose").fadeIn();
		});

		$("#moreGuideitem07Btn").click(function(){
			$("#moreGuideitem07Pop").fadeIn();
			$("#opacityBg").fadeIn();
			$(".moreGuideClose").fadeIn();
		});

		$("#moreGuideitem02Btn").click(function(){
			$("#moreGuideitem02Pop").fadeIn();
			$("#opacityBg").fadeIn();
			$(".moreGuideClose").fadeIn();
		});

		$("#moreGuideitem90Btn").click(function(){
			$("#moreGuideitem90Pop").fadeIn();
			$("#opacityBg").fadeIn();
			$(".moreGuideClose").fadeIn();
		});

		$(".moreGuideClose").click(function(){
			$(".moreGuideitemPop").fadeOut();
			$("#opacityBg").fadeOut();
		});
		/**/

	});

	/*
	* 이용권이 제대로 선택되지 않았을 때를 대비해
	* 페이지 로드 2초 후에 이용권 자동 선택
	*/
	if (paymentItem) {
		setTimeout(function() {
			$("#" + paymentItem).click();
		}, 2000);
	}

	// if (firstPayment === 'Y') {
	// 	if (!couponItem) {
	// 		couponItem = '7@25';
	// 		couponReferer = 'FIRST';
	// 			setTimeout(function() {
	// 				$("#item07").click();
	// 			}, 2000);
	// 	}
	// }
