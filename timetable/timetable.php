<?php 
require_once('../lib/member_func.php'); verify_id(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>수강신청 내역</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/timetableStyle.css">

</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> 시간표 </header>
        <ul>
            <li><a href="timetable.php">시간표 및 강의계획</a></li>
            <li><a href="make_timetable.php">시간표 조합 생성</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="timetable">
            <h1 align="center">2022학년도 3학년 1학기 학생별 시간표</h1>
            <table border="2" bordercolor="#000" style="width:1000px;table-layout:fixed;word-break:break-all;margin-top:-15px;margin-bottom:40px;">
            <tr bgcolor="#30977a">
                <th width=75></th>
                <th>월요일</th>
                <th>화요일</th>
                <th>수요일</th>
                <th>목요일</th>
                <th>금요일</th>
            </tr>
            <?php
                require("../lib/sub_list.php");
                writeSubjectTable(get_block(get_enroll_list($_SESSION['user_id'])));
            ?>
            </table>
        </div>
    </div>
</body>
</html>
