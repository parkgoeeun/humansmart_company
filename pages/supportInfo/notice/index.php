<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/assets/file/cont_db.php");

//	if ((!$_SESSION['admin_grade']) || (!$_SESSION['admin_id'])) {
//		echo "<script>alert(\"관리자 계정으로 다시 로그인 부탁드립니다.\");</script>";
//		echo "<script>location.href='/pages/sign/';</script>";
//
//		exit();
//	}
if ($_GET['mode'] == 'updateMode') {
    $result = mysqli_query($conn_, "UPDATE `trost`.`mb_partner` SET `work_mode` = '" . $_GET['counselingmode'] . "' WHERE (`id` = '" . $_GET['id'] . "') ORDER BY `no` ASC LIMIT 1;");

    if ($result) {
        echo "<script>location.href='/Dummy/pages/supportInfo/partnerInfo/'</script>";
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
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="robots" content="NONE"/>
    <meta name="reply-to" content="trost@hu-mart.com"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <style>
        #example2 td {
            vertical-align: middle;
            font-size: 1.3rem;
        }

        .hashtag {
            width: 100%;
            margin-top: 40px;
        }

        .hashtag th, td {
            vertical-align: top;
            border: 1px solid #999;
        }
    </style>
    <!--    <script type="text/javascript">-->
    <!--        window.onload = function() {-->
    <!--            document.getElementById('content').onclick = function() {-->
    <!--                alert(document.getElementById('frm'));-->
    <!--                return false;-->
    <!--            };-->
    <!--        };-->
    <!--        function showtext(){-->
    <!--            var text = document.getElementById("textarea");-->
    <!--            var showarea = document.getElementById("");-->
    <!--            showarea.innerHTML=text.value;-->
    <!--        }-->
    <!--    </script>-->
    <!--    <script>-->
    <!--        function showtext(){-->
    <!--            var headlines = text(document.getElementById('headline'));-->
    <!--            var details = document.getElementById('detail');-->
    <!--            alert('너가 하려는 건 '+ headlines + details);-->
    <!--        }-->
    <!--    </script>-->
    <script>
        function check() {
            if (frm.headline.value == "") {
                alert("제목을 입력해주세요");
                frm.headline.focus();
                return false;
            }
            else if (frm.detail.value == "") {
                alert("공지 내용을 입력해주세요");
                frm.detail.focus();
                return false;
            }
            else
                $(function () {
                    var totalInfo = new Object();
                    for (var i = 1; i <= 2; i++) {
                        var alarmInfo = new Object();
                        alarmInfo.제목 = $("input#headline").val();
                        alarmInfo.내용 = $("textarea#detail").val();
                        totalInfo[i] = alarmInfo;
                    }
                    var jsonInfo = JSON.stringify(totalInfo);
                    alert(jsonInfo);
                });
        }
    </script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/pages/common/navigation.php"); ?>

    <script>
        document.getElementById("infoTable_9").className = "treeview active";
        document.getElementById("infoTable_9_4").className = "active";

        function is_ie() {
            if (navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
            if (navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
            if (navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
            return false;
        }

    </script>

</div>

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                공지사항 추가
                <small>공지사항을 입력해주세요</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 상담사 관리</a></li>
                <li><a href="#"><strong>공지사항 추가창</strong></a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title"><strong>새로운 공지사항</strong>
                                <small>추가하기</small>
                            </h3>
                        </div>
                        fc
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <form name="frm" onsubmit="return check()">
                                <div><input type="text" id="headline" name="headline" placeholder="제목을 입력해주세요"
                                            style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"/>
                                </div>
                                <textarea class="textarea" id="detail" name="detail" placeholder="내용을 입력해주세요"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        </form>
                        <div class="box-footer">
                            <button id="content" type="submit" class="btn btn-primary pull-right" onclick=check()>저장하기
                            </button>

                        </div>

                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><strong>이전 공지사항</strong>
                                <small>기존 공지사항 수정하기</small>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <form>
                <textarea class="textarea" placeholder="수정할 정보를 입력해주세요"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </form>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">수정하기</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!--<script>-->
    <!--    $("#content").bind("click",function(){-->
    <!--        var targetForm = $("#frm_req_adjust_price .__required");-->
    <!--        $.each(targetForm, function(index, elem){-->
    <!--            alert("이름 : " + $(this).attr("headline") + ", 내용 : " + $(this).attr("detail"));-->
    <!--        });-->
    <!--    });-->
    <!--</script>-->


</body>
</html>
