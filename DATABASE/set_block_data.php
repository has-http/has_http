<?php

$conn = mysqli_connect( 'localhost', 'root', '', 'test_schema2', '3306');
$block_dic = array('4A3' => '월12목67', '4B3' => '월34수56', '4C3' => '월5화7목34', '4D3' => '화12목5금7', '4E3' => '화56금12', '4F3' => '수12금34', '4G3' => '월67수34', '4H3' => '화34금56', '2A3' => '목12', '2B3' => '월67', '2C3' => '수34', '2D3' => '화34', '2E3' => '금56');
foreach ($block_dic as $t_time => $t_name){
    $sql = "INSERT INTO brick VALUES ('".$t_time."', '".$t_name."',0,0,0,0);";
    //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));  //필요할 때 주석 풀고
    if($result === false){
        echo mysqli_error($conn);
    }
}

?>