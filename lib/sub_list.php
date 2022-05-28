<?php

    function get_enroll_list($id){
        /*
        return : array[c_no] = t_no
        */
        $conn = mysqli_connect('localhost', 'root', '', 'test_schema2', '3306');
        $sql = "SELECT c_no, t_no FROM enroll WHERE s_id='".$id."';";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $enroll_list = array();
        while($row = mysqli_fetch_assoc($result)) {
            $enroll_list[$row['c_no']] = $row['t_no'];
        }

        mysqli_close($conn);

        return $enroll_list;
    }

    function get_block($id) {

        /*
        block[i][j] => (j+1)요일 (i+1)교시의 과목 이름이 들어간 이중리스트 작성
        parameter : $subj_applied : 신청한 c_no가 key, t_no가 value인 연관배열
        */

        $enroll_list = get_enroll_list($id);
        $conn = mysqli_connect('localhost', 'root', '', 'test_schema2', '3306');
        $block = array_fill(0, 7, array_fill(0, 5, null));

        foreach ($enroll_list as $c_no => $t_no){
            $sql = "SELECT c_name, t_time FROM teach WHERE c_no='".$c_no."' AND t_no='".$t_no."'";
            
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            
            $row = mysqli_fetch_assoc($result);

            $c_name = $row['c_name'];
            $t_time = $row['t_time'];

            $sql = "SELECT brick1, brick2, brick3, brick4 FROM brick WHERE t_time='".$t_time."'";
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

    function writeSubjectTable($id) {  // block 리스트 기반 table 작성
        $block = get_block($id);
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
                        
?>