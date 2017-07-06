<!DOCTYPE html>
<html>
	<head>
		<title>트로스트 - 심리상담 메신저</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="robots" content="NONE, NOINDEX, NOFOLLOW, NOIMAGEINDEX"/>
		<meta name="reply-to" content="trost@hu-mart.com"/>
		<meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="manifest" href="/assets/file/manifest_webapp.json">
		<link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
		<style>
			.login-page, .register-page { background: #FEA45C; }
		</style>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<b style='color:#FFF;'>TROST</b>
			</div>
			<div class="login-box-body">
				<p class="login-box-msg" style='color:#301D09;'>Only for HumartCompany</p>

				<form id='sign' action="../sign.php" method="post">

					<?php

						if ($_GET['process'] === 'before') {
							?>

								<div class="form-group has-feedback">
									<input type="text" name='sign-up-name' class="form-control" placeholder="이름">
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="text" name='sign-up-code' class="form-control" placeholder="생년월일 (000000)">
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="email" name='sign-up-email' class="form-control" placeholder="이메일 (xx@xx.com)">
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="row" style='text-align:center;'>
									<button id='sign-up' class="btn btn-success btn-block btn-flat" style='margin:15px auto;width:92%;'>인증</button>
								</div>

								<input type='hidden' name='type' value='sign-up-auth'/>

							<?php
						} else if ($_GET['process'] === 'auth') {
							?>

								<div class="form-group has-feedback">
									<input type="text" name='sign-up-id' class="form-control" placeholder="아이디">
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name='sign-up-pw' class="form-control" placeholder="패스워드">
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="row" style='text-align:center;'>
									<button id='sign-up' class="btn btn-success btn-block btn-flat" style='margin:15px auto;width:92%;'>가입</button>
								</div>

								<input type='hidden' name='type' value='sign-up-make'/>
								<input type='hidden' name='sign-up-name' value='<?php echo $_GET['name']; ?>'/>
								<input type='hidden' name='sign-up-code' value='<?php echo $_GET['pri-id']; ?>'/>
								<input type='hidden' name='sign-up-email' value='<?php echo $_GET['email']; ?>'/>

							<?php
						} else {
						    echo "<script>alert(\"잘못된 접근입니다, 같은 문제가 계속 발생하는 경우 트로스트 카카오톡 '@트로스트' 로 연락 주세요.\");</script>";
							echo "<script>location.href='/pages/sign/';</script>";

							exit();
						}

					?>
				</form>
			</div>
		</div>
	</body>
</html>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/analyticsmanage.php"); ?>
