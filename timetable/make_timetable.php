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
        <table style="width:1000px;table-layout:fixed;word-break:break-all;" class="combination_table">
            <thead>
            <tr align="center" bgcolor="white">
                <th>교시</th>
                <th>월요일</th>
                <th>화요일</th>
                <th>수요일</th>
                <th>목요일</th>
                <th>금요일</th>
            </tr>
            </thead>
            <tbody id="tbody"> 
                <?php
                require_once('../lib/enroll_func.php');
                require_once('../lib/sub_list.php');

                $sub_array = array(3001, 3004, 3007, 3019, 3021, 3026, 3027, 3023, 3036);
                $list = get_all_case2($sub_array);
                ?>
                
                <script>
                    var block_list = <?php echo json_encode($list) ?>;
                </script>
            </tbody>
        </table>

        <div class="table_controller">
            <button class="arrow prev text">이전</button>
            <input type="text" class="index_input" style="color: black; " value=1 oninput="process_input()"></input>
            <div id="max_length" class="text"></div>
            <button class="arrow next text">다음</button>
            <button class="save text" onclick="save_process()">저장</button>
        </div>
        
        <script src="../JS/writeSubjectTable.js"></script>
    </div>
</body>
</html>