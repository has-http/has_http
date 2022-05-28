<?php
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

    $conn = mysqli_connect('localhost', 'root', '', 'test_schema2', '3306');
    $msg_array = array();

    //이미 신청한 분반인지 체크
    $sql = "SELECT EXISTS (SELECT * FROM enroll WHERE s_id='{$id}' AND c_no={$c_no} AND t_no={$t_no});";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);

    if ($row[0] == 1) {
        array_push($msg_array, '신청한 과목');
        return $msg_array;
    } 



    //과목 중복 체크
    $sql = "SELECT EXISTS (SELECT * FROM enroll WHERE s_id='{$id}' AND c_no={$c_no});";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);

    if ($row[0] == 1) {
        array_push($msg_array, "과목 중복");
    }

    //시간 중복 체크
    $sql = "SELECT t_time, t_max FROM teach WHERE c_no={$c_no} AND t_no={$t_no}";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);
    $t_time = $row[0];
    $t_max = $row[1];

    $sql = "SELECT brick1, brick2, brick3, brick4 FROM brick WHERE t_time='".$t_time."'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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

    mysqli_close($conn);

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
?>