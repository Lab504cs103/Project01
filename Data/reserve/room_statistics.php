<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=big5">
</head>

<body background="images/background.gif">


<div align="center">
  <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="80%" id="AutoNumber3">
    <tr>
      <td width="30%" align="left" valign="top"><b><font color="#FF0000">1.
      </font></b>&nbsp;<select name="classroom" onchange="location.href=this.options[this.selectedIndex].value;">
      <option >�п�ܭn�έp���Ы�</option>
        <?
          include ("config.php");
          $str = "select room from $roomtable";
          $result = mysql_query($str,$link);

          while ($row = mysql_fetch_row($result)) {
                    list($room) = $row;
                    echo "<option value=\"room_statistics.php?classroom=$room\">
                 $room</option>";
           }
           mysql_close ($link);
        ?>
        </select>
      </td>

      <td width="20%" align="left" valign="top">
      <?
          include ("config.php");
          $str = "select * from $roomtable where room='$classroom'";
          $result = mysql_query($str,$link);
          $row=mysql_fetch_row($result);
          list($room,$detail) = $row;
          echo "$room  �]�ơG</td>";
          echo "<td width=\"50%\" align=\"left\" valign=\"top\">";
          echo "$detail </td>";
          mysql_close ($link);
      ?>
      </td>
      </tr>
    </table>
  </center>
</div>
<br>

<form metohd="post" action="room_statistics.php">
<div align="center">
<table border="0" width="80%" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" cellspacing="5">

<tr>
<td><font size="2">�}�l���</font><font size="2">(�褸)&nbsp;&nbsp;</font><input type="text" name="b_y" size="4">
<font size="2">�~&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="b_m" size="4"> <font size="2">��&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="b_d" size="4"><font size="2">��</font>
</td>
<td>
<input type="submit" value="�d�ݱЫǨϥα���" name="B1">
</td>
</tr>
<tr>
<td><font size="2">�������</font><font size="2">(�褸)&nbsp;&nbsp;</font><input type="text" name="e_y" size="4">
<font size="2">�~&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="e_m" size="4"> <font size="2">��&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="e_d" size="4"><font size="2">��</font>
<td>
�@</td>
</td>

</tr>
</table>

<input type=hidden name='work' value='statistics'>
<input type=hidden name='classroom' value='<?echo $classroom; ?>'>
</p>
</form>


<div align="center">
<table border="1" cellpadding="5" bordercolor="#000080" cellspacing="0" style="border-collapse: collapse" width="75%">
<tr>
  <td width="20%" bgcolor="#384d94" align="center"><font size="2" color="#ffffff">�Ы�</font></td>
  <td width="20%" bgcolor="#384d94" align="center"><font size="2" color="#ffffff">���</font></td>
  <td width="20%" bgcolor="#384d94" align="center"><font size="2" color="#ffffff">�Z��</font></td>
  <td width="20%" bgcolor="#384d94" align="center"><font size="2" color="#ffffff">���</font></td>
  <td width="20%" bgcolor="#384d94" align="center"><font size="2" color="#ffffff">�Юv</font></td>
</tr>

<?
  include ("config.php");

  if ($work=="statistics" && !empty($PHP_AUTH_USER))
  {
     if (!checkdate($b_m,$b_d,$b_y) || !checkdate($e_m,$e_d,$e_y) ){
         echo "<font color=\"red\">�������J�ζ}�l(����)������~�A�Э��s�ˬd��J</font><br><br>";
         exit;
     }

     $begin_date=date("Y-m-d",mktime(0,0,0,$b_m,$b_d,$b_y));
     $end_date=date("Y-m-d",mktime(0,0,0,$e_m,$e_d,$e_y));

     if (!empty($classroom))
     {
          $str="select * from $classroom where classdate >= '$begin_date' and classdate<='$end_date'";
          $result=mysql_query($str,$link);
          while ($row = mysql_fetch_row($result)) {
                   list($classdate,$weekday,$onedayorder,$class,$teacher,$subject,$whobook)=$row;
?>
             <tr>
               <td width="20%"  align="center"><font size="2" color="#000080"><? echo $classroom;?></font>�@</td>
               <td width="20%"  align="center"><font size="2" color="#000080"><? echo $classdate;?></font>�@</td>
               <td width="20%"  align="center"><font size="2" color="#000080"><? echo $class;?></font>�@</td>
               <td width="20%"  align="center"><font size="2" color="#000080"><? echo $subject;?></font>�@</td>
               <td width="20%"  align="center"><font size="2" color="#000080"><? echo $teacher;?></font>�@</td>
             </tr>
<?

          }
     }

  }
?>
</table>
</div>


</body>
</html>