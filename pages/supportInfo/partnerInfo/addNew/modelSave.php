<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

	if ($_POST['mode'] == 'edit') {

		$getInfoOfPartner_q = mysqli_query($conn_, "SELECT * FROM `trost`.`mb_partner` WHERE (`id` = '" . $_POST['id'] . "') ORDER BY `no` DESC LIMIT 1");
		$getInfoOfPartner = mysqli_fetch_array($getInfoOfPartner_q);

		if ($getInfoOfPartner) {

			$pic_name = $getInfoOfPartner['pic'];

			$pic_file = "$_SERVER[DOCUMENT_ROOT]/assets/img/of_partner/" . $pic_name . "_.png";
			$blackpic_file = "$_SERVER[DOCUMENT_ROOT]/assets/img/of_partner/" . $pic_name . ".png";

			if ($_FILES['pic']['tmp_name']) {
				if (move_uploaded_file($_FILES['pic']['tmp_name'], $pic_file)) {
					echo "<script>alert(\"성공적으로 이미지를 업데이트 했습니다.\");</script>";
				}
			}

			if ($_FILES['pic_']['tmp_name']) {
				if (move_uploaded_file($_FILES['pic_']['tmp_name'], $blackpic_file)) {
					echo "<script>alert(\"성공적으로 이미지를 업데이트 했습니다.\");</script>";
				}
			}

			(string) $job = '';

			if ($_POST['job']) {
				foreach ($_POST['job'] as $key => $value) {
					if ($key == 0) {
						$job = $value;
					} else {
						$job = $job . ',' . $value;
					}

					if ($key == 1) {
						break;
					}
				}
			}

			(string) $target = '';

			if ($_POST['target']) {
				foreach ($_POST['target'] as $key => $value) {
					if ($key == 0) {
						$target = $value;
					} else {
						$target = $target . ',' . $value;
					}

					if ($key == 1) {
						break;
					}
				}
			}

			(string) $feel = '';

			if ($_POST['feel']) {
				foreach ($_POST['feel'] as $key => $value) {
					if ($key == 0) {
						$feel = $value;
					} else {
						$feel = $feel . ',' . $value;
					}

					if ($key == 4) {
						break;
					}
				}
			}

			(string) $characters = '';

			if ($_POST['characters']) {
				foreach ($_POST['characters'] as $key => $value) {
					if ($key == 0) {
						$characters = $value;
					} else {
						$characters = $characters . ',' . $value;
					}

					if ($key == 4) {
						break;
					}
				}
			}

			(string) $categorys = '';

			if ($_POST['categorys']) {
				foreach ($_POST['categorys'] as $key => $value) {
					if ($key == 0) {
						$categorys = $value;
					} else {
						$categorys = $categorys . ',' . $value;
					}

					if ($key == 4) {
						break;
					}
				}
			}

			$result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `name` = '" . $_POST['name'] . "', `phone` = '" . $_POST['phone'] . "', `email` = '" . $_POST['email'] . "', `sex` = '" . $_POST['sex'] . "', `introduce` = '" . $_POST['introduce'] . "', `career` = '" . $_POST['career'] . "', `work_time` = '" . $_POST['worktime'] . "', `matchCategorys` = '" . $categorys . "', `matchJob` = '" . $job . "', `matchTarget` = '" . $target . "', `matchFeel` = '" . $feel . "', `matchCharacters` = '" . $characters . "', `age` = '" . $_POST['age'] . "', `work_mode` = '" . $_POST['work_mode'] . "', `mp_work_type` = '" . $_POST['mp_work_type'] . "', `mp_payment_type` = '" . $_POST['mp_payment_type'] . "', `religion` = '" . $_POST['religion'] . "', `first_short_msg` = '" . $_POST['first_short_msg'] . "', `first_long_msg` = '" . $_POST['first_long_msg'] . "' WHERE (`id` = '" . $_POST['id'] . "') ORDER BY `no` DESC LIMIT 1");

			if ($result) {
				echo "<script>alert(\"성공적으로 업데이트 했습니다.\");</script>";
				echo "<script>location.href='/pages/supportInfo/partnerInfo/addNew/?type=mod&id=" . $_POST['id'] . "'</script>";

				exit();
			} else {
				echo "<script>alert(\"정보 업데이트에 실패했습니다, 다시 시도해주세요.\");</script>";
				echo "<script>history.go(-1)</script>";

				exit();
			}

		} else {
			echo "<script>alert(\"정보 업데이트에 실패했습니다, 다시 시도해주세요.\");</script>";
			echo "<script>history.go(-1)</script>";

			exit();
		}

	} else {

		(string) $job = '';

		if ($_POST['job']) {
			foreach ($_POST['job'] as $key => $value) {
				if ($key == 0) {
					$job = $value;
				} else {
					$job = $job . ',' . $value;
				}

				if ($key == 1) {
					break;
				}
			}
		}

		(string) $target = '';

		if ($_POST['target']) {
			foreach ($_POST['target'] as $key => $value) {
				if ($key == 0) {
					$target = $value;
				} else {
					$target = $target . ',' . $value;
				}

				if ($key == 1) {
					break;
				}
			}
		}

		(string) $feel = '';

		if ($_POST['feel']) {
			foreach ($_POST['feel'] as $key => $value) {
				if ($key == 0) {
					$feel = $value;
				} else {
					$feel = $feel . ',' . $value;
				}

				if ($key == 4) {
					break;
				}
			}
		}

		(string) $characters = '';

		if ($_POST['characters']) {
			foreach ($_POST['characters'] as $key => $value) {
				if ($key == 0) {
					$characters = $value;
				} else {
					$characters = $characters . ',' . $value;
				}

				if ($key == 4) {
					break;
				}
			}
		}

		(string) $categorys = '';

		if ($_POST['categorys']) {
			foreach ($_POST['categorys'] as $key => $value) {
				if ($key == 0) {
					$categorys = $value;
				} else {
					$categorys = $categorys . ',' . $value;
				}

				if ($key == 4) {
					break;
				}
			}
		}

		$pic_name = time();
		$pic_file = "$_SERVER[DOCUMENT_ROOT]/assets/img/of_partner/" . $pic_name . "_.png";

		if (move_uploaded_file($_FILES['pic']['tmp_name'], $pic_file)) {

			$blackpic_file = "$_SERVER[DOCUMENT_ROOT]/assets/img/of_partner/" . $pic_name . ".png";

			if (move_uploaded_file($_FILES['pic_']['tmp_name'], $blackpic_file)) {
				$passwd = md5($_POST['pw']);
				$password = password_hash($passwd, PASSWORD_DEFAULT);

				$result = mysqli_query($conn_, "INSERT INTO `trost`.`mb_partner` (name, phone, email, id, pw, sex, introduce, career, matchCategorys, matchJob, matchTarget, matchFeel, matchCharacters, pic, work_time, status, code, age, work_mode, mp_work_type, mp_payment_type, religion, first_short_msg, first_long_msg) VALUES ('$_POST[name]', '$_POST[phone]', '$_POST[email]', '$_POST[id]', '$password', '$_POST[sex]', '$_POST[introduce]', '$_POST[career]', '$categorys', '$job', '$target', '$feel', '$characters', '$pic_name', '$_POST[worktime]', 'N', '$pic_name', '$_POST[age]', '$_POST[work_mode]', '$_POST[mp_work_type]', '$_POST[mp_payment_type]', '$_POST[religion]', '$_POST[first_short_msg]', '$_POST[first_long_msg]')");
			}

		} else {
			echo "<script>alert(\"프로필 이미지에 문제가 생겨 업로드에 실패했습니다, 다시 시도해주세요.\");</script>";
			echo "<script>history.go(-1)</script>";

			exit();
		}

		if ($result) {
			echo "<script>alert(\"성공적으로 업로드 되었습니다.\");</script>";
			echo "<script>location.href='/pages/supportInfo/partnerInfo/addNew/'</script>";

			exit();
		} else {
			echo "<script>alert(\"업로드에 실패했습니다, 다시 시도해주세요.\");</script>";
			echo "<script>history.go(-1)</script>";

			exit();
		}

	}

?>
