<?php
if(isset($_SESSION)) 
{ 
    session_destroy(); 
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>로그인</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/loginStyle.css">
</head>
<body>
    <div>
        <h1>HTTP</h1>
        <h2>Has TimeTable Project</h2>
    </div>
     <div class="login">
         <form action="login_process.php" method="POST">  <!-- 향후 수정 -->
             <input type="text" name="user_id" class="text-field" placeholder="아이디(이메일 주소)">
             <input type="password" name="password" class="text-field" placeholder="비밀번호">
              <input type="submit" value="LOGIN" class="submit-btn" >
          </form>
            
         <div class="links">
             <a href="login_process.php">회원가입</a>
             <a href="login_process.php">비밀번호를 잊어버리셨나요?</a>
        </div>
        <div class = "g_id_signin"
            data-type="icon"
            data-logo_alignment="center"
            data-theme="outline"> 
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <div id="g_id_onload"
      data-client_id="322197737705-ibo2f1h9of611g71k832uo8u7bt6mlmp.apps.googleusercontent.com"
      data-callback="handleCredentialResponse">
    </div>
    
    <div class="g_id_signout"></div>

    <script>
      function handleCredentialResponse(response) {
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', 'login_process.php');
        var hiddenField = document.createElement('input');
        hiddenField.setAttribute('type', 'hidden');
        hiddenField.setAttribute('name', 'id_token');
        hiddenField.setAttribute('value', response.credential);
        form.appendChild(hiddenField)
        document.body.appendChild(form);
        form.submit();
      }
    </script>

    <script>
      function parseJwt (token) {
          var base64Url = token.split('.')[1];
          var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
              return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
          }).join(''));

          return JSON.parse(jsonPayload);
      };
      function onSignout() {
        google.accounts.id.disableAutoSelect();
      }
    </script>
</body>
</html>