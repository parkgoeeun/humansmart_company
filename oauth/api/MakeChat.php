<?php
	/**
	 * Copyright (c) 2017. 주식회사 휴마트컴퍼니. HumartCompany, Inc.
	 */

	Class MakeChat
	{
		// For Class
		public $partne_rID, $time_start, $sys_message;

		// For Response
		public $partner, $client, $chat_log, $recently_no, $date_t;

		function __construct()
		{
			$this->partne_rID = "cordpartner01";
			$this->time_start = date("Y-m-d A h:i");
		}

		function Make_withNormal ($clientID, $device)
		{

			global $conn_;

			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $device = mysqli_real_escape_string($conn_, $device);

			/*
			* 내담자/상담사 정보 조회 + 등록.
			*/
			$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `badge`, `phone` FROM `trost`.`mb_partner` WHERE (`id` = '" . mysqli_real_escape_string($conn_, $this->partne_rID) . "') ORDER BY `no` DESC LIMIT 1;");
			$this->partner = mysqli_fetch_array($getInfoOfPartner_q);

			$getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name`, `msg` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->client = mysqli_fetch_array($getInfoOfClient_q);

			mysqli_query($conn_, "INSERT INTO `trost_counseling`.`counseling_log` (time_start, partner, client, cl_device) VALUES ('" . $this->time_start . "', '" . $this->partner['id'] . "', '" . $this->client['id'] . "', '" . $device . "');");
			(int) $this->chat_log['no'] = mysqli_insert_id($conn_);
			/**/

			/*
			 * 시스템 메세지.
			 */
			$this->sys_message = array(
				"1" => $this->client['name'] . "님,\n트로스트에 오신 것을 환영합니다.\n\n지금 이 공간은 맞춤형 상담사 추천을 위해 트로스트 코디네이터와 연결된 접수 상담 공간입니다.",
				"2" => "*접수 상담을 위한 간단 Tip*\n\n1. 상담 받고 싶은 고민을 편하게 말씀해주세요.\n" . $this->client['name'] . "님만의 맞춤형 상담사를 추천 받을 수 있습니다.\n\n2. 상담 신청이 많을 경우 답변이 늦어질 수 있습니다. 잠시만 기다려주세요.\n\n3. 트로스트 App을 설치하면 트로스트 코디네이터의 답변 알림을 바로 받아 보실 수 있습니다.",
				"3" => "[부재중 안내] 현재 트로스트 코디네이터가 부재중입니다. ** 상담사 선택 버튼을 누르시면, 접수 상담 없이도 바로 상담사를 추천 받으실 수 있습니다. **",
				"4" => "[부재중 안내] 현재 트로스트 코디네이터가 부재중입니다. 접수하신 내용은 내일 오전에 답변을 드립니다.\n\n**실시간 안내 시간** (월~금) 10:00am ~ 09:00pm, (토~일) 1:00pm ~ 8:00pm\n**트로스트 App으로 접속 시 오전 트로스트 코디네이터의 답변 알림을 즉시 받아보실 수 있습니다",
				"5" => "설 연휴 코디네이터 부재중 안내\n<2017.01.27.~2017.01.29.>\n위 기간 동안은 설 연휴 휴무로 코디네이터 운영(상담 접수)이 중단됩니다. 남겨주신 메시지는 연휴 후 1월 30일에 답변 드립니다.\n상담사 선택 및 이용권 결제는 가능하며, 연휴로 인해 이루어지지 못한 상담은 상담사 선생님께 말씀해주시면 기간을 연장해드립니다.\n새해 복 많이 받으세요."
			);

			if ($device === 'APP') {
				$deviceMsg = 'mobile';
			} else {
				$deviceMsg = 'pc';
			}
			/**/

			/*
			 * 부재중 여부.
			 */
			(string) $DateTimeWeek = date("N");
			(string) $DateTimeSet = date("A");
			(string) $DateTimeHour = date("H");
			(int) $Missed = 0;

			if (($DateTimeWeek == 6) || ($DateTimeWeek == 7)) {
				if (($DateTimeHour < 13) || ($DateTimeHour > 19)) {
					$Missed = 1;
				}
			} else {
				if (($DateTimeHour < 10) || ($DateTimeHour > 20)) {
					$Missed = 1;
				}
			}
			/**/

			/*
			 * 시스템 메세지 작성.
			 * Missed, True, 부재 중. 시부고부 / 시부.
			 * Missed, False, 평일 시간. 시시고. / 시시.
			 */
			if ($Missed) {

				if ($this->client['msg']) {
					$this->recently_no = 4;
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', '" . $deviceMsg . "'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', '" . $deviceMsg . "'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->client['msg'] . "', 'client', '" . $deviceMsg . "'), ('4', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['4'] . "', 'trost', '" . $deviceMsg . "');");
				} else {
					$this->recently_no = 3;
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', '" . $deviceMsg . "'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', '" . $deviceMsg . "'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['3'] . "', 'trost', '" . $deviceMsg . "');");
				}

			} else {

				if ($this->client['msg']) {
					$this->recently_no = 3;
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', '" . $deviceMsg . "'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', '" . $deviceMsg . "'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->client['msg'] . "', 'client', '" . $deviceMsg . "')");
				} else {
					$this->recently_no = 2;
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', '" . $deviceMsg . "'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', '" . $deviceMsg . "')");
				}

			}
			/**/

			(int) $historyNo = $this->recently_no - 1;
			(int) $ExtraNo = $this->recently_no + 1;

			/*
			* 메세지 읽은 번호 수정
			*/
			mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `historyPartner` = '" . $historyNo . "' WHERE (`no` = '" . $this->chat_log['no'] . "') ORDER BY `no` DESC LIMIT 1;");

			/*
			* 상담사 배지 수정
			*/
			(int) $unReadBadge = $this->partner['badge'] + 1;
			mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->partner['id'] . "') ORDER BY `no` DESC LIMIT 1;");

		}

		function Make_withCode ($clientID, $partnerID, $device)
		{
			global $conn_;

			(string) $partnerID = mysqli_real_escape_string($conn_, $partnerID);
			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $device = mysqli_real_escape_string($conn_, $device);

			/*
			* 내담자/상담사 정보 조회 + 등록.
			*/
			$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `badge`, `phone` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->partner = mysqli_fetch_array($getInfoOfPartner_q);

			$getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name`, `msg` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->client = mysqli_fetch_array($getInfoOfClient_q);

            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`counseling_log` (time_start, partner, client, payment, cl_device) VALUES ('" . $this->time_start . "', '" . $this->partner['id'] . "', '" . $this->client['id'] . "', 'Y', '" . $device . "')");
            /**/

            /*
            * 상담 생성 시스템메세지 작성.
            */
            $getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `no` FROM `trost_counseling`.`counseling_log` WHERE ((`partner` = '" . $partnerID . "') && (`client` = '" . $clientID . "')) ORDER BY `no` DESC LIMIT 1;");
            $this->chat_log = mysqli_fetch_array($getInfoOfCounseling_q);

            $this->sys_message = [
				"1" => $this->client['name'] . " 님,\n트로스트에 오신 것을 환영합니다. 지금 이 공간은 앞으로 " . $this->partner['name'] . " 상담사님과의 상담이 진행되는 공간입니다.",
			];

			(int) $this->recently_no = 1;
            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc');");

            (int) $historyNo = $this->recently_no - 1;
			(int) $ExtraNo = $this->recently_no + 1;
			/**/

			/*
			 * 메세지 읽은 번호 수정
			 */
//			mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `historyPartner` = '" . $historyNo . "' WHERE (`no` = '" . $this->chat_log['no'] . "');");
			/**/

			/*
			 * 상담사 배지 수정
			 */
			(int) $unReadBadge = $this->partner['badge'] + 1;
			mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $this->partner['id'] . "') ORDER BY `no` DESC LIMIT 1;");
            /**/
		}

		function Make_withCompany ($clientID, $partnerID, $device)
		{
			// 방이 존재하지 않는 상태에서 기업 상담을 신청하는 경우.
			global $conn_;

			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $partnerID = mysqli_real_escape_string($conn_, $partnerID);
			(string) $device = mysqli_real_escape_string($conn_, $device);
			(string) $toDate = date("Y-m-d");

			$getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `pInfo`.`co_group_counseling_status` As `co_group_counseling_status`, `pInfo`.`co_group_first_message` As `co_group_first_message`, `pInfo`.`co_group_payment` As `co_group_payment`, `pInfo`.`groupID` As `groupID`, `pInfo`.`startDate` As `startDate`, `pInfo`.`finishDate` As `finishDate` FROM `trost_company`.`clientInfo` As `cInfo` INNER JOIN `trost_company`.`companyInfo` As `pInfo` ON `cInfo`.`groupID` = `pInfo`.`groupID` WHERE ((`cInfo`.`trostID` = '" . $clientID . "') && (`pInfo`.`startDate` <= '" . $toDate . "') && (`pInfo`.`finishDate` >= '" . $toDate . "')) ORDER BY `cInfo`.`no` DESC LIMIT 1;");
			$getInfoOfCounseling = mysqli_fetch_array($getInfoOfCounseling_q);

			if ($getInfoOfCounseling) {
				/*
				 * 내담자/상담사 상담 정보 조회 + 등록
				 */
				$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `badge`, `phone` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
				$this->partner = mysqli_fetch_array($getInfoOfPartner_q);

				$getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name`, `msg` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$this->client = mysqli_fetch_array($getInfoOfClient_q);

				mysqli_query($conn_, "INSERT INTO `trost_counseling`.`counseling_log` (time_start, partner, client, payment, cl_device) VALUES ('" . $this->time_start . "', '" . $this->partner['id'] . "', '" . $this->client['id'] . "', 'Y', '" . $device . "');");

				$this->chat_log['no'] = mysqli_insert_id($conn_);
				/**/

				/*
				 * 시스템 메세지 저장.
				 */
				if ($getInfoOfCounseling['co_group_first_message']) {
					$firstMessage = $getInfoOfCounseling['co_group_first_message'];
				} else {
					$firstMessage = "안녕하세요,\n" . $getInfoOfCounseling['groupID'] . " 트로스트 무료 체험 기간: " . $getInfoOfCounseling['startDate'] . " ~ "  . $getInfoOfCounseling['finishDate'] . "\n상담사 선생님과 시간을 정해 일주일 1회 60분 동안 실시간 상담을 진행할 수 있습니다.\n그 외 시간은 비실시간으로 연결되어 있으니 필요에 따라 사용하여 주시기 바랍니다.\n무료체험기간 동안 상담의 가능성과 변화의 실마리를 찾을 수 있길 바라겠습니다.";
				}

				$this->sys_message = [
					"1" => "제휴기관 회원 인증 및 상담사와의 연결이 완료되었습니다.",
					"2" => $firstMessage,
					"3" => "안녕하세요 " . $this->client['name'] . " 님\n근로복지넷과 함께하는 심리상담 메신저, 트로스트입니다.\n\n지금 이 공간은 앞으로 " . $this->partner['name'] . " 상담사님과의 상담이 진행되는 공간입니다.\n아래의 내용을 확인하시고, 전화상담과 화상(비디오) 상담 중 진행하실 상담을 선택해주세요.\n\n1. 전화상담(1회 20분) 14회 제공, 2회 연속 사용 가능\n2. 화상상담(1회 50분) 7회 제공\n(1개만 선택 가능, 선택 후 변경 불가)",
					"4" => $this->client['name'] . " 님, 첫 상담 진행 전 상담 시작 설문조사에 응답해 주시길 바랍니다." . "\n\n" . "https://goo.gl/forms/ZyvqMNo0kpIhxlNn1" . "\n\n" . "필수 설문조사이기 때문에, 설문조사에 참여해주셔야 첫 상담 진행이 가능합니다. 감사합니다."
				];

				if (($getInfoOfCounseling['groupID'] === '근로') || ($getInfoOfCounseling['groupID'] === '근로복지넷')) {

                    if ($this->client['msg'] == '') {
                        $this->recently_no = 3;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', 'pc'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['3'] . "', 'trost', 'pc'), ('4', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['4'] . "', 'partner', 'pc');");
                    } else {
                        $this->recently_no = 4;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', 'pc'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->client['msg'] . "', 'client', 'pc'), ('4', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['3'] . "', 'trost', 'pc'), ('5', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['4'] . "', 'partner', 'pc');");
                    }

				} else {

                    if ($this->client['msg'] == '') {
                        $this->recently_no = 2;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', 'pc');");
                    } else {
                        $this->recently_no = 3;
                        mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc'), ('2', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['2'] . "', 'trost', 'pc'), ('3', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->client['msg'] . "', 'client', 'pc');");
                    }

				}

				$historyNo = $this->recently_no - 1;
				$ExtraNo = $this->recently_no + 1;
				/**/

                /*
                 * 기업 고객 전용 결제 정보 생성.
                 */
                if ($getInfoOfCounseling['co_group_counseling_status']) {
                    $date1 = new DateTime($toDate);
                    $date2 = new DateTime($getInfoOfCounseling['finishDate']);
                    $itemCount = $date1->diff($date2);
                    $itemDay = $itemCount->format('%a');

                    $copPayment = explode(',', $getInfoOfCounseling['co_group_counseling_status']);
                    $copPaymentCount = count($copPayment);

                    /*
                     * $copPayment['0'] - 상담 종류.
                     * $copPayment['1'] - 전체 횟수.
                     * $copPayment['2'] - 1회 가능 횟수.
                     */

                    if ($copPaymentCount === 1) {
                        $copPaymentGuide = explode('/', $copPayment['0']);

                        $types = substr($copPaymentGuide['0'], 0, 1);

                        if ($types === 'T') $paymentType = 'texttime';
                        if ($types === 'V') $paymentType = 'voicetime';
                        if ($types === 'F') $paymentType = 'facetime';

                        $copPaymentGuide['0'] = $copPaymentGuide['0'] . "X" . $copPaymentGuide['1'] . "X" . $itemDay;

                        mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('" . $copPaymentGuide['0'] . "', '" . $paymentType. "', '" . $itemDay . "', '" . $copPaymentGuide['1'] . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
                    } else {
                        foreach ($copPayment as $key => $value) {
                            $copPaymentGuide = explode('/', $value);

                            if ($copPaymentGuide['0']) {

                                $types = substr($copPaymentGuide['0'], 0, 1);

                                if ($types === 'T') $paymentType = 'texttime';
                                if ($types === 'V') $paymentType = 'voicetime';
                                if ($types === 'F') $paymentType = 'facetime';

                                $copPaymentGuide['0'] = $copPaymentGuide['0'] . "X" . $copPaymentGuide['1'] . "X" . $itemDay;

                                mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('" . $copPaymentGuide['0'] . "', '" . $paymentType. "', '" . $itemDay . "', '" . $copPaymentGuide['1'] . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
                            }
                        }
                    }
                } else {
                    $date1 = new DateTime($toDate);
                    $date2 = new DateTime($getInfoOfCounseling['finishDate']);
                    $itemCount = $date1->diff($date2);
                    $itemDay = $itemCount->format('%a');
                    $itemCountSet = (round(($itemDay)/7, 0) + 1);

                    mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('texttime', '" . $paymentType. "', '" . $itemDay . "', '" . $itemCountSet . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
                }
                /**/

				// 메세지 읽은 번호 수정
				mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `historyPartner` = '" . $historyNo . "' WHERE (`no` = '" . $this->chat_log['no'] . "') ORDER BY `no` DESC LIMIT 1;");

				// 상담사 배지 수정
				$unReadBadge = $this->partner['badge'] + 1;
				mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");

				$this->date_t = $getInfoOfCounseling['finishDate'];
			}

		}

		function ReMakeChat ($clientID, $partnerID, $roomNo, $device)
        {
			global $conn_;

			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $partnerID = mysqli_real_escape_string($conn_, $partnerID);
			(string) $device = mysqli_real_escape_string($conn_, $device);
			(int) $roomNo = mysqli_real_escape_string($conn_, $roomNo);

			/*
			* 내담자/상담사 정보 조회 + 등록
			*/
			$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `phone`, `badge` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->partner = mysqli_fetch_array($getInfoOfPartner_q);

			$getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->client = mysqli_fetch_array($getInfoOfClient_q);

			$getInfoOfPayment_q = mysqli_query($conn_, "SELECT `date_t` FROM `trost`.`payment` WHERE ((`chat_log` = '" . $roomNo . "') && ((`type` = 'texttime') || (`type` = 'facetime') || (`type` = 'voicetime'))) ORDER BY `no` DESC LIMIT 1;");
			$getInfoOfPayment = mysqli_fetch_array($getInfoOfPayment_q);

			$getInfoOfNewRoom_q = mysqli_query($conn_, "SELECT `partner`, `payment` FROM `trost_counseling`.`counseling_log` WHERE (`no` = '" . $roomNo . "') ORDER BY `no` DESC LIMIT 1;");
			$getInfoOfNewRoom = mysqli_fetch_array($getInfoOfNewRoom_q);
			/**/

			if ($getInfoOfNewRoom['payment'] == 'N') {

				// 결제 상태가 N 인 경우는 무조건 재결제 이다.
				// 결제 한 상담사가 기존의 결제했던 상담사와 똑같으면 그대로 상담을 진행한다.
				if ($getInfoOfNewRoom['partner'] === $this->partner['id']) {

					// 상담사 변경
					// mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = '$partnerID' WHERE (`no` = '" . $roomNo . "')");
					// mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'Y' WHERE (`no` = '" . $roomNo . "')");
//					mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = '" . $partnerID . "', `payment` = 'Y' WHERE (`no` = '" . $roomNo . "') ORDER BY `no` DESC LIMIT 1;");

					$getInfoOfCounseling = mysqli_query($conn_, "SELECT `no`, `client`, `partner`, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = cLog.no ORDER BY `no` DESC LIMIT 1) AS `recently_no` FROM `trost_counseling`.`counseling_log` AS `cLog` WHERE (`no` = '" . $roomNo . "') ORDER BY `no` DESC LIMIT 1;");
					$this->chat_log = mysqli_fetch_array($getInfoOfCounseling);

					$this->recently_no = $this->chat_log['recently_no'] + '1';
					$this->date_t = $getInfoOfPayment['date_t'];
					/**/

					/*
					* 내담자/상담사 정보 조회 + 등록
					*/
                    (int) $unReadMessage = $this->chat_log['recently_no'] - $this->chat_log['historyPartner'] - 1;
                    (int) $unHistoryNo = $this->chat_log['recently_no'] - '1';

					mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = '" . $partnerID . "', `payment` = 'Y', `historyPartner` = '" . $unHistoryNo . "' WHERE (`no` = '" . $this->chat_log['no'] . "')");

					// 코디네이터 배지 초기화
//					mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` - '" . $unReadMessage . "' WHERE (`infoB`.`id` = 'cordpartner01')");
					mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "');");
					/**/

				// 결제 한 상담사가 기존의 결제했던 상담사와 다르면 새로운 상담을 생성 후 진행한다.
				} else {

					// 새로운 상담 생성
					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`counseling_log` (payment, time_start, partner, client, cl_device) VALUES ('Y', '" . $this->time_start . "', '" . $this->partner['id'] . "', '" . $this->client['id'] . "', '" . $device . "');");

					$getInfoOfCounseling = mysqli_query($conn_, "SELECT `no`, `client`, `partner`, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = cLog.no ORDER BY `no` DESC LIMIT 1) AS `recently_no` FROM `trost_counseling`.`counseling_log` AS cLog WHERE ((`partner` = '" . $this->partner['id'] . "') && (`client` = '" . $this->client['id'] . "')) ORDER BY `no` DESC LIMIT 1;");
					$this->chat_log = mysqli_fetch_array($getInfoOfCounseling);

					// 생성 상담방 시스템 메세지 작성
					$this->sys_message = array(
                        "1" => $this->client['name'] . " 님,\n트로스트에 오신 것을 환영합니다. 지금 이 공간은 앞으로 " . $this->partner['name'] . " 상담사님과의 상담이 진행되는 공간입니다.",
					);

					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('1', '" . $this->chat_log['no'] . "', '" . $this->time_start . "', '" . $this->sys_message['1'] . "', 'trost', 'pc');");
					mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS infoA LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "');");

                    // 이거 뭐지? 테스트 필요.
