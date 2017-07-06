<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

	if ($_GET['type'] == 'mod') {
		$getInfoOfPartner_q = mysqli_query($conn_, "SELECT * FROM `trost`.`mb_partner` WHERE (`id` = '" . $_GET['id'] . "') ORDER BY `no` DESC LIMIT 1");
		$getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q);
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
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/pages/common/navigation.php"); ?>

		<script>
			document.getElementById("infoTable_9").className = "treeview active";
			document.getElementById("infoTable_9_3").className = "active";

			function is_ie() {
				if (navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
				if (navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
				if (navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
				return false;
			}
		</script>

			<div class="content-wrapper">
				<section class="content">
					<div class="col-xs-13">
						<div class="box box-warning" style='border-top: 1px solid #C9C9C9;'>
							<div class="box-header with-border">
								<h3 class="box-title">트로스트 상담사 추가</h3>
								<a href='https://docs.google.com/spreadsheets/d/19qyD0JudqoS-F1ef6AKC7QdkE2FapD3e-v6OVieKR0c/' target='_blank' style='margin:0px 0px 0px 7px;font-weight:bold;'> [상담사 DB 참고]</a>
							</div>
							<form role="form" action='modelSave.php' method='post' enctype='multipart/form-data'>
								<div class="box-body" style='width:49%;display:inline-block;'>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 이름</label>
										<input type="text" name='name' class="form-control" id="inputSuccess" placeholder="김태욱" value='<?php echo $getInfoOfPartner['name']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 아이디</label>
										<input type="text" name='id' class="form-control" id="inputSuccess" placeholder="xodnr631" value='<?php echo $getInfoOfPartner['id']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 패스워드</label>
										<input type="text" name='pw' class="form-control" id="inputSuccess" value="test01">
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 연락처</label>
										<input type="text" name='phone' class="form-control" id="inputSuccess" placeholder="01032309051" value='<?php echo $getInfoOfPartner['phone']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 이메일</label>
										<input type="text" name='email' class="form-control" id="inputSuccess" placeholder="develop@humart.com"  value='<?php echo $getInfoOfPartner['email']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 나이</label>
										<input type="text" name='age' class="form-control" id="inputSuccess" placeholder="40"  value='<?php echo $getInfoOfPartner['age']; ?>'>
									</div>
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name='sex' value='M' <?php echo ($getInfoOfPartner['sex'] == 'M')?"checked":"" ?>>
											</span>
											<input type="text" class="form-control" value='남자' readOnly>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name='sex' value='F' <?php echo ($getInfoOfPartner['sex'] == 'F')?"checked":"" ?>>
											</span>
											<input type="text" class="form-control" value='여자' readOnly>
										</div>
									</div>
									<div class="form-group">
										<br/><br/><br/>
										<label for="exampleInputFile">프로필 이미지</label>
										<br/>
										컬러 : <input type="file" name='pic' id="exampleInputFile" style='display:inline-block;width:60%;margin-left:15px;margin-bottom:5px;'><br/>
										흑백 : <input type="file" name='pic_' id="exampleInputFile" style='display:inline-block;width:60%;margin-left:15px;margin-bottom:5px;'><br/>
										<br/>
									</div>
									<!-- <div class="form-group has-success">
										<label><i class="fa fa-check"></i> 근무 가능 시간</label>
										<textarea class="form-control" name='worktime' rows="3" placeholder="월요일 - 1 / 화요일 - 2 / 수요일 - 3 / 목요일 - 4 / 금요일 - 5 / 토요일 - 6 / 일요일 - 7
'날짜-시작시간/종료시간/날짜-시작시간/종료시간/날짜-시작시간/종료시간'
EX) '2-22:00-24:00/3-22:00-24:00/4-22:00-24:00/5-22:00-24:00'"><?php echo $getInfoOfPartner['work_time']; ?></textarea>
									</div> -->
									<div class="form-group has-success">
										<label><i class="fa fa-check"></i> 자기소개</label>
										<textarea class="form-control" name='introduce' rows="3" placeholder="반갑습니다, 김태욱 입니다."><?php echo $getInfoOfPartner['introduce']; ?></textarea>
									</div>
									<div class="form-group has-success">
										<label><i class="fa fa-check"></i> 학력 및 경력</label>
										<textarea class="form-control" name='career' rows="3" placeholder="쉼표(,)로 구분이 되니 공백 없이 다음과 같이 적어주세요. - EX) 학력1,학력2,경력1,경력2,자격증1,자격증2"><?php echo $getInfoOfPartner['career']; ?></textarea>
									</div>
									<div class="form-group has-success">
										<label id='work_mode'><i class="fa fa-check"></i> 진행 상담 종류</label>
										<input type="text" name='work_mode' class="form-control" id="inputSuccess" placeholder="texttime,voicetime,facetime"  value='<?php echo $getInfoOfPartner['work_mode']; ?>'>
									</div>

									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 근무 형태</label><br/>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='mp_work_type' value='free' <?php echo ($getInfoOfPartner['mp_work_type'] == 'free')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='프리랜서' readOnly>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='mp_work_type' value='cop' <?php echo ($getInfoOfPartner['mp_work_type'] == 'cop')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='기업 소속' readOnly>
											</div>
										</div>
										<br/><br/>
									</div>

									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 수익 배분 형태</label><br/>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='mp_payment_type' value='7:3' <?php echo ($getInfoOfPartner['mp_payment_type'] == '7:3')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='7:3' readOnly>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='mp_payment_type' value='6:4' <?php echo ($getInfoOfPartner['mp_payment_type'] == '6:4')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='6:4' readOnly>
											</div>
										</div>
										<br/><br/>
									</div>

									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 종교</label><br/>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='religion' value='none' <?php echo ($getInfoOfPartner['religion'] == 'none')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='none' readOnly>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='religion' value='christianity' <?php echo ($getInfoOfPartner['religion'] == 'christianity')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='christianity' readOnly>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='religion' value='buddhism' <?php echo ($getInfoOfPartner['religion'] == 'buddhism')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='buddhism' readOnly>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='religion' value='catholica' <?php echo ($getInfoOfPartner['religion'] == 'catholica')?"checked":"" ?>>
												</span>
												<input type="text" class="form-control" value='catholica' readOnly>
											</div>
										</div>
										<br/><br/>
									</div>
								</div>

								<div class="box-body" style='width:49%;display:inline-block;'>
									<!-- <strong>[해시태그 변경은 [WEB] 토픽에 선생님과 변경 사항을 올려주세요!]</strong> -->
									<div class="form-group has-success">
										<div class="form-group has-success">
											<label><i class="fa fa-check"></i> 단기 사전메시지</label>
											<textarea class="form-control" name='first_short_msg' rows="3" placeholder="반갑습니다, 김태욱 입니다."><?php echo $getInfoOfPartner['first_short_msg']; ?></textarea>
										</div>
										<div class="form-group has-success">
											<label><i class="fa fa-check"></i> 장기 사전메시지</label>
											<textarea class="form-control" name='first_long_msg' rows="3" placeholder="반갑습니다, 김태욱 입니다."><?php echo $getInfoOfPartner['first_long_msg']; ?></textarea>
										</div>

										<h3 style='margin-bottom:-8px;font-weight: normal;'> 어떤 일을 하고있나요? (최대 2개)</h3>
										<br/>

										<!-- // matchCategorys
										// matchJob
										// matchTarget
										// matchFeel
										// matchCharacters -->

										<input type='checkbox' id='c102' class='c6' name='job[]' value='학생' <?php if (strpos($getInfoOfPartner['matchJob'], '학생') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c102' style='cursor:pointer !important;'>학생</label>
										<input type='checkbox' id='c103' class='c6' name='job[]' value='유학생' <?php if (strpos($getInfoOfPartner['matchJob'], '유학생') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c103' style='cursor:pointer !important;'>유학생</label>
										<input type='checkbox' id='c104' class='c6' name='job[]' value='가정주부' <?php if (strpos($getInfoOfPartner['matchJob'], '가정주부') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c104' style='cursor:pointer !important;'>가정주부</label>
										<input type='checkbox' id='c105' class='c6' name='job[]' value='취업준비' <?php if (strpos($getInfoOfPartner['matchJob'], '취업준비') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c105' style='cursor:pointer !important;'>취업준비</label>
										<br/>
										<input type='checkbox' id='c106' class='c6' name='job[]' value='무직' <?php if (strpos($getInfoOfPartner['matchJob'], '무직') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c106' style='cursor:pointer !important;'>무직</label>
										<input type='checkbox' id='c107' class='c6' name='job[]' value='직장인' <?php if (strpos($getInfoOfPartner['matchJob'], '직장인') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c107' style='cursor:pointer !important;'>직장인</label>
										<input type='checkbox' id='c108' class='c6' name='job[]' value='기타' <?php if (strpos($getInfoOfPartner['matchJob'], '기타') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c108' style='cursor:pointer !important;'>기타</label>

										<h3 style='margin-bottom:-8px;font-weight: normal;'> 고민의 대상은 누구인가요? (최대 2개)</h3>
										<br/>
										<input type='checkbox' id='c9' class='c2' name='target[]' value='나' <?php if (strpos($getInfoOfPartner['matchTarget'], '나') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c9' style='cursor:pointer !important;'>나</label>
										<input type='checkbox' id='c10' class='c2' name='target[]' value='가족' <?php if (strpos($getInfoOfPartner['matchTarget'], '가족') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c10' style='cursor:pointer !important;'>가족</label>
										<input type='checkbox' id='c11' class='c2' name='target[]' value='연인' <?php if (strpos($getInfoOfPartner['matchTarget'], '연인') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c11' style='cursor:pointer !important;'>연인</label>
										<input type='checkbox' id='c12' class='c2' name='target[]' value='배우자' <?php if (strpos($getInfoOfPartner['matchTarget'], '배우자') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c12' style='cursor:pointer !important;'>배우자</label>
										<br/>
										<input type='checkbox' id='c13' class='c2' name='target[]' value='직장동료' <?php if (strpos($getInfoOfPartner['matchTarget'], '직장동료') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c13' style='cursor:pointer !important;'>직장동료</label>
										<input type='checkbox' id='c14' class='c2' name='target[]' value='자녀' <?php if (strpos($getInfoOfPartner['matchTarget'], '자녀') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c14' style='cursor:pointer !important;'>자녀</label>
										<input type='checkbox' id='c15' class='c2' name='target[]' value='친구' <?php if (strpos($getInfoOfPartner['matchTarget'], '친구') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c15' style='cursor:pointer !important;'>친구</label>
										<input type='checkbox' id='c109' class='c2' name='target[]' value='육아' <?php if (strpos($getInfoOfPartner['matchTarget'], '육아') !== false) echo "checked"; ?> />&nbsp;&nbsp;<label for='c109' style='cursor:pointer !important;'>육아</label>

										<h3 style='margin-bottom:-8px;font-weight: normal;'> 어떤 감정을 느끼고 계신가요? (최대 5개)</h3>
										<br/>
										<input type='checkbox' id='c16' class='c3' name='feel[]' value='무기력' <?php if (strpos($getInfoOfPartner['matchFeel'], '무기력') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c16' style='cursor:pointer !important;'>무기력</label>
										<input type='checkbox' id='c17' class='c3' name='feel[]' value='우울' <?php if (strpos($getInfoOfPartner['matchFeel'], '우울') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c17' style='cursor:pointer !important;'>우울</label>
										<input type='checkbox' id='c18' class='c3' name='feel[]' value='불안' <?php if (strpos($getInfoOfPartner['matchFeel'], '불안') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c18' style='cursor:pointer !important;'>불안</label>
										<input type='checkbox' id='c19' class='c3' name='feel[]' value='분노' <?php if (strpos($getInfoOfPartner['matchFeel'], '분노') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c19' style='cursor:pointer !important;'>분노</label>
										<input type='checkbox' id='c20' class='c3' name='feel[]' value='짜증' <?php if (strpos($getInfoOfPartner['matchFeel'], '짜증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c20' style='cursor:pointer !important;'>짜증</label>
										<input type='checkbox' id='c21' class='c3' name='feel[]' value='답답' <?php if (strpos($getInfoOfPartner['matchFeel'], '답답') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c21' style='cursor:pointer !important;'>답답</label>
										<br/>
										<input type='checkbox' id='c22' class='c3' name='feel[]' value='막막' <?php if (strpos($getInfoOfPartner['matchFeel'], '막막') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c22' style='cursor:pointer !important;'>막막</label>
										<input type='checkbox' id='c23' class='c3' name='feel[]' value='두려움' <?php if (strpos($getInfoOfPartner['matchFeel'], '두려움') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c23' style='cursor:pointer !important;'>두려움</label>
										<input type='checkbox' id='c24' class='c3' name='feel[]' value='실망' <?php if (strpos($getInfoOfPartner['matchFeel'], '실망') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c24' style='cursor:pointer !important;'>실망</label>
										<input type='checkbox' id='c25' class='c3' name='feel[]' value='불쌍' <?php if (strpos($getInfoOfPartner['matchFeel'], '불쌍') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c25' style='cursor:pointer !important;'>불쌍</label>
										<input type='checkbox' id='c26' class='c3' name='feel[]' value='불행' <?php if (strpos($getInfoOfPartner['matchFeel'], '불행') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c26' style='cursor:pointer !important;'>불행</label>
										<br/>
										<input type='checkbox' id='c27' class='c3' name='feel[]' value='슬픔' <?php if (strpos($getInfoOfPartner['matchFeel'], '슬픔') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c27' style='cursor:pointer !important;'>슬픔</label>
										<input type='checkbox' id='c28' class='c3' name='feel[]' value='불만족' <?php if (strpos($getInfoOfPartner['matchFeel'], '불만족') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c28' style='cursor:pointer !important;'>불만족</label>
										<input type='checkbox' id='c29' class='c3' name='feel[]' value='혼란' <?php if (strpos($getInfoOfPartner['matchFeel'], '혼란') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c29' style='cursor:pointer !important;'>혼란</label>
										<input type='checkbox' id='c30' class='c3' name='feel[]' value='쓸쓸' <?php if (strpos($getInfoOfPartner['matchFeel'], '쓸쓸') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c30' style='cursor:pointer !important;'>쓸쓸</label>
										<input type='checkbox' id='c31' class='c3' name='feel[]' value='민감' <?php if (strpos($getInfoOfPartner['matchFeel'], '민감') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c31' style='cursor:pointer !important;'>민감</label>
										<input type='checkbox' id='c32' class='c3' name='feel[]' value='황당' <?php if (strpos($getInfoOfPartner['matchFeel'], '황당') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c32' style='cursor:pointer !important;'>황당</label>
										<br/>
										<input type='checkbox' id='c33' class='c3' name='feel[]' value='무감정' <?php if (strpos($getInfoOfPartner['matchFeel'], '무감정') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c33' style='cursor:pointer !important;'>무감정</label>
										<input type='checkbox' id='c34' class='c3' name='feel[]' value='평온' <?php if (strpos($getInfoOfPartner['matchFeel'], '평온') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c34' style='cursor:pointer !important;'>평온</label>
										<input type='checkbox' id='c35' class='c3' name='feel[]' value='복잡' <?php if (strpos($getInfoOfPartner['matchFeel'], '복잡') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c35' style='cursor:pointer !important;'>복잡</label>
										<input type='checkbox' id='c36' class='c3' name='feel[]' value='호기심' <?php if (strpos($getInfoOfPartner['matchFeel'], '호기심') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c36' style='cursor:pointer !important;'>호기심</label>
										<input type='checkbox' id='c37' class='c3' name='feel[]' value='서운' <?php if (strpos($getInfoOfPartner['matchFeel'], '서운') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c37' style='cursor:pointer !important;'>서운</label>
										<br/>
										<input type='checkbox' id='c38' class='c3' name='feel[]' value='안타까움' <?php if (strpos($getInfoOfPartner['matchFeel'], '안타까움') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c38' style='cursor:pointer !important;'>안타까움</label>
										<input type='checkbox' id='c39' class='c3' name='feel[]' value='공허' <?php if (strpos($getInfoOfPartner['matchFeel'], '공허') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c39' style='cursor:pointer !important;'>공허</label>
										<input type='checkbox' id='c40' class='c3' name='feel[]' value='억울함' <?php if (strpos($getInfoOfPartner['matchFeel'], '억울함') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c40' style='cursor:pointer !important;'>억울함</label>
										<input type='checkbox' id='c41' class='c3' name='feel[]' value='당황' <?php if (strpos($getInfoOfPartner['matchFeel'], '당황') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c41' style='cursor:pointer !important;'>당황</label>
										<input type='checkbox' id='c42' class='c3' name='feel[]' value='씁쓸' <?php if (strpos($getInfoOfPartner['matchFeel'], '씁쓸') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c42' style='cursor:pointer !important;'>씁쓸</label>
										<input type='checkbox' id='c43' class='c3' name='feel[]' value='외로움' <?php if (strpos($getInfoOfPartner['matchFeel'], '외로움') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c43' style='cursor:pointer !important;'>외로움</label>
										<br/>
										<input type='checkbox' id='c44' class='c3' name='feel[]' value='울고싶음' <?php if (strpos($getInfoOfPartner['matchFeel'], '울고싶음') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c44' style='cursor:pointer !important;'>울고싶음</label>
										<input type='checkbox' id='c45' class='c3' name='feel[]' value='갈등' <?php if (strpos($getInfoOfPartner['matchFeel'], '갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c45' style='cursor:pointer !important;'>갈등</label>
										<input type='checkbox' id='c46' class='c3' name='feel[]' value='열등감' <?php if (strpos($getInfoOfPartner['matchFeel'], '열등감') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c46' style='cursor:pointer !important;'>열등감</label>
										<input type='checkbox' id='c47' class='c3' name='feel[]' value='기타' <?php if (strpos($getInfoOfPartner['matchFeel'], '기타') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c47' style='cursor:pointer !important;'>기타</label>

										<h3 style='margin-bottom:-8px;font-weight: normal;'> 당신의 성격은 어떠신가요? (최대 5개)</h3>
										<br/>
										<input type='checkbox' id='c48' class='c4' name='characters[]' value='예민하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '예민하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c48' style='cursor:pointer !important;'>예민하다</label>
										<input type='checkbox' id='c49' class='c4' name='characters[]' value='신경질적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '신경질적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c49' style='cursor:pointer !important;'>신경질적이다</label>
										<input type='checkbox' id='c50' class='c4' name='characters[]' value='신중하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '신중하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c50' style='cursor:pointer !important;'>신중하다</label>
										<input type='checkbox' id='c51' class='c4' name='characters[]' value='무덤덤하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '무덤덤하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c51' style='cursor:pointer !important;'>무덤덤하다</label>
										<input type='checkbox' id='c52' class='c4' name='characters[]' value='쾌활하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '쾌활하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c52' style='cursor:pointer !important;'>쾌활하다</label>
										<input type='checkbox' id='c53' class='c4' name='characters[]' value='소심하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '소심하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c53' style='cursor:pointer !important;'>소심하다</label>
										<br/>
										<input type='checkbox' id='c54' class='c4' name='characters[]' value='외향적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '외향적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c54' style='cursor:pointer !important;'>외향적이다</label>
										<input type='checkbox' id='c55' class='c4' name='characters[]' value='내향적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '내향적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c55' style='cursor:pointer !important;'>내향적이다</label>
										<input type='checkbox' id='c56' class='c4' name='characters[]' value='웃기다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '웃기다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c56' style='cursor:pointer !important;'>웃기다</label>
										<input type='checkbox' id='c57' class='c4' name='characters[]' value='꼼꼼하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '꼼꼼하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c57' style='cursor:pointer !important;'>꼼꼼하다</label>
										<input type='checkbox' id='c58' class='c4' name='characters[]' value='덜렁댄다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '덜렁댄다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c58' style='cursor:pointer !important;'>덜렁댄다</label>
										<br/>
										<input type='checkbox' id='c59' class='c4' name='characters[]' value='의욕적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '의욕적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c59' style='cursor:pointer !important;'>의욕적이다</label>
										<input type='checkbox' id='c60' class='c4' name='characters[]' value='회의적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '회의적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c60' style='cursor:pointer !important;'>회의적이다</label>
										<input type='checkbox' id='c61' class='c4' name='characters[]' value='낙관적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '낙관적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c61' style='cursor:pointer !important;'>낙관적이다</label>
										<input type='checkbox' id='c62' class='c4' name='characters[]' value='비관적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '비관적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c62' style='cursor:pointer !important;'>비관적이다</label>
										<input type='checkbox' id='c63' class='c4' name='characters[]' value='무신경하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '무신경하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c63' style='cursor:pointer !important;'>무신경하다</label>
										<input type='checkbox' id='c64' class='c4' name='characters[]' value='단호하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '단호하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c64' style='cursor:pointer !important;'>단호하다</label>
										<br/>
										<input type='checkbox' id='c65' class='c4' name='characters[]' value='다정하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '다정하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c65' style='cursor:pointer !important;'>다정하다</label>
										<input type='checkbox' id='c66' class='c4' name='characters[]' value='착하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '착하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c66' style='cursor:pointer !important;'>착하다</label>
										<input type='checkbox' id='c67' class='c4' name='characters[]' value='바보같다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '바보같다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c67' style='cursor:pointer !important;'>바보같다</label>
										<input type='checkbox' id='c68' class='c4' name='characters[]' value='게으르다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '게으르다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c68' style='cursor:pointer !important;'>게으르다</label>
										<input type='checkbox' id='c69' class='c4' name='characters[]' value='부지런하다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '부지런하다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c69' style='cursor:pointer !important;'>부지런하다</label>
										<br/>
										<input type='checkbox' id='c70' class='c4' name='characters[]' value='독립적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '독립적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c70' style='cursor:pointer !important;'>독립적이다</label>
										<input type='checkbox' id='c71' class='c4' name='characters[]' value='의존적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '의존적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c71' style='cursor:pointer !important;'>의존적이다</label>
										<input type='checkbox' id='c72' class='c4' name='characters[]' value='이성적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '이성적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c72' style='cursor:pointer !important;'>이성적이다</label>
										<input type='checkbox' id='c73' class='c4' name='characters[]' value='감정적이다' <?php if (strpos($getInfoOfPartner['matchCharacters'], '감정적이다') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c73' style='cursor:pointer !important;'>감정적이다</label>
										<input type='checkbox' id='c74' class='c4' name='characters[]' value='기타' <?php if (strpos($getInfoOfPartner['matchCharacters'], '기타') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c74' style='cursor:pointer !important;'>기타</label>

										<h3 style='margin-bottom:-8px;font-weight: normal;'> 특별한 고민이 있으신가요? (최대 5개)</h3>
										<br/>
										<input type='checkbox' id='c75' class='c5' name='categorys[]' value='대인관계' <?php if (strpos($getInfoOfPartner['matchCategorys'], '대인관계') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c75' style='cursor:pointer !important;'>대인관계</label>
										<input type='checkbox' id='c76' class='c5' name='categorys[]' value='애정결핍' <?php if (strpos($getInfoOfPartner['matchCategorys'], '애정결핍') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c76' style='cursor:pointer !important;'>애정결핍</label>
										<input type='checkbox' id='c77' class='c5' name='categorys[]' value='신체화증상' <?php if (strpos($getInfoOfPartner['matchCategorys'], '신체화증상') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c77' style='cursor:pointer !important;'>신체화증상</label>
										<input type='checkbox' id='c78' class='c5' name='categorys[]' value='조현증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '조현증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c78' style='cursor:pointer !important;'>조현증</label>
										<input type='checkbox' id='c79' class='c5' name='categorys[]' value='공황장애' <?php if (strpos($getInfoOfPartner['matchCategorys'], '공황장애') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c79' style='cursor:pointer !important;'>공황장애</label>
										<input type='checkbox' id='c80' class='c5' name='categorys[]' value='불면증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '불면증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c80' style='cursor:pointer !important;'>불면증</label>
										<br/>
										<input type='checkbox' id='c81' class='c5' name='categorys[]' value='우울증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '우울증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c81' style='cursor:pointer !important;'>우울증</label>
										<input type='checkbox' id='c82' class='c5' name='categorys[]' value='불안증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '불안증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c82' style='cursor:pointer !important;'>불안증</label>
										<input type='checkbox' id='c83' class='c5' name='categorys[]' value='지나친상상' <?php if (strpos($getInfoOfPartner['matchCategorys'], '지나친상상') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c83' style='cursor:pointer !important;'>지나친상상</label>
										<input type='checkbox' id='c84' class='c5' name='categorys[]' value='성격장애' <?php if (strpos($getInfoOfPartner['matchCategorys'], '성격장애') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c84' style='cursor:pointer !important;'>성격장애</label>
										<input type='checkbox' id='c85' class='c5' name='categorys[]' value='트라우마' <?php if (strpos($getInfoOfPartner['matchCategorys'], '트라우마') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c85' style='cursor:pointer !important;'>트라우마</label>
										<br/>
										<input type='checkbox' id='c86' class='c5' name='categorys[]' value='콤플렉스' <?php if (strpos($getInfoOfPartner['matchCategorys'], '콤플렉스') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c86' style='cursor:pointer !important;'>콤플렉스</label>
										<input type='checkbox' id='c87' class='c5' name='categorys[]' value='자존감상실' <?php if (strpos($getInfoOfPartner['matchCategorys'], '자존감상실') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c87' style='cursor:pointer !important;'>자존감상실</label>
										<input type='checkbox' id='c88' class='c5' name='categorys[]' value='진로고민' <?php if (strpos($getInfoOfPartner['matchCategorys'], '진로고민') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c88' style='cursor:pointer !important;'>진로고민</label>
										<input type='checkbox' id='c89' class='c5' name='categorys[]' value='성정체성' <?php if (strpos($getInfoOfPartner['matchCategorys'], '성정체성') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c89' style='cursor:pointer !important;'>성정체성</label>
										<input type='checkbox' id='c90' class='c5' name='categorys[]' value='성생활' <?php if (strpos($getInfoOfPartner['matchCategorys'], '성생활') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c90' style='cursor:pointer !important;'>성생활</label>
										<input type='checkbox' id='c91' class='c5' name='categorys[]' value='중독증세' <?php if (strpos($getInfoOfPartner['matchCategorys'], '중독증세') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c91' style='cursor:pointer !important;'>중독증세</label>
										<br/>
										<input type='checkbox' id='c92' class='c5' name='categorys[]' value='다중인격' <?php if (strpos($getInfoOfPartner['matchCategorys'], '다중인격') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c92' style='cursor:pointer !important;'>다중인격</label>
										<input type='checkbox' id='c93' class='c5' name='categorys[]' value='적응장애' <?php if (strpos($getInfoOfPartner['matchCategorys'], '적응장애') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c93' style='cursor:pointer !important;'>적응장애</label>
										<input type='checkbox' id='c94' class='c5' name='categorys[]' value='사회도피' <?php if (strpos($getInfoOfPartner['matchCategorys'], '사회도피') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c94' style='cursor:pointer !important;'>사회도피</label>
										<input type='checkbox' id='c95' class='c5' name='categorys[]' value='무기력증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '무기력증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c95' style='cursor:pointer !important;'>무기력증</label>
										<input type='checkbox' id='c101' class='c5' name='categorys[]' value='강박증' <?php if (strpos($getInfoOfPartner['matchCategorys'], '강박증') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c101' style='cursor:pointer !important;'>강박증</label>
										<br/>
										<input type='checkbox' id='c102' class='c5' name='categorys[]' value='감정조절장애' <?php if (strpos($getInfoOfPartner['matchCategorys'], '감정조절장애') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c102' style='cursor:pointer !important;'>감정조절장애</label>
										<input type='checkbox' id='c103' class='c5' name='categorys[]' value='자살' <?php if (strpos($getInfoOfPartner['matchCategorys'], '자살') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c103' style='cursor:pointer !important;'>자살</label>
										<input type='checkbox' id='c104' class='c5' name='categorys[]' value='죽음' <?php if (strpos($getInfoOfPartner['matchCategorys'], '죽음') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c104' style='cursor:pointer !important;'>죽음</label>
										<input type='checkbox' id='c105' class='c5' name='categorys[]' value='가짜자기' <?php if (strpos($getInfoOfPartner['matchCategorys'], '가짜자기') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c105' style='cursor:pointer !important;'>가짜자기</label>
										<input type='checkbox' id='c106' class='c5' name='categorys[]' value='기타' <?php if (strpos($getInfoOfPartner['matchCategorys'], '기타') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c106' style='cursor:pointer !important;'>기타</label>
										<br/>
										<input type='checkbox' id='c107' class='c5' name='categorys[]' value='부부갈등' <?php if (strpos($getInfoOfPartner['matchCategorys'], '부부갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c107' style='cursor:pointer !important;'>부부갈등</label>
										<input type='checkbox' id='c108' class='c5' name='categorys[]' value='이혼문제' <?php if (strpos($getInfoOfPartner['matchCategorys'], '이혼문제') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c108' style='cursor:pointer !important;'>이혼문제</label>
										<input type='checkbox' id='c109' class='c5' name='categorys[]' value='육아문제' <?php if (strpos($getInfoOfPartner['matchCategorys'], '육아문제') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c109' style='cursor:pointer !important;'>육아문제</label>
										<input type='checkbox' id='c110' class='c5' name='categorys[]' value='직장갈등' <?php if (strpos($getInfoOfPartner['matchCategorys'], '직장갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c110' style='cursor:pointer !important;'>직장갈등</label>
										<input type='checkbox' id='c111' class='c5' name='categorys[]' value='가족갈등' <?php if (strpos($getInfoOfPartner['matchCategorys'], '가족갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c111' style='cursor:pointer !important;'>가족갈등</label>
										<br/>
										<input type='checkbox' id='c112' class='c5' name='categorys[]' value='연애문제' <?php if (strpos($getInfoOfPartner['matchCategorys'], '연애문제') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c112' style='cursor:pointer !important;'>연애문제</label>
										<input type='checkbox' id='c113' class='c5' name='categorys[]' value='부모갈등' <?php if (strpos($getInfoOfPartner['matchCategorys'], '부모갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c113' style='cursor:pointer !important;'>부모갈등</label>
										<input type='checkbox' id='c114' class='c5' name='categorys[]' value='자녀갈등' <?php if (strpos($getInfoOfPartner['matchCategorys'], '자녀갈등') !== false) echo "checked"; ?> >&nbsp;&nbsp;<label for='c114' style='cursor:pointer !important;'>자녀갈등</label>
									<br/><br/>
									<br/><br/>
								</div>
								<button class="btn btn-block btn-success btn-lg">추가</button>
								<input type='hidden' name='mode' value=''/>
								<?php

									if ($_GET['type'] == 'mod') {
										echo "<input type='hidden' name='mode' value='edit'/>
										<input type='hidden' name='partnerID' value='" . $_GET['id'] . "'/>";
									}

								?>
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>


		<script src="../../../../bootstrap/js/bootstrap.min.js"></script>
		<!-- <script src="../../../../plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../../../../plugins/datatables/dataTables.bootstrap.min.js"></script> -->
		<script src="../../../../dist/js/app.min.js"></script>
	</body>
</html>
