<?
include ("config.php");
if ($work=="create_room" && !empty($PHP_AUTH_USER)) {
   if (empty($room)) {
         echo "�ЫǦW�٩νs����ťաA�Ц^�W�@�����s��J";
         exit;
   }

   //�إߦU�O�ЫǸ�ƪ�

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

   $query_insert="insert into $roomtable (room,detail) values ('$room','$detail')";      //�N�ЫǦW�δy�z�O��
   $result = mysql_query($query_insert,$link) or die ("Invalid insert query");
}
?>
<html>
<head><title>�إ߱ЫǸ�ƪ�</title></head>
<body bgcolor="#345998" background="images/background.gif">
<p align="center"><font color=FF0000>�ЫǸ�ƶȯ�إߤ@���A�B�Ыǽs�����୫��<br>
�Y���ƫإ߱N���ɭP��Ʈw��ƿ򥢪��M�I�I</font></p>
<p align="center"><font color="#000080">�ثe�w�إ߸�ƪ��Ы�</font></p>
<div align="center">
  <center>
<table border="1" cellpadding="5" bordercolor="#000080" cellspacing="0" style="border-collapse: collapse">
<tr>
        <td width="360" bgcolor="#97DDFF"><font color="#000080" size="2">�ЫǦW�٩νs��</font></td>
        <td width="450" bgcolor="#97DDFF"><font color="#000080" size="2">�ЫǦ�m�B�]�ơB�n��y�z</font></td>
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

<p align="center"><font color="#000080">�إ߷s���ЫǸ�ƪ�</font></p>

<form method="POST" action="create_room_table.php">
  <input type=hidden name='work' value='create_room'>
  <div align="center">
  <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#000080" height="205" >
    <tr>
      <td width="360" align="left" valign="top" bgcolor="#97DDFF">
      <font color="#000080" size="2">�ЫǦW�٩νs���G</font><p>
      <font color="#000080" size="2">(�п�J�^��B�Ʀr���s���A�p3A�C</font><b><font color="#FF0000" size="2">���i��&quot;����&quot;��&quot;�¼Ʀr</font></b><font color="#FF0000" size="2">&quot;</font><font color="#000080" size="2">�C���s���N���ЫǸ�ƪ��W��)</font></td>
      <td width="450" bgcolor="#97DDFF"><font color="#000080" size="2">�ЫǦ�m�B�]�ơB�n��y�z�G</font><p>
      <font color="#000080" size="2">(�Ҧp�G�ͬ�����]�T�ӡACPU
      Celeron_600�A128 MB RAM...�C�Y�ݴ���Щ�C�楽�ۦ�[�J&lt;br&gt; tag)</font></td>
    </tr>
    <tr>
      <td width="360" align="left" height="95">
      <input type="text" name="room" size="31"></td>
      <td width="450" height="95"><textarea rows="5" name="detail" cols="47"></textarea></td>
    </tr>
    <tr>
      <td height="28" colspan="2">
      <p align="center"><input type="submit" value="�إ߱ЫǸ�ƪ�">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" value="�M�����g"></td>
    </tr>
  </table>

  </div>

</form>
</body>
</html>