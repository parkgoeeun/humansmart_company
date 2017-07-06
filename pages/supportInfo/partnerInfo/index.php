<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

	if ($_GET['mode'] == 'updateMode') {
		$result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `work_mode` = '" . $_GET['counselingmode'] . "' WHERE (`id` = '" . $_GET['id'] . "') ORDER BY `no` ASC LIMIT 1;");

		if ($result) {
			echo "<script>location.href='/pages/supportInfo/partnerInfo/'</script>";
		} else {
			echo "<script>alert('상태 변경에 실패했습니다, 다시 시도해주세요.')</script>";
			echo "<script>history.go(-1)</script>";
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
	<link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
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
			document.getElementById("infoTable_9_2").className = "active";

			function is_ie() {
				if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
				if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
				if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
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

							<?php $getInfoOfPartner_q = mysqli_query($conn_, "SELECT `no`, `id`, `name`, `sex`, `age`, `religion`, `phone`, `email`, `matchJob`, `matchTarget`, `matchFeel`, `matchCharacters`, `matchCategorys`, `work_mode`, `status` FROM `trost`.`mb_partner` ORDER BY `no` DESC;"); ?>

							<div class="box-body">
								<table id="example2" class="table table-bordered table-hover" style='word-break:break-all;'>
									<thead>
										<tr style='background:#f4f4f4;'>
											<th colspan='11'> (진행 상담 종류 변경: texttime,facetime,voicetime) </th>
										</tr>
										<tr style='background:#f4f4f4;'>
											<th></th>
											<th>이름</th>
											<th>성별</th>
											<th>나이</th>
											<th>종교</th>
											<th>결혼여부</th>
											<th>연락처</th>
											<th>휴대폰기종</th>
											<th>이메일</th>
											<th>상담 상태</th>
											<th>진행 상담 종류</th>
										</tr>
									</thead>
									<tbody>

								<?php

									$jobList = array('학생','유학생','가정주부','취업준비','무직','직장인','기타');
									$MinusjobList = array('학생','유학생','가정주부','취업준비','무직','직장인','기타');
									$targetList = array('나','가족','연인','배우자','직장동료','자녀','친구','육아');
									$MinustargetList = array('나','가족','연인','배우자','직장동료','자녀','친구','육아');
									$feelsList = array('무기력','우울','불안','분노','짜증','답답','막막','두려움','실망','불쌍','불행','슬픔','불만족','혼란','쓸쓸','민감','황당','무감정','평온','복잡','호기심','서운','안타까움','공허','억울함','당황','씁쓸','외로움','울고싶음','갈등','열등감','기타');
									$MinusfeelsList = array('무기력','우울','불안','분노','짜증','답답','막막','두려움','실망','불쌍','불행','슬픔','불만족','혼란','쓸쓸','민감','황당','무감정','평온','복잡','호기심','서운','안타까움','공허','억울함','당황','씁쓸','외로움','울고싶음','갈등','열등감','기타');
									$charctersList = array('예민하다','신경질적이다','신중하다','무덤덤하다','쾌활하다','소심하다','외향적이다','내향적이다','웃기다','꼼꼼하다','덜렁댄다','의욕적이다','회의적이다','낙관적이다','비관적이다','무신경하다','단호하다','다정하다','착하다','바보같다','게으르다','부지런하다','독립적이다','의존적이다','이성적이다','감정적이다','기타');
									$MinuscharctersList = array('예민하다','신경질적이다','신중하다','무덤덤하다','쾌활하다','소심하다','외향적이다','내향적이다','웃기다','꼼꼼하다','덜렁댄다','의욕적이다','회의적이다','낙관적이다','비관적이다','무신경하다','단호하다','다정하다','착하다','바보같다','게으르다','부지런하다','독립적이다','의존적이다','이성적이다','감정적이다','기타');
									$categoryList = array('대인관계','애정결핍','신체화증상','조현증','공황장애','불면증','우울증','불안증','지나친상상','성격장애','트라우마','콤플렉스','자존감상실','진로고민','성정체성','성생활','중독증세','다중인격','적응장애','사회도피','무기력증','강박증','감정조절장애','자살','죽음','가짜자기','기타','부부갈등','이혼문제','육아문제','직장갈등','가족갈등','연애문제','부모갈등','자녀갈등');
									$MinuscategoryList = array('대인관계','애정결핍','신체화증상','조현증','공황장애','불면증','우울증','불안증','지나친상상','성격장애','트라우마','콤플렉스','자존감상실','진로고민','성정체성','성생활','중독증세','다중인격','적응장애','사회도피','무기력증','강박증','감정조절장애','자살','죽음','가짜자기','기타','부부갈등','이혼문제','육아문제','직장갈등','가족갈등','연애문제','부모갈등','자녀갈등');

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

										if ($getInfoOfPartner['work_mode'] == '') {
											$getInfoOfPartner['work_mode'] = '';
										}

										echo "<tr>
											<td>" . $getInfoOfPartner['no'] . "</td>
											<td>
												<a style='font-weight:bold;' href='/pages/supportInfo/partnerInfo/profile/?no=" . $getInfoOfPartner['no'] . "'>" . $getInfoOfPartner['name'] . "(" . $getInfoOfPartner['id'] . ")</a><br/>
												<button onclick='location.href=\"/pages/supportInfo/partnerInfo/addNew/?type=mod&id=" . $getInfoOfPartner['id'] . "\"' class=\"btn btn-primary btn-xs\" style='vertical-align:middle;margin-top:6px;'>수정</button>
											</td>
											<td>" . $getInfoOfPartner['sex'] . "</td>
											<td>" . $getInfoOfPartner['age'] . "</td>
											<td>" . $getInfoOfPartner['religion'] . "</td>
											<td> </td>
											<td>" . $getInfoOfPartner['phone'] . "</td>
											<td> </td>
											<td>" . $getInfoOfPartner['email'] . "</td>
											<td>" . $status . "</td>
											<td>
												<input type='text' class='form-control' id='newCounselingMode_" . $getInfoOfPartner['id'] . "' value='" . $getInfoOfPartner['work_mode'] . "' style='padding: 5px 3px;width: 70%;font-size: 1.4rem;'>
												<button onclick='changeCounselingMode(\"" . $getInfoOfPartner['id'] . "\")' class=\"btn btn-primary btn-sm\" style='vertical-align:middle;margin-left:3px;'>적용</button>
											</td>
										</tr>";

										// 직장 체크
										$jobs = explode(',', $getInfoOfPartner['matchJob']);

										foreach ($jobs as $keys => $values) {
											foreach ($jobList as $key => $value) {
												if ($values == $value) {
													$jobRank[$values] += 1;
													unset($MinusjobList[$key]);
												}
											}
										}

										$targets = explode(',', $getInfoOfPartner['matchTarget']);

										foreach ($targets as $keys => $values) {
											foreach ($targetList as $key => $value) {
												if ($values == $value) {
													$targetRank[$values] += 1;
													unset($MinustargetList[$key]);
												}
											}
										}

										$feels = explode(',', $getInfoOfPartner['matchFeel']);

										foreach ($feels as $keys => $values) {
											foreach ($feelsList as $key => $value) {
												if ($values == $value) {
													$feelsRank[$values] += 1;
													unset($MinusfeelsList[$key]);
												}
											}
										}

										$characters = explode(',', $getInfoOfPartner['matchCharacters']);

										foreach ($characters as $keys => $values) {
											foreach ($charctersList as $key => $value) {
												if ($values == $value) {
													$charctersRank[$values] += 1;
													unset($MinuscharctersList[$key]);
												}
											}
										}

										$categorys = explode(',', $getInfoOfPartner['matchCategorys']);

										foreach ($categorys as $keys => $values) {
											foreach ($categoryList as $key => $value) {
												if ($values == $value) {
													$categoryRank[$values] += 1;
													unset($MinuscategoryList[$key]);
												}
											}
										}

									}

									arsort($jobRank);
									arsort($targetRank);
									arsort($feelsRank);
									arsort($charctersRank);
									arsort($categoryRank);

									echo "<table class='hashtag'>
									<thead>
										<tr>
											<th colspan='5'>상담사 태그 상태</th>
										</tr>
										<tr>
											<th>직장</th>
											<th>대상</th>
											<th>감정</th>
											<th>성격</th>
											<th>고민</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan='5'>선택한 해시태그</td>
										</tr>
										<tr>
											<td>";

											foreach ($jobRank as $key => $value) {
												echo "[" . $value . "명] " . $key . "<br/>";
											}

												echo "</td><td>";

											foreach ($targetRank as $key => $value) {
												echo "[" . $value . "명] " . $key . "<br/>";
											}

												echo "</td><td>";

											foreach ($feelsRank as $key => $value) {
												echo "[" . $value . "명] " . $key . "<br/>";
											}

												echo "</td><td>";

											foreach ($charctersRank as $key => $value) {
												echo "[" . $value . "명] " . $key . "<br/>";
											}

												echo "</td><td>";

											foreach ($categoryRank as $key => $value) {
												echo "[" . $value . "명] " . $key . "<br/>";
											}

											echo "</td>
											</tr>
											<tr>
												<td colspan='5'>선택하지 않은 해시태그</td>
											</tr>
											<tr>
												<td>";

											foreach ($MinusjobList as $key => $value) {
												echo "[" . $value . "] <br/>";
											}

												echo "</td><td>";

											foreach ($MinustargetList as $key => $value) {
												echo "[" . $value . "] <br/>";
											}

												echo "</td><td>";

											foreach ($MinusfeelsList as $key => $value) {
												echo "[" . $value . "] <br/>";
											}

												echo "</td><td>";

											foreach ($MinuscharctersList as $key => $value) {
												echo "[" . $value . "] <br/>";
											}

												echo "</td><td>";

											foreach ($MinuscategoryList as $key => $value) {
												echo "[" . $value . "] <br/>";
											}

												echo "</td>
												</tr>
										</tbody>
									</table>";

								?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>


	<script src="../../../bootstrap/js/bootstrap.min.js"></script>
	<script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="../../../dist/js/app.min.js"></script>

	<script>

		'use strict';

		$(function () {
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"order": [[ 0, "desc" ]],
				"lengthMenu": [[15, 20, 50, -1], [15, 20, 50, "All"]],
				"info": true,
				"autoWidth": false
			});
		});

		function changeStatus(id, status) {
			var returnValue = confirm("정말 상담사 상태를 변경 시키겠습니까?");

			if (returnValue) {
				location.href = '?mode=change&id=' + id + '&status=' + status;
			}
		}

		function changeCounselingMode(id) {
			location.href = '?mode=updateMode&id=' + id + '&counselingmode=' + $("#newCounselingMode_" + id).val();
		}

	</script>

	</body>
</html>
