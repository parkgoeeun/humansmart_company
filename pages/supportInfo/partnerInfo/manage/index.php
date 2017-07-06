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

		#example2 td, #example3 td { vertical-align:middle; font-size:1.3rem; }

		.hashtag { width: 100%; margin-top: 40px; }
		.hashtag th, td { vertical-align:top; border: 1px solid #999; }

	</style>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/pages/common/navigation.php"); ?>

		<script>
			document.getElementById("infoTable_9").className = "treeview active";
			document.getElementById("infoTable_9_1").className = "active";

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
								<h3 class="box-title">상담사 정보</h3>
							</div>

			                <?php $getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `sex`, `email`, `work_mode`, `recently_time`, `recently_device`, `status`, `pic`, `point`, `userStatus` FROM `trost`.`mb_partner` WHERE (`status` != 'N') ORDER BY `no` DESC"); ?>

							<div class="box-body">
								<table id="example2" class="table table-bordered table-hover" style='word-break:break-all;'>
									<thead>
										<tr style='background:#f4f4f4;'>
											<th colspan='10'>전체 정보 (상담사 상태: 'YY = 유료 + 무료 상담', 'NY = 무료 상담', 'YN = 유료 상담', 'N = 상담 안함' / 'C = 모든 상담', 'YC = 기업 + 유료', 'CY = 기업 + 무료', 'CC = 기업')<br/>(상담 가능 상태 변경: texttime,facetime,voicetime)</th>
										</tr>
										<tr style='background:#f4f4f4;'>
											<th>이미지</th>
											<th>이름</th>
											<th>담당 내담자<br/>(진행/전체)</th>
											<th>최근 로그인 시간</th>
											<th>접속 중</th>
											<th>보유 점수</th>
											<th>점수 관리</th>
											<th>상태</th>
											<th>상태 관리</th>
										</tr>
									</thead>
									<tbody>

								<?php

									while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q)) {

										$query5_q = mysqli_query($conn_, "SELECT count(*) FROM `trost_counseling`.`counseling_log` WHERE ((`partner` = '" . $getInfoOfPartner['id'] . "') && (`payment` = 'Y'))");
										$query5 = mysqli_fetch_array($query5_q);

										$countOfPayment_q = mysqli_query($conn_, "SELECT count(*) FROM `trost`.`payment` WHERE (`partner` = '" . $getInfoOfPartner['id'] . "') ORDER BY `no` ASC;");
										$countOfPayment = mysqli_fetch_array($countOfPayment_q);

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

										if ($getInfoOfPartner['work_mode'] == '') {
											$getInfoOfPartner['work_mode'] = '';
										}

										echo "<tr>
										<td style='text-align:center;'>
											<a style='font-weight:bold;' href='/pages/supportInfo/partnerInfo/profile/?no=" . $getInfoOfPartner['no'] . "'><img src='/assets/img/of_partner/" . $getInfoOfPartner['pic'] . "_.png' style='width:40px;vertical-align:middle;margin:0px 5px;'/></a>
										</td>
										<td>
											<a style='font-weight:bold;' href='/pages/supportInfo/partnerInfo/profile/?no=" . $getInfoOfPartner['no'] . "'>" . $getInfoOfPartner['name'] . "<br/>(" . $getInfoOfPartner['id'] . ")</a><br/>
											<button onclick='location.href=\"/pages/supportInfo/partnerInfo/addNew/?type=mod&id=" . $getInfoOfPartner['id'] . "\"' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;margin-top:6px;'>수정</button>
										</td>
										<td>" . $query5['0'] . " / " . $countOfPayment['0'] . "</td>
										<td>" . $getInfoOfPartner['recently_device'] . " / " . $getInfoOfPartner['recently_time'] . "</td>
										<td>" . $getInfoOfPartner['userStatus'] . "</td>
										<td>" . $getInfoOfPartner['point'] . "</td>";

										echo "<td>" . $status . "</td>
										<td style='text-align:center;'>
											<!-- <button onclick='plusPoint(\"" . $getInfoOfPartner['id'] . "\")' class='btn btn-success btn-xs' style='vertical-align:middle;'>+5</button>
											<button onclick='minusPoint(\"" . $getInfoOfPartner['id'] . "\")' class='btn btn-warning btn-xs' style='vertical-align:middle;'>-5</button>
											<br/><br/> -->
											<button onclick='managePlusPoint(\"" . $getInfoOfPartner['id'] . "\")' class='btn btn-success btn-xs' style='vertical-align:middle;'>+</button>
											<input type='text' name='pointVal' id='pointVal_" . $getInfoOfPartner['id'] . "' style='width:30px;vertical-align:middle;' placeholder='5'/>
											<button onclick='manageMinusPoint(\"" . $getInfoOfPartner['id'] . "\")' class='btn btn-warning btn-xs' style='vertical-align:middle;'>-</button>
										</td>
										<td style='text-align:left;'>";

										if ($getInfoOfPartner['status'] === 'YY') {
											// 유료 + 무료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'YN') {
											// 유료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'NY') {
											// 무료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'N') {
											// 전체 비활성

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'C') {
											// 기업 + 유료 + 무료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'CY') {
											// 기업 + 무료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'YC') {
											// 기업 + 유료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'CC') {
											// 기업

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											</td>";

										}

										echo "</tr>";

									}

								?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">상담사 정보</h3>
							</div>

			                <?php $getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `sex`, `email`, `work_mode`, `recently_time`, `recently_device`, `status`, `pic`, `point`, `userStatus` FROM `trost`.`mb_partner` WHERE (`status` = 'N') ORDER BY `no` DESC"); ?>

							<div class="box-body">
								<table id="example3" class="table table-bordered table-hover" style='word-break:break-all;'>
									<thead>
										<!-- <tr style='background:#f4f4f4;'>
											<th colspan='10'>전체 정보 (상담사 상태: 'YY = 유료 + 무료 상담', 'NY = 무료 상담', 'YN = 유료 상담', 'N = 상담 안함' / 'C = 모든 상담', 'YC = 기업 + 유료', 'CY = 기업 + 무료', 'CC = 기업')<br/>(상담 가능 상태 변경: texttime,facetime,voicetime)</th>
										</tr> -->
										<tr style='background:#f4f4f4;'>
											<th>이미지</th>
											<th>이름</th>
											<th>담당 내담자(전체)</th>
											<th>상담사 등록일</th>
											<th>상담사 중지일</th>
											<th>상태</th>
											<th>상태 관리</th>
										</tr>
									</thead>
									<tbody>

								<?php

									while ($getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q)) {

										// $query5_q = mysqli_query($conn_, "SELECT count(*) FROM `trost_counseling`.`counseling_log` WHERE ((`partner` = '" . $getInfoOfPartner['id'] . "') && (`payment` = 'Y'))");
										// $query5 = mysqli_fetch_array($query5_q);

										$countOfPayment_q = mysqli_query($conn_, "SELECT count(*) FROM `trost`.`payment` WHERE (`partner` = '" . $getInfoOfPartner['id'] . "') ORDER BY `no` ASC;");
										$countOfPayment = mysqli_fetch_array($countOfPayment_q);

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

										if ($getInfoOfPartner['work_mode'] == '') {
											$getInfoOfPartner['work_mode'] = '';
										}

										echo "<tr>
										<td style='text-align:center;'>
											<a style='font-weight:bold;' href='/pages/supportInfo/partnerInfo/profile/?no=" . $getInfoOfPartner['no'] . "'><img src='/assets/img/of_partner/" . $getInfoOfPartner['pic'] . "_.png' style='width:40px;vertical-align:middle;margin:0px 5px;'/></a>
										</td>
										<td>
											<a style='font-weight:bold;' href='/pages/supportInfo/partnerInfo/profile/?no=" . $getInfoOfPartner['no'] . "'>" . $getInfoOfPartner['name'] . "<br/>(" . $getInfoOfPartner['id'] . ")</a><br/>
											<button onclick='location.href=\"/pages/supportInfo/partnerInfo/addNew/?type=mod&id=" . $getInfoOfPartner['id'] . "\"' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;margin-top:6px;'>수정</button>
										</td>
										<td>" . $countOfPayment['0'] . "</td>
										<td> .... </td>
										<td> .... </td>
										<td>" . $status . "</td>
										<td style='text-align:left;'>";

										if ($getInfoOfPartner['status'] === 'YY') {
											// 유료 + 무료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'YN') {
											// 유료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'NY') {
											// 무료 상담만

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'N') {
											// 전체 비활성

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'C') {
											// 기업 + 유료 + 무료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'CY') {
											// 기업 + 무료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'YC') {
											// 기업 + 유료

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업</button>
											</td>";

										} else if ($getInfoOfPartner['status'] === 'CC') {
											// 기업

											echo "<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YY\")' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;'>유료/무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YN\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>유료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"NY\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>무료 활성</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"N\")' class=\"btn btn-primary btn-xs\" style='margin-left:6px;vertical-align:middle;'>비활성</button>
											<br/><br/>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"C\")' class=\"btn btn-warning btn-xs\" style='vertical-align:middle;'>기업/유료/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"CY\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/무료</button>
											<button onclick='changeStatus(\"" . $getInfoOfPartner['id'] . "\", \"YC\")' class=\"btn btn-warning btn-xs\" style='margin-left:6px;vertical-align:middle;'>기업/유료</button>
											</td>";

										}

										echo "</tr>";

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
					"lengthMenu": [[10, 15, 45, -1], [10, 15, 45, "All"]],
					"info": true,
					"autoWidth": false
				});
			});

			function plusPoint (partnerID) {

				var result = confirm("포인트 5점을 추가하시겠습니까?");

				if (result) {
					location.href = '/pages/supportInfo/partnerInfo/manage/?partnerID=' + partnerID + '&plus=5';
				}

			}

			function minusPoint (partnerID) {

				var result = confirm("포인트 5점을 제거하시겠습니까?");

				if (result) {
					location.href = '/pages/supportInfo/partnerInfo/manage/?partnerID=' + partnerID + '&minus=5';
				}

			}

			function managePlusPoint (partnerID) {

				var point = $("#pointVal_" + partnerID).val();

				if (point == '') {
					alert("몇 포인트를 추가/제외하실건지 먼저 작성해주세요!");

					return false;
				} else {
					var result = confirm("포인트 " + point + "점을 추가하시겠습니까?");

					if (result) {
						location.href = '/pages/supportInfo/partnerInfo/manage/?partnerID=' + partnerID + '&plus=' + point;
					}
				}

			}

			function manageMinusPoint (partnerID) {

				var point = $("#pointVal_" + partnerID).val();

				if (point == '') {
					alert("몇 포인트를 추가/제외하실건지 먼저 작성해주세요!");

					return false;
				} else {
					var result = confirm("포인트 " + point + "점을 제거하시겠습니까?");

					if (result) {
						location.href = '/pages/supportInfo/partnerInfo/manage/?partnerID=' + partnerID + '&minus=' + point;
					}
				}

			}

			function updateBadge (partnerID) {

				var result = confirm(partnerID + " 선생님의 안 읽은 메세지 개수를 새로고침 합니다.");

				if (result) {
					location.href = '/pages/supportInfo/partnerInfo/manage/?partnerID=' + partnerID + '&type=updateBadge';
				}

			}

			function changeStatus(id, status) {
				var returnValue = confirm("정말 상담사 상태를 변경 시키겠습니까?");

				if (returnValue) {
					location.href = '?mode=change&id=' + id + '&status=' + status;
				}
			}

		</script>

	</body>
</html>
