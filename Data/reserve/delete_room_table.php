<?
include ("config.php");
if ($work=="delete_room" && !empty($PHP_AUTH_USER)) {
     for ($i=0;$i<count($delete_room);$i++){

           $query_delete="delete from $roomtable where room='$delete_room[$i]'";   //刪除勾選的教室
           $result = mysql_query($query_delete,$link) or die ("Invalid delete query");

           $query_delete_table="drop table $delete_room[$i]";                    //刪除教室資料表
           $result = mysql_query($query_delete_table,$link) or die ("Invalid delete table query");
     }
}
?>

<html>
<BODY bgcolor="#384D94" background="images/background.gif">

<form action="delete_room_table.php" method="get">
<div align="center">
  <center>
<table border="1" style="border-collapse: collapse" bordercolor="#000080" cellpadding="6" cellspacing="0">
<tr>
     <td width="30%" bgcolor="#97DDFF"><font color="#000080">教室名稱或編號</font></td>
     <td width="60%" bgcolor="#97DDFF"><font color="#000080">教室位置、設備、軟體描述</font></td>
     <td width="10%" bgcolor="#97DDFF"><font color="#000080">刪除</font></td>
</tr>
<?
include ("config.php");
$str = "SELECT * FROM $roomtable";
$result = mysql_query($str,$link);
while ($row = mysql_fetch_row($result)) {
        list($room,$detail) = $row;
        echo "<tr>";
        echo "<td width=\"30%\"><font color=\"#000080\">$room</font></td>";
        echo "<td width=\"60%\"><font color=\"#000080\">$detail</font></td>";
        echo "<td width=\"10%\"><input type=checkbox name=delete_room[] value=\"$room\"></td>";
        echo "</tr>";
}
?>
</table>
  </center>
</div>
<input type=hidden name='work' value='delete_room'>
<p align="center"> <input type="submit" value="刪除勾選教室" name="B1">&nbsp;&nbsp;&nbsp;
<input type="reset" value="清除勾選教室" name="B2"></form>

</body>
</html>