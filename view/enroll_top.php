<?php 
require_once('../lib/member_func.php'); verify_id(); 
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
            <h1>과목 및 분반 선택</h1>
            <ul>

            <script>
                    function f_click(a){
                        let form = document.createElement('form');
                        form.action = './enrollment_selecSubj.php';
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
                        
                        $sql = "SELECT * FROM enroll WHERE s_id='".$_SESSION['user_id']."'";
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
