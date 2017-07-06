<?php

//	if ((($_SESSION['admin_grade'] === 'admin') || ($_SESSION['admin_grade'] === 'staff')) && ($_SESSION['admin_id'])) {

?>

	<header class="main-header">
		<a href="/" class="logo">
			<span class="logo-mini"><b>T</b></span>
			<span class="logo-lg"><b>TROST</b></span>
		</a>
		<nav class="navbar navbar-static-top" role="navigation"></nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<li id='infoTable_9' class="treeview">
					<a href="#">
						<i class="fa fa-table"></i><span>상담사 관리</span>
					</a>
					<ul class="treeview-menu">
                        <li id='infoTable_9_2'><a href="/pages/supportInfo/partnerInfo/">상담사 현황</a></li>
						<li id='infoTable_9_3'><a href="/pages/supportInfo/partnerInfo/addNew/">상담사 추가</a></li>
					</ul>
				</li>
			</ul>
		</section>
	</aside>

<?php

//	} else {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}

//	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/analyticsmanage.php");

?>
