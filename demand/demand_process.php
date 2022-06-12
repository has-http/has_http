<?php
session_start();
if (isset($_SESSION['user_id'])){
    require_once("../lib/utill.php");
    $conn = mysql_connect();
    $s_id = $_SESSION['user_id'];
    
    if (isset($_POST['c_no'])){ //demand_process.php에서 넘어옴
        if (empty($_POST['t_no'])){
            echo "<script>alert('버튼을 클릭하여 과목을 선택해주세요.');window.location = './demand.php';</script>";
            exit();
        }
        $c_no = mysqli_real_escape_string($conn, $_POST['c_no']);
        $t_no = mysqli_real_escape_string($conn, $_POST['t_no']);
    }

    else if(isset($_POST['t_no/c_no'])){ //demand.php 에서 넘어옴
        $tcc = mysqli_real_escape_string($conn, $_POST['t_no/c_no']);
        $tcc_array = explode('/', $tcc);
        $t_no = $tcc_array[0];
        $c_no = $tcc_array[1];
    }

    else{
        echo "<script>alert('fatal error');window.location = './demand.php';</script>";
    }

    if ($_POST['submit_input'] == "수강 신청"){
        $sql = "Delete From demand WHERE s_id ='{$s_id}' AND c_no={$c_no}";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $sql = "INSERT INTO demand (s_id, c_no, t_no) values ('".$s_id."', '".$c_no . "', '" . $t_no . "')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $sql = "UPDATE teach SET t_dem = 
                    (SELECT count(s_id) FROM demand WHERE demand.c_no = {$c_no} AND demand.t_no = {$t_no} AND s_id = '{$s_id}') 
                WHERE teach.c_no = {$c_no} AND teach.t_no = {$t_no};";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        mysqli_close($conn);
        echo "<script>alert('성공적으로 신청되었습니다.');window.location = './demand.php';</script>";
        }

    else if ($_POST['submit_input'] = "신청 취소"){
            $sql = "UPDATE demand SET t_no = null WHERE s_id ='{$s_id}' AND c_no={$c_no}";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $sql = "UPDATE teach SET t_dem = 
                    (SELECT count(s_id) FROM demand WHERE demand.c_no = {$c_no} AND demand.t_no = {$t_no} AND s_id = '{$s_id}') 
                    WHERE teach.c_no = {$c_no} AND teach.t_no = {$t_no};";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            mysqli_close($conn);
            echo "<script>alert('성공적으로 취소되었습니다.');window.location = './demand.php';</script>";
    }
    else{
        echo "<script>alert('fatal error');window.location = './demand.php';</script>";
    }
} 

else{
    echo "<script>alert('로그인 해주세요.');window.location = '../member/login.php';</script>";
}
?>
