<?
include ("config.php");
if ($work=="create_room" && !empty($PHP_AUTH_USER)) {
   if (empty($room)) {
         echo "教室名稱或編號欄空白，請回上一頁重新輸入";
         exit;
   }

   //建立各別教室資料表

   $query="create table $room(
        classdate date not null,
        weekday tinyint not null,
        onedayorder tinyint not null,
        class varchar(20) not null,
        teacher varchar(20) not null,
        subject varchar(20) not null,
        whobook varchar(20) not null,
        primary key(classdate,weekday,onedayorder));";
   $result=mysql_query($query,$link) or die ("Unable to create classroom table");

   $query_insert="insert into $roomtable (room,detail) values ('$room','$detail')";      //將教室名及描述記錄
   $result = mysql_query($query_insert,$link) or die ("Invalid insert query");
}
?>
<html>
<head><title>建立教室資料表</title></head>
<body bgcolor="#345998" background="images/background.gif">
<p align="center"><font color=FF0000>教室資料僅能建立一次，且教室編號不能重複<br>
若重複建立將有導致資料庫資料遺失的危險！</font></p>
<p align="center"><font color="#000080">目前已建立資料表之教室</font></p>
<div align="center">
  <center>
<table border="1" cellpadding="5" bordercolor="#000080" cellspacing="0" style="border-collapse: collapse">
<tr>
        <td width="360" bgcolor="#97DDFF"><font color="#000080" size="2">教室名稱或編號</font></td>
        <td width="450" bgcolor="#97DDFF"><font color="#000080" size="2">教室位置、設備、軟體描述</font></td>
</tr>

<?
  include ("config.php");
  $str = "SELECT * FROM $roomtable";
  $result = mysql_query($str,$link);

  while ($row = mysql_fetch_row($result)) {
        list($room,$detail) = $row;
        echo "<tr>";
        echo "<td width=\"360\"><font color=\"#000080\">$room</font></td>";
        echo "<td width=\"450\"><font color=\"#000080\">$detail</font></td>";
        echo "</tr>";
  }
?>
</table>

  </center>
</div>

<br>

<p align="center"><font color="#000080">建立新的教室資料表</font></p>

<form method="POST" action="create_room_table.php">
  <input type=hidden name='work' value='create_room'>
  <div align="center">
  <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#000080" height="205" >
    <tr>
      <td width="360" align="left" valign="top" bgcolor="#97DDFF">
      <font color="#000080" size="2">教室名稱或編號：</font><p>
      <font color="#000080" size="2">(請輸入英文、數字之編號，如3A。</font><b><font color="#FF0000" size="2">不可用&quot;中文&quot;或&quot;純數字</font></b><font color="#FF0000" size="2">&quot;</font><font color="#000080" size="2">。此編號將為教室資料表之名稱)</font></td>
      <td width="450" bgcolor="#97DDFF"><font color="#000080" size="2">教室位置、設備、軟體描述：</font><p>
      <font color="#000080" size="2">(例如：生活科技館三樓，CPU
      Celeron_600，128 MB RAM...。若需換行請於每行末自行加入&lt;br&gt; tag)</font></td>
    </tr>
    <tr>
      <td width="360" align="left" height="95">
      <input type="text" name="room" size="31"></td>
      <td width="450" height="95"><textarea rows="5" name="detail" cols="47"></textarea></td>
    </tr>
    <tr>
      <td height="28" colspan="2">
      <p align="center"><input type="submit" value="建立教室資料表">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" value="清除重寫"></td>
    </tr>
  </table>

  </div>

</form>
</body>
</html>