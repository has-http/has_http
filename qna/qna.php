<?php 
require_once('../lib/member_func.php'); verify_id(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>QnA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/qnaStyle.css">
</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> QnA </header>
    </div>
    <div class="main">
        <h1 class="qna-heading">QnA</h1>
        <section class="qna-container">
            <h4 class="qna-page">수강신청 페널티 제도에 대해 궁금합니다</h1>
            <div class="qna-body">
                <p>수업 및 방과후 수업 만족도조사, 과목 수요조사 등 학교에서 필수로 요구하는 설문조사에 참여하지 않았을 경우 10분 페널티가 부여됩니다. </p>
            </div>
            <hr class="hr-line">
            <h4 class="qna-page">2022학년도 2학기 수강신청은 언제인가요?</h1>
                <div class="qna-body">
                    <p>2022년 7월에 예정되어있습니다. 자세한 일정은 공지를 참고하세요.</p>
                </div>
            <hr class="hr-line">
            <h4 class="qna-page">"장바구니" 기능은 무엇인가요?</h1>
                <div class="qna-body">
                    <p>'시간표' > '시간표 조합 생성' 페이지에서 본인이 선택한 과목을 기반으로 가능한 모든 시간표 조합을 확인할 수 있습니다. 그중 본인이 원하는 조합의 시간표를 '저장'할 경우 '수강신청' > '수강신청하기' 페이지에서 장바구니 기능 사용이 가능합니다. 
                        <br> 이는 본인이 선택한 시간표 조합의 과목 및 분반을 한꺼번에 선택할 수 있어, 과목별로 각각 분반을 선택하지 않아도 된다는 이점이 있습니다. </p>
                </div>
            <hr class="hr-line">    
        </section>
    </div>
    <script src="../JS/qna.js"></script>
</body>
</html>
