<?php
if (isset($_COOKIE['id'])){
    require_once("../lib/utill.php");
    $c_no = $_POST['c_no'];
    $s_id = $_COOKIE['id'];
    $conn = mysql_connect();
    if ($_POST['submit_input'] == "수강 신청"){
        if (empty($_POST['t_no'])){
            echo "<script>alert('버튼을 클릭하여 신청을 해주세요.');window.location = './enrollment.php';</script>";
        }
        else{
            $sql = "Delete From enroll WHERE s_id ='{$s_id}' AND c_no={$c_no}";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $sql = "INSERT INTO enroll values ('".$s_id."', '".$_POST['c_no'] . "', '" . $_POST['c_name'] . "', '" . $_POST['t_no'] . "')";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            mysqli_close($conn);
            echo "<script>alert('성공적으로 신청되었습니다.');window.location = './enrollment.php';</script>";
        }
    }
    else if ($_POST['submit_input'] = "신청 취소"){
            $sql = "Delete From enroll WHERE s_id ='{$s_id}' AND c_no={$c_no}";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            mysqli_close($conn);
            echo "<script>alert('성공적으로 취소되었습니다.');window.location = './enrollment.php';</script>";
    }

}  
else{
    echo "<script>alert('로그인 해주세요.');window.location = '../member/login.html';</script>";
}
?>
