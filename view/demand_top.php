<?php 
require_once('../lib/member_func.php'); verify_id(); 
if (!check_sub()){
    echo "<script>alert('과목 선택을 먼저 해주세요'); window.location.href = '../enrollment/enroll_subjinfo.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>수강신청하기</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <script>
        let target = new Date(2022,4,10,12,7,0);
        let now_time = new Date();
        if (target.getTime() > now_time.getTime()) {
            alert("수강신청 기간이 아닙니다.");
            window.location.href = './enroll_check.html';
        }
    </script>
</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> 수강신청 </header>
        <ul>
            <li><a href="enrollment.php">수강신청하기</a></li>
            <li><a href="enroll_subjInfo.php">과목 선택</a></li>
            <li><a href="demand.php">pre-수강신청</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="choose_subj">
            <h1>과목 및 분반 선택 (pre-수강신청 ver.)</h1>
            <h2>이 페이지는 실제 수강신청 페이지가 아닌 모의 수강신청 페이지로서, 미리 수강신청을 연습해볼 수 있습니다.
                <br>이곳에서 본인의 수강과목 중 희망하는 분반에 대해 현재 해당 분반을 희망하는 인원을 확인할 수 있습니다.
                <br>또한, 모의 수강신청을 완료하면 해당 시간표 수강신청을 성공할 확률을 맨 하단에서 확인할 수 있습니다. </h2>
            <ul>

            <script>
                    function f_click(a){
                        let form = document.createElement('form');
                        form.action = './demand_selecSubj.php';
                        form.method = 'POST';
                        
                        form.innerHTML = '<input name="sub_num" value="' + a + '">';

                        document.body.append(form);

                        form.submit();
                    }
                </script>

                <?php
                    require_once('../lib/member_func.php');
                    require_once("../lib/utill.php");
                    $c_no_array = get_demand_cno();
                    $conn = mysql_connect();

                    foreach($c_no_array as $c_no){
                        $result = query_conn($conn, "SELECT c_name FROM course WHERE c_no='{$c_no}'");
                        $c_name = mysqli_fetch_row($result)[0];
                        echo "<li id=a{$c_no} onclick='f_click({$c_no})'>{$c_name}</li>";
                    }
                    
                ?>

                <style>
                    <?php
                        $s_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM demand WHERE s_id='{$s_id}' and t_no IS NOT null";
                        $temp = mysqli_query($conn, $sql);
                        while ($c_no = mysqli_fetch_array($temp)['c_no']) {
                            echo ".choose_subj #a".$c_no."{";
                            echo "background-color : #666;";
                            echo "text-decoration: line-through;";
                            echo "}";
                        }
                    ?>

                </style>

            </ul>
        
        </div>
        
