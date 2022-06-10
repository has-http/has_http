<!DOCTYPE html>
<html lang="ko">
<head>
    <title>과목 선택</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/enroll_subjInfoStyle.css">
</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> 수강신청 </header>
        <ul>
            <li><a href="enrollment.php">수강신청하기</a></li>
            <li><a href="enroll_subjInfo.php">과목 선택</a></li>
            <li><a href="enroll_pre.php">pre-수강신청</a></li>
        </ul>
    </div>
    <div class="main">
        <h1>과목 선택</h1>
        <h2>본인이 수강하는 과목만 정확하게 선택한 후, "과목 선택" 버튼을 눌러주세요</h2>
        <div class="choose_subj">
            <div class="choose_subjL">
                <table border="2" bordercolor="#000">
                    <thead>
                        <tr bgcolor="#298168">
                            <th>교과</th>
                            <th colspan="4">과목명</th>
                            <th>단위수</th>
                            <th>선택</th>
                        </tr>
                        <?php
                            $classification_arrayL = array('국어', '영어', '제2외국어', '수학', '교양', '체육');
                            require_once('../lib/sub_list.php');
                            writeSubinfoTable($classification_arrayL);
                        ?>
                        <!--
                        <tr><td rowspan="3" style="font-weight:bold;">국어</td><td colspan="4">심화 국어</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">고전읽기</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">현대문학감상</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="4" style="font-weight:bold;">영어</td><td colspan="4">심화 영어 I</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">심화 영어 작문 I</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">시사영어</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">영어 비평적 읽기와 쓰기</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="3" style="font-weight:bold;">제2외국어</td><td colspan="4">중국 언어와 문화</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">일본 문화</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">중국어 독해와 작문 I</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="6" style="font-weight:bold;">수학</td><td colspan="4">응용수학탐구</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">수학적 사고와 통계</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">통합수학 I</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">수학세미나 I</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">수학 과제연구</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">AP 미적분학</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td style="font-weight:bold;">교양</td><td colspan="4">심리학</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="2" style="font-weight:bold;">체육</td><td colspan="4">스포츠 생활(남)</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">스포츠 생활(여)</td><td>2</td><td><input type="checkbox"></td></tr>
                        -->                       
                    </thead>
                </table>
            </div>

            <div class="choose_subjR">
                <table border="2" bordercolor="#000">
                    <thead>
                        <tr bgcolor="#298168">
                            <th>교과</th>
                            <th colspan="4">과목명</th>
                            <th>단위수</th>
                            <th>선택</th>
                        </tr>
                        <?php 
                            $classification_arrayR = array('사회', '과학', '예술');
                            writeSubinfoTable($classification_arrayR);
                        ?>
                        <!--
                        <tr><td rowspan="5" style="font-weight:bold;">사회</td><td colspan="4">생활과 윤리</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">사회문화</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">비교문화</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">국제 경제</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">AP 세계사</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="9" style="font-weight:bold;">과학</td><td colspan="4">응용물리학탐구</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">응용화학탐구</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">응용생명과학탐구</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">응용지구과학탐구</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">고전역학</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">유기화학</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">고급 생명과학</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">에너지환경과학</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">프로그래밍</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td rowspan="4" style="font-weight:bold;">예술</td><td colspan="4">음악사</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">미술사</td><td>2</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">음악 전공 실기</td><td>4</td><td><input type="checkbox"></td></tr>
                        <tr><td colspan="4">매체 미술</td><td>4</td><td><input type="checkbox"></td></tr>
                        -->
                    </thead>
                </table>
            </div>
            <input id="submit_input" name="submit_input"  type="submit" value='과목 선택'>
        </div>
    </div>
</body>
</html>