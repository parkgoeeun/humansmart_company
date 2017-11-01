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
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script>
    <style>
        #example2 td { vertical-align:middle; font-size:1.3rem; }
        .hashtag { width: 100%; margin-top: 40px; }
        .hashtag th, td { vertical-align:top; border: 1px solid #999; }
    </style>
    <script>
        var xE = {};
        function xFn(e)
        {
            xE.w.focus();
            var c = e.innerHTML,
                a = c +' ';
            try { a += xE.d.execCommand(c, false, e); } catch (x) { a += 'Error : ' + x.message; }
            xE.m.innerHTML = a;
        }
        function xHv()
        {
            xE.m.innerHTML =
                xE.d.body.innerHTML
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
        }
        window.onload = function()
        {
            xE.w = document.getElementById('yF').contentWindow;
            xE.d = xE.w.document;
            xE.d.write('<!DOCTYPE html><html><head></head><body></body></html>');
            xE.d.designMode = 'on';
            xE.m = document.getElementById('yM');
            xE.w.focus();
        }
        $("#inputFile").change(function(e) {
            onChange(e);
        });
        function onChange(event) {
            var reader = new FileReader();
            reader.onload = onReaderLoad;
            reader.readAsText(event.target.files[0]);
        }
        function onReaderLoad(event){
            //alert(event.target.result);
            var obj = JSON.parse(event.target.result);
            alert(obj);
        }
        function check(){
            if(frm.headline.value==""){
                alert("제목을 입력해주세요");
                frm.headline.focus();
                return false;
            }
            else if(frm.detail.value==""){
                alert("공지 내용을 입력해주세요");
                frm.detail.focus();
                return false;
            }
            else {
                var totalInfo = new Object();
                var retotalInfo = new Object();
                var alarmInfo = new Object();
                var realarmInfo = new Object();
                var jsonInfo = new Object();

                alarmInfo.제목 = $("input#headline").val();
                alarmInfo.내용 = $("textarea#detail").val();
                totalInfo[0] = alarmInfo;

                realarmInfo.제목 = $("input#reheadline_").val();
                realarmInfo.내용 = $("input#redetail_").val();
                $.getJSON('questionData.json', function(data) {

                    $.each(data, function(entryIndex, entry) {
                        totalInfo[parseInt(entryIndex) + 1] = entry;
                        retotalInfo[parseInt(entryIndex) + 1] = realarmInfo;
                    });
                    jsonInfo = JSON.stringify(totalInfo);
                    jsonInfo = JSON.stringify(retotalInfo);
                    alert(jsonInfo);
//                    string path = "C:\Users\goe eun park\PhpstormProjects\trost\Dummy\pages\supportInfo\notice\noticeData.json";
//                    try{
//                        System.IO.DirectoryInfo di = new System.IO.DirectoryInfo(path);
//                        di.Delete();
//                        Condole.WriteLine("OK");
//                    }
//                    catch (Exception e){
//                        Console.WriteLine(e.Message.ToString());
//                    }
                    var dataUri = "data:application/json;charset=utf-8,"+ encodeURIComponent(jsonInfo);
                    $("#link").attr("href", dataUri);
                });
            }
        }
        $(document).ready(function() {
            $('#change_btn').click(function() {
                $.getJSON('questionData.json', function(data) {
                    var html = ''
                    var i = 1;
                    $.each(data, function(entryIndex, entry) {
                        console.log(i);
                        html +='<form>' + '제목 : <input type ="text" id = "reheadline_' + i + '" value="' + entry.title + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">';
                        html +='<form>' + '내용: <input type ="text" id = "redetail_' + i + '" value="' + entry.content + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">';
                        html += '</form>';
                        i++;
                    });
                    $('#dictionary').html(html);
                });
                return false;
            });
        });
    </script>
    </head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/pages/common/navigation.php"); ?>
    <script>
        document.getElementById("infoTable_9").className = "treeview active";
        document.getElementById("infoTable_9_5").className = "active";
        function is_ie() {
            if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
            if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
            if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
            return false;
        }
    </script>
</div>
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Q&A  추가
                <small>Q&A 를 입력해주세요</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 상담사 관리</a></li>
                <li><a href="#"><strong>Q&A 추가창</strong></a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title"><strong>Q&A </strong>
                                <small>새로 추가하기</small>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <div style="padding:2px">
                                <button type=button onclick="xFn(this)">bold</button>
                                <button type=button onclick="xFn(this)">italic</button>
                                <button type=button onclick="xFn(this)">delete</button>
                                <button type=button onclick="xFn(this)">insertOrderedList</button>
                                <button type=button onclick="xFn(this)">insertUnorderedList</button>
                                <button type=button onclick="xFn(this)">justifyCenter</button>
                                <button type=button onclick="xFn(this)">justifyFull</button>
                                <button type=button onclick="xFn(this)">justifyLeft</button>
                                <button type=button onclick="xFn(this)">justifyRight</button>
                                <button type=button onclick="xFn(this)">removeFormat</button>
                                <button type=button onclick="xFn(this)">selectAll</button>
                                <button type=button onclick="xFn(this)">strikeThrough</button>
                                <button type=button onclick="xFn(this)">underline</button>
                                <button type=button onclick="xFn(this)">undo</button>
                                <button type=button onclick="xHv()">HTML</button>
                            </div>
                            <iframe id=yF src="about:blank" style="box-sizing:border-box;border:1px solid #999;padding:2px;width:100%;height:150px;"></iframe>
                            <div id=yM style="padding:2px"></div>
                            <form name = "frm" onsubmit="return check()">
                                <div> <input type ="text"  id = "headline" name="headline" placeholder="제목입력창 : html 변환 -> 변환된 코드 복사 -> 붙여넣기" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"/>
                                </div>
                                <textarea class="textarea" id = "detail" name="detail" placeholder="내용입력창 : html 변환 -> 변환된 코드 복사 -> 붙여넣기" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div></form>
                        <div class="box-footer">
                            <button id = "save" type="submit" class="btn btn-primary pull-right" onclick = check() >저장하기</button>
                            <a href= # id="link" download="noticeData.json">download</a>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><strong>이전 Q&A </strong>
                                <small>기존 Q&A 수정하기</small>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <div id="container">
                                <div class="letters">
                                    <div class="letter" id="target">
                                        <button id = "change_btn"type="submit" class="btn btn-primary pull-right">이전 공지사항 불러오기</button>
                                    </div>
                                </div>
                                <div id="dictionary">
                                </div>
                            </div>
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
</body>
</html>