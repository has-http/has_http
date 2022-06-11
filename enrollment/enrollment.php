<?php 
    require('../view/enroll_top.php');
    $id = $_SESSION['user_id'];
    $result = custom_query("SELECT count(table_index) FROM timetable_index WHERE s_id = '{$id}';");
    $count = mysqli_fetch_row($result)[0];
    if ($count == 1){
        require('../view/shopping_bag.php');
    }
    require('../view/enroll_bottom.php');
?>