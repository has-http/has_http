<div class="check_subj">
            <table border="2" width="100%" height="230" bordercolor="#000">
                <thead>
                    <tr align="center" bgcolor="#298168">
                        <th colspan="6"> 현재 시간표 </th>
                    </tr>
                    <tr align="center" bgcolor="#30977a">
                        <td>  </td>
                        <th>월</th> 
                        <th>화</th>
                        <th>수</th>
                        <th>목</th>
                        <th>금</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("../lib/sub_list.php");
                        writeSubjectTable(get_block(get_demand_list($_SESSION['user_id'])));
                        
                    ?>

                    
                </tbody>
            </table>
        </div>
        <?php
            require_once('../lib/demand_func.php');
            $probability = get_probability_improved(get_teach_dict(), get_demand_tno());
            if ($probability >= 0){
                echo '<h1 style="margin:30px 0 50px 260px;">다음 시간표를 수강신청하는 데 성공할 확률은 ' . $probability* 100 . ' % 입니다.</h1>';
            }
        ?>
    </div>

</body>
</html>
