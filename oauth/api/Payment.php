<?php
    /**
     * Copyright (c) 2017. 주식회사 휴마트컴퍼니. HumartCompany, Inc.
     */
    Class Payment
    {
        // For Class. (Information Of Payment)
        public $payDateFrom, $payDateTo, $payDate, $itemPrice, $couponItemPrice, $itemType, $itemDay, $itemCount, $PayCoupon, $PayMethod, $counselingPaymentMode, $sysMessage, $paymentType, $sentenceItem;
    
        // For Class. (Information Of Buyer, Counseling)
        public $roomNumber, $MatchPartner, $buyerID, $buyerName, $buyerTel;
    
        // For Response.
        public $counseling, $infoClient, $infoPartner, $response_msg, $recentlyNo;
    
        // For Construct.
        public function __construct($userType, $userItem, $userCoupon, $userCouponReferer, $userClient, $userRoomNo, $userPayMethod, $userBuyerName, $userBuyerTel, $userPartner) {
    
            global $conn_;
    
            (string) $this->payDateFrom = date("Y-m-d");
            (string) $this->payDate = date("Y-m-d A h:i");
            (string) $this->itemType = mysqli_real_escape_string($conn_, $userType);
            (string) $this->item = mysqli_real_escape_string($conn_, $userItem);
            (string) $this->PayCoupon = mysqli_real_escape_string($conn_, $userCoupon);
            (string) $this->PayCouponReferer = mysqli_real_escape_string($conn_, $userCouponReferer);
            (string) $this->buyerID = mysqli_real_escape_string($conn_, $userClient);
            (int) $this->roomNumber = mysqli_real_escape_string($conn_, $userRoomNo);
            (string) $this->PayMethod = mysqli_real_escape_string($conn_, $userPayMethod);
            (string) $this->buyerName = mysqli_real_escape_string($conn_, $userBuyerName);
            (string) $this->buyerTel = mysqli_real_escape_string($conn_, $userBuyerTel);
            (string) $this->MatchPartner = mysqli_real_escape_string($conn_, $userPartner);
    
            (array) $this->counselingPaymentMode = [
                "T30X1X5" => [
                    "itemName" => "텍스트 30분","itemFullName" => "텍스트 테라피 30분 전문 상담권","itemMinute" => "30분"
                ],
                "T50X1X5" => [
                    "itemName" => "텍스트 50분","itemFullName" => "텍스트 테라피 50분 전문 상담권","itemMinute" => "50분"
                ],
                "T30X4X14" => [
                    "itemName" => "텍스트 2주","itemFullName" => "텍스트 테라피 2주 단기 프로그램","itemMinute" => "30분"
                ],
                "T50X4X28" => [
                    "itemName" => "텍스트 4주","itemFullName" => "텍스트 테라피 4주 프로그램(문장완성검사 포함 상품)","itemMinute" => "50분"
                ],
                "T50X10X70" => [
                    "itemName" => "텍스트 10주","itemFullName" => "텍스트 테라피 10주 프로그램(문장완성검사 포함 상품)","itemMinute" => "50분"
                ],
                "V30X1X5" => [
                    "itemName" => "전화상담 30분","itemFullName" => "전화상담 30분 전문 상담권","itemMinute" => "30분"
                ],
                "V50X1X5" => [
                    "itemName" => "전화상담 50분","itemFullName" => "전화상담 50분 전문 상담권","itemMinute" => "50분"
                ],
                "V50X2X14" => [
                    "itemName" => "전화상담 2주","itemFullName" => "전화상담 2주 단기 프로그램","itemMinute" => "50분"
                ],
                "V30X4X28" => [
                    "itemName" => "전화상담 4주","itemFullName" => "전화상담 4주 프로그램(문장완성검사 포함 상품)","itemMinute" => "30분"
                ],
                "S-T50X1X14-V30X1X14" => [
                    "itemName" => "텍스트+전화","itemFullName" => "(혼합상담) 텍스트 + 전화 프로그램","itemMinute" => ""
                ],
                "S-SCT-T50X1X7" => [
                    "itemName" => "텍스트+검사","itemFullName" => "(심리검사) 심리검사 프로그램(문장완성검사 포함 상품)","itemMinute" => "50분"
                ]
            ];
    
            (string) $toDate = date("Y-m-d");
    
            if ($this->item === 'T30X1X5') {
                $this->itemPrice = '30000';
                $this->couponItemPrice = '30000';
                $this->itemDay = '5';
                $this->itemCount = '1';
                $this->paymentType = 'single';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'T50X1X5') {
                $this->itemPrice = '45000';
                $this->couponItemPrice = '45000';
                $this->itemDay = '5';
                $this->itemCount = '1';
                $this->paymentType = 'single';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'T30X4X14') {
                $this->itemPrice = '115000';
                $this->couponItemPrice = '120000';
                $this->itemDay = '14';
                $this->itemCount = '4';
                $this->paymentType = 'package';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'T50X4X28') {
                $this->itemPrice = '170000';
                $this->couponItemPrice = '170000';
                $this->itemDay = '28';
                $this->itemCount = '4';
                $this->paymentType = 'package';
                $this->sentenceItem = 'Y';
            } else if ($this->item === 'T50X10X70') {
                $this->itemPrice = '400000';
                $this->couponItemPrice = '400000';
                $this->itemDay = '70';
                $this->itemCount = '10';
                $this->paymentType = 'package';
                $this->sentenceItem = 'Y';
            } else if ($this->item === 'V30X1X5') {
                $this->itemPrice = '40000';
                $this->couponItemPrice = '40000';
                $this->itemDay = '5';
                $this->itemCount = '1';
                $this->paymentType = 'single';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'V50X1X5') {
                $this->itemPrice = '60000';
                $this->couponItemPrice = '60000';
                $this->itemDay = '5';
                $this->itemCount = '1';
                $this->paymentType = 'single';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'V50X2X14') {
                $this->itemPrice = '115000';
                $this->couponItemPrice = '115000';
                $this->itemDay = '14';
                $this->itemCount = '2';
                $this->paymentType = 'package';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'V30X4X28') {
                $this->itemPrice = '145000';
                $this->couponItemPrice = '145000';
                $this->itemDay = '28';
                $this->itemCount = '4';
                $this->paymentType = 'package';
                $this->sentenceItem = 'Y';
            } else if ($this->item === 'S-T50X1X14-V30X1X14') {
                $this->itemPrice = '80000';
                $this->couponItemPrice = '85000';
                $this->itemDay = '14';
                $this->itemCount = '1';
                $this->paymentType = 'package';
                $this->sentenceItem = 'N';
            } else if ($this->item === 'S-SCT-T50X1X7') {
                $this->itemPrice = '50000';
                $this->couponItemPrice = '75000';
                $this->itemDay = '7';
                $this->itemCount = '1';
                $this->paymentType = 'package';
                $this->sentenceItem = 'Y';
            }
    
            if ($this->PayCoupon) {
    
                if ($this->PayCoupon === 'FIRST-A-5000') {
                    $this->itemPrice = $this->couponItemPrice - 5000;
                } else if ($this->PayCoupon === 'REVIEW-A-5000') {
                    $this->itemPrice = $this->couponItemPrice - 5000;
                } else if ($this->PayCoupon === 'PLUS-A-10P') {
                    if ($this->paymentType === 'single') {
                        $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.1);
                    }
                } else if ($this->PayCoupon === 'FRIEND-BE-A-10P') {
                    $this->itemPrice = $this->couponItemPrice - 10000;
                } else if ($this->PayCoupon === 'FRIEND-B-A-10P') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.1);
                } else if ($this->PayCoupon === 'EVENT-T-20000') {
                    if ($this->item === 'T50X4X28') {
                        $this->itemPrice = $this->couponItemPrice - 20000;
                    }
                } else if ($this->PayCoupon === 'EVENT-RESEARCH') {
                    $this->itemPrice = $this->couponItemPrice - 5000;
                } else if ($this->PayCoupon === 'FINISH-5P') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.05);
                } else if ($this->PayCoupon === 'EVENT-DEFAULT') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.05);
                } else if ($this->PayCoupon === 'BLOG-PARTNER') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.1);
                } else if ($this->PayCoupon === 'GLOBAL-KOREAN') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.2);
                } else if ($this->PayCoupon === 'FACEBOOK-10P') {
                    $this->itemPrice = $this->couponItemPrice - ($this->couponItemPrice*0.1);
                } else if ($this->PayCoupon === 'FIRST-T50-15000') {
                    if ($this->item === 'T50X1X5') {
                        $this->itemPrice = $this->couponItemPrice - 15000;
                    }
                } else if (($this->PayCoupon === 'FREE-T30') || ($this->PayCoupon === 'FREE-T50') || ($this->PayCoupon === 'FREE-V30') || ($this->PayCoupon === 'FREE-V50')) {
                    $this->itemPrice = 0;
                }
    
                mysqli_query($conn_, "UPDATE `trost`.`coupon` SET `used` = 'Y', `usedD` = '" . $toDate. "' WHERE ((`client` = '" . $this->buyerID . "') && (`event` = 'itemCoupon') && (`item` = '" . $this->PayCoupon . "')) ORDER BY `no` DESC LIMIT 1;");
    
            }
    
            mysqli_query($conn_, "UPDATE `trost`.`coupon` SET `used` = 'Y', `usedD` = '" . $toDate. "' WHERE ((`client` = '" . $this->buyerID . "') && (`event` = 'itemCoupon') && (`item` = 'FIRST-T50-15000')) ORDER BY `no` DESC LIMIT 1;");
    
            $this->payDateTo = date("Y-m-d", strtotime("+" . $this->itemDay . " day"));
    
            /**
             * 상담 정보 조회 및 저장.
             */
            $getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `no` as `no`, `partner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE (`no_log` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1) as `recentlyNo` FROM `trost_counseling`.`counseling_log` WHERE (`no` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1;");
            $this->infoOfCounseling = mysqli_fetch_array($getInfoOfCounseling_q);
    
            $this->recentlyNo = $this->infoOfCounseling['recentlyNo'];
            /**/
    
            /**
             * 상담사, 내담자 정보 조회 및 저장.
             */
            $getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `badge`, `first_short_msg`, `first_long_msg`, `mp_first_voice_msg`, `phone` FROM `trost`.`mb_partner` WHERE (`id` = '" . $this->MatchPartner . "') ORDER BY `no` DESC LIMIT 1;");
            $this->infoPartner = mysqli_fetch_array($getInfoOfPartner_q);
    
            $getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `msg`, `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $this->buyerID . "') ORDER BY `no` DESC LIMIT 1;");
            $this->infoClient = mysqli_fetch_array($getInfoOfClient_q);
            /**/
    
            /**
             * 기존 결제가 있고, 종료되지 않은 경우 내역 합체.
             */
            $getAgainCheckPayment_q = mysqli_query($conn_, "SELECT `no`, `date_t`, `itemCount` FROM `trost`.`payment` WHERE ((`buyer` = '" . $this->buyerID . "') && (`date_t` >= '" . $this->payDateTo . "') && (`itemCount` != '0')) ORDER BY `date_t` DESC LIMIT 1;");
            $getAgainCheckPayment = mysqli_fetch_array($getAgainCheckPayment_q);
    
            if ($getAgainCheckPayment) {
    
                if ($getAgainCheckPayment['date_t'] >= $this->payDateTo) {
                    (int) $tempItemDay = 0;
    
                    // 결제 횟수 = 남은 횟수 + 결제 횟수
                    //                $this->itemCount += $getAgainCheckPayment['itemCount'];
    
                    // 결제 종료 기간 = 남은 기간(기존 결제 종료 - 오늘 = 기존 기간) + 결제 기간
                    $bStartDate = new DateTime($this->payDateFrom);
                    $bFinishDate = new DateTime($getAgainCheckPayment['date_t']);
    
                    $bDiffDate = date_diff($bStartDate, $bFinishDate);
    
                    $tempItemDay = $this->itemDay + $bDiffDate->days;
                    $this->payDateTo = date("Y-m-d", strtotime("+" . $tempItemDay . " day"));
                }
            }
            /**/
    
            /**
             * 시스템 메시지.
             */
            (array) $this->sysMessage = [
                "paymentFirstMessage" => $this->infoClient['name'] . " 님, 트로스트에 오신 것을 환영합니다. 지금 이 공간은 앞으로 " . $this->infoPartner['name'] . " 상담사님과의 상담이 진행되는 공간입니다. ",
                "afterPartnerMessage" => "* 첫 상담 일정을 위한 응대는 상담사의 일정에 따라 시간이 소요될 수 있습니다. 상담 기간 내에 정해진 실시간 상담 횟수를 충분히 이용하실 수 있으니 걱정하지 않으셔도 됩니다. 우선 상담사의 사전 질문지의 답변을 작성해주세요.",
                "buyVoicePayment" => $this->infoClient['name'] . " 님께서 구매하신 상담권의 정보입니다.\n- 상담권 정보 : " . $this->counselingPaymentMode[$this->item]['itemFullName'] . "\n- 신청 상담사 : " . $this->infoPartner['name'] . " 상담사\n- 사용가능기간 : " . $this->payDateFrom . " ~ " . $this->payDateTo . "\n\n* 이용방법 : 1. 구매하신 상담권은 사용 가능 기간 내에 전화상담 " . $this->counselingPaymentMode[$this->item]['itemMinute'] . " " . $this->itemCount . "회를 진행할 수 있습니다.\n2. 상담은 상담방에서 채팅으로 상담사와 일정 예약 > 예약된 시간에 상담방 입장 > 상담사가 전화상담을 시작 요청 > 상담 진행 의 순서로 진행됩니다.\n3. 전화상담의 경우 데이터 통신(lte, wifi 환경)을 통해 진행됩니다. 상담 진행시 안정적인 데이터 통신환경에서 진행하시기 바랍니다.",
                "buyTextPayment" => $this->infoClient['name'] . " 님께서 구매하신 상담권의 정보입니다.\n- 상담권 정보 : " . $this->counselingPaymentMode[$this->item]['itemFullName'] . "\n- 신청 상담사 : " . $this->infoPartner['name'] . " 상담사\n- 사용가능기간 : " . $this->payDateFrom . " ~ " . $this->payDateTo . "\n\n* 이용방법 : 구매하신 상담권은 사용 가능 기간 내에 실시간 상담 " . $this->counselingPaymentMode[$this->item]['itemMinute'] . " " . $this->itemCount . "회를 진행할 수 있습니다. 상담은 상담사와 일정 예약 > 예약된 시간에 상담사가 상담 시작 > 상담 진행의 순서로 진행됩니다.",
                "buySentence" => "* 상담방 내부 작성칸 좌측의 (+)메뉴에서 \'문장완성검사\'를 작성해주세요. (문장완성검사는 앱에서만 가능합니다)",
                "applyPaypal" => $this->buyerTel . " 으로 페이팔 결제 청구서가 발송된 상태입니다.\n페이팔에서 입금 완료 정보가 넘어오는대로 선택하신 상담사와 연결됩니다.\n\n*상담방 연결이 1일 이상 지연되는 경우 1:1 문의를 이용해주세요.",
                "buyPackageSCT" => $this->infoClient['name'] . " 님께서 구매하신 상담권의 정보입니다.\n- 상담권 정보 : " . $this->counselingPaymentMode[$this->item]['itemFullName'] . "\n- 신청 상담사 : " . $this->infoPartner['name'] . " 상담사\n- 사용가능기간 : " . $this->payDateFrom . " ~ " . $this->payDateTo . "\n* 이용방법 : 구매하신 상담권은 사용 가능 기간 내에 텍스트 테라피 실시간 상담 50분 1회를 진행할 수 있습니다. 상담은 상담사와 일정 예약 > 상담 시작 전 \'문장완성검사지\' 작성 > 예약된 시간에 상담사가 상담 시작 > 상담 진행의 순서로 진행됩니다.",
                "buyPackageMix" => $this->infoClient['name'] . " 님께서 구매하신 상담권의 정보입니다.\n- 상담권 정보 : " . $this->counselingPaymentMode[$this->item]['itemFullName'] . "\n- 신청 상담사 : " . $this->infoPartner['name'] . " 상담사\n- 사용가능기간 : " . $this->payDateFrom . " ~ " . $this->payDateTo . "\n* 이용방법 : 구매하신 상담권은 사용 가능 기간 내에 텍스트 테라피 실시간 상담 50분 1회와 전화상담 30분 1회를 진행할 수 있습니다. 상담은 상담사와 일정 예약 > 예약된 시간에 상담사가 상담 시작 > 상담 진행의 순서로 진행됩니다. 텍스트 테라피는 트로스트 웹(www.trost.co.kr)에서도 진행이 가능하오나 전화상담의 경우 데이터 통신을 이용해 진행되므로 트로스트 앱에서만 가능합니다.\n* 전화상담의 경우 데이터 통신(lte, wifi 환경)을 통해 진행됩니다. 상담 진행시 안정적인 데이터 통신환경에서 진행하시기 바랍니다.",
                "holidayMessageV1" => "5월 연휴 및 선거 기간으로 인해 상담사 선생님과 스케줄을 잡기가 어려우실 경우 선생님께 기간 연장을 요청해주시기 바랍니다.^^ 만약 상담사 변경을 원하실 경우 고객센터에 문의해주세요. 즐거운 연휴 보내시기 바랍니다."
            ];
        }
    
        public function PayCard_TEXT ()
        {
            global $conn_;
    
            if ($this->infoOfCounseling['no']) {
                /**
                 * 시스템 메시지 순서.
                 * [1] 자사 인사 메시지. (X)
                 * [2] 구매한 상담권 정보 메시지.
                 * [3] 상담사 사전 질문지 전송.
                 * [4] 상담사 사전 질문지 전송 후 메시지.
                 */
    
                /**
                 * 결제 이용권 안내 메시지.
                 */
                $this->recentlyNo += 1;
                mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buyTextPayment'] . "', 'trost', 'pc');");
                /**/
    
                if ($this->item === 'T50X10X70') {
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '이벤트 도서 증정을 위한 배송지 정보를 입력하여 주세요. https://goo.gl/4iPJoQ', 'trost', 'pc');");
                }
    
                /**
                 * 결제 데이터 생성 전에 같은 상담사 인지 다시 체크.
                 * 기존에 결제했던 선생님과 다른 선생님이여야지 사전 메시지 작성.
                 */
                $checkPaymentForMessage_q = mysqli_query($conn_, "SELECT `partner` FROM `trost`.`payment` WHERE (`buyer` = '" . $this->buyerID . "') ORDER BY `no` DESC LIMIT 1;");
                $checkPaymentForMessage = mysqli_fetch_array($checkPaymentForMessage_q);
    
                if (($checkPaymentForMessage['partner'] !== $this->MatchPartner) || (!$checkPaymentForMessage)) {
    
                    if ($this->paymentType === 'single') {
                        if ($this->infoPartner['first_short_msg']) {
                            $this->recentlyNo += 1;
                            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoPartner['first_short_msg'] . "', 'partner', 'pc');");
                        }
                    } else {
                        if ($this->infoPartner['first_long_msg']) {
                            $this->recentlyNo += 1;
                            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoPartner['first_long_msg'] . "', 'partner', 'pc');");
                        }
                    }
    
                    /**
                     * 사전 질문지 이후 실시간 관련 내용 안내.
                     */
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['afterPartnerMessage'] . "', 'trost', 'pc');");
                    /**/
    
                }
                /**/
    
                /**
                 * 문장 완성 쿠폰 지급.
                 */
                if ($this->sentenceItem === 'Y') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'SCT', '" . $this->buyerID . "', 'N', '" . $this->payDateTo . "');");
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buySentence'] . "', 'trost', 'pc');");
                }
    
                /**
                 * (1) 결제 정보 작성
                 * (2) 결제 정보 업데이트
                 */
                mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'Y' WHERE (`no` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1;");
                mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `p_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('" . $this->itemType . "', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
    
                /**
                 * 읽은 메시지 수 관리.
                 */
                $unReadBadge = $this->infoPartner['badge'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
    
                /**
                 * 메시지에 "[#finish#]" 가 있는 경우 제거.
                 */
                $getFinishMessage_q = mysqli_query($conn_, "SELECT `id`, `log` FROM `trost_counseling`.`log_counseling` WHERE ((`log` LIKE '%[#finish#]%') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `no` DESC LIMIT 1;");
                $getFinishMessage = mysqli_fetch_array($getFinishMessage_q);
    
                if ($getFinishMessage) {
                    $logMessage = explode('[#finish#]', $getFinishMessage['log']);
    
                    mysqli_query($conn_, "UPDATE `trost_counseling`.`log_counseling` SET `log` = '" . $logMessage['0'] . "' WHERE ((`id` = '" . $getFinishMessage['id'] . "') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `id` DESC LIMIT 1;");
                }
    
                /**
                 * 리뷰 작성 쿠폰 지급
                 */
                if ($this->paymentType === 'package') {
                    $couponExpireDate = new Datetime();
                    $couponExpireDate = $couponExpireDate->add(new DateInterval("P" . $this->itemDay . "D"));
                    $couponExpireDate = $couponExpireDate->format("Y-m-d");
    
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'PLUS-A-10P', '" . $this->buyerID . "', 'N', '" . $couponExpireDate . "');");
                }
    
                /**
                 * 상담 접수지 내 고민 작성.
                 */
                if ($this->infoClient['msg']) {
                    $this->infoClient['msg'] = "[상담 접수지 고민 내용] " . $this->infoClient['msg'];
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoClient['msg'] . "', 'client', 'pc');");
                }
    
                if ($this->infoPartner['phone']) {
                    if (($_SERVER['HTTP_HOST'] === 'old-api.trost.co.kr') || ($_SERVER['HTTP_HOST'] === 'www.old-api.trost.co.kr')) {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/api/sendMessage.php");
                    } else {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/oauth/api/sendMessage.php");
                    }
    
                    $clientName = mb_substr($this->infoClient['name'], 0, 2, 'UTF-8') . "~";
                    $itemContent = $this->counselingPaymentMode[$this->item]['itemName'];
    
                    $sms = new sms();
                    $aParams = array(
                        'TR_ID' => 'trost',
                        'TR_KEY' => 'AFFPJ0ZIRW',
                        'TR_TXTMSG' => '[트로스트] "[NAME]" 내담자가 [NAME2] 신청하셨습니다.',
                        'TR_TO' => array(
                            $this->infoPartner['phone'] => array(
                                'name' => $clientName,
                                'name2' => $itemContent,
                            ),
                        ),
                        'TR_FROM' => '02-6435-1242',
                        'TR_DATE' => '0',
                        'TR_COMMENT' => '상담사 결제 안내'
                    );
    
                    $recv = $sms->send($aParams);
                }
            }
        }
    
        public function PayCard_VOICE ()
        {
            global $conn_;
    
            if ($this->infoOfCounseling['no']) {
                /**
                 * 시스템 메시지 순서.
                 * [1] 자사 인사 메시지. (X)
                 * [2] 구매한 상담권 정보 메시지.
                 * [3] 상담사 사전 질문지 전송.
                 * [4] 상담사 사전 질문지 전송 후 메시지.
                 */
    
                /**
                 * 결제 이용권 안내 메시지.
                 */
                $this->recentlyNo += 1;
                mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buyVoicePayment'] . "', 'trost', 'pc');");
    
                /**
                 * 결제 데이터 생성 전에 같은 상담사 인지 다시 체크.
                 * 기존에 결제했던 선생님과 다른 선생님이여야지 사전 메시지 작성.
                 */
                $checkPaymentForMessage_q = mysqli_query($conn_, "SELECT `partner` FROM `trost`.`payment` WHERE (`buyer` = '" . $this->buyerID . "') ORDER BY `no` DESC LIMIT 1;");
                $checkPaymentForMessage = mysqli_fetch_array($checkPaymentForMessage_q);
    
                if (($checkPaymentForMessage['partner'] !== $this->MatchPartner) || (!$checkPaymentForMessage)) {
    
                    if ($this->infoPartner['mp_first_voice_msg']) {
                        $this->recentlyNo += 1;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoPartner['mp_first_voice_msg'] . "', 'partner', 'pc');");
                    }
    
                    /**
                     * 사전 질문지 이후 실시간 관련 내용 안내.
                     */
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['afterPartnerMessage'] . "', 'trost', 'pc');");
    
                }
    
                /**
                 * 문장 완성 쿠폰 지급.
                 */
                if ($this->sentenceItem === 'Y') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'SCT', '" . $this->buyerID . "', 'N', '" . $this->payDateTo . "');");
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buySentence'] . "', 'trost', 'pc');");
                }
    
                /**
                 * 1) 결제 정보 작성
                 * 2) 결제 정보 업데이트
                 */
                mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'Y' WHERE (`no` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1;");
                mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `p_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('" . $this->itemType . "', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
    
                /**
                 * 읽은 메시지 수 관리.
                 */
                $unReadBadge = $this->infoPartner['badge'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
    
                /**
                 * 메시지에 "[#finish#]" 가 있는 경우 제거.
                 */
                $getFinishMessage_q = mysqli_query($conn_, "SELECT `id`, `log` FROM `trost_counseling`.`log_counseling` WHERE ((`log` LIKE '%[#finish#]%') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `no` DESC LIMIT 1;");
                $getFinishMessage = mysqli_fetch_array($getFinishMessage_q);
    
                if ($getFinishMessage) {
                    $logMessage = explode('[#finish#]', $getFinishMessage['log']);
    
                    mysqli_query($conn_, "UPDATE `trost_counseling`.`log_counseling` SET `log` = '" . $logMessage['0'] . "' WHERE ((`id` = '" . $getFinishMessage['id'] . "') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `id` DESC LIMIT 1;");
                }
    
                /**
                 * 리뷰 작성 쿠폰 지급
                 */
                if ($this->paymentType === 'package') {
                    $couponExpireDate = new Datetime();
                    $couponExpireDate = $couponExpireDate->add(new DateInterval("P" . $this->itemDay . "D"));
                    $couponExpireDate = $couponExpireDate->format("Y-m-d");
    
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'PLUS-A-10P', '" . $this->buyerID . "', 'N', '" . $couponExpireDate . "');");
                }
    
                /**
                 * 상담 접수지 내 고민 작성.
                 */
                if ($this->infoClient['msg']) {
                    $this->infoClient['msg'] = "[상담 접수지 고민 내용] " . $this->infoClient['msg'];
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoClient['msg'] . "', 'client', 'pc');");
                }
    
                if ($this->infoPartner['phone']) {
                    if (($_SERVER['HTTP_HOST'] === 'old-api.trost.co.kr') || ($_SERVER['HTTP_HOST'] === 'www.old-api.trost.co.kr')) {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/api/sendMessage.php");
                    } else {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/oauth/api/sendMessage.php");
                    }
    
                    $clientName = mb_substr($this->infoClient['name'], 0, 2, 'UTF-8') . "~";
                    $itemContent = $this->counselingPaymentMode[$this->item]['itemName'];
    
                    $sms = new sms();
                    $aParams = array(
                        'TR_ID' => 'trost',
                        'TR_KEY' => 'AFFPJ0ZIRW',
                        'TR_TXTMSG' => '[트로스트] "[NAME]" 내담자가 [NAME2] 신청했습니다.',
                        'TR_TO' => array(
                            $this->infoPartner['phone'] => array(
                                'name' => $clientName,
                                'name2' => $itemContent,
                            ),
                        ),
                        'TR_FROM' => '02-6435-1242',
                        'TR_DATE' => '0',
                        'TR_COMMENT' => '상담사 결제 안내'
                    );
    
                    $recv = $sms->send($aParams);
                }
            }
        }
    
        public function PayCard_Special ()
        {
            global $conn_;
    
            if ($this->infoOfCounseling['no']) {
    
                $this->recentlyNo += 1;
    
                if ($this->item === 'S-T50X1X14-V30X1X14') {
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buyPackageMix'] . "', 'trost', 'pc');");
    
                    /**
                     * 결제 데이터 생성 전에 같은 상담사 인지 다시 체크.
                     * 기존에 결제했던 선생님과 다른 선생님이여야지 사전 메시지 작성.
                     */
                    $checkPaymentForMessage_q = mysqli_query($conn_, "SELECT `partner` FROM `trost`.`payment` WHERE (`buyer` = '" . $this->buyerID . "') ORDER BY `no` DESC LIMIT 1;");
                    $checkPaymentForMessage = mysqli_fetch_array($checkPaymentForMessage_q);
    
                    if (($checkPaymentForMessage['partner'] !== $this->MatchPartner) || (!$checkPaymentForMessage)) {
    
                        if ($this->infoPartner['mp_first_voice_msg']) {
                            $this->recentlyNo += 1;
                            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoPartner['mp_first_voice_msg'] . "', 'partner', 'pc');");
                        }
    
                        /**
                         * 사전 질문지 이후 실시간 관련 내용 안내.
                         */
                        $this->recentlyNo += 1;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['afterPartnerMessage'] . "', 'trost', 'pc');");
    
                    }
                } else if ($this->item === 'S-SCT-T50X1X7') {
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buyPackageSCT'] . "', 'trost', 'pc');");
    
                    /**
                     * 결제 데이터 생성 전에 같은 상담사 인지 다시 체크.
                     * 기존에 결제했던 선생님과 다른 선생님이여야지 사전 메시지 작성.
                     */
                    $checkPaymentForMessage_q = mysqli_query($conn_, "SELECT `partner` FROM `trost`.`payment` WHERE (`buyer` = '" . $this->buyerID . "') ORDER BY `no` DESC LIMIT 1;");
                    $checkPaymentForMessage = mysqli_fetch_array($checkPaymentForMessage_q);
    
                    if (($checkPaymentForMessage['partner'] !== $this->MatchPartner) || (!$checkPaymentForMessage)) {
    
                        if ($this->infoPartner['first_short_msg']) {
                            $this->recentlyNo += 1;
                            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoPartner['first_short_msg'] . "', 'partner', 'pc');");
                        }
    
                        /**
                         * 사전 질문지 이후 실시간 관련 내용 안내.
                         */
                        $this->recentlyNo += 1;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['afterPartnerMessage'] . "', 'trost', 'pc');");
    
                    }
                }
    
                /**
                 * 문장 완성 쿠폰 지급.
                 */
                if ($this->sentenceItem === 'Y') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'SCT', '" . $this->buyerID . "', 'N', '" . $this->payDateTo . "');");
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage['buySentence'] . "', 'trost', 'pc');");
                }
    
                /**
                 * 1) 결제 정보 작성
                 * 2) 결제 정보 업데이트
                 */
                mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'Y' WHERE (`no` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1;");
    
                if ($this->item === 'S-T50X1X14-V30X1X14') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `p_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '0', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
                    mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `p_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('voicetime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
                } else if ($this->item === 'S-SCT-T50X1X7') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `p_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
                }
    
                /**
                 * 읽은 메시지 수 관리.
                 */
                $unReadBadge = $this->infoPartner['badge'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
    
                /**
                 * 메시지에 "[#finish#]" 가 있는 경우 제거.
                 */
                $getFinishMessage_q = mysqli_query($conn_, "SELECT `id`, `log` FROM `trost_counseling`.`log_counseling` WHERE ((`log` LIKE '%[#finish#]%') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `no` DESC LIMIT 1;");
                $getFinishMessage = mysqli_fetch_array($getFinishMessage_q);
    
                if ($getFinishMessage) {
                    $logMessage = explode('[#finish#]', $getFinishMessage['log']);
    
                    mysqli_query($conn_, "UPDATE `trost_counseling`.`log_counseling` SET `log` = '" . $logMessage['0'] . "' WHERE ((`id` = '" . $getFinishMessage['id'] . "') && (`no_log` = '" . $this->roomNumber . "') && (`log_from` = 'trost')) ORDER BY `id` DESC LIMIT 1;");
                }
    
                /**
                 * 리뷰 작성 쿠폰 지급
                 */
                if ($this->paymentType === 'package') {
                    $couponExpireDate = new Datetime();
                    $couponExpireDate = $couponExpireDate->add(new DateInterval("P" . $this->itemDay . "D"));
                    $couponExpireDate = $couponExpireDate->format("Y-m-d");
    
                    mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `client`, `used`, `finishD`) VALUES ('" . $this->payDateFrom . "', 'itemCoupon', 'text', 'PLUS-A-10P', '" . $this->buyerID . "', 'N', '" . $couponExpireDate . "');");
                }
    
                /**
                 * 상담 접수지 내 고민 작성.
                 */
                if ($this->infoClient['msg']) {
                    $this->infoClient['msg'] = "[상담 접수지 고민 내용] " . $this->infoClient['msg'];
    
                    $this->recentlyNo += 1;
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoClient['msg'] . "', 'client', 'pc');");
                }
    
                if ($this->infoPartner['phone']) {
                    if (($_SERVER['HTTP_HOST'] === 'old-api.trost.co.kr') || ($_SERVER['HTTP_HOST'] === 'www.old-api.trost.co.kr')) {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/api/sendMessage.php");
                    } else {
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/oauth/api/sendMessage.php");
                    }
    
                    $clientName = mb_substr($this->infoClient['name'], 0, 2, 'UTF-8') . "~";
                    $itemContent = $this->counselingPaymentMode[$this->item]['itemName'];
    
                    $sms = new sms();
                    $aParams = array(
                        'TR_ID' => 'trost',
                        'TR_KEY' => 'AFFPJ0ZIRW',
                        'TR_TXTMSG' => '[트로스트] "[NAME]" 내담자가 [NAME2] 신청하셨습니다.',
                        'TR_TO' => array(
                            $this->infoPartner['phone'] => array(
                                'name' => $clientName,
                                'name2' => $itemContent,
                            ),
                        ),
                        'TR_FROM' => '02-6435-1242',
                        'TR_DATE' => '0',
                        'TR_COMMENT' => '상담사 결제 안내'
                    );
    
                    $recv = $sms->send($aParams);
                }
    
            } else {
                return 0;
            }
        }
    
        public function PayBank_ALL ($bankCode, $bankNum, $paymentID, $expireDate, $expireTime)
        {
            global $conn_;
    
            if ($this->infoOfCounseling['no']) {
    
                if ($this->PayMethod == 'APP_payBank') {
                    $this->PayMethod = '무통장입금_앱';
                    $device = 'mobile';
                } else {
                    $this->PayMethod = '무통장입금';
                    $device = 'pc';
                }
    
                $expireDateString = $expireDate . "/" . $expireTime;
    
                if ($bankCode == "11") { $bankString = "NH농협은행 : " . $bankNum; }
                else if ($bankCode == "04") { $bankString = "KB국민은행 : " . $bankNum; }
                else if ($bankCode == "88") { $bankString = "신한은행 : " . $bankNum; }
                else if ($bankCode == "20") { $bankString = "우리은행 : " . $bankNum; }
                else if ($bankCode == "03") { $bankString = "기업은행 : " . $bankNum; }
                else if ($bankCode == "81") { $bankString = "KEB 하나은행 : " . $bankNum; }
                else if ($bankCode == "31") { $bankString = "대구은행 : " . $bankNum; }
                else if ($bankCode == "32") { $bankString = "부산은행 : " . $bankNum; }
                else if ($bankCode == "71") { $bankString = "우체국 : " . $bankNum; }
                else if ($bankCode == "34") { $bankString = "광주은행 : " . $bankNum; }
                else if ($bankCode == "23") { $bankString = "SC은행 : " . $bankNum; }
                else if ($bankCode == "39") { $bankString = "경남은행 : " . $bankNum; }
                else if ($bankCode == "27") { $bankString = "한국씨티은행 : " . $bankNum; }
                else if ($bankCode == "07") { $bankString = "수협중앙회 : " . $bankNum; }
                else { $bankString = "우리은행 : 1005-502-954964"; }
    
                $expireDateString_ = explode('/', $expireDateString);
    
                $bank_date_year = substr($expireDateString_['0'], 0, 4);
                $bank_date_month = substr($expireDateString_['0'], 4, 2);
                $bank_date_day = substr($expireDateString_['0'], 6, 2);
    
                $bank_time_hour = substr($expireDateString_['1'], 0, 2);
                $bank_time_minute = substr($expireDateString_['1'], 2, 2);
    
                $expireDate = $bank_date_year . "." . $bank_date_month . "." . $bank_date_day . " " . $bank_time_hour . ":" . $bank_time_minute;
    
                $this->sysMessage["applyBank"] = "무통장 입금 신청 상태입니다. 입금 후 최대 1시간 이내로 상담방이 연결됩니다.\n\n- " . $this->counselingPaymentMode[$this->item]['itemFullName'] . "(상담사: " . $this->infoPartner['name'] . ")\n- " . $bankString . "\n- 예금주 : (주)휴마트컴퍼니\n- 입금 금액 : " . number_format($this->itemPrice) . "원\n- 입금 기한 : " . $expireDate . "\n\n*기한 내 미입금시 자동으로 신청이 취소됩니다.\n";
    
                /**
                 * 1) 결제 정보 작성
                 * 2) 시스템 메세지 작성
                 */
                if ($this->item === 'S-T50X1X14-V30X1X14') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`, `pe_bank_info_string`, `pe_bank_expire_time`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $paymentID . "', '" . $bankString . "', '" . $expireDateString . "');");
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`, `pe_bank_info_string`, `pe_bank_expire_time`) VALUES ('voicetime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $paymentID . "', '" . $bankString . "', '" . $expireDateString . "');");
                } else if ($this->item === 'S-SCT-T50X1X7') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`, `pe_bank_info_string`, `pe_bank_expire_time`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $paymentID . "', '" . $bankString . "', '" . $expireDateString . "');");
                } else {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`, `pe_bank_info_string`, `pe_bank_expire_time`) VALUES ('" . $this->itemType . "', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $paymentID . "', '" . $bankString . "', '" . $expireDateString . "');");
                }
    
                $this->recentlyNo += 1;
                mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage["applyBank"] . "', 'trost', '" . $device . "');");
                /**/
    
                /**
                 * 읽은 메시지 수 관리.
                 */
                $unReadBadge = $this->infoPartner['badge'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
                /**/
    
            }
    
        }
    
        public function PayCard_Paypal ($invoiceID)
        {
            global $conn_;
    
            if ($this->infoOfCounseling['no']) {
    
                if ($this->PayMethod == 'APP') {
                    $this->PayMethod = 'Paypal-App';
                    $device = 'mobile';
                } else {
                    $this->PayMethod = 'Paypal';
                    $device = 'pc';
                }
    
                /**
                 * 1) 결제 정보 작성
                 * 2) 시스템 메세지 작성
                 */
                if ($this->item === 'S-T50X1X14-V30X1X14') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $invoiceID . "');");
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`) VALUES ('voicetime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $invoiceID . "');");
                } else if ($this->item === 'S-SCT-T50X1X7') {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`) VALUES ('texttime', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $invoiceID . "');");
                } else {
                    mysqli_query($conn_, "INSERT INTO `trost`.`paymentExtra` (`type`, `pe_type_item`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`, `pe_bank_info`) VALUES ('" . $this->itemType . "', '" . $this->item . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "', '" . $invoiceID . "');");
                }
    
                $this->recentlyNo += 1;
                mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->sysMessage["applyPaypal"] . "', 'trost', '" . $device . "');");
                /**/
    
                /**
                 * 읽은 메시지 수 관리.
                 */
                $unReadBadge = $this->infoPartner['badge'] + 1;
                mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
                /**/
    
            }
    
        }
    
        //		public function PayCard_FACE ()
        //		{
        //
        //			global $conn_;
        //
        //			if ($this->infoOfCounseling['no']) {
        //
        //				/*
        //				* 1) 결제 정보 작성
        //				* 2) 결제 정보 업데이트
        //				* 3) 시스템 메세지 작성
        //				*/
        //				mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'Y' WHERE (`no` = '" . $this->roomNumber . "') ORDER BY `no` DESC LIMIT 1;");
        //				mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoClient['name'] . "님이 " . $this->infoPartner['name'] . " 상담사와 매칭되었습니다.\n\n이용정보 : 화상상담 " . $this->itemCount . "회 이용권\n유효기간 : " . $this->payDateFrom . " ~ " . $this->payDateTo . "\n\n* 이용방법 안내\n1. 유효기간 내에 상담사와 일정 예약 후 화상상담을 진행할 수 있습니다.\n2. 대화방에서 상담사와 채팅으로 상담 일정을 예약 > 예약된 시간에 상담사가 상담 시작 > 상담 진행 의 순서로 진행됩니다.\n3. 고민 내용이 복잡하여 따로 정리가 필요할 때는 상담사에게 문의하여 제시되는 양식에 따라 사전 텍스트 인터뷰로 고민을 남길 수 있습니다. 남긴 고민에 대한 상담은 화상상담에서 진행됩니다.\n4. 화상상담은 1회 최소 30분에서 최대 2시간까지 상담사와 협의 후 진행할 수 있습니다.\n5. 남은 이용 횟수 확인은 [내 상태] 페이지에서 확인 가능합니다.\n6. 상담사가 다른 내담자와 상담 중이거나 다른 일정이 있을 경우 답장이 늦어질 수 있습니다.', 'trost', 'pc');");
        //				mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('" . $this->itemType . "', '" . $this->itemDay . "', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateTo . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "');");
        //				/***********************************/
        //
        //				// 화상/전화상담 1회, 3회, 5회 이용권 결제 시 '화상상담 50,000원 할인 쿠폰' 발급.
        //				$FVCouponDate = new Datetime($this->payDateTo);
        //				$FVCouponDate = $FVCouponDate->add(new DateInterval("P10D"));
        //				$FVCouponDate = $FVCouponDate->format("Y-m-d");
        //
        //				mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (`openD`, `event`, `type`, `item`, `referer`, `finishD`, `client`) VALUES ('" . $this->payDateFrom . "', 'promo5', 'text', 'F-F@50', 'PAYMENT-F', '" . $FVCouponDate . "', '" . $this->buyerID . "');");
        //				//
        //
        //				if ($this->infoPartner['id'] != 'cordpartner01') {
        //					$unReadBadge = $this->infoPartner['badge'] + 1;
        //					mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
        //				}
        //                if ($this->infoPartner['phone']) {
        //
        //                    if (($_SERVER['HTTP_HOST'] === 'old-api.trost.co.kr') || ($_SERVER['HTTP_HOST'] === 'www.old-api.trost.co.kr')) {
        //                        include_once($_SERVER['DOCUMENT_ROOT'] . "/api/sendMessage.php");
        //                    } else {
        //                        include_once($_SERVER['DOCUMENT_ROOT'] . "/oauth/api/sendMessage.php");
        //                    }
        //
        //                    $clientName = mb_substr($this->infoClient['name'], 0, 2, 'UTF-8') . "~";
        //                    $itemContent = "화상 " . $this->itemCount . "회";
        //
        //                    $sms = new sms();
        //                    $aParams = array(
        //                        'TR_ID' => 'trost',
        //                        'TR_KEY' => 'AFFPJ0ZIRW',
        //                        'TR_TXTMSG' => '[트로스트] "[NAME]" 내담자가 [NAME2] 신청했습니다.',
        //                        'TR_TO' => array(
        //                            $this->infoPartner['phone'] => array(
        //                                'name' => $clientName,
        //                                'name2' => $itemContent,
        //                            ),
        //                        ),
        //                        'TR_FROM' => '02-6435-1242',
        //                        'TR_DATE' => '0',
        //                        'TR_COMMENT' => '상담사 결제 안내'
        //                    );
        //
        //                    $recv = $sms->send($aParams);
        //
        //                }
        //
        //			}
        //
        //		}
    
        //		public function PayCard_AddText()
        //{
        //
        //			// if ($this->infoOfCounseling['no']) {
        //
        //				global $conn_;
        //
        //				/*
        //				* 해당 결제기록에 금액, 실시간 회수 추가.
        //				* 정산을 위한 추가 결제 기록 생성.
        //				*/
        //				mysqli_query($conn_, "UPDATE `trost`.`payment` AS `infoA` LEFT JOIN `trost`.`payment` AS `infoB` ON `infoA`.`no` = `infoB`.`no` SET `infoB`.`itemCount` = `infoB`.`itemCount` + '" . $this->itemCount . "' WHERE ((`infoB`.`chat_log` = '" . $this->roomNumber . "') && (`infoB`.`type` = 'texttime'))");
        //				mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `buyername`, `buyertel`, `chat_log`, `partner`) VALUES ('texttime_Add', '0', '" . $this->itemCount . "', '" . $this->payDateFrom . "', '" . $this->payDateFrom . "', '" . $this->payDate . "', '" . $this->itemPrice . "', '" . $this->PayMethod . "', '" . $this->buyerID . "', '" . $this->buyerName . "', '" . $this->buyerTel . "', '" . $this->roomNumber . "', '" . $this->MatchPartner . "')");
        //				/**/
        //
        //				/*
        //				* (1) 안내 시스템메세지 작성.
        //				* (2) 상담사 안 읽은 메세지 +1.
        //				*/
        //				mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recentlyNo . "', '" . $this->roomNumber . "', '" . $this->payDate . "', '" . $this->infoClient['name'] . " 내담자가 " . $this->infoPartner['name'] . " 상담사에게 실시간 상담 " . $this->itemCount . "회를 추가로 결제하셨습니다. 이용권 기간 내에 상담을 진행해주시기 바랍니다.', 'trost', 'pc')");
        //
        //				(int) $unReadBadge = $this->infoPartner['badge'] + 1;
        //				mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->infoPartner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
        //				/**/
        //
        //			// }
        //
        //		}
    
    }