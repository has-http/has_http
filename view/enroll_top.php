<!DOCTYPE html>
<html>
<head>
    <title>수강신청하기</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/home2Style.css">
    <link rel="stylesheet" href="../CSS/enrollmentStyle.css">
    <script>
        let target = new Date(2022,4,10,12,7,0);
        let now_time = new Date();
        if (target.getTime() > now_time.getTime()) {
            alert("수강신청 기간이 아닙니다.");
            window.location.href = './enroll_check.html';
        }
    </script>
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
        <div class="choose_subj">
            <h1>과목 및 분반 선택</h1>
            <ul>

            <script>
                    function f_click(a){
                        let form = document.createElement('form');
                        form.action = './enrollment_selecSubj.php';
                        form.method = 'POST';
                        
                        form.innerHTML = '<input name="sub_num" value="' + a + '">';

                        document.body.append(form);

                        form.submit();
                    }
                </script>

                <li id=a3001 onclick="f_click(3001)">심화국어</li>
                <li id=a3004 onclick="f_click(3004)">수학세미나</li>
                <li id=a3007 onclick="f_click(3007)">통합수학I</li>
                <li id=a3019 onclick="f_click(3019)">프로그래밍</li>
                <li id=a3021 onclick="f_click(3021)">고전역학</li>
                <li id=a3026 onclick="f_click(3026)">에너지환경과학</li>
                <li id=a3027 onclick="f_click(3027)">스포츠 생활</li>
                <li id=a3023 onclick="f_click(3023)">응용화학탐구</li>
                <li id=a3036 onclick="f_click(3036)">심리학</li>
                
                <style>
                    <?php
                        $conn = mysqli_connect( 'localhost', 'root', '', 'test_schema2', '3306');
                        $sql = "SELECT * FROM enroll WHERE s_id='".$_COOKIE['id']."'";
                        $temp = mysqli_query($conn, $sql);
                        while ($c_no = mysqli_fetch_array($temp)['c_no']) {
                            echo ".choose_subj #a".$c_no."{";
                            echo "background-color : blue;";
                            echo "text-decoration: line-through;";
                            echo "}";
                        }
                    ?>

                </style>

            </ul>
        </div>
