<?php
function insert_subj($sub_array, $id){
    require_once('utill.php');
    $conn = mysql_connect();
    foreach ($sub_array as $c_no){
        $sql = "INSERT INTO demand (s_id, c_no) values ('{$id}', {$c_no})";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    mysqli_close($conn);

}
?>