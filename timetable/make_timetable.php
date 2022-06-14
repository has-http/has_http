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
        <div class="timetable">
            <h2>본인이 선택한 과목을 바탕으로 가능한 시간표 조합을 모두 확인할 수 있습니다. 
                <br> "저장" 버튼을 누르면 '수강신청' > '수강신청하기' 페이지에서 "장바구니" 기능을 사용할 수 있습니다.</h2>
            <table border="2" bordercolor="#000" style="width:1000px;table-layout:fixed;word-break:break-all;" class="combination_table">
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
                    require_once('../lib/demand_func.php');
                    $sub_array = get_demand_cno();
                    $fixed_array = get_fixed_tno();
                    $result = get_all_case_client($sub_array, $fixed_array);
                    $list = $result[0];
                    $tno_list = $result[1];

                    $all_probabillity_list = get_all_probability($tno_list);

                    ?>
                    
                    <script>
                        var block_list = <?php echo json_encode($list) ?>;
                        var prob_list = <?php echo json_encode($all_probabillity_list) ?>;
                        var block_index = <?php echo get_table_index($tno_list); ?>;
                        var max_plob_index =  <?php echo array_search(max($all_probabillity_list), $all_probabillity_list); ?> ;
                        var fixed_list = <?php echo json_encode(get_fix_block());?>;
                    </script>
                </tbody>
            </table>

            <div class="table_controller">
                <button class="arrow prev text" style="color:#fff;">이전</button>
                <input type="text" class="index_input" style="color: black; height:25px;margin-top:7px; " value=1 oninput="process_input()"></input>
                <div id="max_length" class="text"></div>
                <button class="arrow next text" style="color:#fff;">다음</button>
                <button class="text max_probability" style="color:#fff;">최고 확률</button>
                <button class="save text" style="color:#fff;" onclick="save_process()">저장</button>
                <div id="probability"> </div>
            </div>

            
            
            
            <script src="../JS/writeSubjectTable.js"></script>
        </div>
        <form action="fix_process.php" method="POST" class="fix_form">
            <div class="selecFixed">
                <h2>다음 중 희망하는 특정 과목의 특정 분반을 선택하면, 해당 과목의 분반을 포함하는 시간표 조합을 볼 수 있습니다.</h2>
                <div class="label">
                    <ul>
                        <?php
                        $c_name_dict = get_demand_cname();
                        foreach ($c_name_dict as $c_no => $c_name){
                            ?> <li> <?php echo $c_name; ?> </li> <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class = "select_box">
                <?php
                foreach($c_name_dict as $c_no => $c_name){
                    ?> <select name= <?php echo 'subj[]' ?> class="select">
                            <?php $fix_arr = get_fix_selected($c_no); ?>
                            <option value=0 <?php echo $fix_arr[0]; ?> >선택 안 함</option>
                            <?php
                            $result = custom_query("SELECT count(t_no) FROM teach WHERE c_no = {$c_no}");
                            $count = mysqli_fetch_row($result)[0];
                            for ($i=1; $i<=$count; $i++){
                                ?>
                                <option value= <?php echo $i.' '.$fix_arr[$i];?>> <?php echo $i; ?>분반</option>
                                <?php
                            }
                        ?></select>
                <?php }
                ?>
                </div>
            </div>
            <button class="submit" style="color:#fff;">확인</button>
        </form>
    </div>
</body>
</html>
