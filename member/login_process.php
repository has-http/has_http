<?php
require_once("../lib/utill.php");
$temp = custom_query("SELECT * FROM student WHERE s_id = '".$_COOKIE['id']."'");
$result = mysqli_fetch_array($temp);
if (!$result) {
 $temp = custom_query("INSERT INTO student VALUES ('".$_COOKIE['id'] ."', '_','_','0');"); // 학생 부가 데이터는 향후 추가
 $result = mysqli_fetch_array($temp);
}
header("Location: ../home/home2.php");
exit;
?>