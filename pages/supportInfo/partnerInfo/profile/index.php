<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

	$query = mysqli_query($conn_, "SELECT `id`, `name`, `pic`, `recently_time`, `email`, `phone`, `introduce`, `career`, `matchJob`, `matchTarget`, `matchFeel`, `matchCharacters`, `matchCategorys` FROM `trost`.`mb_partner` WHERE (`no` = '" . $_GET['no'] . "') ORDER BY `no` DESC LIMIT 1");
	$row = mysqli_fetch_array($query);

	$today = date("Y-m-d");
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
		<link rel="stylesheet" href="../../../../dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../../../../dist/css/skins/_all-skins.min.css">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Basic Template Resource -->
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php require_once("$_SERVER[DOCUMENT_ROOT]/pages/common/navigation.php"); ?>

		<script>
			document.getElementById("infoTable_4").className = "treeview active";
			document.getElementById("infoTable_4_7").className = "active";
		</script>

		<?php

		echo "
			<div class='content-wrapper'>
				<section class='content-header'>
					<h1> " . $row['name'] . " 상담가 <small>CODE: " . $row['pic'] . "</small></h1>
					<ol class='breadcrumb'>
						<li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
						<li><a href='#'>Examples</a></li>
						<li class='active'>Invoice</li>
					</ol>
				</section>

				<section class='invoice'>
					<div class='row'>
						<div class='col-xs-12'>
							<h2 class='page-header'>
								<i class='fa fa-globe'></i> TROST Counselor. <small class='pull-right'>Date: " . $row['recently_time'] . "</small>
							</h2>
						</div>
					</div>
					<div class='row invoice-info' style='margin-bottom:30px;'>
						<div class='col-sm-4 invoice-col' style='font-size: 15px;line-height:23px;'>
							<h4>[개인 정보]</h4>
							<strong>" . $row['name'] . "</strong><br>이메일 : " . $row['email'] . "<br/>연락처 : " . $row['phone'] . "<br/>성별 : ";

							echo $row[sex] == 'M' ? "남자<br/>":"여자<br/>";

							echo "<br/>자기소개 : " . $row['introduce'] . "<br/>
						</div>
						<div class='col-sm-4 invoice-col' style='font-size: 15px;line-height:23px;'>
							<h4>[상담 정보]</h4>
							상담 시간 : " . $row['work_time'] . "<br/>
							<br/>경력<br/>";

							(int) $i = 0;
							$career = explode(",", $row['career']);

							foreach ($career as $key => $value) {
								$i = $key + 1;
								echo $i . ")" . $value . "<br/>";
							}

							echo "
							</div>
							<div class='col-sm-4 invoice-col' style='font-size: 15px;line-height:23px;'>
							<h4>[상담 정보]</h4>
							<b>직장 : </b>" . $row['matchJob'] . "<br>
							<b>타겟 : </b>" . $row['matchTarget'] . "<br>
							<b>감정 : </b>" . $row['matchFeel'] . "<br>
							<b>성격 : </b>" . $row['matchCharacters'] . "<br>
							<b>고민 : </b>" . $row['matchCategorys'] . "<br>
						</div>
					</div>

					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
								<thead>
									<tr>
										<th colspan='4'><th>
									</tr>
									<tr>
										<th colspan='4'>담당 내담자 (결제 완료)<th>
									</tr>
									<tr>
										<th style='width:5%;text-align:center;'></th>
										<th style='width:15%;text-align:center;'>닉네임(이름)</th>
										<th style='width:40%;text-align:center;'>상담 시작시간</th>
										<th style='width:40%;text-align:center;'>결제기간</th>
									</tr>
								</thead>
								<tbody>";

								$query2 = mysqli_query($conn_, "SELECT `no`, `client`, `payment`, `time_start` FROM `trost_counseling`.`counseling_log` WHERE ((`partner` = '" . $row['id'] . "') && (`payment` = 'Y')) ORDER BY `no` DESC");
								while ($row2 = mysqli_fetch_array($query2)) {
									$query3 = mysqli_query($conn_, "SELECT `name` FROM `trost`.`mb_client` WHERE (`id` = '" . $row2['client'] . "') ORDER BY `no` DESC LIMIT 1");
									$row3 = mysqli_fetch_array($query3);

									$query4 = mysqli_query($conn_, "SELECT `date_f`, `date_t` FROM `trost`.`payment` WHERE (`chat_log` = '" . $row2['no'] . "') ORDER BY `no` DESC LIMIT 1");
									$row4 = mysqli_fetch_array($query4);

									if ($today <= $row4['date_t']) {
										echo "<tr>
											<td style='text-align:center;'>" . $row2['no'] . "</td>
											<td style='text-align:center;'>" . $row3['name'] . "</td>
											<td style='text-align:center;'>" . $row2['time_start'] . "</td>
											<td style='text-align:center;'>" . $row4['date_f'] . " ~ " . $row4['date_t'] . "</td>
										</tr>";
									}
								}

							echo "</tbody>
							</table>
						</div>
					</div>

					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
								<thead>
									<tr>
										<th colspan='4'><th>
									</tr>
									<tr>
										<th colspan='4'>담당 내담자 (결제 종료)<th>
									</tr>
									<tr>
										<th style='width:5%;text-align:center;'></th>
										<th style='width:15%;text-align:center;'>닉네임(이름)</th>
										<th style='width:40%;text-align:center;'>상담 시작시간</th>
										<th style='width:40%;text-align:center;'>결제기간</th>
									</tr>
								</thead>
								<tbody>";

								$query2 = mysqli_query($conn_, "SELECT `no`, `client`, `payment`, `time_start` FROM `trost_counseling`.`counseling_log` WHERE ((`partner` = '" . $row['id'] . "') && ((`payment` = 'N') || (`payment` = 'Y'))) ORDER BY `no` DESC");
								while ($row2 = mysqli_fetch_array($query2)) {
									$query3 = mysqli_query($conn_, "SELECT `name` FROM `mb_client` WHERE (`id` = '" . $row2['client'] . "') ORDER BY `no` DESC LIMIT 1");
									$row3 = mysqli_fetch_array($query3);

									$query4 = mysqli_query($conn_, "SELECT `date_f`, `date_t` FROM `trost`.`payment` WHERE (`chat_log` = '" . $row2['no'] . "') ORDER BY `no` DESC LIMIT 1");
									$row4 = mysqli_fetch_array($query4);

									if ((($today > $row4['date_t']) && ($row2['payment'] == 'Y')) || ($row2['payment'] == 'N')) {

										echo "<tr>
											<td style='text-align:center;'>" . $row2['no'] . "</td>
											<td style='text-align:center;'>" . $row3['name'] . "</td>
											<td style='text-align:center;'>" . $row2['time_start'] . "</td>
											<td style='text-align:center;'>" . $row4['date_f'] . " ~ " . $row4['date_t'] . "</td>
										</tr>";
									}
								}

						echo "</tbody>
							</table>
						</div>
					</div>";
				?>
				</section>
			</div>
		</div>


		<script src="../../../../bootstrap/js/bootstrap.min.js"></script>
		<script src="../../../../dist/js/app.min.js"></script>

	</body>
</html>
