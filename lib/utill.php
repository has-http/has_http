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
?>