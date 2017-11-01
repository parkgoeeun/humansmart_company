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
    <script src="//code.jquery.com/jquery.min.js"></script>
    <style>
        #example2 td { vertical-align:middle; font-size:1.3rem; }
        .hashtag { width: 100%; margin-top: 40px; }
        .hashtag th, td { vertical-align:top; border: 1px solid #999; }
    </style>
    <script>
//        var current_page = 1;
//        var records_per_page = 2;
//        var objJson = [
//            { adName: "AdName 1"},
//            { adName: "AdName 2"},
//            { adName: "AdName 3"},
//            { adName: "AdName 4"},
//            { adName: "AdName 5"},
//            { adName: "AdName 6"},
//        ];
//        function prevPage()
//        {
//            if (current_page > 1) {
//                current_page--;
//                changePage(current_page);
//            }
//        }
//        function nextPage()
//        {
//            if (current_page < numPages()) {
//                current_page++;
//                changePage(current_page);
//            }
//        }
//        function changePage(page)
//        {
//            var btn_next = document.getElementById("btn_next");
//            var btn_prev = document.getElementById("btn_prev");
//            var listing_table = document.getElementById("listingTable");
//            var page_span = document.getElementById("page");
// Validate page
//            if (page < 1) page = 1;
//            if (page > numPages()) page = numPages();
//            listing_table.innerHTML = "";
//            for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
//            }
//            page_span.innerHTML = page;
//            if (page == 1) {
//                btn_prev.style.visibility = "hidden";
//            } else {
//                btn_prev.style.visibility = "visible";
//            }
//            if (page == numPages()) {
//                btn_next.style.visibility = "hidden";
//            } else {
//                btn_next.style.visibility = "visible";
//            }
//        }
//        function numPages()
//        {
//            return Math.ceil(objJson.length / records_per_page);
//        }
//        window.onload = function() {
//            changePage(1);
//        };
        $(document).ready(function() {
            $.getJSON('adviceData.json', function(data) {
                var html = ''
                $.each(data, function(entryIndex, entry) {
                    for(var i =0;i<entry.length;i++){
//                           console.log(entry[i].question.title);
                                html+= '<section class="content"> <div class="row"> <div class="col-md-12"> <div style = "height: 800px; margin:0px 5% 0px 2%; " class="box box-info"><div clss="box-header">';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '질문id </label> <div class="col-sm-10"><input type ="text" class="form-control" id = "question_ID" value="' + entry[i].question.id + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; "></div></div>';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '페이지 </label> <div class="col-sm-10"><input type ="text" id = "page_num" value="' + (parseInt(entryIndex)+1) + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '제목 </label> <div class="col-sm-10"> <input type ="text" id = "title" value="' + entry[i].question.title + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '부제목 </label><div class="col-sm-10"> <input type ="text" id = "subtitle" value="' + entry[i].question.subTitle + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '순서 </label> <div class="col-sm-10"><input type ="text" id = "num" value="' + (i+1) + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                                html +='<div class="form-group"><label class="col-sm-2 control-label">' + '카테고리 </label><div class="col-sm-10"> <input type ="text" id = "category" value="' + entry[i].question.category + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';

                                //   console.log(entry[i].answer);
                                $.each(entry[i].answer, function(entryIndex_, entry_) {
//                                console.log("i= "+i);
//                                console.log("entryIndex= " + entryIndex);
//                                console.log("entryIndex_= "+entryIndex_);
//                                console.log(entry_)
                                    html +='<br><br><br>'
                            html +='<div class="form-group"><label class="col-sm-2 control-label">' + '형식 </label> <div class="col-sm-10"><input type ="text" id = "label_set" value="' + entry[i].answer[entryIndex_].type + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                            html +='<div class="form-group"><label class="col-sm-2 control-label">' + '답변 </label><div class="col-sm-10"> <input type ="text" id = "answer" value="' + entry[i].answer[entryIndex_].title + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                            html +='<div class="form-group"><label class="col-sm-2 control-label">'+ '답변id </label> <div class="col-sm-10"><input type ="text" id = "answer_ID" value="' + entry[i].answer[entryIndex_].answer_id + '" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></div></div>';
                        });
                        html += '</div> </div></div></div></div></section>';
                    }
                });
                $('#dictionary').html(html);
            });
            return false;
        });
        function check(){
//            if(frm.title_.value==""|| frm.page_num_.value==""|| frm.answer_.value ==""  || frm.category_.value =="" ||frm.num_.value==""){
//                alert("빈칸을 입력해주세요");
//                return false;
//            }
//            else {
                    var totalInfo = new Object();
                //    var retotalInfo = new Object();
                    var alarmInfo = new Array();
                //   var realarmInfo = new Object();
                    var jsonInfo = new Object();
                    var question = new Object();
                alarmInfo.question[0].제목= $("input#title_").val();
                alarmInfo.question[1].페이지번호 = $("input#page_num_").val();
                alarmInfo.question[2].문제번호 = $("input#num_").val();
                alarmInfo.question[3].category = $("input#category_").val();
                alarmInfo.answer[0] = $("input#answer_").val();
                alarmInfo.answer[1].형식 = $("select#form_set_").val();
                console.log(alarmInfo.question[0].페이지번호);
                totalInfo[0] = alarmInfo;
//                realarmInfo.제목 = $("input#reheadline_").val();
//                realarmInfo.내용 = $("input#redetail_").val();

                $.getJSON('adviceData.json', function(data) {
                    $.each(data, function(entryIndex, entry) {
                        totalInfo[parseInt(entryIndex) + 1] = entry;
//                        retotalInfo[parseInt(entryIndex) + 1] = realarmInfo;
                    });
                    jsonInfo = JSON.stringify(totalInfo);
//                    jsonInfo = JSON.stringify(retotalInfo);
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
//                    var dataUri = "data:application/json;charset=utf-8,"+ encodeURIComponent(jsonInfo);
//                    $("#link").attr("href", dataUri);
                });

                return false;
//            }
        }
    </script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Dummy/pages/common/navigation.php"); ?>
    <script>
        document.getElementById("infoTable_9").className = "treeview active";
        document.getElementById("infoTable_9_6").className = "active";
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
            <h1><strong>
                    상담접수지</strong>
                <small>상담 접수지 관리</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 상담사 관리</a></li>
                <li><a href="#"><strong>상담접수지 추가창</strong></a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div clss="box-header">
                            <h3 class="box-title"><strong> &nbsp;&nbsp;상담접수지</strong>
                                <small>새로 추가하기</small>
                            </h3>
                        </div>
                        <!-- /.box-header -->
<!--                        <form name = "frm" >-->
                        <div style = " height: 435px; margin:0px 5% 0px 2%; "><br>
                            <label >Question title</label>
                            <input id = "title_" name = "title_" placeholder="enter title" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'/>
                            <label>page num</label>
                            <input id = "page_num_" name = "page_num_" placeholder="enter category" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'/>
                            <label>question num</label>
                            <input id = "num_" name = "num_" placeholder="enter page number" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'/>
                            <label>category</label>
                            <input id = "category_" name = "category_" placeholder="enter question number" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'/>
                            <label>answer</label>
                            <input id = "answer_" name = "answer_" placeholder="enter answer" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'/>
                            <label>text form</label>
                            <select id = "form_set_" name = "form_set_" class="form-control" style='margin:0px 0px 0px 7px;font-weight:bold;'>
                                <option>mainPage</option>
                                <option>setPoint</option>
                                <option>setList</option>
                                <option>setText</option>
                                <option>setButtonWithList</option>
                                <option>setTextWithList</option>
                                <option>setTextWithLists</option>
                                <option>setLists</option>
                            </select>
                            <div class="box-footer">
                                <button class="btn btn-primary pull-right" onclick = check();return false;>저장하기</button>
                                <a href= # id="link" download="adviceData.json">download</a>
                            </div>
                            <div id="pagingNav" class="pagination"></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form">
                                            <div class="form-group">
                                                <div id="dictionary"></div>
                                            </div>
                                        </form>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        </form>-->
                    </div>
                    <!-- /.box -->
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