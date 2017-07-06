<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

	if ($_GET['type'] == 'updateBadge') {
		(int) $unReadBadge = 0;

		$selectinfo_q = mysqli_query($conn_, "SELECT `no`, `client` As clientID, `historyPartner`, (SELECT `no` FROM `trost_counseling`.`log_counseling` WHERE `no_log` = cLog.no ORDER BY `no` DESC LIMIT 1) AS recentlyNo, (SELECT max(`name`) FROM `trost`.`mb_client` WHERE `id` = clientID) AS clientName FROM `trost_counseling`.`counseling_log` AS cLog WHERE (`partner` = '" . $_GET['partnerID'] . "')");

		while ($selectinfo = mysqli_fetch_array($selectinfo_q)) {
			$unReadMessage = $selectinfo['recentlyNo'] - $selectinfo['historyPartner'];
			$unReadBadge = $unReadBadge + $unReadMessage;
		}

		$result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `badge` = '" . $unReadBadge . "' WHERE (`id` = '" . $_GET['partnerID'] . "')");

		if ($result) {
			echo "<script>alert(\"안 읽은 메세지 총 " . $unReadBadge . "개 업데이트 되었습니다.\");</script>";
			echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";

			exit();
		}
	}

	if ($_GET['mode'] == 'change') {
		mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `status` = '" . $_GET['status'] . "' WHERE (`id` = '" . $_GET['id'] . "') ORDER BY `no` ASC LIMIT 1;");
		echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";
	}

	if (($_GET['plus']) || ($_GET['minus'])) {

		if ($_GET['partnerID'] == '') {
			echo "<script>alert(\"잘못된 접근입니다.\");</script>";
			echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";

			exit();
		}

		if ($_GET['plus']) {

			$result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS infoA LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`point` = `infoB`.`point` + " . $_GET['plus'] . " WHERE (`infoB`.`id` = '" . $_GET['partnerID'] . "')");

			if ($result) {
				// echo "<script>alert(\"성공적으로 수정되었습니다!\");</script>";
				echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";
			} else {
				echo "<script>alert(\"수정에 실패했습니다, 다시 시도해주세요!\");</script>";
				echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";
			}

		} else if ($_GET['minus']) {

			$result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` AS infoA LEFT JOIN `trost`.`mb_partner` AS `infoB` ON `infoA`.`id` = `infoB`.`id` SET `infoB`.`point` = `infoB`.`point` - " . $_GET['minus'] . " WHERE (`infoB`.`id` = '" . $_GET['partnerID'] . "')");

			if ($result) {
				// echo "<script>alert(\"성공적으로 수정되었습니다!\");</script>";
				echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";
			} else {
				echo "<script>alert(\"수정에 실패했습니다, 다시 시도해주세요!\");</script>";
				echo "<script>location.href='/pages/supportInfo/partnerInfo/manage/';</script>";
			}

		}

	}

?>
<!DOCTYPE html>
<html>
	<head>
	<title>트로스트 - 온라인 심리상담 서비스</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	<meta name="robots" content="NONE"/>
	<meta name="reply-to" content="trost@hu-mart.com"/>
	<meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="../../../../dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="../../../../dist/css/skins/_all-skins.min.css">
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>

		#example2 td { vertical-align:middle; font-size:1.3rem; }

		.hashtag { width: 100%; margin-top: 40px; }
		.hashtag th, td { vertical-align:top; border: 1px solid #999; }

	</style>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/pages/common/navigation.php"); ?>

		<script>
			document.getElementById("infoTable_9").className = "treeview active";
			document.getElementById("infoTable_9_8").className = "active";

			function is_ie() {
				if (navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
				if (navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
				if (navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
				return false;
			}
		</script>

		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">상담사 '바로 상담 가능' 모드 체크</h3>
							</div>

			                <?php $getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `recently_time`, `userStatus`, `status` FROM `trost`.`mb_partner` ORDER BY `no` DESC"); ?>

							<div class="box-body">
								<table id="example2" class="table table-bordered table-hover" style='word-break:break-all;border-collapse:collapse;'>
									<thead>
										<tr style='background:#f4f4f4;'>
											<th colspan='8'>전체 정보</th>
										</tr>
										<tr style='background:#f4f4f4;'>
											<th style='width:5%;'></th>
											<th style='width:10%;'>상담사 정보</th>
											<th style='width:10%;'>상담 상태</th>
											<th style='width:18%;'>현재 상태</th>
											<th style='width:22%;'>현재 상태 ~ 마지막 상태 변경 시간 간격</th>
											<th style='width:10%;'>전체 전환(번)</th>
											<th style='width:10%;'>오늘 전환(번)</th>
											<th style='width:16%;'>평균 ON-OFF 간격</th>
										</tr>
									</thead>
									<tbody>

								<?php

									(string) $userStatus = '';
									(string) $diffString = '';
									(int) $totalCount = 0;
									(int) $todayCount = 0;

									(string) $toDay = date("Y-m-d");
									(string) $toDayCheckTime = date("Y-m-d H:i:s");
									(array) $getPartnerInfo = [];

									while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q)) {

										if ($getInfoOfPartner['status'] == 'YY') {
											(string) $status = "유료/무료";
										} else if ($getInfoOfPartner['status'] == 'NY') {
											(string) $status = "무료";
										} else if ($getInfoOfPartner['status'] == 'YN') {
											(string) $status = "유료";
										} else if ($getInfoOfPartner['status'] == 'N') {
											(string) $status = "중지";
										} else if ($getInfoOfPartner['status'] == 'C') {
											(string) $status = "기업/유료/무료";
										} else if ($getInfoOfPartner['status'] == 'YC') {
											(string) $status = "기업/유료";
										} else if ($getInfoOfPartner['status'] == 'CY') {
											(string) $status = "기업/무료";
										} else if ($getInfoOfPartner['status'] == 'CC') {
											(string) $status = "기업";
										}

										$getPartnerInfo['todayCount'][$getInfoOfPartner['id']] = 0;
										$getPartnerInfo['totalCount'][$getInfoOfPartner['id']] = 0;
										$totalCount = 0;
										$todayCount = 0;
										$recentlyCheckTime = '';
										$lastCheckTime = '';
										$getPartnerStatus = [];
										$diffString = '';
										$diffsString = '';
										$recentlyCheckTime = '';
										$lastCheckTime = '';

										$getLastStatus_q = mysqli_query($conn_, "SELECT `ph_partner_id`, `ph_mode`, `ph_time` FROM `trost_history`.`PartnerHistory` WHERE (`ph_partner_id` = '" . $getInfoOfPartner['id'] . "') ORDER BY `no` DESC;");

										while ($getLastStatus = mysqli_fetch_array($getLastStatus_q, MYSQLI_ASSOC)) {
											$getPartnerStatus[] = $getLastStatus;
										}

										foreach ($getPartnerStatus as $key => $value) {
											$phDay = substr($getPartnerStatus[$key]['ph_time'], 0, 10);

											if ($phDay == $toDay) {
												$getPartnerInfo['todayCount'][$getPartnerStatus[$key]['ph_partner_id']] += 1;
											}

											$getPartnerInfo['totalCount'][$getPartnerStatus[$key]['ph_partner_id']] += 1;
										}

										if ($getPartnerStatus['0']['ph_time']) $recentlyCheckTime = $getPartnerStatus['0']['ph_time'];
										if ($getPartnerStatus['1']['ph_time']) $lastCheckTime = $getPartnerStatus['1']['ph_time'];

										if ($getInfoOfPartner['userStatus'] === 'Y') {
											$userStatus = '접속 O';
										} else {
											$userStatus = '접속 X';
										}

										if (($recentlyCheckTime) && ($lastCheckTime)) {
											$firstDate = $recentlyCheckTime;
											$childDate = $lastCheckTime;

											$date = new DateTime($firstDate);
											$date_ = new DateTime($childDate);
											$diffS = date_diff($date, $date_);

											$diffString = $diffS->days . "일 " . $diffS->h . "시간 " . $diffS->i . "분 " . $diffS->s . "초 (" . $lastCheckTime . ")";
										}

										if (($recentlyCheckTime) && ($toDayCheckTime)) {
											$firstDates = $toDayCheckTime;
											$childDates = $recentlyCheckTime;

											$dates = new DateTime($firstDates);
											$date_s = new DateTime($childDates);
											$diffSs = date_diff($dates, $date_s);

											$diffsString = "'" . $diffSs->days . "일 " . $diffSs->h . "시간 " . $diffSs->i . "분 " . $diffSs->s . "초' 유지 중";
										}

										echo "<tr>
											<td>" . $getInfoOfPartner['no'] . "</td>
											<td>" . $getInfoOfPartner['name'] . "(" . $getInfoOfPartner['id'] . ")</td>
											<td>" . $status . "</td>
											<td>" . $userStatus . " - <b>" . $diffsString . "</b><br/>(" . $recentlyCheckTime . ")</td>
											<td>" . $diffString . "</td>
											<td>" . $getPartnerInfo['totalCount'][$getInfoOfPartner['id']] . "</td>
											<td>" . $getPartnerInfo['todayCount'][$getInfoOfPartner['id']] . "</td>
											<td> ... </td>
										</tr>";

									}

								?>
										</tr>
									</tbody>
								</table>
							</div>

							<?php $getStatusOfPartner_q = mysqli_query($conn_, "SELECT `no`, `ph_partner_id`, `ph_mode`, `ph_time` FROM `trost_history`.`PartnerHistory` ORDER BY `no` DESC;"); ?>

							<div class="box-body">
								<table id="example3" class="table table-bordered table-hover" style='word-break:break-all;'>
									<thead>
										<tr style='background:#f4f4f4;'>
											<th colspan='4'>전체 정보</th>
										</tr>
										<tr style='background:#f4f4f4;'>
											<th></th>
											<th>상담사 아이디</th>
											<th>모드</th>
											<th>작동 시간</th>
										</tr>
									</thead>
									<tbody>

								<?php

									(string) $pMode = '';

									while ($getStatusOfPartner = mysqli_fetch_array($getStatusOfPartner_q)) {

										$pMode = '';

										($getStatusOfPartner['ph_mode'] === 'counseling_on') ? $pMode = '바로 상담 가능 ON' : $pMode = '바로 상담 가능 OFF';

										echo "<tr>
											<td>" . $getStatusOfPartner['no'] . "</td>
											<td>" . $getStatusOfPartner['ph_partner_id'] . "</td>
											<td>" . $pMode . "</td>
											<td>" . $getStatusOfPartner['ph_time'] . "</td>
										</tr>";

									}

								?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<script src="../../../../bootstrap/js/bootstrap.min.js"></script>
		<script src="../../../../plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="../../../../dist/js/app.min.js"></script>

		<script>

			'use strict';

			$(function () {
				$('#example2, #example3').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"order": [[ 0, "desc" ]],
					"lengthMenu": [[20, 25, 55, -1], [20, 25, 55, "All"]],
					"info": true,
					"autoWidth": false
				});
			});

		</script>

	</body>
</html>
