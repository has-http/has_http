<?php
require_once 'lib/vendor/autoload.php';

// Get $id_token via HTTPS POST.
$CLIENT_ID = "322197737705-ibo2f1h9of611g71k832uo8u7bt6mlmp.apps.googleusercontent.com";
if (!isset($_POST['id_token'])){
    if (isset($_POST['password'])){
      /*
      if($_POST['password'] == 'HS203!bn'){ //디버깅용
        session_start();
        $_SESSION['user_id'] = $_POST['user_id'];
        header("Location: ../home/home2.php");
        exit;
      }
      else{
        echo "<script>alert('자체 로그인 기능은 아직 구현되지 않았습니다 구글 로그인을 이용해주세요');";
        echo "window.location = 'login.php';</script>"; 
      }
      */
      echo "<script>alert('자체 로그인 기능은 아직 구현되지 않았습니다 구글 로그인을 이용해주세요');";
      echo "window.location = 'login.php';</script>"; 
    }
    else{
        echo "<script>alert('잘못된 접근입니다 구글 로그인을 이용해주세요');";
        echo "window.location = 'login.php';</script>";
    }
}
$id_token = $_POST['id_token'];
$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($id_token);
if ($payload) {
  if ($payload['email_verified'] == true and isset($payload['hd']) and $payload['hd'] == 'hana.hs.kr'){
    require_once("../lib/utill.php");

    session_start();
    $conn = mysql_connect();

    $user_id = $payload['email'];
    $user_id = explode('@', $user_id)[0];

    $_SESSION['isLogin'] = time();
    $_SESSION['user_id'] = $user_id;


    $temp = custom_query("SELECT * FROM student WHERE s_id = '".$user_id."'");
    $result = mysqli_fetch_array($temp);
    if (!isset($result)) {
      $temp = custom_query("INSERT INTO student VALUES ('".$user_id ."', '_','_','0');"); // 학생 부가 데이터는 향후 추가
      $result = mysqli_fetch_array($temp);
    }
    header("Location: ../home/home2.php");
    exit;
  }
  else{
    echo "<script>alert('하나고 구글 계정을 사용해주세요');";
    echo "window.location = 'login.php';</script>";
  }
} else {
  echo "<script>alert('잘못된 접근입니다');";
  echo "window.location = 'login.php';</script>";
}
exit;

/*
if (isset($_POST['password']) and $_POST['password'] != 'hbv6398!!'){
    header("Location: login.php");
    exit;
}*/

?>