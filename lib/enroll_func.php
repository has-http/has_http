<?php
require_once('utill.php');
function get_condition($id, $c_no, $t_no, $block){
    /*
    수강신청 해당 분반 상태를 알려주는 함수 (ex. 정원 초과, 시간 중복, 과목 중복)
    parameter
    $id : 사용자 아이디
    $c_no : 신청할 과목의 id
    $t_no : 신청할 분반 id
    $block : get_block()의 결과 (효율성 위해 내부에서 실행 안 하고 파라미터로 받음)
    return 
    $msg_array : 각 조건에 맞는 메시지를 담은 array
    */

    
    $msg_array = array();

    //이미 신청한 분반인지 체크
    $sql = "SELECT EXISTS (SELECT * FROM enroll WHERE s_id='{$id}' AND c_no={$c_no} AND t_no={$t_no});";
    $result = custom_query($sql);
    $row = mysqli_fetch_row($result);

    if ($row[0] == 1) {
        array_push($msg_array, '신청한 분반');
        return $msg_array;
    } 


    
    //과목 중복 체크
    $sql = "SELECT EXISTS (SELECT * FROM enroll WHERE s_id='{$id}' AND c_no={$c_no});";
    $result = custom_query($sql);
    $row = mysqli_fetch_row($result);

    if ($row[0] == 1) {
        array_push($msg_array, "과목 중복");
    }
    

    //시간 중복 체크
    $sql = "SELECT b_code, t_max, t_now FROM teach WHERE c_no={$c_no} AND t_no={$t_no}";
    $result = custom_query($sql);
    $row = mysqli_fetch_row($result);
    $b_code = $row[0];
    $t_max = $row[1];
    $t_now = $row[2];

    $sql = "SELECT b_1, b_2, b_3, b_4 FROM brick WHERE b_code='".$b_code."'";
    $result = custom_query($sql);
    $row = mysqli_fetch_assoc($result);

    foreach($row as $brick) {
        if (!isset($brick)){
            break;
        }

        $j = $brick % 10;
        $i = ($brick - $j) / 10;

        if (!empty($block[$i][$j])){
            array_push($msg_array, "시간 중복");
            break;
        }
    }
    
    //정원 초과 체크
    
    if ($t_max <= $t_now){
        array_push($msg_array, "정원 초과");
    }

    return $msg_array;
}

function get_radio($msg_array, $t_no){
    /*
    수강 신청 시 라디오 버튼 설정
    parameter
    $msg_array : get_condition()의 반환값
    $t_no : 해당 과목의 분반
    return
    $msg_html : 라디오 버튼 생성하는 html 코드 반환
    */

    //신청한 과목일때
    $index = array_search('신청한 분반', $msg_array);
    if ($index !== false){
        return "<input type='radio' name='t_no' value='{$t_no}' checked>";
    }

    //시간 중복과 정원 초과 아닐 때
    $index1 = array_search('시간 중복', $msg_array);
    $index2 = array_search('정원 초과', $msg_array);

    if ($index1 === false and $index2 === false){
        return "<input type='radio' name='t_no' value='{$t_no}'>";
    }

    //있을때
    else{
        return "";
    }

}

function get_radio_shopping($msg_array, $t_no, $c_no, $c_name){
    /*
    수강 신청 시 라디오 버튼 설정 // 장바구니에서
    parameter
    $msg_array : get_condition()의 반환값
    $t_no : 해당 과목의 분반
    return
    $msg_html : 라디오 버튼 생성하는 html 코드 반환
    */

    //신청한 과목일때
    $index = array_search('신청한 분반', $msg_array);
    if ($index !== false){
        return "<input type='radio' name='t_no/c_no' value='{$t_no}/{$c_no}'>";
    }

    //시간 중복, 정원 초과, 과목 중복 아닐 때
    $index1 = array_search('시간 중복', $msg_array);
    $index2 = array_search('정원 초과', $msg_array);
    $index3 = array_search('과목 중복', $msg_array);

    if ($index1 === false and $index2 === false and $index3 === false){
        return "<input type='radio' name='t_no/c_no' value='{$t_no}/{$c_no}'>";
    }

    //있을때
    else{
        return "";
    }

}

