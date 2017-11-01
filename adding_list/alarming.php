<?php
/**
 * Created by PhpStorm.
 * User: goe eun park
 * Date: 2017-07-04
 * Time: 오후 4:01
 */
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>공지사항</title>
    <script type = "text/javascript">
            var testList = new Array();
            for(var i=1;i<=2;i++){
    var data = new Object();
    data.number = i;
    data.name="공지사항 #" +i;
    data.content = content;
    testList.push(data);
            }
            var jsonData = JSON.stringify(testList);
            alert(jsonData);
    </script>
</head>
<body>

</body>
</html>