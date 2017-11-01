<?php
    /**
 * Copyright (c) 2017. 주식회사 휴마트컴퍼니. HumartCompany, Inc.
 */

//    session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>트로스트 - 온라인 심리상담 서비스</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="robots" content="NONE, NOINDEX, NOFOLLOW, NOIMAGEINDEX"/>
		<meta name="reply-to" content="trost@hu-mart.com"/>
		<meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			@media (max-width: 999px) {
				#mobile_section a { display: block;border: 2px solid #999999;border-radius: 6px;margin: 10px auto;padding: 12px 0px;width: 90%;text-align: center;font-weight: bold;font-size: 2rem; }
			}
			@media (min-width: 999px) {
				#mobile_section { display: none; }
			}
			/*.content { height:auto;min-height: none; }*/
			.col-md-12.title { border:2px solid #999999;border-radius:6px;margin:10px 0px;padding:0px 15px;height:auto; }
			.col-md-12.title p { width:100%;margin:0px;padding:0px;cursor:pointer;padding:10px 0px;text-align: center;font-size:1.8rem; }
		</style>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/pages/common/navigation.php"); ?>

		<script>
			document.getElementById("infoMain").className = "treeview active";
			document.getElementById("infoMain_1").className = "active";

			function checkSupport(value)
            {
				var state = $("#" + value).css('display');

				if (state == 'none') {
					$("#" + value).css('display', '');
				} else {
					$("#" + value).css('display', 'none');
				}
			}
		</script>

			<div class="content-wrapper">
				<section class="content" id='mobile_section'>
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header with-border" style='padding:10px;'>
								<a href="/pages/supportInfo/payment/">결제 내역</a>
								<a href="/pages/supportInfo/payment/Extra/">결제 대기 내역</a>
								<a href="/pages/supportInfo/counseling/">상담 진행 내역</a>
								<a href="/pages/__tables/managecontact.php">문의 확인 내역</a>
							</div>
						</div>
					</div>
				</section>
				<section class="content-header">
					<h1>대시보드 [1] - 전체 데이터 현황</h1>
				</section>
				<section class="content">
					<!-- First Row -->
					<div class="row">
					</div>
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
									<?php echo "<h3>" . number_format($inWEB + $inAPP) . "</h3>"; ?>
									<p style='font-weight:bold;'>전체 내담자(명)</p>
								</div>
								<a href="/pages/tables/userinfo.php" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-yellow">
								<div class="inner">
									<?php echo "<h3>" . number_format($truePartner + $falsePartner) . " / " . number_format($truePartner) . "</h3>"; ?>
									<p style='font-weight:bold;'>전체 상담사(명) / 현재 활동 중(명)</p>
								</div>
								<a href="/pages/tables/userinfo_p.php" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-green">
								<div class="inner">
									<?php echo "<h3>" . number_format($totalCounselingCount) . "</h3>"; ?>
									<p style='font-weight:bold;'>전체 상담 <?php echo "<span style='font-size:1.5rem;'> (" . number_format($totalCounselingCountPC) . " / " . number_format($totalCounselingCountApp) . ")</span>"; ?></p>
								</div>
								<a href="/pages/supportInfo/counseling/" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-red">
								<div class="inner">
									<?php echo "<h3>" . number_format($totalMessageCount) . "</h3>"; ?>
									<p style='font-weight:bold;'>전체 메세지 <?php echo "<span style='font-size:1.5rem;'> (" . number_format($totalMessageCountPC) . " / " . number_format($totalMessageCountApp) . ")</span>"; ?></p>
								</div>
								<a href="/pages/supportInfo/counseling/" class="small-box-footer">더보기</a>
							</div>
						</div>
					</div>
					<!-- First Row -->

					<!-- Second Row -->
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
									<?php echo "<h3>" . number_format($inPaymentMoney + $inPaymentCoupon) . "(" . number_format($inPaymentMoney) . " / " . number_format($inPaymentCoupon) . ")</h3>"; ?>
								<p style='font-weight:bold;'>전체 결제자(명) - 순수 결제 / 쿠폰 이용 (=0원)</p>
							</div>
							<a href="/pages/supportInfo/payment/" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-yellow">
								<div class="inner">
									<?php echo "<h3>" . number_format($inPaymentMoneyAgainWithCash + $inPaymentMoneyAgainWithFree) . "(" . number_format($inPaymentMoneyAgainWithCash) . " / " . number_format($inPaymentMoneyAgainWithFree) . ")</h3>"; ?>
									<p style='font-weight:bold;'>전체 재결제자(명) - 순수 결제 / 쿠폰 이용 (=0원)</p>
								</div>
								<a href="/pages/supportInfo/payment/" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-green">
								<div class="inner">
									<?php echo "<h3>" . number_format($inSentence) . " (" . number_format($inSentencePayment) . ")</h3>"; ?>
									<p style='font-weight:bold;'>문장완성 참가자 (결제 경험자) (명)</p>
								</div>
								<a href="/pages/supportInfo/extraCounseling/sentencecomplete/" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-red">
								<div class="inner">
									<?php echo "<h3>" . number_format($inTraingleLove) . " (" . number_format($inTraingleLovePayment) . ")</h3>"; ?>
									<p style='font-weight:bold;'>사랑의삼각형 참가자 (결제 경험자) (명)</p>
								</div>
								<a href="/pages/supportInfo/extraCounseling/trainglelove/" class="small-box-footer">더보기</a>
							</div>
						</div>
					</div>
					<!-- Second Row -->

					<!-- Third Row -->
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
									<?php echo "<h3>" . number_format($todayUpWeb + $todayUpApp) . " (" . number_format($todayUpWeb) . "/" . number_format($todayUpApp) . ")</h3>"; ?>
									<p style='font-weight:bold;'>오늘의 회원가입(명) (웹/앱)(명)</p>
								</div>
								<a href="#" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-yellow">
								<div class="inner">
									<?php echo "<h3>" . number_format($todayInWeb + $todayInApp) . " (" . number_format($todayInWeb) . "/" . number_format($todayInApp) . ")</h3>"; ?>
									<p style='font-weight:bold;'>오늘의 로그인(명) (웹/앱)(명)</p>
								</div>
								<a href="#" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">

							<div class="small-box bg-green">
								<div class="inner">
									<?php echo "<h3>" . number_format($todayCounselingCount) . "</h3>"; ?>
									<p style='font-weight:bold;'>오늘의 상담</p>
								</div>
								<a href="/pages/supportInfo/counseling/" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">

							<div class="small-box bg-red">
								<div class="inner">
									<?php echo "<h3>" . number_format($todayMessageCount) . " (" . number_format($todayMessageCountPC) . "/" . number_format($todayMessageCountApp) . ")</h3>"; ?>
									<p style='font-weight:bold;'>오늘의 메세지(개) (웹/앱)(개)</p>
								</div>
								<a href="/pages/supportInfo/counseling/" class="small-box-footer">더보기</a>
							</div>
						</div>
					</div>
					<!-- Third Row -->

					<!-- Fouth Row -->
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
									<?php echo "<h3>" . number_format($inWEB) . " / " . number_format($inAPP) . "</h3>"; ?>
									<p style='font-weight:bold;'>회원가입 웹/앱</p>
								</div>
								<a href="#" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3>업데이트 중</h3>
									<p style='font-weight:bold;'>오늘의 누적 방문 수 웹/앱</p>
								</div>
								<a href="#" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>업데이트 중</h3>
									<p style='font-weight:bold;'>전체 누적 방문 수 웹/앱</p>
								</div>
								<a href="#" class="small-box-footer">더보기</a>
							</div>
						</div>
						<div class="col-lg-3 col-xs-6">
							<div class="small-box bg-red">
								<div class="inner">
									<?php echo "<h3>" . number_format($payment) . " (" . number_format($countPaymentInWeb) . "/" . number_format($countPaymentInApp) . ")</h3>"; ?>
									<p style='font-weight:bold;'>오늘의 매출(원) (웹/앱)(명)</p>
								</div>
								<a href="/pages/supportInfo/payment/" class="small-box-footer">더보기</a>
							</div>
						</div>
					</div>
					<!-- Fouth Row -->

				</section>
			</div>
		</div>

		<script src="assets/js/jquery-latest.min.js?ver=2.2.4"></script>
<!--		<script> $.widget.bridge('uibutton', $.ui.button); </script>-->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="dist/js/app.min.js"></script>

	</body>
</html>
