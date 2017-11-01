<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/assets/file/cont_db.php");

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
<!--suppress ALL -->
<html>
	<head>
		<title>트로스트 - 온라인 심리상담 서비스</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="robots" content="NONE"/>
		<meta name="reply-to" content="trost@hu-mart.com"/>
		<meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <!-- Then include bootstrap js -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../../../plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="../../../../dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../../../../dist/css/skins/_all-skins.min.css">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function scoring() {
                var a = {"10":[""],"9":[""],"8":[""],"7":[""],"6":[""],"5":[""],"4":[""],"3":[""],"2":[""],"1":[""]};

                $("table#scoringtable td input[type=text]").each(function(i, v)
                {
                    var tempKeywords = $(v).attr('id');
                    var tempPoint = $(v).val();

                    if (!tempPoint) {
                        tempPoint = 1;
                    }
                    a[tempPoint].push(tempKeywords);
                }).promise().done( function(){
                    console.log(JSON.stringify(a));
                    $("textarea[name=extraCategorys]").val(JSON.stringify(a));
                });
                return false;
            }

            var jsonData = {"8":["적응장애"],"6":["사회도피"],"5":["대인관계","우울","분노","무기력","스트레스","자존감상실","진로고민"],"4":["가족문제","부부관계","육아","연인문제","애정결핍","강박증","불면증","콤플렉스","신체화증상","해외생활"],"3":["트라우마","감정조절장애","중독","성격장애","히키코모리","성소수자","성생활","공황장애","섭식장애","조현증","직장갈등"],"2":["로리타콤플렉스","가짜자기","지나친상상","자살","불안"],"1":[""]};

            $(document).ready(function() {

                $.each(jsonData, function(entryIndex, entry) {
                    $.each(entry, function(entryIndex_, entry_) {

                        $("table#scoringtable td input[type=text]").each(function(i, v)
                        {
                            if (entry_ == $(v).attr('id')) {
//                                console.log(' - ' + entry_ + ' / ' + entryIndex);
//                                console.log($(v).attr('id'));
                                $(v).val(entryIndex);
                            }
                        });
                    });
                });

            });
        </script>
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">

		<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/pages/common/navigation.php"); ?>

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
										<input type="text" name='name' class="form-control" id="inputSuccess" placeholder="이름을 입력해주세요" value='<?php echo $getInfoOfPartner['name']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 아이디</label>
										<input type="text" name='id' class="form-control" id="inputSuccess" placeholder="아이디를 입력해주세요" value='<?php echo $getInfoOfPartner['id']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 패스워드</label>
										<input type="password" name='password' class="form-control" id="inputSuccess" value = "test01">
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 연락처</label>
										<input type="text" name='phone' class="form-control" id="inputSuccess" placeholder="연락처를 입력해주세요" value='<?php echo $getInfoOfPartner['phone']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 이메일</label>
										<input type="text" name='email' class="form-control" id="inputSuccess" placeholder="이메일을 입력해주세요"  value='<?php echo $getInfoOfPartner['email']; ?>'>
									</div>
									<div class="form-group has-success">
										<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 나이</label>
										<input type="text" name='age' class="form-control" id="inputSuccess" placeholder="나이를 입력해주세요"  value='<?php echo $getInfoOfPartner['age']; ?>'>
									</div>
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name='gender' value='M' <?php echo ($getInfoOfPartner['gender'] == 'M')?"checked":"" ?>>
											</span>
											<input type="text" class="form-control" value='남자' readOnly>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name='gender' value='F' <?php echo ($getInfoOfPartner['gender'] == 'F')?"checked":"" ?>>
											</span>
											<input type="text" class="form-control" value='여자' readOnly>
										</div>
									</div>
									<div class="form-group">
										<br/><br/><br/>
										<label for="exampleInputFile">프로필 이미지</label>
										<br/>
										흑백 : <input type="file" name='image_black' id="exampleInputFile" style='display:inline-block;width:60%;margin-left:15px;margin-bottom:5px;'><br/>
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
                                        <input type="text" name='head_introduce' rows="3" class="form-control" id="inputSuccess" placeholder="소개 헤드라인을 입력해주세요" value='<?php echo $getInfoOfPartner['head_introduce']; ?>'><br/>
										<textarea class="form-control" name='introduce' rows="3" placeholder="소개 내용을 입력해주세요."><?php echo $getInfoOfPartner['introduce']; ?></textarea>
									</div>
									<div class="form-group has-success">
										<label><i class="fa fa-check"></i> 경력</label>
										<textarea class="form-control" name='career' rows="3" placeholder="쉼표(,)로 구분이 되니 공백 없이 다음과 같이 적어주세요. - EX) 학력1,학력2,경력1,경력2,자격증1,자격증2"><?php echo $getInfoOfPartner['career']; ?></textarea>
									</div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 근무 형태</label><br/>
                                        <div class="col-lg-6">
                                            <div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='work_type' value='free' <?php echo ($getInfoOfPartner['work_type'] == 'free')?"checked":"" ?>>
												</span>
                                                <input type="text" class="form-control" value='프리랜서' readOnly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='work_type' value='cop' <?php echo ($getInfoOfPartner['work_type'] == 'cop')?"checked":"" ?>>
												</span>
                                                <input type="text" class="form-control" value='기업 소속' readOnly>
                                            </div>
                                        </div>
                                        <br/><br/>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 수익 분배</label><br/>
                                        <div class="col-lg-6">
                                            <div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='payment_type' value='7:3' <?php echo ($getInfoOfPartner['payment_type'] == '7:3')?"checked":"" ?>>
												</span>
                                                <input type="text" class="form-control" value='7:3' readOnly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
												<span class="input-group-addon">
													<input type="radio" name='payment_type' value='6:4' <?php echo ($getInfoOfPartner['payment_type'] == '6:4')?"checked":"" ?>>
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
                                        <br/><br/><br/><br/>
                                    </div>
                                    <div class="form-group has-success">
                                        <label><i class="fa fa-check"></i> 텍스트 단기 사전 메시지</label>
                                        <textarea class="form-control" name='first_msg_short' rows="3" placeholder="텍스트 단기 사전 메시지를 입력해주세요"><?php echo $getInfoOfPartner['first_msg_short']; ?></textarea>
                                    </div>
								</div>

								<div class="box-body" style='width:49%;display:inline-block;'>
									<!-- <strong>[해시태그 변경은 [WEB] 토픽에 선생님과 변경 사항을 올려주세요!]</strong> -->

									<div class="form-group has-success">
                                        <div class="form-group has-success">
                                            <label><i class="fa fa-check"></i> 텍스트 장기 사전 메시지</label>
                                            <textarea class="form-control" name='first_msg_long' rows="3" placeholder="텍스트 장기 사전 메시지를 입력해주세요"><?php echo $getInfoOfPartner['first_msg_long']; ?></textarea>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><i class="fa fa-check"></i> 전화 사전 메시지</label>
                                            <textarea class="form-control" name='first_msg_voice' rows="3" placeholder="전화 사전 메시지를 입력해주세요"><?php echo $getInfoOfPartner['first_msg_voice']; ?></textarea>
                                        </div>
                                        <div class="form-group has-success">
                                            <label id='work_mode'><i class="fa fa-check"></i> 상담 종류</label>
                                            <input type="text" name='work_mode' class="form-control" id="inputSuccess" placeholder="상담 종류를 입력해주세요 ex)texttime, voicetime, facetime"  value='<?php echo $getInfoOfPartner['work_mode']; ?>'>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><i class="fa fa-check"></i> 상담 스타일</label>
                                            <input type="text" name='matchStyle' class="form-control" id="inputSuccess" placeholder="상담 스타일을 입력해주세요"  value='<?php echo $getInfoOfPartner['matchStyle']; ?>'>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><i class="fa fa-check"></i> 상담 시간</label>
                                            <textarea class="form-control" name='work_time' rows="3" placeholder="상담 시간을 입력해주세요."><?php echo $getInfoOfPartner['work_time']; ?></textarea>
                                        </div>
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> 고민 키워드</label>


                                        <table id = "scoringtable" border="1" width="650" border="1" style="border: 1px solid forestgreen; height: 100px; margin-left: auto; margin-right: auto; text-align: center;">
                                            <tr>
                                                <th>키워드</th><th>점수(10~0점)</th><th>키워드</th><th>점수(10~0점)</th>
                                            </tr>
                                            <tr>
                                                <td>대인관계</td><td><input type="text" id="대인관계"/></td><td>트라우마</td><td><input type="text" id="트라우마"/></td>
                                            </tr>                             <tr>
                                                <td>자존감상실</td><td><input type="text" id="자존감상실"/></td><td>감정조절장애</td><td><input type="text" id="감정조절장애"/></td>
                                            </tr>                             <tr>
                                                <td>분노</td><td><input type="text" id="분노"/></td><td>진로고민</td><td><input type="text" id="진로고민"/></td>
                                            </tr>                             <tr>
                                                <td>우울</td><td><input type="text" id="우울"/></td><td>사회도피</td><td><input type="text" id="사회도피"/></td>
                                            </tr>                             <tr>
                                                <td>불안</td><td><input type="text" id="불안"/></td><td>중독</td><td><input type="text" id="중독"/></td>
                                            </tr>                             <tr>
                                                <td>가족문제</td><td><input type="text" id="가족문제"/></td><td>신체화증상</td><td><input type="text" id="신체화증상"/></td>
                                            </tr>                             <tr>
                                                <td>부부관계</td><td><input type="text" id="부부관계"/></td><td>해외생활</td><td><input type="text" id="해외생활"/></td>
                                            </tr>                             <tr>
                                                <td>육아</td><td><input type="text" id="육아"/></td><td>성격장애</td><td><input type="text" id="성격장애"/></td>
                                            </tr>                             <tr>
                                                <td>스트레스</td><td><input type="text" id="스트레스"/></td><td>적응장애</td><td><input type="text" id="적응장애"/></td>
                                            </tr>                             <tr>
                                                <td>직장갈등</td><td><input type="text" id="직장갈등"/></td><td>성생활</td><td><input type="text" id="성생활"/></td>
                                            </tr>                             <tr>
                                                <td>연인문제 </td><td><input type="text" id="연인문제"/></td><td>성소수자</td><td><input type="text" id="성소수자"/></td>
                                            </tr>                             <tr>
                                                <td>애정결핍</td><td><input type="text" id="애정결핍"/></td><td>공황장애</td><td><input type="text" id="공황장애"/></td>
                                            </tr>                             <tr>
                                                <td>무기력</td><td><input type="text" id="무기력"/></td><td>섭식장애</td><td><input type="text" id="섭식장애"/></td>
                                            </tr>                             <tr>
                                                <td>강박증</td><td><input type="text" id="강박증"/></td><td>로리타콤플렉스</td><td><input type="text" id="로리타콤플렉스"/></td>
                                            </tr>                             <tr>
                                                <td>불면증</td><td><input type="text" id="불면증"/></td><td>히키코모리</td><td><input type="text" id="히키코모리"/></td>
                                            </tr>                             <tr>
                                                <td>자살</td><td><input type="text" id="자살"/></td><td>조현증</td><td><input type="text" id="조현증"/></td>
                                            </tr>                             <tr>
                                                <td>콤플렉스</td><td><input type="text" id="콤플렉스"/></td><td></td><td></td>
                                            </tr>                             <tr>
                                                <td>가짜자기</td><td><input type="text" id="가짜자기"/></td><td></td><td></td>
                                            </tr>                             <tr>
                                                <td>지나친 상상</td><td><input type="text" id="지나친 상상<"/></td><td></td><td></td>
                                            </tr>
                                        </table> *점수를 입력하지 않는 경우 자동 1점 처리 됩니다.
                                        <button id = "score_btn" class="btn btn-primary pull-right" onclick = "scoring();return false;" >Submit</button>
                                        <textarea class="form-control" name='extraCategorys' rows="3" ><?php echo $getInfoOfPartner['extraCategorys']; ?></textarea>

                                    </div><br/>
								<button class="btn btn-block btn-success btn-lg">저장하기</button>
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


<!--		<script src="../../../../bootstrap/js/bootstrap.min.js"></script>-->
		<!-- <script src="../../../../plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../../../../plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<!--		<script src="../../../../dist/js/app.min.js"></script>-->
	</body>
</html>
