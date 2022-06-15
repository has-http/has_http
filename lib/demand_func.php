<?php


require_once('utill.php');
function get_teach_dict(){ 
    /*확률 계산 시 쿼리 중복을 피하기 위한 teach_dict 생성
    teach_dict[$c_no][$t_no] = (t_dem, t_max)
    */
    
    $result = custom_query("SELECT c_no, t_no, t_dem, t_max FROM teach");
    $teach_dict = array();
    while ($row = mysqli_fetch_row($result)){
        $c_no = $row[0];
        $t_no = $row[1];
        $t_dem = $row[2];
        $t_max = $row[3];

        if (!isset($teach_dict[$c_no])){
            $teach_dict[$c_no] = array();
        }
        $teach_dict[$c_no][$t_no] = array($t_dem, $t_max);
    }
    $result = custom_query("SELECT c_no, count(t_no) FROM teach group by c_no;");
    while($row = mysqli_fetch_row($result)){
        $teach_dict[$row[0]]['count'] = $row[1]; 
    }
    return $teach_dict;
}



function get_probability_improved($teach_dict, $demand_arr){ //개선된 것

    $probability = 1;
    foreach ($demand_arr as $c_no => $t_no){
        if (!isset($t_no)){
            return -1;
        }
        $temp = $teach_dict[$c_no][$t_no];
        $t_dem = $temp[0];
        $t_max = $temp[1];

        $sql = "SELECT count(s_id) FROM demand WHERE c_no = {$c_no}";
        $demand_count = mysqli_fetch_row(custom_query($sql))[0];

        $t_count = $teach_dict[$c_no]['count']; // 과목의 분반 개수
        $not_demand_count = ($t_max * $t_count) - $demand_count; //수요조사에 참여하지 않은 인원
        $virtual_num = ($not_demand_count - ($not_demand_count % $t_count)) / $t_count;       
        
        $t_dem += $virtual_num;
        
        //잔여 인원 고려
        $not_considered_virtual = $not_demand_count % $t_count;
        $enroll_probability = $not_considered_virtual / $t_count;
        $not_enroll_probability = 1 - $enroll_probability;
           

        if ($t_max < $t_dem){
            $not_enroll_probability *= $t_max / $t_dem;
        }

        $t_dem += 1;
        if ($t_max < $t_dem){
            $enroll_probability *= $t_max / $t_dem;
        }

        $probability *= ($not_enroll_probability + $enroll_probability);
        
    }
    return $probability;
}

function get_cno_count(){
    // count_arr[$c_no]= count(s_id) by demand
    // 수요 조사에 안 참여한 사람을 구하기 위해 만드는 array
    $sql = "SELECT teach.c_no, count(s_id)  FROM teach LEFT OUTER JOIN demand 
            ON demand.c_no = teach.c_no AND demand.t_no = teach.t_no 
            group by teach.c_no";
    $result = custom_query($sql);
    $count_arr = array();
    
    while ($row = mysqli_fetch_row($result)){
        $c_no = $row[0];
        if (!isset($count_arr[$c_no])){
            $count_arr[$c_no] = array();
        }
        $count_arr[$c_no] = $row[1]; 
    }

    
    return $count_arr;
}

function get_probability_improved_fast($teach_dict, $tno_list, $count_arr, $demand_arr){ 
    // 더 개선된 것, sql문을 전부 빼내고 demand와 tno_list가 다를 수 있음 고려   

    $probability = 1;
    foreach ($tno_list as $c_no => $t_no){
        if (!isset($t_no)){
            return -1;
        }

        $temp = $teach_dict[$c_no][$t_no];
        $t_dem = $temp[0];
        $t_max = $temp[1];

        $demand_count = $count_arr[$c_no];

        if (!isset($demand_arr[$c_no])){ //만약 해당 과목 분반 신청 x => 조합에 대한 신청인원 +1, 조합에 대한 t_no 신청인원 +1 
            $demand_count += 1;
            $t_dem += 1;
        }

        else if ($demand_arr[$c_no] != $t_no){ //만약 해당 과목 다른 분반 신청 => 조합에 대한 t_no 신청인원 +1 
            $t_dem += 1;
        }


        $t_count = $teach_dict[$c_no]['count']; // 과목의 분반 개수
        $not_demand_count = ($t_max * $t_count) - $demand_count; //수요조사에 참여하지 않은 인원
        $virtual_num = ($not_demand_count - ($not_demand_count % $t_count)) / $t_count;       
        
        $t_dem += $virtual_num;
        
        //잔여 인원 고려
        $not_considered_virtual = $not_demand_count % $t_count;
        $enroll_probability = $not_considered_virtual / $t_count;
        $not_enroll_probability = 1 - $enroll_probability;
           

        if ($t_max < $t_dem){
            $not_enroll_probability *= $t_max / $t_dem;
        }

        $t_dem += 1;
        if ($t_max < $t_dem){
            $enroll_probability *= $t_max / $t_dem;
        }

        $probability *= ($not_enroll_probability + $enroll_probability);
        
    }
    return $probability;
}

function get_all_probability($all_tno_list){
    $teach_dict = get_teach_dict();
    $arr = array();
    $count_arr = get_cno_count();
    $demand_arr = get_demand_tno();

    foreach($all_tno_list as $tno_list){
        array_push($arr, get_probability_improved_fast($teach_dict, $tno_list, $count_arr, $demand_arr));
    }
    return $arr;
}

function get_fixed_tno(){ //고정된 arr[c_no] = t_no 리턴
    $s_id = $_SESSION['user_id'];
    $sql = "SELECT c_no, t_no FROM fix_subj where s_id = '{$s_id}' and t_no is not null";

    $result = custom_query($sql);
    $fixed_tno = array();
    while ($row = mysqli_fetch_row($result)){
        $fixed_tno[$row[0]] = $row[1];
    }
    return $fixed_tno;

}

function get_fix_selected($c_no) { // 고정된 분반만 'selected' 아니면 ''을 가진 array
    $s_id = $_SESSION['user_id'];

    $sql = "SELECT t_no FROM fix_subj WHERE c_no = {$c_no} AND s_id = '{$s_id}' AND t_no is not null";
    $result = custom_query($sql);
    if (isset($result)){
        $t_no = mysqli_fetch_row($result)[0];
    }
    else{
        $t_no = 0;
    }

    $count = mysqli_fetch_row(custom_query("SELECT count(t_no) FROM teach WHERE c_no = {$c_no}"))[0];
    $count += 1;

    $arr = array();
    for ($i=0;$i<$count;$i++){
        if ($i == $t_no){
            array_push($arr, 'selected');
        }
        else{
            array_push($arr, '');
        }
    }
    return $arr;
}

function get_fix_block(){ // block[i][j] = fix됐으면 1 아니면 0 리턴
    $conn = mysql_connect();
    $block = array_fill(0, 7, array_fill(0, 5, 0));
    $fixed_array = get_fixed_tno();

    foreach ($fixed_array as $c_no => $t_no){
        
        $sql = "SELECT b_1, b_2, b_3, b_4 FROM brick 
                INNER JOIN teach ON brick.b_code = teach.b_code WHERE teach.c_no = {$c_no} AND teach.t_no = {$t_no}";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        $row = mysqli_fetch_row($result);
        
        foreach($row as $brick) {
            if (!isset($brick)){
                break;
            }

            $j = $brick % 10;
            $i = ($brick - $j) / 10;

            $block[$i][$j] = 1;
        }
    }
    mysqli_close($conn);
    return $block;
}
?>