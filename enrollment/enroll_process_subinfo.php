<?php
require_once('../lib/member_func.php'); 
require_once('../lib/utill.php');
verify_id();
if (isset($_POST["submit_input"]) ){
    if (!isset($_POST['subj'])){
        echo "<script>alert('과목을 입력해주세요');window.location = 'enroll_subjinfo.php';</script>";
        exit;
    }

    $conn = mysql_connect();
    $s_id = $_SESSION['user_id'];
    query_conn($conn, "DELETE FROM demand WHERE s_id = '{$s_id}';");

    query_conn($conn, "DELETE FROM enroll WHERE s_id = '{$s_id}';");
    query_conn($conn, "DELETE FROM fix_subj WHERE s_id = '{$s_id}';");
    $sub_array = $_POST["subj"];

    foreach($sub_array as $c_no){
        $c_no = mysqli_real_escape_string($conn, $c_no);
        query_conn($conn, "INSERT INTO demand (s_id, c_no) VALUES ('{$s_id}', '{$c_no}')");
        query_conn($conn, "INSERT INTO fix_subj (s_id, c_no) VALUES ('{$s_id}', '{$c_no}')");
    }

    query_conn($conn, "UPDATE teach SET t_now = (SELECT count(s_id) FROM enroll WHERE enroll.c_no = teach.c_no AND enroll.t_no = teach.t_no);");
    query_conn($conn, "UPDATE teach SET t_dem = (SELECT count(s_id) FROM demand WHERE demand.c_no = teach.c_no AND demand.t_no = teach.t_no);");

    mysqli_close($conn);

    echo "<script>alert('성공적으로 입력되었습니다.');window.location = 'enroll_subjinfo.php';</script>";
}

else{
    echo "<script>alert('오류 발생 담당자에게 문의하세요');window.location = 'enroll_subjinfo.php';</script>";
}

?>