<?php
	/****************************************
	* PHP API for Coupon.
	*****************************************/
	header("Content-type: application/json; charset=utf-8");
	require_once("$_SERVER[DOCUMENT_ROOT]/assets/file/cont_db.php");

	$json = file_get_contents('php://input');
	$requests = json_decode($json);

	(string) $roomNumber = mysqli_real_escape_string($conn_, $requests->no_log);

	$counseling_q = mysqli_query($conn_, "SELECT `no`, `client`, `partner`, `historyClient`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = '" . $roomNumber . "' ORDER BY `no` DESC LIMIT 1) as cNo FROM `trost_counseling`.`counseling_log` WHERE (`no` = '" . $roomNumber . "') ORDER BY `no` DESC");
	$counseling = mysqli_fetch_array($counseling_q);

	if ($counseling['no'] != '') {

		(string) $date = date("Y-m-d");
		(string) $toNow = date("Y-m-d A h:i");
		(int) $recentlyNo = $counseling['cNo'] + 1;
		(int) $unReadBadge = $recentlyNo - $counseling['historyClient'];

		// 사일런트 푸시 일 때
		// iOS - Alert, Sound 비공개
		if ($counseling['partner'] == 'cordpartner01') {

			$getTokenOfClient_q = mysqli_query($conn_, "SELECT `t0ken` FROM `mb_client` WHERE (`id` = '" . $counseling['client'] . "') LIMIT 1");
			$getTokenOfClient = mysqli_fetch_array($getTokenOfClient_q);

			if ($getTokenOfClient['t0ken'] != '') {

				$token_length = strlen($getTokenOfClient['t0ken']);

				if ($token_length == '64') {

					$body['aps'] = array(
						"content-available"=>"1",
						"badge"=>"$unReadBadge",
						"sound"=>"default",
						"type"=>"chat",
						"coupon"=>"Y",
						"visible"=>"Y",
						"alert"=>"30분 무료상담 쿠폰이 지급되었습니다.",
						"title"=>"트로스트",
						"body"=>"30분 무료상담 쿠폰이 지급되었습니다.",
						"log"=>"30분 무료상담 쿠폰이 지급되었습니다.",
						"log_from"=>"trost",
						"no_log"=>"$roomNumber",
						"no"=>$counseling['cNo']
					);

				    $ctx = stream_context_create();
				    stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/manage/Apns/keys_for_php/apnsProd.pem');
				    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

				    $payload = json_encode($body);

					$inner = chr(1) . pack('n', 32) . pack('H*', $getTokenOfClient['t0ken']) . chr(2) . pack('n', strlen($payload)) . $payload . chr(5) . pack('n', 1) . chr(10);
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
							"0"=>"$getTokenOfClient[t0ken]"
						),
						"priority"=>"high",
						"data"=>array(
							"sound"=>"default",
							"badge"=>"$unReadBadge",
							"type"=>"chat",
							"coupon"=>"Y",
							"visible"=>"Y",
							"title"=>"트로스트",
							"body"=>"30분 무료상담 쿠폰이 지급되었습니다.",
							"log"=>"30분 무료상담 쿠폰이 지급되었습니다.",
							"log_from"=>"trost",
							"no_log"=>$roomNumber,
							"no"=>$counseling['cNo']
						)
					);

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($push));

					curl_exec($ch);
					curl_close($ch);

				}

			}

			mysqli_query($conn_, "INSERT INTO `trost`.`coupon` (openD, event, type, item, client, finishD) VALUES ('" . $date . "', 'promo5', 'text', 'free24', '" . $counseling['client'] . "', '2017-03-31')");
			mysqli_query($conn_, "INSERT INTO `trost_counseling`.`log_counseling` (no, no_log, time_message, log, log_from, device) VALUES ('" . $recentlyNo . "', '" . $roomNumber . "', '" . $toNow . "', '30분 무료상담 쿠폰이 지급되었습니다.', 'trost', 'mobile')");

			$response = array(
				"result"=>"Y",
				"type"=>"coupon"
			);

		} else {

			$response = array(
				"result"=>"N",
				"type"=>"coupon"
			);

		}

	} else {

		$response = array(
			"result"=>"N",
			"type"=>"coupon",
			"msg"=>"잘못된 접근입니다."
		);

	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);

	?>
