<?php
/**
 * Copyright (c) 2017. 주식회사 휴마트컴퍼니. HumartCompany, Inc.
 */

Class JandiAlarm
{

    public $counselingModeStr;

    // Dev
    // https://wh.jandi.com/connect-api/webhook/11259587/099b16b025143484efea17bc88e0a790

    // Production
    // https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1

    public function __construct ($counselingMode)
    {

        if ($counselingMode === 'texttime') {
            $this->counselingModeStr = '텍스트 테라피';
        } else if ($counselingMode === 'facetime') {
            $this->counselingModeStr = '화상상담';
        } else if ($counselingMode === 'voicetime') {
            $this->counselingModeStr = '전화상담';
        } else if ($counselingMode === 'texttime_Add') {
            $this->counselingModeStr = '(문제발생)';
        } else if ($counselingMode === 'special') {
            $this->counselingModeStr = '특별상담';
        } else {
            $this->counselingModeStr = '(문제발생)';
        }

//            (array) $this->paymentItemName = [
//                "T30X1X5" => [
//                    "itemName" => "텍스트 30분","itemFullName" => "텍스트 30분 전문 상담권","itemMinute" => "30분",
//                ],
//                "T50X1X5" => [
//                    "itemName" => "텍스트 50분","itemFullName" => "텍스트 50분 전문 상담권","itemMinute" => "50분",
//                ],
//                "T30X4X14" => [
//                    "itemName" => "텍스트 2주","itemFullName" => "2주 텍스트 패키지","itemMinute" => "30분",
//                ],
//                "T50X4X28" => [
//                    "itemName" => "텍스트 4주","itemFullName" => "4주 텍스트 패키지","itemMinute" => "50분",
//                ],
//                "T50X10X70" => [
//                    "itemName" => "텍스트 10주","itemFullName" => "10주 텍스트 패키지","itemMinute" => "50분",
//                ],
//                "V30X1X5" => [
//                    "itemName" => "전화상담 30분","itemFullName" => "전화 30분 전문 상담권","itemMinute" => "30분",
//                ],
//                "V50X1X5" => [
//                    "itemName" => "전화상담 50분","itemFullName" => "전화 50분 전문 상담권","itemMinute" => "50분",
//                ],
//                "V50X2X14" => [
//                    "itemName" => "전화상담 2주","itemFullName" => "2주 전화 패키지","itemMinute" => "50분",
//                ],
//                "V30X4X28" => [
//                    "itemName" => "전화상담 4주","itemFullName" => "4주 전화 패키지","itemMinute" => "30분",
//                ],
//                "S-T50X1X14-V30X1X14" => [
//                    "itemName" => "텍스트+전화","itemFullName" => "(혼합상담) 텍스트+전화 프로그램","itemMinute" => "",
//                ],
//                "S-SCT-T50X1X7" => [
//                    "itemName" => "텍스트+검사","itemFullName" => "(심리검사) 심리검사 프로그램","itemMinute" => "50분",
//                ],
//            ];

        function checkCoupon ($paymentCoupon)
        {
            if ($paymentCoupon) {
                (string) $couponItem = $paymentCoupon;
                (string) $couponName = '';

//					if ($couponItem === 'A@10') {
//						$couponName = "10% 할인";
//					} else if ($couponItem === '7@25') {
//						$couponName = "25% 할인";
//					} else if ($couponItem === 'FIRST-5000') {
//						$couponName = "5000원 할인";
//					} else if ($couponItem === '2@30') {
//						$couponName = "30% 할인";
//					} else if ($couponItem === 'V@50') {
//						$couponName = "50% 할인";
//					} else if ($couponItem === 'L@10') {
//						$couponName = "10% 할인";
//					} else {
                $couponName = $paymentCoupon;
//					}

                $couponName = " / '" . $couponName . "' 쿠폰 적용";

                return $couponName;
            } else {
                $couponName = "";
            }
        }

        function MadePaymentItemName ($paymentItemType)
        {

            (array) $paymentItemName = [
                "T30X1X5" => [
                    "itemName" => "텍스트 30분","itemFullName" => "텍스트 30분 전문 상담권","itemMinute" => "30분",
                ],
                "T50X1X5" => [
                    "itemName" => "텍스트 50분","itemFullName" => "텍스트 50분 전문 상담권","itemMinute" => "50분",
                ],
                "T30X4X14" => [
                    "itemName" => "텍스트 2주","itemFullName" => "2주 텍스트 패키지","itemMinute" => "30분",
                ],
                "T50X4X28" => [
                    "itemName" => "텍스트 4주","itemFullName" => "4주 텍스트 패키지","itemMinute" => "50분",
                ],
                "T50X10X70" => [
                    "itemName" => "텍스트 10주","itemFullName" => "10주 텍스트 패키지","itemMinute" => "50분",
                ],
                "V30X1X5" => [
                    "itemName" => "전화상담 30분","itemFullName" => "전화 30분 전문 상담권","itemMinute" => "30분",
                ],
                "V50X1X5" => [
                    "itemName" => "전화상담 50분","itemFullName" => "전화 50분 전문 상담권","itemMinute" => "50분",
                ],
                "V50X2X14" => [
                    "itemName" => "전화상담 2주","itemFullName" => "2주 전화 패키지","itemMinute" => "50분",
                ],
                "V30X4X28" => [
                    "itemName" => "전화상담 4주","itemFullName" => "4주 전화 패키지","itemMinute" => "30분",
                ],
                "S-T50X1X14-V30X1X14" => [
                    "itemName" => "텍스트+전화","itemFullName" => "(혼합상담) 텍스트+전화 프로그램","itemMinute" => "",
                ],
                "S-SCT-T50X1X7" => [
                    "itemName" => "텍스트+검사","itemFullName" => "(심리검사) 심리검사 프로그램","itemMinute" => "50분",
                ],
            ];

            if ($paymentItemName[$paymentItemType]['itemFullName']) {
                return $paymentItemName[$paymentItemType]['itemFullName'];
            } else {
                return '';
            }

        }

    }

    public function pushCardPayment ($payDevice, $payMethod, $clientID, $clientName, $partnerID, $partnerName, $paymentItem, $paymentMoney, $paymentCoupon)
    {
        /*
        * 무통장 입금 신청.
        * 구동 환경, 결제 환경, 상담 모드, 내담자 이름, 상담사 이름, 결제 아이템/결제 금액.
        * $reqJandiAlarm->pushPayment('App', 'Paypal', $cID, $MakePayment->infoClient['name'], $getInfoOfPartner['id'], $getInfoOfPartner['name'], $paymentItem);
        */

        $headers = array("Content-Type:application/json;charset=utf-8","Accept:application/vnd.tosslab.jandi-v2+json");
        (string) $messageBody = "'" . $clientName . "' 내담자가 '" . $partnerName . "' 상담사에게 " . $this->counselingModeStr . " " . MadePaymentItemName($paymentItem) . "(" . number_format($paymentMoney) . "원" . checkCoupon($paymentCoupon) . ") 카드 결제했습니다.";

        $request = array(
            "body"=>"[[결제안내]](http://trost.co.kr/manage/a2m1n/pages/supportInfo/payment/?query=jandi-alarm) " . $messageBody,
            "connectColor"=>"#999999",
            "connectInfo"=>array(
                "0"=>array("title"=>"[내담자 정보]","description"=>$clientName . " 내담자\n(" . $clientID . ")"),
                "1"=>array("title"=>"[상담사 정보]","description"=>$partnerName . " 상담사\n(" . $partnerID . ")"),
                "2"=>array("title"=>"[결제 정보]","description"=>"결제환경: " . $payDevice . "\n상담종류 : " . $this->counselingModeStr . "\n기간/금액 : " . MadePaymentItemName($paymentItem) . "권"),
            ),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_exec($ch);
        curl_close($ch);

    }

    public function pushExtraPayment ($payDevice, $payMethod, $clientID, $clientName, $partnerID, $partnerName, $paymentItem, $paymentMoney, $paymentCoupon)
    {
        /*
        * 무통장 입금 신청.
        * 구동 환경, 결제 환경, 상담 모드, 내담자 이름, 상담사 이름, 결제 아이템/결제 금액.
        * $reqJandiAlarm->pushPayment('App', 'Paypal', $cID, $MakePayment->infoClient['name'], $getInfoOfPartner['id'], $getInfoOfPartner['name'], $paymentItem);
        */

        $headers = array("Content-Type:application/json;charset=utf-8","Accept:application/vnd.tosslab.jandi-v2+json");
        (string) $messageBody = "'" . $clientName . "' 내담자가 '" . $partnerName . "' 상담사에게 " . $this->counselingModeStr . " " . MadePaymentItemName($paymentItem) . "(" . number_format($paymentMoney) . "원" . checkCoupon($paymentCoupon) . ") 무통장 입금 신청했습니다.\n입금 확인 후에 관리자페이지에서 승인해주세요.";

        $request = array(
            "body"=>"[[결제안내]](http://trost.co.kr/manage/a2m1n/pages/supportInfo/payment/?query=jandi-alarm) " . $messageBody,
            "connectColor"=>"#999999",
            "connectInfo"=>array(
                "0"=>array("title"=>"[내담자 정보]","description"=>$clientName . " 내담자\n(" . $clientID . ")"),
                "1"=>array("title"=>"[상담사 정보]","description"=>$partnerName . " 상담사\n(" . $partnerID . ")"),
                "2"=>array("title"=>"[결제 정보]","description"=>"결제환경: " . $payDevice . "\n상담종류 : " . $this->counselingModeStr . "\n기간/금액 : " . MadePaymentItemName($paymentItem) . "권"),
            ),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_exec($ch);
        curl_close($ch);

    }

    public function pushCheckExtraPayment ($payDevice, $payMethod, $clientID, $clientName, $partnerID, $partnerName, $paymentItem, $paymentMoney, $paymentCoupon)
    {
        /*
        * 무통장 입금 신청.
        * 구동 환경, 결제 환경, 상담 모드, 내담자 이름, 상담사 이름, 결제 아이템/결제 금액.
        * $reqJandiAlarm->pushPayment('App', 'Paypal', $cID, $MakePayment->infoClient['name'], $getInfoOfPartner['id'], $getInfoOfPartner['name'], $paymentItem);
        */

        $headers = array("Content-Type:application/json;charset=utf-8","Accept:application/vnd.tosslab.jandi-v2+json");
        (string) $messageBody = "'" . $clientName . "' 내담자가 '" . $partnerName . "' 상담사에게 " . $this->counselingModeStr . " " . MadePaymentItemName($paymentItem) . "(" . number_format($paymentMoney) . "원" . checkCoupon($paymentCoupon) . ") 무통장 입금 확인되어 승인되었습니다.";

        $request = array(
            "body"=>"[[결제안내]](http://trost.co.kr/manage/a2m1n/pages/supportInfo/payment/?query=jandi-alarm) " . $messageBody,
            "connectColor"=>"#999999",
            "connectInfo"=>array(
                "0"=>array("title"=>"[내담자 정보]","description"=>$clientName . " 내담자\n(" . $clientID . ")"),
                "1"=>array("title"=>"[상담사 정보]","description"=>$partnerName . " 상담사\n(" . $partnerID . ")"),
                "2"=>array("title"=>"[결제 정보]","description"=>"결제환경: " . $payDevice . "\n상담종류 : " . $this->counselingModeStr . "\n기간/금액 : " . MadePaymentItemName($paymentItem) . "권"),
            ),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_exec($ch);
        curl_close($ch);

    }

    public function pushPaypal ($payDevice, $payMethod, $clientID, $clientName, $partnerID, $partnerName, $paymentItem, $paymentMoney, $paymentCoupon)
    {
        /*
        * 페이팔 신청.
        * 구동 환경, 결제 환경, 상담 모드, 내담자 이름, 상담사 이름, 결제 아이템/결제 금액.
        * $reqJandiAlarm->pushPaypal('App', 'Paypal', $_GET['client'], $buyerName, $getInfoOfPartner['id'], $getInfoOfPartner['name'], $itemPrice);
        */

        $headers = array("Content-Type:application/json;charset=utf-8","Accept:application/vnd.tosslab.jandi-v2+json");
        (string) $messageBody = "'" . $clientName . "' 내담자가 '" . $partnerName . "' 상담사에게 " . $this->counselingModeStr . " " . MadePaymentItemName($paymentItem) . "(" . number_format($paymentMoney) . "원" . checkCoupon($paymentCoupon) . ") 페이팔 결제 신청했습니다.\n입금 확인 후에 관리자페이지에서 승인해주세요.";

        $request = array(
            "body"=>"[[결제안내]](http://trost.co.kr/manage/a2m1n/pages/supportInfo/payment/?query=jandi-alarm) " . $messageBody,
            "connectColor"=>"#999999",
            "connectInfo"=>array(
                "0"=>array("title"=>"[내담자 정보]","description"=>$clientName . " 내담자\n(" . $clientID . ")"),
                "1"=>array("title"=>"[상담사 정보]","description"=>$partnerName . " 상담사\n(" . $partnerID . ")"),
                "2"=>array("title"=>"[결제 정보]","description"=>"결제환경: " . $payDevice . "\n상담종류 : " . $this->counselingModeStr . "\n기간/금액 : " . MadePaymentItemName($paymentItem) . "권"),
            ),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_exec($ch);
        curl_close($ch);

    }

    public function pushCheckPaypalPayment ($payDevice, $payMethod, $clientID, $clientName, $partnerID, $partnerName, $paymentItem, $paymentMoney, $paymentCoupon)
    {
        /*
        * 무통장 입금 신청.
        * 구동 환경, 결제 환경, 상담 모드, 내담자 이름, 상담사 이름, 결제 아이템/결제 금액.
        * $reqJandiAlarm->pushPayment('App', 'Paypal', $cID, $MakePayment->infoClient['name'], $getInfoOfPartner['id'], $getInfoOfPartner['name'], $paymentItem);
        */

        $headers = array("Content-Type:application/json;charset=utf-8","Accept:application/vnd.tosslab.jandi-v2+json");
        (string) $messageBody = "'" . $clientName . "' 내담자가 '" . $partnerName . "' 상담사에게 " . $this->counselingModeStr . " " . MadePaymentItemName($paymentItem) . "(" . number_format($paymentMoney) . "원" . checkCoupon($paymentCoupon) . ") 페이팔 입금 확인되어 승인되었습니다.";

        $request = array(
            "body"=>"[[결제안내]](http://trost.co.kr/manage/a2m1n/pages/supportInfo/payment/?query=jandi-alarm) " . $messageBody,
            "connectColor"=>"#999999",
            "connectInfo"=>array(
                "0"=>array("title"=>"[내담자 정보]","description"=>$clientName . " 내담자\n(" . $clientID . ")"),
                "1"=>array("title"=>"[상담사 정보]","description"=>$partnerName . " 상담사\n(" . $partnerID . ")"),
                "2"=>array("title"=>"[결제 정보]","description"=>"결제환경: " . $payDevice . "\n상담종류 : " . $this->counselingModeStr . "\n기간/금액 : " . MadePaymentItemName($paymentItem) . "권"),
            ),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://wh.jandi.com/connect-api/webhook/11259587/eb950e94d0bcc39d3fd598ea3e009cb1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_exec($ch);
        curl_close($ch);

    }

}
