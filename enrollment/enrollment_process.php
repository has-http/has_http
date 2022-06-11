<?php
session_start();
if (isset($_SESSION['user_id'])){
    require_once("../lib/utill.php");
    $conn = mysql_connect();
    $s_id = $_SESSION['user_id'];
    
    if (isset($_POST['c_no'])){ //enrollment_process.php에서 넘어옴
        if (empty($_POST['t_no'])){
            echo "<script>alert('버튼을 클릭하여 과목을 선택해주세요.');window.location = './enrollment.php';</script>";
            exit();
        }
        $c_no = mysqli_real_escape_string($conn, $_POST['c_no']);
        $t_no = mysqli_real_escape_string($conn, $_POST['t_no']);
        $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    }

    else if(isset($_POST['t_no/c_no/c_name'])){ //enrollment.php 에서 넘어옴
        $tcc = mysqli_real_escape_string($conn, $_POST['t_no/c_no/c_name']);
        $tcc_array = explode('/', $tcc);
        $t_no = $tcc_array[0];
        $c_no = $tcc_array[1];
        $c_name = $tcc_array[2];
    }

    else{
        echo "<script>alert('fatal error');window.location = './enrollment.php';</script>";
    }

    if ($_POST['submit_input'] == "수강 신청"){

        $sql = "Delete From enroll WHERE s_id ='{$s_id}' AND c_no={$c_no}";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $sql = "INSERT INTO enroll (s_id, c_no, c_name, t_no) values ('".$s_id."', '".$c_no . "', '" . $c_name . "', '" . $t_no . "')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        db_index_sort('enroll', 'e_index');
        mysqli_close($conn);
        echo "<script>alert('성공적으로 신청되었습니다.');window.location = './enrollment.php';</script>";
        }

    else if ($_POST['submit_input'] = "신청 취소"){
            $sql = "Delete From enroll WHERE s_id ='{$s_id}' AND c_no={$c_no}";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            db_index_sort('enroll', 'e_index');
            mysqli_close($conn);
            echo "<script>alert('성공적으로 취소되었습니다.');window.location = './enrollment.php';</script>";
    }
    else{
        echo "<script>alert('fatal error');window.location = './enrollment.php';</script>";
    }
} 

else{
    echo "<script>alert('로그인 해주세요.');window.location = '../member/login.php';</script>";
}
?>
