<?php 
    require('../view/demand_top.php');
    /*$id = $_SESSION['user_id'];
    $result = custom_query("SELECT count(c_no) FROM demand WHERE s_id = '{$id}' AND t_no IS NOT Null"); //과목을 하나 이상 담았으면
    $count = mysqli_fetch_row($result)[0];
    if ($count >= 1){
        require('../view/demand_shopping_bag.php');
    }*/
    require('../view/demand_bottom.php');
?>