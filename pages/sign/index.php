<?php
	// (string) $realm = 'HumartCompany';
	// (array) $users = ['admintrost' => 'trost12@3!'];
	//
	// if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
	//     header('HTTP/1.1 401 Unauthorized');
	//     header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
	//
	// 	die('잘못된 정보입니다.');
	// }
	//
	// if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) {
	// 	die('Wrong Credentials!');
	// }
	//
	// function http_digest_parse ($txt) {
	// 	$needed_parts = ['nonce' => 1,'nc' => 1,'cnonce' => 1,'qop' => 1,'username' => 1,'uri' => 1,'response' => 1];
	// 	$data = [];
	//
	// 	preg_match_all('@(\w+)=(?:([\'"])([^\2]+)]\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);
	//
	//     foreach ($matches as $m) {
	//         $data[$m[1]] = $m[3] ? $m[3] : $m[4];
	//         unset($needed_parts[$m[1]]);
	//     }
	//
	//     return $needed_parts ? false : $data;
	// }
?>
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
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
		<script src="/assets/js/jquery-latest.min.js?ver=2.2.4"></script>
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

				<form id='sign' action="sign.php" method="post">
					<div class="form-group has-feedback">
						<input type="text" name='id' class="form-control" placeholder="아이디">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name='pw' class="form-control" placeholder="패스워드">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row" style='text-align:center;'>
						<button id='sign-in' class="btn btn-primary btn-block btn-flat" style='margin:15px auto;width:92%;'>로그인</button>
						<button id='sign-up' class="btn btn-success btn-block btn-flat" style='margin:15px auto;width:92%;'>회원가입</button>
					</div>

					<input type='hidden' name='type' value='login'/>
					<input type='hidden' name='referer' value='admin'/>
				</form>
			</div>
		</div>
	</body>
</html>

<script>

	'use_strict';

	if ((location.host === 'trost.co.kr') || (location.host === 'www.trost.co.kr')) {
		if (location.protocol !== 'https:') {
			location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
		}
	}

	$("#sign-in").click(function(){
		$("form#sign").submit();
		return false;
	});

	$("#sign-up").click(function(){
		location.href = '/pages/sign/up/?process=before';
		return false;
	});

</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/analyticsmanage.php"); ?>
