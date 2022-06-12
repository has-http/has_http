<?php
require_once("../lib/utill.php");
session_start();
$conn = mysql_connect();

$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

$_SESSION['isLogin'] = time();
$_SESSION['user_id'] = $user_id;

$temp = custom_query("SELECT * FROM student WHERE s_id = '".$user_id."'");
$result = mysqli_fetch_array($temp);
if (!isset($result)) {
 $temp = custom_query("INSERT INTO student VALUES ('".$_SESSION['user_id'] ."', '_','_','0');"); // 학생 부가 데이터는 향후 추가
 $result = mysqli_fetch_array($temp);
}
header("Location: ../home/home2.php");
exit;
?>