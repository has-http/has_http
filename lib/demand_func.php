<?php
function get_demand_tno($sub_array, $id){
    require_once('utill.php');
    $sql = "SELECT c_no, t_no FROM demand WHERE s_id = '{$id}' AND t_no is not null";
    $result = custom_query($sql);
    $demand_tno = array();
    while ($row = mysqli_fetch_row($result)){
        $c_no = $row[0];
        $t_no = $row[1];
        if (in_array($c_no, $sub_array)){
            array_push($demand_tno, $t_no);
        }

    }
    return $demand_tno;
}
?>