//					mysqli_query($conn_, "UPDATE `trost`.`payment` SET `chat_log` = '" . $this->chat_log['no'] . "' WHERE ((`buyer` = '" . $this->client['id'] . "') && ((`type` = 'texttime') || (`type` = 'facetime') || (`type` = 'voicetime'))) ORDER BY `no` DESC LIMIT 1");

				}

            } else {

                /*
                * 내담자/상담사 정보 조회 + 등록
                * $this->recently_no - 최근 메세지 번호.
                * $unReadMessage - 해당 상담에서 안 읽은 메세지 개수.
                * $this->date_t - 결제 종료 날짜.
                */
                $getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `no`, `client`, `partner`, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = `cLog`.`no` ORDER BY `no` DESC LIMIT 1) AS `recently_no` FROM `trost_counseling`.`counseling_log` AS `cLog` WHERE (`no` = '" . $roomNo . "') ORDER BY `no` DESC LIMIT 1;");
                $this->chat_log = mysqli_fetch_array($getInfoOfCounseling_q);
                /**/

                /*
                * 상담사 및 상담 상태 변경.
                * 상담사 읽은 메세지 번호 업데이트.
                */
				mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = '" . $partnerID . "', `payment` = 'Y', `historyPartner` = '" . ($this->chat_log['recently_no'] - 1) . "' WHERE (`no` = '" . $roomNo . "') ORDER BY `no` DESC LIMIT 1;");

				(int) $this->recently_no = $this->chat_log['recently_no'];
				(int) $unReadMessage = $this->chat_log['recently_no'] - $this->chat_log['historyPartner'] - 1;
				(string) $this->date_t = $getInfoOfPayment['date_t'];
                /**/

				/*
				* 코디네이터, 결제 상담사 배지 업데이트
				*/
