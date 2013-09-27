<?
include ("config.php");
if ($work=="add_user" && !empty($PHP_AUTH_USER)) {
   if (empty($name)) {
         echo "教師帳號欄空白，請回上一頁重新輸入";
         exit;
   }
   if (empty($passwd)) {
         echo "教師密碼欄空白，請回上一頁重新輸入";
         exit;
   }
   $query_insert="insert into $userstable (name,passwd,chinesename) values ('$name','$passwd','$chinesename')";
   $result = mysql_query($query_insert,$link) or die ("Invalid insert query");
}
?>
<html>
<head><title>新增教師帳號</title></head>
<body bgcolor="#345998" background="images/background.gif">

<p align="center"><font color="#000080">目前已有使用帳號之教師</font></p>
<div align="center">
  <center>
<table border="1" cellpadding="5" bordercolor="#345998" cellspacing="0" style="border-collapse: collapse" width="75%">
<tr>
  <td width="33%" bgcolor="#000080" align="center"><font size="2" color="#97DDFF">教師帳號</font></td>
  <td width="33%" bgcolor="#000080" align="center"><font size="2" color="#97DDFF">密碼</font></td>
  <td width="33%" bgcolor="#000080" align="center"><font size="2" color="#97DDFF">中文姓名</font></td>
</tr>

<?
  include ("config.php");
  $str = "SELECT * FROM $userstable";
  $result = mysql_query($str,$link);

  while ($row = mysql_fetch_row($result)) {
        list($name,$passwd,$chinesename) = $row;
?>
        <tr>
         <td width="33%" align="center"><font color="#000080"><? echo $name;?> </font>　</td>
         <td width="33%" align="center"><font color="#000080"><? echo $passwd;?> </font>　</td>
         <td width="33%" align="center"><font color="#000080"><? echo $chinesename;?> </font>　</td>
        </tr>
<?
  }
?>
</table>

  </center>
</div>

<br>

<p align="center"><font color="#000080">建立新的教師帳號</font></p>

<form method="POST" action="adduser.php">
  <input type=hidden name='work' value='add_user'>
  <div align="center">
    <center>
  <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#345998" height="176" width="75%" >
    <tr>
      <td width="33%" align="center" valign="top" bgcolor="#000080" height="19">
      <font color="#97DDFF" size="2">帳號</font></td>
      <td width="33%" bgcolor="#000080" height="19" align="center"><font size="2" color="#97DDFF">密碼</font></td>
      <td width="33%" bgcolor="#000080" height="19" align="center">
      <font size="2" color="#97DDFF">中文姓名</font></td>
    </tr>
    <tr>
      <td width="33%" align="center" height="57">
      <input type="text" name="name" size="20"></td>
      <td width="33%" align="center" height="57"><input type="password" name="passwd" size="20"></td>
      <td width="33%" align="center" height="57"><input type="text" name="chinesename" size="20"></td>
    </tr>
    <tr>
      <td width="99%" align="center" height="57" colspan="3">
      <input type="submit" value="新增使用者帳號">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" value="清除重新設定"></td>
    </tr>
    </table>

  </center>
  </div>

</form>
</body>
</html>