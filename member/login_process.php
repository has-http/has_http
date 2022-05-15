<?php
$conn = mysqli_connect( 'localhost', 'root', '', 'test_schema2', '3306');
$temp = mysqli_query($conn, "SELECT * FROM student WHERE s_id = '".$_COOKIE['id']."'");
$result = mysqli_fetch_array($temp) or mysqli_error($conn);
if (!$result) {
 $temp = mysqli_query($conn, "INSERT INTO student VALUES ('".$_COOKIE['id'] ."', '_','_','0');"); // 학생 부가 데이터는 향후 추가
 $result = mysqli_fetch_array($temp) or die(mysqli_error($conn));
}
header("Location: ../home/home2.php"); 
?>