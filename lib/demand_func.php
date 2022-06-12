<?php
function get_teach_dict(){ 
    /*확률 계산 시 쿼리 중복을 피하기 위한 teach_dict 생성
    teach_dict[$c_no][$t_no] = (t_dem, t_max)
    */
    require_once('utill.php');
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

function get_probability($teach_dict, $demand_arr){
    require_once('utill.php');
    $proballity = 1;
    foreach ($demand_arr as $c_no => $t_no){
        if (!isset($t_no)){
            return -1;
        }
        $temp = $teach_dict[$c_no][$t_no];
        $t_dem = $temp[0];
        $t_max = $temp[1];
        if ($t_max < $t_dem){
            $proballity *= $t_max / $t_dem;
        }
    }
    return $proballity;
}

function get_probability_improved($teach_dict, $demand_arr){ //개선된 것
    require_once('utill.php');
    $proballity = 1;
    foreach ($demand_arr as $c_no => $t_no){
        if (!isset($t_no)){
            return -1;
        }
        $temp = $teach_dict[$c_no][$t_no];
        $t_dem = $temp[0];
        $t_max = $temp[1];

        $sql = "SELECT count(s_id) FROM demand WHERE c_no = {$c_no} AND t_no = {$t_no}";
        $demand_count = mysqli_fetch_row(custom_query($sql))[0];

        $x = $teach_dict[$c_no]['count'];
        $temp2 = ($t_max * $x) - $demand_count;

        $virtual_num = ($temp2 - ($temp2 % $x)) / $x;
        
        $t_dem += $virtual_num;
        
        if ($t_max < $t_dem){
            $proballity *= $t_max / $t_dem;
        }
    }
    return $proballity;
}
?>