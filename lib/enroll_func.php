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
        array_push($msg_array, '신청한 과목');
        return $msg_array;
    } 


    /*
    //과목 중복 체크
    $sql = "SELECT EXISTS (SELECT * FROM enroll WHERE s_id='{$id}' AND c_no={$c_no});";
    $result = custom_query($sql);
    $row = mysqli_fetch_row($result);

    if ($row[0] == 1) {
        array_push($msg_array, "과목 중복");
    }
    */

    //시간 중복 체크
    $sql = "SELECT t_time, t_max FROM teach WHERE c_no={$c_no} AND t_no={$t_no}";
    $result = custom_query($sql);
    $row = mysqli_fetch_row($result);
    $t_time = $row[0];
    $t_max = $row[1];

    $sql = "SELECT brick1, brick2, brick3, brick4 FROM brick WHERE t_time='".$t_time."'";
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
    
    if ($t_max <= 0){
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
    $index = array_search('신청한 과목', $msg_array);
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

function get_all_case($sub_array, $type){
    /*
    과목 목록 보고 모든 수강 신청 경우의 수를 알려주는 함수
    parameter
    $sub_array : c_no가 담긴 배열
    $type : 'client'는 출력할 배열, 'server'은 서버측에서 다룰 배열
    return
    $all_block_list : 
    */
    
    $all_block_list = array(array_fill(0, 7, array_fill(0, 5, null))); 
    $brick_array = get_brick_array();
    $conn = mysql_connect();

    $sql = "SELECT c_no, t_time, c_name, t_no FROM teach;";
    $teach_array = array();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_row($result)){  
        if (!isset($teach_array[$row[0]])) {
            $teach_array[$row[0]] = array();
        }
        array_push($teach_array[$row[0]], array($row[1], $row[2], $row[3]));
    }
    
    foreach($sub_array as $c_no) { //각 과목
        $new_all_block_list = array();  // 해당 과목 집어넣은 후의 $new_block_list
        
        foreach($all_block_list as $block_list){ //각 경우의 수
            $new_block_list = array(); //그 경우의 수에서 모든 분반의 $block_list를 가진 array         
            foreach($teach_array[$c_no] as $row_array){  //분반
                $t_time = $row_array[0];
                $c_name = $row_array[1];
                $t_no = $row_array[2];
                $row2 = $brick_array[$t_time];
                
                $new_block = $block_list; // 해당 분반 추가했을 때의 $block_list
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
                    if ($type == 'client'){
                        $new_block[$i][$j] = $c_name . " ({$t_no}분반)";
                    }
                    if ($type == 'server'){
                        $new_block[$i][$j] = array($c_no, $t_no);
                    }
                    
                }
                if ($flag){
                    
                    array_push($new_block_list, $new_block); 
                    
                }

            }
            
            $new_all_block_list = array_merge($new_all_block_list, $new_block_list); 
            
            
        }
        
        $all_block_list = $new_all_block_list;
        
    }

    return $all_block_list;
}
    


function get_brick_array(){
    $result = custom_query("SELECT t_time, brick1, brick2, brick3, brick4 FROM brick;");
    $brick_array = array();
    while ($row = mysqli_fetch_assoc($result)){
        $brick_array[$row['t_time']] = array($row['brick1'],$row['brick2'],$row['brick3'],$row['brick4']);
    }
    return $brick_array;
}

function add_block($c_no, $block, $brick_array){
    $conn = mysql_connect();
    $sql = "SELECT t_time, c_name FROM teach WHERE c_no='".$c_no."';";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $new_block_list = array();
    while ($row = mysqli_fetch_row($result)){  //분반
        $t_time = $row[0];
        $c_name = $row[1];
        $sql2 = "SELECT brick1, brick2, brick3, brick4 FROM brick WHERE t_time='".$t_time."';";
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
?>