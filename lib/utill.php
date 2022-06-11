<?php
function mysql_connect(){
    // 나중에 DB 변경할 때 편하게 바꾸기 위한 함수
    return mysqli_connect('localhost', 'root', '', 'test_schema2', '3306');
}

function custom_query($sql){
    $conn = mysql_connect();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    return $result;
}

function query_conn($conn, $sql){ // conn을 매번 껐다 켰다 하지 않는 함수
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    return $result;
}

function db_index_sort($db_name, $index_name){
    $conn = mysql_connect();
    $sql =  "SET @count=0; UPDATE {$db_name} SET {$index_name}=@count:=@count+1;";
    mysqli_multi_query($conn, $sql);
}
?>