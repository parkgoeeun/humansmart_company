<?php
	/*
	* Copyright (C) 2016 휴마트컴퍼니, Inc. All rights reserved.
	* PHP 푸시 API
	*
	* iOS Push Parameter
	* chr(1) - Device Token
	* chr(2) - About Payload
	* chr(3) - Notification Identifier
	* chr(4) - Expiration Date
	* chr(5) - Priority
	*/
	Class Push
	{
		// For Class_Client
		public $c_token_length, $clientID, $clientName, $clientToken, $clientBadge;

		// For Class_Partner
		public $p_token_length, $partnerID, $partnerName, $partnerToken, $partnerBadge, $partnerPic;

		// For Class
		public $time_message, $userType;

		function __construct ($pID, $cID) {

			global $conn_;

			(string) $toDate = date("Y-m-d");
			(string) $this->time_message = date("Y-m-d A h:i");

			(string) $this->partnerID = "";
			(string) $this->partnerName = "";
			(string) $this->partnerToken = "";
			(int) $this->partnerBadge = "";
			(int) $this->partnerPic = "";

			(string) $this->clientID = "";
			(string) $this->clientName = "";
			(string) $this->clientToken = "";
			(int) $this->clientBadge = "";

			(int) $this->p_token_length = 0;
			(int) $this->c_token_length = 0;

			if ((!$pID) && ($cID)) {

				$client_q = mysqli_query($conn_, "SELECT `name`, `t0ken`, (SELECT `historyClient` FROM `trost_counseling`.`counseling_log` WHERE `client` = '" . $cID . "' ORDER BY `no` DESC LIMIT 1) As cBadge FROM `trost`.`mb_client` WHERE (`id` = '" . $cID . "') ORDER BY `no` DESC LIMIT 1;");
				$client = mysqli_fetch_array($client_q);

				(string) $this->clientID = $cID;
				(string) $this->clientName = $client['name'];
				(string) $this->clientToken = $client['t0ken'];
				(int) $this->clientBadge = $client['cBadge'];

				(int) $this->c_token_length = strlen($this->clientToken);

			} else if (($pID) && (!$cID)) {

				$partner_q = mysqli_query($conn_, "SELECT `name`, `t0ken`, `badge`, `pic` FROM `trost`.`mb_partner` WHERE (`id` = '" . $pID . "') ORDER BY `no` DESC LIMIT 1;");
				$partner = mysqli_fetch_array($partner_q);

				(string) $this->partnerID = $pID;
				(string) $this->partnerName = $partner['name'];
				(string) $this->partnerToken = $partner['t0ken'];
				(int) $this->partnerBadge = $partner['badge'];
				(int) $this->partnerPic = $partner['pic'];

				(int) $this->p_token_length = strlen($this->partnerToken);

			} else {

				$client_q = mysqli_query($conn_, "SELECT `name`, `t0ken`, (SELECT `historyClient` FROM `trost_counseling`.`counseling_log` WHERE `client` = '" . $cID . "' ORDER BY `no` DESC LIMIT 1) As cBadge FROM `trost`.`mb_client` WHERE (`id` = '" . $cID . "') ORDER BY `no` DESC LIMIT 1;");
				$client = mysqli_fetch_array($client_q);

				$partner_q = mysqli_query($conn_, "SELECT `name`, `t0ken`, `badge`, `pic` FROM `trost`.`mb_partner` WHERE (`id` = '" . $pID . "') ORDER BY `no` DESC LIMIT 1;");
				$partner = mysqli_fetch_array($partner_q);

				(string) $this->partnerID = $pID;
				(string) $this->partnerName = $partner['name'];
				(string) $this->partnerToken = $partner['t0ken'];
				(int) $this->partnerBadge = $partner['badge'];
				(int) $this->partnerPic = $partner['pic'];

				(string) $this->clientID = $cID;
				(string) $this->clientName = $client['name'];
				(string) $this->clientToken = $client['t0ken'];
				(int) $this->clientBadge = $client['cBadge'];

				(int) $this->p_token_length = strlen($this->partnerToken);
				(int) $this->c_token_length = strlen($this->clientToken);

			}

			$getInfoOfCounseling_q = mysqli_query($conn_, "SELECT LEFT(`pInfo`.`groupID`, 2) As `groupID`, `pInfo`.`startDate` As `startDate`, `pInfo`.`finishDate` As `finishDate` FROM `trost_company`.`clientInfo` As `cInfo` INNER JOIN `trost_company`.`companyInfo` As `pInfo` ON `cInfo`.`groupID` = `pInfo`.`groupID` WHERE ((`cInfo`.`trostID` = '" . $cID . "') && (`pInfo`.`startDate` <= '" . $toDate . "') && (`pInfo`.`finishDate` >= '" . $toDate . "')) ORDER BY `cInfo`.`no` DESC LIMIT 1");
			$getInfoOfCounseling = mysqli_fetch_array($getInfoOfCounseling_q);

			if ($getInfoOfCounseling) {
				(string) $this->userType = 'corporation';

				$this->clientName = "*" . $this->clientName . " [" . $getInfoOfCounseling['groupID'] . "]";
			} else {
				(string) $this->userType = 'personal';
			}

		}

		function MakeChat ($noRoom, $noMsg, $paymentDate, $paymentStatus)
		{
			global $conn_;

			/*
			 * YY - 무료이용
			 * NY - 유료이용
			 * 내담자
			 * "[트로스트] 000 상담사와 상담방이 연결되었습니다."
			 * 상담사
			 * "[트로스트] 000 내담자가 신규 상담을 신청하였습니다."
			 */

			if (!$paymentStatus) { $paymentStatus = "YY"; }

			if (($this->partnerID != '') && ($this->partnerToken != '')) {

				settype($this->partnerBadge, "int");

				if ($this->p_token_length == '64') {

					$body['aps'] = [
						"content-available" => "1",
                        "type" => "makechat",
                        "sound" => "default",
                        "badge" => $this->partnerBadge,
                        "title" => "트로스트",
                        "alert" => "[트로스트] " . $this->clientName . " 내담자가 신규 상담을 신청하였습니다.",
                        "body" => "[트로스트] " . $this->clientName . " 내담자가 신규 상담을 신청하였습니다.",
                        "log" => "[트로스트] " . $this->clientName . " 내담자가 신규 상담을 신청하였습니다.",
                        "log_from" => "trost",
						"no_log" => "$noRoom",
						"no" => "$noMsg",
						"id" => "$this->clientID",
						"name" => "$this->clientName",
						"pic" => "00000000",
						"time_message" => "$this->time_message",
						"result" => "S",
						"payment" => "$paymentStatus",
						"userType" => $this->userType
					];

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->partnerToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->partnerToken"
						),
						"priority" => "high",
						"data"=>array(
                            "type"=>'makechat',
                            "sound" => "default",
                            "badge" => $this->partnerBadge,
                            "title"=>'트로스트',
                            "body" => "[트로스트] " . $this->clientName . " 내담자가 신규 상담을 신청하였습니다.",
							"no_log" => "$noRoom",
							"no" => "$noMsg",
							"id" => "$this->clientID",
							"name" => "$this->clientName",
							"pic" => "00000000",
							"time_message" => "$this->time_message",
							"result" => "S",
							"payment" => "$paymentStatus",
							"userType" => $this->userType
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

			if (($this->clientID != '') && ($this->clientToken != '')) {

				if ($this->c_token_length == '64') {

					$body['aps'] = array(
                        "type" => "chat",
                        "content-available" => "1",
                        "sound" => "default",
						"badge" => $this->clientBadge,
						"title" => "트로스트",
						"alert" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
						"body" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
						"log" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
						"log_from" => "trost",
						"sender" => "$this->partnerID",
						"name" => "$this->partnerName",
						"pic" => "$this->partnerPic",
						"no_log" => "$noRoom",
						"no" => "$noMsg",
						"time_message" => "$this->time_message",
						"result" => "S",
						"payment" => "$paymentStatus",
						"userType" => $this->userType
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->clientToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
						"Content-Type:application/json;charset=utf-8",
						"Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->clientToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"type" => "chat",
							"badge" => $this->clientBadge,
							"title" => "트로스트",
                            "alert" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
							"body" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
							"log" => "[트로스트] " . $this->partnerName . " 상담사와 상담방이 연결되었습니다.",
							"log_from" => "trost",
							"sender" => "$this->partnerID",
							"name" => "$this->partnerName",
							"pic" => "$this->partnerPic",
							"no_log" => "$noRoom",
							"no" => "$noMsg",
							"time_message" => "$this->time_message",
							"result" => "S",
							"payment" => "$paymentStatus",
							"userType" => $this->userType
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

		function PaymentPush ($noRoom, $response_msg)
		{

			global $conn_;

			if (($this->partnerID != '') && ($this->partnerToken != '')) {

				settype($this->partnerBadge, "int");

				if ($this->p_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"result" => "Y",
						"type" => "chat",
						"badge" => $this->partnerBadge,
						"title" => "트로스트",
						"alert" => $this->clientName . " 내담자가 " . $response_msg . " 이용권을 결제했습니다.",
						"body" => $this->clientName . " 내담자가 " . $response_msg . " 이용권을 결제했습니다.",
						"log" => $this->clientName . " 내담자가 " . $response_msg . " 이용권을 결제했습니다.",
						"no_log" => "$noRoom",
						"id" => "$this->clientID",
						"name" => "$this->clientName",
						"log_from" => "trost",
						"pic" => "00000000",
						"time_message" => "$this->time_message",
						"userType" => $this->userType
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);
					$inner = chr(1) . pack('n', 32) . pack('H*', $this->partnerToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->partnerToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"result" => "Y",
							"type" => "chat",
							"badge" => $this->partnerBadge,
							"title" => "트로스트",
							"body" => $this->clientName . "내담자가 " . $response_msg . "일 이용권을 결제했습니다.",
							"log" => $this->clientName . "내담자가 " . $response_msg . "일 이용권을 결제했습니다.",
							"no_log" => "$noRoom",
							"id" => "$this->clientID",
							"name" => "$this->clientName",
							"log_from" => "trost",
							"pic" => "00000000",
							"time_message" => "$this->time_message",
							"userType" => $this->userType
						)
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

			if (($this->clientID != '') && ($this->clientToken != '')) {

				settype($this->clientBadge, "int");

				if ($this->c_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"type" => "chat",
						"badge" => $this->clientBadge,
						"title" => "트로스트",
						"alert" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
						"body" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
						"log" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
						"log_from" => "trost",
						"sender" => "$this->partnerID",
						"name" => "$this->partnerName",
						"pic" => "$this->partnerPic",
						"no_log" => "$noRoom",
						"time_message" => "$this->time_message",
						"userType" => $this->userType
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->clientToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
						"Content-Type:application/json;charset=utf-8",
						"Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->clientToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"type" => "chat",
							"badge" => $this->clientBadge,
							"title" => "트로스트",
							"alert" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
							"body" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
							"log" => $this->partnerName . " 상담사와 상담이 매칭되었습니다.",
							"log_from" => "trost",
							"sender" => "$this->partnerID",
							"name" => "$this->partnerName",
							"pic" => "$this->partnerPic",
							"no_log" => "$noRoom",
							"time_message" => "$this->time_message",
							"userType" => $this->userType
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

		function afterFinishReMakeChat ($noRoom, $noMsg, $paymentDate) {

			global $conn_;

			if (($this->partnerID != '') && ($this->partnerToken != '')) {

				settype($this->partnerBadge, "int");

				if ($this->p_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"badge" => $this->partnerBadge,
						"type" => "makechat",
						"title" => "트로스트",
						"alert" => $this->clientName . " 님이 귀환하셨습니다.",
						"body" => $this->clientName . " 님이 귀환하셨습니다.",
						"result" => "S",
						"payment" => "NN",
						"no_log" => "$noRoom",
						"no" => "$noMsg",
						"id" => "$this->clientID",
						"name" => "$this->clientName",
						"pic" => "00000000",
						"time_message" => "$paymentDate",
						"userType" => "personal"
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->partnerToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->partnerToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"type"=>'makechat',
							"badge" => $this->partnerBadge,
							"title"=>'트로스트',
							"body" => "$this->clientName" . "님이 귀환하셨습니다.",
							"result" => "S",
							"payment" => "NN",
							"no_log" => "$noRoom",
							"no" => "$noMsg",
							"id" => "$this->clientID",
							"name" => "$this->clientName",
							"pic" => "00000000",
							"time_message" => "$paymentDate",
							"userType" => "personal"
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

		function reservationPushForPartner ($numberOfRoom, $numberOfMsg, $pushMessage, $loadMessage, $finishGuide)
		{
	    	global $conn_;

			if (($this->partnerID != '') && ($this->partnerToken != '')) {

				settype($this->partnerBadge, "int");
				$this->partnerBadge = $this->partnerBadge + 1;

				if ($this->p_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"badge" => $this->partnerBadge,
						"type" => "chat",
						"title" => "트로스트",
						"alert" => $pushMessage,
						"body" => $pushMessage,
						"no_log" => $numberOfRoom,
						"no" => $numberOfMsg,
						"log" => $loadMessage,
						"log_from" => "trost",
						"time_message" => $this->time_message,
						"name" => "트로스트",
						"pic" => "00000000",
						"userType" => $this->userType
					);

					if ($finishGuide === 'playrtc') {
						$body['aps']['extraType'] = 'playRTC';
						$body['aps']['finishGuide'] = '';
					} else {
						unset($body['aps']['extraType']);
						unset($body['aps']['finishGuide']);
					}

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->partnerToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->partnerToken"
						),
						"priority" => "high",
						"data"=>array(
					        "sound" => "default",
					        "badge" => $this->partnerBadge,
					        "title" => "트로스트",
					        "body" => $pushMessage,
							"type" => "chat",
							"no_log" => $numberOfRoom,
							"no" => $numberOfMsg,
							"log" => $loadMessage,
							"log_from" => "trost",
							"time_message" => $this->time_message,
							"name" => "트로스트",
							"pic" => "00000000",
							"userType" => $this->userType
						),
					);

					if ($finishGuide === 'playrtc') {
						$push['data']['extraType'] = 'playRTC';
						$push['data']['finishGuide'] = '';
					} else {
						unset($push['data']['extraType']);
						unset($push['data']['finishGuide']);
					}

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

	    }

		function reservationPushForClient ($numberOfRoom, $numberOfMsg, $pushMessage, $loadMessage, $finishGuide)
		{
			global $conn_;

			if (($this->clientID != '') && ($this->clientToken != '')) {

				settype($this->clientBadge, "int");
				settype($numberOfMsg, "int");

				$unReadBadge = $numberOfMsg - $this->clientBadge;

				if ($this->c_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"badge" => $unReadBadge,
						"type" => "chat",
						"finishGuide" => "$finishGuide",
						"title" => "트로스트",
						"alert" => $pushMessage,
						"body" => $pushMessage,
						"no_log" => $numberOfRoom,
						"no" => $numberOfMsg,
						"log" => $loadMessage,
						"log_from" => "trost",
						"time_message" => $this->time_message,
						"name" => "트로스트",
						"pic" => "00000000",
						"userType" => $this->userType
					);

					if ($finishGuide === 'playrtc') {
						$body['aps']['extraType'] = 'playRTC';
						$body['aps']['finishGuide'] = '';
					} else {
						unset($body['aps']['extraType']);
						unset($body['aps']['finishGuide']);
					}

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->clientToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->clientToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"badge" => $unReadBadge,
							"title" => "트로스트",
							"body" => $pushMessage,
							"type" => "chat",
							"finishGuide" => "$finishGuide",
							"no_log" => $numberOfRoom,
							"no" => $numberOfMsg,
							"log" => $loadMessage,
							"log_from" => "trost",
							"time_message" => $this->time_message,
							"name" => "트로스트",
							"pic" => "00000000",
							"userType" => $this->userType
						),
					);

					if ($finishGuide === 'playrtc') {
						$push['data']['extraType'] = 'playRTC';
						$push['data']['finishGuide'] = '';
					} else {
						unset($push['data']['extraType']);
						unset($push['data']['finishGuide']);
					}

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

		function facetimeCallPush ($roomNumber, $channelID, $channelName, $channelTimer) {

	    	global $conn_;

			if (($this->clientID != '') && ($this->clientToken != '')) {

				settype($this->clientBadge, "int");
				settype($roomNumber, "int");

				$unReadBadge = $numberOfMsg - $this->clientBadge;

				if ($this->c_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"badge" => $unReadBadge,
						"no_room" => $channelID,
						"no_log" => $roomNumber,
						"title" => "트로스트",
						"alert" => $this->partnerName . " 상담사에게 화상 상담 신청 알람이 왔습니다",
						"body" => $this->partnerName . " 상담사에게 화상 상담 신청 알람이 왔습니다",
						"type" => "makevideo",
						"finishTime" => "$channelTimer",
						"name" => $this->partnerName,
						"sender" => $this->partnerID,
						"pic" => $this->partnerPic,
						"userType" => $this->userType
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->clientToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->clientToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"badge" => $unReadBadge,
							"no_room" => $channelID,
							"no_log" => $roomNumber,
							"title" => "트로스트",
							"alert" => $this->partnerName . " 상담사에게 화상 상담 신청 알람이 왔습니다",
							"body" => $this->partnerName . " 상담사에게 화상 상담 신청 알람이 왔습니다",
							"type" => "makevideo",
							"finishTime" => "$channelTimer",
							"name" => $this->partnerName,
							"sender" => $this->partnerID,
							"pic" => $this->partnerPic,
							"userType" => $this->userType
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

		function voicetimeCallPush ($roomNumber, $channelID, $channelName, $channelTimer) {

	    	global $conn_;

			if (($this->clientID != '') && ($this->clientToken != '')) {

				settype($this->clientBadge, "int");
				settype($roomNumber, "int");

				$unReadBadge = $numberOfMsg - $this->clientBadge;

				if ($this->c_token_length == '64') {

					$body['aps'] = array(
						"content-available" => "1",
						"sound" => "default",
						"badge" => $unReadBadge,
						"no_room" => $channelID,
						"no_log" => $roomNumber,
						"title" => "트로스트",
						"alert" => $this->partnerName . " 상담사에게 전화 상담 신청 알람이 왔습니다",
						"body" => $this->partnerName . " 상담사에게 전화 상담 신청 알람이 왔습니다",
						"type" => "makevoice",
						"finishTime" => "$channelTimer",
						"name" => $this->partnerName,
						"sender" => $this->partnerID,
						"pic" => $this->partnerPic,
						"userType" => $this->userType
					);

					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
					$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

					$payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $this->clientToken) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
					$notification = chr(2) . pack('N', strlen($inner)) . $inner;

					fwrite($fp, $notification, strlen($notification));
					fclose($fp);

				} else {

					$headers = array(
					    "Content-Type:application/json;charset=utf-8",
					    "Authorization:key=AIzaSyDYpkGz6fcmPbMzVtWSf-xWWGofQCxIfXA"
					);

					$push = array(
						"registration_ids"=>array(
							"0" => "$this->clientToken"
						),
						"priority" => "high",
						"data"=>array(
							"sound" => "default",
							"badge" => $unReadBadge,
							"no_room" => $channelID,
							"no_log" => $roomNumber,
							"title" => "트로스트",
							"alert" => $this->partnerName . " 상담사에게 전화 상담 신청 알람이 왔습니다",
							"body" => $this->partnerName . " 상담사에게 전화 상담 신청 알람이 왔습니다",
							"type" => "makevoice",
							"finishTime" => "$channelTimer",
							"name" => $this->partnerName,
							"sender" => $this->partnerID,
							"pic" => $this->partnerPic,
							"userType" => $this->userType
						),
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

		}

	}

?>
