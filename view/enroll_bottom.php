<div class="check_subj">
            <table border="2" width="100%" height="230" bordercolor="#000">
                <thead>
                    <tr align="center" bgcolor="#298168">
                        <th colspan="6"> 현재 시간표 </th>
                    </tr>
                    <tr align="center" bgcolor="#30977a">
                        <td style="padding-left: 20px">  </td>
                        <th>월</th> 
                        <th>화</th>
                        <th>수</th>
                        <th>목</th>
                        <th>금</th>
                    </tr>
                </thead>
                <tbody>
                    <script type="text/javascript">
                        for(var i=0; i<7;i++){
                            document.write("<tr>");
                            for(var j=0; j<6; j++){
                                document.write("<td style='padding-left: 160px'>" + "</td>");
                            }
                            document.write("</tr>");
                        }
                    </script>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const main = document.querySelector('.main');
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.height = `${main.clientHeight}px`;
    </script>
</body>
</html>