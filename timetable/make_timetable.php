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
        <table style="width:1000px;table-layout:fixed;word-break:break-all;">
            <?php
            require_once('../lib/enroll_func.php');
            require_once('../lib/sub_list.php');

            $sub_array = array(3001, 3004, 3007, 3019, 3021, 3026, 3027, 3023, 3036);
            $list = get_all_case2($sub_array);
            
            writeSubjectTable($list[0]);
            ?>
        </table>
    </div>
</body>
</html>