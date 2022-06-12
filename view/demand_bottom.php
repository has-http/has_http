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
    </div>

</body>
</html>
