<?php 
    require('../view/demand_top.php');
    require_once('../lib/demand_func.php');
        $probability = get_probability_improved(get_teach_dict(), get_demand_tno());
        if ($probability >= 0){
            echo '<h1>' . $probability* 100 . ' %</h1>';
        }
    require('../view/demand_bottom.php');
?>