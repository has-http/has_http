<?php
function get_demand_cno(){ // 수요조사에 응답한 c_no 반환
    require_once('utill.php');
    verify_id();
    $s_id = $_SESSION['user_id'];
    $result = custom_query("SELECT c_no FROM demand WHERE s_id='{$s_id}'");
    $demand_array = array();
    while ($row = mysqli_fetch_row($result)){
        array_push($demand_array, $row[0]);
    }

    return $demand_array;
}

function verify_id(){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    if (!isset($_SESSION['isLogin'])){
        session_destroy();
        echo "<script>alert('로그인 해주세요.');window.location = '../member/login.php';</script>";
    }
    else{
        return True;
    }
}
?>