<?php
require_once('../lib/utill.php');
if (isset($_POST["submit_input"])){
    $conn = mysql_connect();
    $s_id = $_COOKIE['id'];
    query_conn($conn, "DELETE FROM demand WHERE s_id = '{$s_id}';");
    query_conn($conn, "DELETE FROM enroll WHERE s_id = '{$s_id}';");
    $sub_array = $_POST["subj"];
    foreach($sub_array as $c_no){
        query_conn($conn, "INSERT INTO demand (s_id, c_no) VALUES ('{$s_id}', '{$c_no}')");
    }


    mysqli_close($conn);

    echo "<script>alert('성공적으로 입력되었습니다.');window.location = 'enroll_subjinfo.php';</script>";
}

else{
    echo "<script>alert('오류 발생 관련자에게 문의하세요');window.location = 'enroll_subjinfo.php';</script>";
}

?>