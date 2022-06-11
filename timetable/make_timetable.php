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
        <h1>시간표 조합 생성</h1>
        <h2>본인이 선택한 과목을 바탕으로 가능한 시간표 조합을 모두 확인할 수 있습니다. 
            <br> "저장" 버튼을 누르면 '수강신청' > '수강신청하기' 페이지에서 "장바구니" 기능을 사용할 수 있습니다.</h2>
        <table border="2" bordercolor="#000" style="width:1000px;table-layout:fixed;word-break:break-all;background-color:" class="combination_table">
            <thead>
            <tr align="center" bgcolor="#298168">
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
                $list = get_all_case($sub_array, 'client');
                ?>
                
                <script>
                    var block_list = <?php echo json_encode($list) ?>;
                </script>
            </tbody>
        </table>

        <div class="table_controller">
            <button class="arrow prev text" style="color:#fff;">이전</button>
            <input type="text" class="index_input" style="color: black; height:25px;margin-top:7px; " value=1 oninput="process_input()"></input>
            <div id="max_length" class="text"></div>
            <button class="arrow next text" style="color:#fff;">다음</button>
            <button class="save text" style="color:#fff;" onclick="save_process()">저장</button>
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
