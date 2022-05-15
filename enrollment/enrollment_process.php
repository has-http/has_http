<?php
if (empty($_POST['t_no'])){
    echo "<script>alert('버튼을 클릭하여 신청을 해주세요.');window.location = './enrollment.php';</script>";
}
else{
    if (isset($_COOKIE['id'])){
        $s_id = $_COOKIE['id'];
    
        $conn = mysqli_connect('localhost', 'root', '', 'test_schema2', '3306');
        $sql = "INSERT INTO enroll values ('".$s_id."', '".$_POST['c_no'] . "', '" . $_POST['c_name'] . "', '" . $_POST['t_no'] . "')";
        $temp = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($temp === false){
            echo mysqli_error($conn);
        }

        echo "<script>alert('성공적으로 신청되었습니다.');window.location = './enrollment.php';</script>";
    }
    else{
        echo "<script>alert('로그인 해주세요.');window.location = '../memeber/login.php';</script>";
    }
}
?>
