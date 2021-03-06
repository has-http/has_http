<?php
require_once('utill.php');
function get_enroll_list($id){
    /*
    return : array[c_no] = t_no
    */
    $sql = "SELECT c_no, t_no FROM enroll WHERE s_id='".$id."';";
    $result = custom_query($sql);
    $enroll_list = array();
    while($row = mysqli_fetch_assoc($result)) {
        $enroll_list[$row['c_no']] = $row['t_no'];
    }

    return $enroll_list;
}

function get_demand_list($id){
    /*
    return : array[c_no] = t_no
    */
    $sql = "SELECT c_no, t_no FROM demand WHERE s_id='".$id."';";
    $result = custom_query($sql);
    $enroll_list = array();
    while($row = mysqli_fetch_assoc($result)) {
        $enroll_list[$row['c_no']] = $row['t_no'];
    }

    return $enroll_list;
}


function get_block($base_list) {

    /*
    block[i][j] => (j+1)요일 (i+1)교시의 과목 이름이 들어간 이중리스트 작성
    parameter : $subj_applied : 신청한 c_no가 key, t_no가 value인 연관배열
    */
    
    $conn = mysql_connect();
    $block = array_fill(0, 7, array_fill(0, 5, null));

    foreach ($base_list as $c_no => $t_no){
        if (!isset($t_no)){
            continue;
        }
        $sql = "SELECT c_name, b_code FROM teach WHERE c_no='".$c_no."' AND t_no='".$t_no."'";
        
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        $row = mysqli_fetch_assoc($result);

        $c_name = $row['c_name'];
        $b_code = $row['b_code'];

        $sql = "SELECT b_1, b_2, b_3, b_4 FROM brick WHERE b_code='".$b_code."'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);

        
        foreach($row as $brick) {
            if (!isset($brick)){
                break;
            }

            $j = $brick % 10;
            $i = ($brick - $j) / 10;

            $block[$i][$j] = $c_name;
        }
    }
    mysqli_close($conn);
    return $block;
}

function writeSubjectTable($block) {  // block 리스트 기반 table 작성
    for ($i=0; $i<7; $i++){
        echo "<tr><td>".($i+1)."교시 </td>";
        for ($j=0; $j<5; $j++){
            echo "<td>";
            echo $block[$i][$j];
            echo "</td>";                                
        }
        echo "</tr>";
    }
}

function writeSubinfoTable($classification_array){  //subinfo.php에 들어갈 표 작성
    require_once('../lib/utill.php');
    require_once('../lib/member_func.php');
    $demand_cno = get_demand_cno();
    $conn = mysql_connect();

    foreach ($classification_array as $class){
        $result = query_conn($conn, "SELECT count(c_no) FROM course WHERE c_classify = '{$class}';");
        $count = mysqli_fetch_row($result)[0];
        echo "<tr><td rowspan='{$count}' style='font-weight:bold;'>{$class}</td>";

        $result = query_conn($conn, "SELECT c_no, c_name, c_count FROM course WHERE c_classify = '{$class}';");
        $row = mysqli_fetch_row($result);
        
        if (isset($row)){
            $c_no = $row[0];
            $c_name = $row[1];
            $c_count = $row[2];
            
            echo "<td colspan='4'>{$c_name}</td> <td>{$c_count}</td> <td>
                <input type='checkbox' name='subj[]' value={$c_no}";
            if (in_array($c_no, $demand_cno)){
                echo " checked";
            }
            echo "></td>"; // 첫 행은 <tr> 빠짐
            while($row = mysqli_fetch_row($result)){  
                $c_no = $row[0];
                $c_name = $row[1];
                $c_count = $row[2];
                
                echo "<tr><td colspan='4'>{$c_name}</td> <td>{$c_count}</td> <td>
                    <input type='checkbox' name='subj[]' value={$c_no}";
                if (in_array($c_no, $demand_cno)){
                    echo " checked";
                }
                echo "></td></tr>";
            }
        }
       
    }
    mysqli_close($conn);
}

function get_blockDicionary() { // 4A3 => 월12 금12같은 것 알려주는 array 반환
    require_once('utill.php');
    $block_dic = array();

    $result = custom_query("SELECT b_code, b_time FROM brick");
    while ($row = mysqli_fetch_row($result)){
        $b_code = $row[0];
        $b_time = $row[1];
        $block_dic[$b_code] = $b_time;
    }
    return $block_dic;
}


                        
?>