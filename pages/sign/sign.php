<?php

	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/analyticsmanage.php");

	if ($_POST['type'] === 'login') {

		if (($_POST['id'] === '') || ($_POST['pw'] === '')) {
			$actionLog = $_POST['type'] . " - NULL - NULL";
			addActionLog('try-user(login)', $actionLog);

		    echo "<script>alert(\"잘못된 접근입니다, 같은 문제가 계속 발생하는 경우 트로스트 카카오톡 '@트로스트' 로 연락 주세요. 1\");</script>";
			echo "<script>location.href='/pages/sign/';</script>";

			exit();
		}

		// 행동 로그 작성.
		$actionLog = $_POST['type'] . " - " . $_POST['id'] . " - " . $_POST['pw'];
		addActionLog('try-user(login)', $actionLog);

		$signAdmin_q = mysqli_query($conn_, "SELECT `no`, `u_pw`, `u_name`, `u_grade` FROM `trost_admin`.`Users` WHERE (`u_id` = '" . $_POST['id'] . "') ORDER BY `no` DESC LIMIT 1");
		$signAdmin = mysqli_fetch_array($signAdmin_q);

		if ($signAdmin) {

			$passwd = mysqli_real_escape_string($conn_, md5($_POST['pw']));

			if (password_verify($passwd, $signAdmin['u_pw'])) {
				$_SESSION['admin_grade'] = $signAdmin['u_grade'];
				$_SESSION['admin_name'] = $signAdmin['u_name'];
				$_SESSION['admin_id'] = $_POST['id'];

				if ($_SESSION['admin_grade'] === 'counselor') {
					echo "<script>alert(\"반갑습니다, '" . $signAdmin['u_name'] . "' 선생님. 페이지 로딩에 약간의 시간이 필요합니다.\");</script>";
					echo "<script>location.href='/pages/supportInfo/payment/Rebill/';</script>";
				} else {
					echo "<script>location.href='/';</script>";
				}
			} else {
			    echo "<script>alert(\"로그인에 실패했습니다, 다시 시도해주세요.\");</script>";
				echo "<script>location.href='/pages/sign/';</script>";
			}

			exit();

		} else {
			echo "<script>alert(\"로그인에 실패했습니다, 다시 시도해주세요.\");</script>";
			echo "<script>location.href='/pages/sign/';</script>";

			exit();
		}

	} else if ($_POST['type'] === 'sign-up-auth') {

		// 행동 로그 작성.
		$actionLog = $_POST['type'] . " - " . $_POST['sign-up-code'] . " - " . $_POST['sign-up-name'] . " - " . $_POST['sign-up-email'];
		addActionLog('try-user(sign-up-auth)', $actionLog);

		$getInfo_q = mysqli_query($conn_, "SELECT `no`, `u_id` FROM `trost_admin`.`Users` WHERE ((`u_pri_id` = '" . $_POST['sign-up-code'] . "') && (`u_name` = '" . $_POST['sign-up-name'] . "') && (`u_email` = '" . $_POST['sign-up-email'] . "')) ORDER BY `no` DESC LIMIT 1");
		$getInfo = mysqli_fetch_array($getInfo_q);

		if ($getInfo) {

			if ($getInfo['u_id']) {
				echo "<script>alert(\"이미 회원가입된 계정 입니다.\");</script>";
				echo "<script>location.href='/pages/sign/';</script>";
			} else {
				echo "<script>alert(\"인증되었습니다, 가입해주세요.\");</script>";
				echo "<script>location.href='/pages/sign/up/?process=auth&pri-id=" . $_POST['sign-up-code'] . "&name=" . $_POST['sign-up-name'] . "&email=" . $_POST['sign-up-email'] . "';</script>";
			}

			exit();
		} else {
			echo "<script>alert(\"인증에 실패하였습니다.\");</script>";
			echo "<script>location.href='/pages/sign/up/?process=before';</script>";

			exit();
		}

	} else if ($_POST['type'] === 'sign-up-make') {

		// 행동 로그 작성.
		$actionLog = $_POST['type'] . " - " . $_POST['sign-up-code'] . " - " . $_POST['sign-up-name'] . " - " . $_POST['sign-up-email'] . " - " . $_POST['sign-up-id'] . " - " . $_POST['sign-up-pw'];
		addActionLog('try-user(sign-up-make)', $actionLog);

		$getInfo_q = mysqli_query($conn_, "SELECT `no` FROM `trost_admin`.`Users` WHERE ((`u_pri_id` = '" . $_POST['sign-up-code'] . "') && (`u_name` = '" . $_POST['sign-up-name'] . "') && (`u_email` = '" . $_POST['sign-up-email'] . "')) ORDER BY `no` DESC LIMIT 1");
		$getInfo = mysqli_fetch_array($getInfo_q);

		if ($getInfo) {

			$passwd = mysqli_real_escape_string($conn_, md5($_POST['sign-up-pw']));
			$password = password_hash($passwd, PASSWORD_DEFAULT);

			$makeInfo = mysqli_query($conn_, "UPDATE `trost_admin`.`Users` SET `u_id` = '" . $_POST['sign-up-id'] . "', `u_pw` = '" . $password . "' WHERE (`no` = '" . $getInfo['no'] . "') ORDER BY `no` DESC LIMIT 1");

			if ($makeInfo) {
				echo "<script>alert(\"가입이 완료되었습니다, 로그인 해주세요.\");</script>";
				echo "<script>location.href='/pages/sign/';</script>";
			} else {
				echo "<script>alert(\"가입에 실패했습니다, 다시 시도해주세요.\");</script>";
				echo "<script>location.href='/pages/sign/up/?process=auth&pri-id=" . $_POST['sign-up-code'] . "&name=" . $_POST['sign-up-name'] . "&email=" . $_POST['sign-up-email'] . "';</script>";
			}

			exit();
		} else {
			echo "<script>alert(\"인증에 실패하였습니다.\");</script>";
			echo "<script>location.href='/pages/sign/up/?process=before';</script>";

			exit();
		}

	}

?>