function get_all_case_client($sub_array, $fixed_array=array()){
    /*
    과목 목록 보고 모든 수강 신청 경우의 수를 알려주는 함수 + indexing에 필요한 것 까지 return
    parameter
    $sub_array : c_no가 담긴 배열
    $user_array : demand한 배열 $user_array[c_no] = t_no, 저장된 인덱스 알아오기 위해 만든 배열
    $fixed_array : 고정된 과목 받아오는 함수 $fixed_array[c_no] = t_no
    variables
    $all_block_list : return할 array, 7x5 array(시간표 조합)들이 담긴 array로 구성되있다.
    $new_all_block_list : 과목 하나하나 넣음에 따라 생길 all_block_list, all_block_list는 foreach에서 돌아야하니
                          과목 하나 끝난 후 업데이트
    구조
    sub_array에 담긴 과목 순서대로 하나씩 경우의 수 고려 => all_block_list에 있는 각 경우의 수에 대해 과목 고려
    => 해당 과목의 각 분반 고려 => 그 분반에 들어가는 시간 하나하나 고려
    */
    
    $all_block_list = array(array_fill(0, 7, array_fill(0, 5, null))); 
    $all_tno_dict = array(array());

    $brick_array = get_brick_array();
    $conn = mysql_connect();

    $sql = "SELECT c_no, b_code, t_no, c_name  FROM teach ORDER BY c_no;";
    $teach_array = array();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_row($result)){  
        if (!isset($teach_array[$row[0]])) {
            $teach_array[$row[0]] = array();
        }
        array_push($teach_array[$row[0]], array($row[1], $row[3], $row[2]));
    }
    
    foreach($sub_array as $c_no) { //각 과목
        $new_all_block_list = array();  // 해당 과목 집어넣은 후의 $new_block_list
        $new_all_tno_dict = array();
        $count = count($all_block_list);
        for($index=0; $index<$count; $index++){ //각 경우의 수
            $block_list = $all_block_list[$index];
            $tno_dict = $all_tno_dict[$index];
            $new_block_list = array(); //그 경우의 수에서 해당 과목을 추가했을 때 모든 $block_list(7x6)를 가진 array
            $new_tno_dict = array();

            foreach($teach_array[$c_no] as $row_array){  //분반
                $b_code = $row_array[0];
                $c_name = $row_array[1];
                $t_no = $row_array[2];

                if (isset($fixed_array[$c_no]) and $fixed_array[$c_no] != $t_no){
                    continue;
                }

                $row2 = $brick_array[$b_code];
                
                $new_block = $block_list; // 해당 분반 추가했을 때의 $block_list (7*6 array)
                $new_tno = $tno_dict;
                $flag = true;
                
                foreach($row2 as $brick) {  //교시 
                    
                    if (!isset($brick)){
                        break;
                    }
                    $j = $brick % 10;
                    $i = ($brick - $j) / 10;
                    
                    if (isset($block_list[$i][$j])){  //이미 해당 교시에 차있으면 $new_block_list에 안 넣음
                        $flag = false;
                        break; 
                    }
                    $new_block[$i][$j] = $c_name . " ({$t_no}분반)";

                    
                }
                if ($flag){
                    array_push($new_block_list, $new_block);   
                    
                    $new_tno[$c_no] = $t_no;
                    array_push($new_tno_dict, $new_tno);
                }
            }
            $new_all_block_list = array_merge($new_all_block_list, $new_block_list);  // new_block_list는 다음 all_block_list의 경우의 수 받아와야하니
            $new_all_tno_dict = array_merge($new_all_tno_dict, $new_tno_dict);
        }
        $all_block_list = $new_all_block_list;
        $all_tno_dict = $new_all_tno_dict;
    }
    return array($all_block_list, $all_tno_dict);
}
    
