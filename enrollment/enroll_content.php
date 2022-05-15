<!DOCTYPE html>
<html lang="ko">
<head>
    <title>수강신청 내역</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <link rel="stylesheet" href="../CSS/enroll_contentStyle.css">
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
            <h1>수강신청 내역</h1>
            <table border="2" bordercolor="#000" style="width:1000px;table-layout:fixed;word-break:break-all;">
                <thead>
                    <tr align="center" bgcolor="#298168">
                        <th colspan="7"> 수강신청 내역 </th>
                    </tr>
                    <tr align="center" bgcolor="#30977a">
                        <th colspan="2">과목명</th>
                        <th>단위수</th>
                        <th>분반</th>
                        <th colspan="2">요일</th>
                        <th>신청취소</th>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">프로그래밍</td>
                        <td align="center">2</td>
                        <td align="center">1</td>
                        <td align="center" colspan="2">목12</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">고전역학</td>
                        <td align="center">4</td>
                        <td align="center">2</td>
                        <td align="center" colspan="2">월5화7목34</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">통합수학</td>
                        <td align="center">4</td>
                        <td align="center">1</td>
                        <td align="center" colspan="2">월67수34</td>
                        <td></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
</body>
</html>