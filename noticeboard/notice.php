<?php 
require_once('../lib/member_func.php'); verify_id(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>공지사항</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/qnaStyle.css">
</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> 공지사항 </header>
    </div>
    <div class="main">
        <h1 class="qna-heading">공지사항</h1>
        <section class="qna-container">
            <h4 class="qna-page">[전교생] 2022 2학기 수강과목 확정조사 안내</h1>
            <div class="qna-body">
                <p> 1. 기간: 6월 9일 목요일 ~ 6월 10일 금요일 23:59 
                    <br>2. 방법: 인트라넷 [수강신청] 메뉴에서 수강과목들을 신청
                    <br>3. 주의사항: 확정조사 기간에 제시되는 시간표 블록, 분반 수는 임시로 설정한 것입니다.
                    <br>             따라서 선착순이 아니며, 모든 블록에 모든 수업이 열려있습니다.
                    <br>             확정조사 단계에서 실제 수강신청을 "연습"한다고 생각하시면 됩니다. 
                </p>
            </div>
            <hr class="hr-line">
            <h4 class="qna-page">2022학년도 2학기 1차 과목 수요조사 안내 (5/31까지) </h1>
            <div class="qna-body">
                <p> 모든 학생들은 기한 내 꼭 참여하기 바랍니다. <br> *기간: 5월 30일(월) ~ 5월 31일(화) 23:59 <br>*방법: 구글 설문조사(반드시 하나고 계정으로 로그인하여 링크 접속) <br>*주의사항: 모든 영역의 단위수가 졸업 이수 요건을 충족하는지 반드시 확인할 것</p>
            </div>
            <hr class="hr-line">
            <h4 class="qna-page">[12기, 13기] 교육과정설명회 질의응답</h1>
                <div class="qna-body">
                    <p>지난 5월에 있었던 교육과정설명회에서 문의주셨던 질문들을 모아 각 학과와 부서에서 답변을 정리하였습니다. <br> 교육과정에 대한 이해에 도움이 되셨으면 좋겠습니다. <br> 감사합니다. </p>
                </div>
            <hr class="hr-line">
        </section>
    </div>
    <script src="../JS/qna.js"></script>
</body>
</html>