//				mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` - '" . $unReadMessage . "' WHERE (`infoB`.`id` = 'cordpartner01')");
				mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "');");
				/**/

			}

		}

		function ReMakeChat_withCompany ($clientID, $partnerID, $numberOfRoom)
		{
			// 이미 방이 존재할 때 기업 상담을 신청하는 경우.
			global $conn_;

			(string) $toDate = date("Y-m-d");
			(string) $toTime = date("Y-m-d A h:i");

			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $partnerID = mysqli_real_escape_string($conn_, $partnerID);
			(int) $numberOfRoom = mysqli_real_escape_string($conn_, $numberOfRoom);

			$getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `pInfo`.`co_group_counseling_status` As `co_group_counseling_status`, `pInfo`.`co_group_first_message` As `co_group_first_message`, `pInfo`.`co_group_payment` As `co_group_payment`, `pInfo`.`groupID` As `groupID`, `pInfo`.`startDate` As `startDate`, `pInfo`.`finishDate` As `finishDate` FROM `trost_company`.`clientInfo` As `cInfo` INNER JOIN `trost_company`.`companyInfo` As `pInfo` ON `cInfo`.`groupID` = `pInfo`.`groupID` WHERE ((`cInfo`.`trostID` = '" . $clientID . "') && (`pInfo`.`startDate` <= '" . $toDate . "') && (`pInfo`.`finishDate` >= '" . $toDate . "')) ORDER BY `cInfo`.`no` DESC LIMIT 1;");
			$getInfoOfCounseling = mysqli_fetch_array($getInfoOfCounseling_q);

			if ($getInfoOfCounseling) {

				/*
				 * 내담자/상담사 정보 조회 + 등록
				 */
				$getInfoOfPartner = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `phone`, `badge` FROM `trost`.`mb_partner` WHERE (`id` = '" . $partnerID . "') ORDER BY `no` DESC LIMIT 1;");
				$this->partner = mysqli_fetch_array($getInfoOfPartner);

				$getInfoOfClient = mysqli_query($conn_, "SELECT `id`, `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
				$this->client = mysqli_fetch_array($getInfoOfClient);

				$getInfoOfPayment_q = mysqli_query($conn_, "SELECT `date_t` FROM `trost`.`payment` WHERE ((`chat_log` = '" . $numberOfRoom . "') && (`type` != 'texttime_Add')) ORDER BY `no` DESC LIMIT 1;");
				$getInfoOfPayment = mysqli_fetch_array($getInfoOfPayment_q);
				/**/

				/*
				 * 상담사 변경.
				 */
				mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = '" . $partnerID . "', `payment` = 'Y' WHERE (`no` = '" . $numberOfRoom . "') ORDER BY `no` DESC LIMIT 1;");
				/**/

				/*
				 * 시스템 메시지 작성
				 */
				$getInfoOfChatLog_q = mysqli_query($conn_, "SELECT `no`, `client`, `partner`, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = `cLog`.`no` ORDER BY `no` DESC LIMIT 1) AS `recently_no` FROM `trost_counseling`.`counseling_log` AS `cLog` WHERE (`no` = '" . $numberOfRoom . "') ORDER BY `no` DESC LIMIT 1;");
				$this->chat_log = mysqli_fetch_array($getInfoOfChatLog_q);

				if ($getInfoOfCounseling['co_group_first_message']) {
					$sys_message = $getInfoOfCounseling['co_group_first_message'];
				} else {
					$sys_message = "안녕하세요,\n" . $getInfoOfCounseling['groupID'] . " 트로스트 무료 체험 기간: " . $getInfoOfCounseling['startDate'] . " ~ "  . $getInfoOfCounseling['finishDate'] . "\n상담사 선생님과 시간을 정해 일주일 1회 60분 동안 실시간 상담을 진행할 수 있습니다.\n그 외 시간은 비실시간으로 연결되어 있으니 필요에 따라 사용하여 주시기 바랍니다.\n무료체험기간 동안 상담의 가능성과 변화의 실마리를 찾을 수 있길 바라겠습니다.";
				}

                $this->recently_no = $this->chat_log['recently_no'] + 2;
				mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . ($this->chat_log['recently_no'] + 1) . "', '" . $numberOfRoom . "', '" . $toTime . "', '제휴기관 회원 인증 및 상담사와의 연결이 완료되었습니다.', 'trost', 'pc'), ('" . ($this->chat_log['recently_no'] + 2) . "', '" . $numberOfRoom . "', '" . $toTime . "', '" . $sys_message . "', 'trost', 'pc');");

				if (($getInfoOfCounseling['groupID'] === '근로') || ($getInfoOfCounseling['groupID'] === '근로복지넷')) {
                    $this->recently_no += 2;
                    $sys_message_etc = "안녕하세요 " . $this->client['name'] . " 님\n근로복지넷과 함께하는 심리상담 메신저, 트로스트입니다.\n\n지금 이 공간은 앞으로 " . $this->partner['name'] . " 상담사님과의 상담이 진행되는 공간입니다.\n아래의 내용을 확인하시고, 전화상담과 화상(비디오) 상담 중 진행하실 상담을 선택해주세요.\n\n1. 전화상담(1회 20분) 14회 제공, 2회 연속 사용 가능\n2. 화상상담(1회 50분) 7회 제공\n(1개만 선택 가능, 선택 후 변경 불가)";
                    $sys_message_etc_ = "첫 상담 진행 전 상담 시작 설문조사에 응답해 주시길 바랍니다.\n\nhttps://goo.gl/forms/ZyvqMNo0kpIhxlNn1\n\n필수 설문조사이기 때문에, 설문조사에 참여해주셔야 첫 상담 진행이 가능합니다. 감사합니다.";

					mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES , ('" . ($this->chat_log['recently_no'] + 3) . "', '" . $numberOfRoom . "', '" . $toTime . "', '" . $sys_message_etc . "', 'trost', 'pc');");
                    mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES , ('" . ($this->chat_log['recently_no'] + 4) . "', '" . $numberOfRoom . "', '" . $toTime . "', '" . $sys_message_etc_ . "', 'trost', 'pc');");
				}

				$this->date_t = $getInfoOfPayment['date_t'];
				/**/

				/*
				 * 내담자/상담사 정보 조회 + 등록
				 */
				$unReadMessage = $this->chat_log['recently_no'] - $this->chat_log['historyPartner'];
				$unHistoryNo = $this->chat_log['recently_no'] - '1';

				mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `historyPartner` = '" . $unHistoryNo . "' WHERE (`no` = '" . $this->chat_log['no'] . "') ORDER BY `no` DESC LIMIT 1;");

				// 코디네이터 배지 초기화
				mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS infoA LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "');");
				/**/

				/*
				* 기업 고객 전용 결제 정보 생성.
				*/
				if ($getInfoOfCounseling['co_group_counseling_status']) {
					$date1 = new DateTime($toDate);
					$date2 = new DateTime($getInfoOfCounseling['finishDate']);
					$itemCount = $date1->diff($date2);
					$itemDay = $itemCount->format('%a');

					$copPayment = explode(',', $getInfoOfCounseling['co_group_counseling_status']);
					$copPaymentCount = count($copPayment);

					/*
					 * $copPayment['0'] - 상담 종류.
					 * $copPayment['1'] - 전체 횟수.
					 * $copPayment['2'] - 1회 가능 횟수.
					 */

					if ($copPaymentCount === 1) {
						$copPaymentGuide = explode('/', $copPayment['0']);

                        $types = substr($copPaymentGuide['0'], 0, 1);

                        if ($types === 'T') $paymentType = 'texttime';
                        if ($types === 'V') $paymentType = 'voicetime';
                        if ($types === 'F') $paymentType = 'facetime';

                        $copPaymentGuide['0'] = $copPaymentGuide['0'] . "X" . $copPaymentGuide['1'] . "X" . $itemDay;

						mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('" . $copPaymentGuide['0'] . "', '" . $paymentType. "', '" . $itemDay . "', '" . $copPaymentGuide['1'] . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
					} else {
						foreach ($copPayment as $key => $value) {
							$copPaymentGuide = explode('/', $value);
							if ($copPaymentGuide['0']) {

                                $types = substr($copPaymentGuide['0'], 0, 1);

                                if ($types === 'T') $paymentType = 'texttime';
                                if ($types === 'V') $paymentType = 'voicetime';
                                if ($types === 'F') $paymentType = 'facetime';

                                $copPaymentGuide['0'] = $copPaymentGuide['0'] . "X" . $copPaymentGuide['1'] . "X" . $itemDay;

								mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('" . $copPaymentGuide['0'] . "', '" . $paymentType. "', '" . $itemDay . "', '" . $copPaymentGuide['1'] . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
							}
						}
					}
				} else {
					$date1 = new DateTime($toDate);
					$date2 = new DateTime($getInfoOfCounseling['finishDate']);
					$itemCount = $date1->diff($date2);
					$itemDay = $itemCount->format('%a');
					$itemCountSet = (round(($itemDay)/7, 0) + 1);

					mysqli_query($conn_, "INSERT INTO `trost`.`payment` (`p_type_item`, `type`, `item`, `itemCount`, `date_f`, `date_t`, `paydate`, `payment`, `paymethod`, `buyer`, `chat_log`, `partner`) VALUES ('texttime', '" . $paymentType. "', '" . $itemDay . "', '" . $itemCountSet . "', '" . $toDate . "', '" . $getInfoOfCounseling['finishDate'] . "', '" . $this->time_start . "', '0', 'cop', '" . $clientID . "', '" . $this->chat_log['no'] . "', '" . $partnerID . "');");
				}
				/**/

			}

		}

		function afterFinishReMakeChat ($clientID, $partnerID, $numberOfRoom)
		{
			// 종료 상담 세팅 업데이트.
			global $conn_;

			(string) $clientID = mysqli_real_escape_string($conn_, $clientID);
			(string) $partnerID = mysqli_real_escape_string($conn_, $partnerID);
			(int) $numberOfRoom = mysqli_real_escape_string($conn_, $numberOfRoom);

			/*
			* 내담자/상담사 정보 조회 + 등록
			*/
			$getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
			$this->client = mysqli_fetch_array($getInfoOfClient_q);

//			$getInfoOfPartner_q = mysqli_query($conn_, "SELECT `id`, `name`, `t0ken`, `phone`, `badge` FROM `trost`.`mb_partner` WHERE (`id` = 'cordpartner01') ORDER BY `no` DESC LIMIT 1;");
//			$this->partner = mysqli_fetch_array($getInfoOfPartner_q);

			$getInfoOfCounseling_q = mysqli_query($conn_, "SELECT `no`, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = cLog.no ORDER BY `no` DESC LIMIT 1) AS recently_no FROM `trost_counseling`.`counseling_log` AS cLog WHERE (`no` = '" . $numberOfRoom . "');");
			$this->chat_log = mysqli_fetch_array($getInfoOfCounseling_q);
			/**/

			/*
			* 내담자/상담사 정보 조회 + 등록
			*/
			$sys_message = $this->client['name'] . " 님 상담이 도움이 되셨나요? 트로스트를 이용해주셔서 감사합니다. 심리상담은 결국 자신이 가장 편안하고 행복하게 살아갈 수 있는 방법을 찾아나가는 여정이 아닐까 싶습니다.\n마음이 지치고 힘드실 때는 언제든 다시 찾아주세요. 지금 상담사님과 상담을 원하실 경우 아래 ‘재결제하기＇버튼을 통해 가능합니다.[#button#]재결제하기[#button#]";
			$this->recently_no = $this->chat_log['recently_no'] + 1;

			mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $this->recently_no . "', '" . $numberOfRoom . "', '" . $this->time_start . "', '" . $sys_message . "', 'trost', 'mobile');");
			/**/

			/*
			* 내담자/상담사 정보 조회 + 등록
			*/
//			$unReadMessage = $this->chat_log['recently_no'] - $this->chat_log['historyPartner'];
//            $unHistoryNo = $this->chat_log['recently_no'] - '1';
			/**/

            // 상태 변경 (유료 상담 -> 접수 상담: 상담사/상담 상태)
			// mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `partner` = 'cordpartner01', `payment` = '', `historyPartner` = '" . $unHistoryNo . "' WHERE (`no` = '" . $numberOfRoom . "')");
            mysqli_query($conn_, "UPDATE `trost_counseling`.`counseling_log` SET `payment` = 'N' WHERE (`no` = '" . $numberOfRoom . "');");

			// 기존 유료 상담사 배지 초기화
//			mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` - '" . $unReadMessage . "' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "')");
//			mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = 'cordpartner01')");

			// 신규 접수 상담사 배지 초기화
//			mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS `infoA` LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`badge` = `infoB`.`badge` + '1' WHERE (`infoB`.`id` = '" . $this->partner['id'] . "')");
			/**/
		}

		function ConnectTutorialCounseling($clientID, $device)
        {
            // 튜토리얼 상담 연결
            global $conn_;

            (string) $toDate = date("Y-m-d A h:i");
            (string) $clientID = mysqli_real_escape_string($conn_, $clientID);
            (string) $device = mysqli_real_escape_string($conn_, $device);

            if ($device === 'APP') {
                $M_device = 'mobile';
            } else {
                $M_device = 'pc';
            }

            /**
             * 내담자/상담사 정보 조회 + 등록
             */
            $getInfoOfClient_q = mysqli_query($conn_, "SELECT `id`, `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $clientID . "') ORDER BY `no` DESC LIMIT 1;");
            $this->client = mysqli_fetch_array($getInfoOfClient_q);

            (string) $clientName = $this->client['name'];

            (string) $partnerID = 'trost_guide';
            (string) $partnerName = '트로스트';
            /**/

            /**
             * 내담자/상담사 정보 조회 + 등록
             */
            $sys_message = [
                "2017-05-28 AM 02:00/trost/" . $clientName . " 님, 트로스트에 오신 것을 환영합니다.  지금 이 공간은 \'트로스트\'가 상담사 역할을 하며, 상담권 결제 후 상담이 진행되기까지의 예시화면을 보여드리는 튜토리얼 방입니다.",
                "2017-05-28 AM 02:00/partner/안녕하세요. 상담사 " . $partnerName . " 입니다. 상담 시작 전 아래 질문을 읽어 보시고, 답변을 작성해주세요. 어떠한 고민으로 상담을 신청해주셨나요? 상담을 원하는 일시(여러 시간대)를 알려주세요.",
                "2017-05-28 AM 02:05/client/불면증이 심합니다. 불안한 마음이 계속돼서 힘들어요... 평일은 오후 9시 이후, 토요일 시간 관계없이 괜찮습니다.",
                "2017-05-28 AM 09:46/partner/" . $clientName . " 님, 남겨주신 내용 확인하였어요. 평일 오후 9시 이후라고 하셨는데 오늘 밤 9시에 가능하신가요?",
                "2017-05-28 AM 09:50/client/네 가능합니다~",
                "2017-05-28 AM 09:52/partner/그럼 그때로 예약해드릴게요.",
                "2017-05-28 AM 09:52/trost/텍스트 테라피 실시간 상담 예약이 완료되었습니다. 2017-05-29 PM 09:00",
                "2017-05-29 PM 08:56/partner/" . $clientName . " 님~ 상담 시작해도 될까요?",
                "2017-05-29 PM 08:57/client/네! 상담사님",
                "2017-05-29 PM 08:57/trost/텍스트 테라피 실시간 상담이 시작되었습니다. 상담 종료 예정 시각은 PM 09:48 입니다.",
                "2017-05-29 PM 08:58/partner/불면증과 불안한 마음부터 이야기해봐야 할 것 같네요. 잠을 제대로 못 주무신 지는 얼마나 되셨나요?",
                "2017-05-29 PM 08:59/trost/트로스트에서의 텍스트 테라피 상담은 위와 같은 방식으로 진행됩니다~",
                "2017-05-29 PM 08:59/trost/\'상담사 찾기\' 탭에서 고민키워드에 맞는 나만의 상담사를 선택하여 상담을 시작해 보세요. (본 튜토리얼은 예시 화면으로 실제 상담 시 상담사별로 다소 차이가 있을 수 있습니다)",
            ];

            mysqli_query($conn_, "INSERT INTO `trost_counseling`.`counseling_log` (`time_start`, `partner`, `client`, `payment`, `cl_device`) VALUES ('" . $toDate . "', '" . $partnerID . "', '" . $clientID . "', '', '" . $device . "');");
            (int) $counselingNo = mysqli_insert_id($conn_);

            foreach ($sys_message As $key => $value)
            {
                $sys_string = explode('/', $value);
                mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . ($key + 1) . "', '" . $counselingNo . "', '" . $sys_string['0'] . "', '" . $sys_string['2'] . "', '" . $sys_string['1'] . "', '" . $M_device . "');");
            }
            /**/
        }

	}