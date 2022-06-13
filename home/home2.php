<?php 
require_once('../lib/member_func.php');verify_id(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>하나고등학교 수강신청</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
</head>
<body>
    <?php require('../view/menu.php'); ?>

    <div class="banner"> 
        <div class="inner-list">
            <div class="inner-banner">
                <img src="../image/hana_sample_picture.jpg">
            </div>
            <div class="inner-banner">
                <img src="../image/hana_sample_picture.jpg">
            </div>
            <div class="inner-banner">
                <img src="../image/hana_sample_picture.jpg">
            </div>
            <div class="inner-banner">
                <img src="../image/hana_sample_picture.jpg">
            </div>
        </div>
        <div class="circles">
            <div class="circle circle0 showing_circle"></div>
            <div class="circle circle1"></div>
            <div class="circle circle2"></div>
            <div class="circle circle3"></div>  
        </div>
    </div>

    <script src="../JS/banner.js"></script>

    <div class="information">
        <div class="notice">
            <table>
                <caption>공지사항</caption>
                <thhead>
                    <tr align="center">
                        <th class="num">번호</th>
                        <th class="title">제목</th>
                        <th class="date">등록일</th>
                    </tr>
                </thhead>
    
                <tbody>
                    <tr align="center" bgcolor="white">
                        <td>1</td>
                        <td>[전교생] 2022 2학기 수강과목 확정조사 안내 </td>
                        <td>2022.06.08</td>
                    </tr>
                    <tr align="center" bgcolor="white">
                        <td>2</td>
                        <td> 2022학년도 2학기 1차 과목 수요조사 안내 (5/31까지) </td>
                        <td>2022.05.20</td>
                    </tr>
                    <tr align="center" bgcolor="white">
                      <td>3</td>
                      <td>[12기, 13기] 교육과정설명회 질의응답</td>
                      <td>2022.05.10</td>
                    </tr>
                </tbody>
    
            </table>
        </div>
    
        <div class="subject_table">
            <table>
                <caption>시간표</caption>
                <thhead>
                    <tr align="center">
                        <th class="period">교시</th>
                        <th class="title">월요일</th>
                        <th class="title">화요일</th>
                        <th class="title">수요일</th>
                        <th class="title">목요일</th>
                        <th class="title">금요일</th>
                    </tr>
                </thhead>
    
                <tbody>

                    <?php
                        require("../lib/sub_list.php");
                        writeSubjectTable(get_block(get_enroll_list($_SESSION['user_id'])));
                    ?>
                </tbody>
            </table>
    
    
        </div>
    </div>
    

</body>
</html>
