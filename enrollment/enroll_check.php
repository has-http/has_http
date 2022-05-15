<!DOCTYPE html>
<html lang="ko">
<head>
    <title>과목 확인</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/enroll_checkStyle.css">
</head>
<body>
    <?php require('../view/menu.php'); ?>
    <div class="sidebar">
        <header> 수강신청 </header>
        <ul>
            <li><a href="enrollment.php">수강신청하기</a></li>
            <li><a href="enroll_content.php">수강신청 내역</a></li>
            <li><a href="enroll_check.php">과목확인</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="content">
            <h1>과목확인</h1>
            <table border="2" bordercolor="#000" style="width:1000px;table-layout:fixed;word-break:break-all;margin-top:30px;">
                <thead>
                    <tr align="center" bgcolor="#30977a">
                        <th>교과영역</th>
                        <th colspan="2">과목군</th>
                        <th colspan="6">이수과목</th>
                        <th>최소 이수<br>단위</th>
                        <th>이수단위</th>
                        <th>이수확인</th>
                    </tr>
                    <tr>
                        <td rowspan="4">기초영역</td>
                        <td colspan="2">국어</td>
                        <td colspan="6">국어(6), 심화국어(4)</td>
                        <td>10</td>
                        <td>10</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">수학</td>
                        <td  colspan="6">기하(4), 미적분학I(4), 수학(6)</td>
                        <td>10</td>
                        <td>14</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">영어</td>
                        <td colspan="6">심화영어독해II(4), 영미문학읽기(4), 영어(6)</td>
                        <td>10</td>
                        <td>14</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">한국사</td>
                        <td colspan="6">한국사(6)</td>
                        <td>6</td>
                        <td>6</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td rowspan="2">탐구영역</td>
                        <td colspan="2">사회</td>
                        <td colspan="6">경제(4), 통합사회(6)</td>
                        <td>10</td>
                        <td>10</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">과학</td>
                        <td colspan="6">고전역학(4), 과학탐구실험(2), 물리학I(3), 유기화학(4)</td>
                        <td>12</td>
                        <td>13</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td rowspan="2">체육/예술</td>
                        <td colspan="2">체육</td>
                        <td colspan="6">스포츠생활(2), 운동과건강(4), 체육(4)</td>
                        <td>12</td>
                        <td>10</td>
                        <td>미이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">예술</td>
                        <td colspan="6">매체미술(4), 미술(3), 음악(3)</td>
                        <td>6</td>
                        <td>10</td>
                        <td>이수</td>
                    </tr>
                    <tr>
                        <td rowspan="2">생활/교양</td>
                        <td colspan="2">제2외국어</td>
                        <td colspan="6">중국어I(6)</td>
                        <td rowspan="2">12</td>
                        <td rowspan="2">12</td>
                        <td rowspan="2">이수</td>
                    </tr>
                    <tr>
                        <td colspan="2">예술</td>
                        <td colspan="6">매체미술(4), 미술(3), 음악(3)</td>
                    </tr>
                    <tr bgcolor="#EADEB6">
                        <td colspan="3">이수단위합계</td>
                        <td colspan="6">이수과목합계</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>