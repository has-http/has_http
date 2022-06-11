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
                require_once('../lib/member_func.php');
                $sub_array = get_demand_cno();
                $fixed_array = get_demand_tno();
                $list = get_all_case($sub_array, 'client', $fixed_array);
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

        <script> var block_index = <?php
            require_once('../lib/utill.php');
            $id = $_SESSION['user_id'];
            $result = custom_query("SELECT table_index FROM timetable_index WHERE s_id = '{$id}';");
            $row = mysqli_fetch_row($result);
            if (isset($row)){
                echo $row[0];
            }
            else{
                echo 0;
            }
        ?>;
        </script>
        
        
        <script src="../JS/writeSubjectTable.js"></script>
    </div>
</body>
</html>