function get_all_case_server($sub_array, $fixed_array=array()){
    /*
    과목 목록 보고 모든 수강 신청 경우의 수를 알려주는 함수
    get_all_case_client랑 사실상 같지만 if로 계속 거르기엔 구동 시간이 오래 결려서 구분지음
    */
    
    $all_block_list = array(array_fill(0, 7, array_fill(0, 5, null))); 
    $brick_array = get_brick_array();
    $conn = mysql_connect();

    $sql = "SELECT c_no, b_code, t_no FROM teach ORDER BY c_no;";
    $teach_array = array();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_row($result)){  
        if (!isset($teach_array[$row[0]])) {
            $teach_array[$row[0]] = array();
        }
        array_push($teach_array[$row[0]], array($row[1], $row[2]));
    }
    
    foreach($sub_array as $c_no) { //각 과목
        $new_all_block_list = array();  // 해당 과목 집어넣은 후의 $new_block_list
        
        foreach($all_block_list as $block_list){ //각 경우의 수
            $new_block_list = array(); //그 경우의 수에서 모든 분반의 $block_list를 가진 array         
            foreach($teach_array[$c_no] as $row_array){  //분반
                $b_code = $row_array[0];
                $t_no = $row_array[1];
                if (isset($fixed_array[$c_no]) and $fixed_array[$c_no] != $t_no){
                    continue;
                }

                $row2 = $brick_array[$b_code];
                
                $new_block = $block_list; // 해당 분반 추가했을 때의 $block_list (7*6 array)
                $flag = true;
                
                foreach($row2 as $brick) {  //교시 
                    
                    if (!isset($brick)){
                        break;
                    }
        
                    $j = $brick % 10;
                    $i = ($brick - $j) / 10;
                    
                    if (isset($block_list[$i][$j])){  //이미 해당 교시에 차있으면 $new_block_list에 안 넣음
                        $flag = false;
                        break; 
                    }

                    $new_block[$i][$j] = array($c_no, $t_no);
                    
                }
                if ($flag){
                    
                    array_push($new_block_list, $new_block);          
                }
            }
            $new_all_block_list = array_merge($new_all_block_list, $new_block_list);  // new_block_list는 다음 all_block_list의 경우의 수 받아와야하니
        }
        $all_block_list = $new_all_block_list;
    }
    return $all_block_list;
}


function get_brick_array(){
    $result = custom_query("SELECT b_code, b_1, b_2, b_3, b_4 FROM brick;");
    $brick_array = array();
    while ($row = mysqli_fetch_assoc($result)){
        $brick_array[$row['b_code']] = array($row['b_1'],$row['b_2'],$row['b_3'],$row['b_4']);
    }
    return $brick_array;
}

function add_block($c_no, $block, $brick_array){
    $conn = mysql_connect();
    $sql = "SELECT b_code, c_name FROM teach WHERE c_no='".$c_no."';";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $new_block_list = array();
    while ($row = mysqli_fetch_row($result)){  //분반
        $b_code = $row[0];
        $c_name = $row[1];
        $sql2 = "SELECT b_1, b_2, b_3, b_4 FROM brick WHERE b_code='".$b_code."';";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $row2 = mysqli_fetch_row($result2);


        $new_block = $block;
        $flag = true;
        foreach($row2 as $brick) {  //교시
            if (!isset($brick)){
                break;
            }

            $j = $brick % 10;
            $i = ($brick - $j) / 10;
            
            if (isset($block[$i][$j])){  //이미 해당 교시에 차있으면 $new_block_list에 안 넣음
                $flag = false;
                break; 
            }

            $new_block[$i][$j] = $c_name;
        
        
        }
        if ($flag){
            array_push($new_block_list, $new_block);
        }
    }
    mysqli_close($conn);
    return $new_block_list;
}


    
function get_class_count($c_no, $t_no){
    /*
    분반에 '수요조사'한 사람이 몇명인지 return
    prameter
    $c_no, $t_no => 그 분반의 과목, 분반 번호
    */
    require_once('utill.php');
    custom_query("SELECT count(s_id)");
}

function get_table_index($list) { 
    /*$list는 get_all_case_client($sub_array)
    */

    require_once('member_func.php');
    $target = get_demand_tno();
    
    $count = count($list);
    for ($i=0; $i<$count; $i++){
        $list[$i]['index'] = $i;
    }

    foreach($target as $c_no => $t_no){
        $new_list = array();
        $count = count($list);
        for ($i=0; $i<$count; $i++){
            
            $temp = $list[$i];
            if ($temp[$c_no] == $t_no){
                array_push($new_list, $temp);
            } 
        }
        $list = $new_list;
    }
    if (count($list) == 1){
        return $list[0]['index'];
    }
    else{
        return 0;
    }
    

}

?>