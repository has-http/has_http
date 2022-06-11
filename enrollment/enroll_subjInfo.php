<?php 
require_once('../lib/member_func.php'); verify_id(); 
?>
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
        <h2>본인이 수강하는 과목만 정확하게 선택한 후, "과목 선택" 버튼을 눌러주세요<br>과목 변경 시 시간표 조합은 초기화됩니다</h2>
        <form action = "enroll_process_subinfo.php" method="POST">
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
                        </thead>
                    </table>
                </div>
                <input id="submit_input" name="submit_input"  type="submit" value='과목 선택' >
            </div>
        </form>
    </div>
</body>
</html>