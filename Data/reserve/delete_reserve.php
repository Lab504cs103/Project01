<?
include ("config.php");

$whobook=$PHP_AUTH_USER;
$wday = date("w");     //�P���X
$year=date("Y");
$month=date("m");
$day=date("d");

if ($weekfirst=="")            // �qform_post�Ӫ��w��
     if ($nextfirst=="")
          if ($wday==0) $weekfirst = date("Y-m-d",mktime(0,0,0,$month,$day-6,$year));   //���o�P���@���
               else  $weekfirst = date("Y-m-d",mktime(0,0,0,$month,$day-$wday+1,$year));
     else                     // �q�U�@�g�s���Ө�
          $weekfirst=$nextfirst;

$tok=split("-",$weekfirst);                                     //�����C�g�Ĥ@�Ѥ��~�A��A��
$weeklast=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+6,$tok[0]));//���P���骺���

if ($work=="delete_classroom" && !empty($PHP_AUTH_USER))
{

     for ($i=0;$i<count($delete_item);$i++){
           $date_tok=split("@",$delete_item[$i]);
           $query_delete="delete from $classroom where classdate='$date_tok[2]' and weekday=$date_tok[0] and onedayorder=$date_tok[1]";   //�R���Ŀ諸�Ы�
           $result = mysql_query($query_delete,$link) or die ("Invalid delete query");
     }

}

?>
<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=big5">
</head>

<body background="images/background.gif">


<div align="center">
  <center>
  <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="80%" id="AutoNumber3">
    <tr>
      <td width="30%" align="left" valign="top"><font color="red"><b>1.</b> </font>&nbsp;<select name="classroom" onchange="location.href=this.options[this.selectedIndex].value;">
      <option >��ܭn�����w�����Ы�</option>
        <?
          include ("config.php");
          $str = "select room from $roomtable";
          $result = mysql_query($str,$link);

          while ($row = mysql_fetch_row($result)) {
                    list($room) = $row;
                    echo "<option value=\"delete_reserve.php?classroom=$room&nextfirst=$nextfirst\">
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
<?
     include ("config.php");

     for ($i = 1; $i<=$numofday ; $i++)
           for ($j=1;$j<=$numofclass;$j++)
                     $emptset[$i][$j] = -1 ;                                      // �����]���Ű�

     if (!empty($classroom))
     {
          $str="select * from $classroom where classdate >= '$weekfirst' and classdate<='$weeklast' and whobook='$whobook'";
          $result=mysql_query($str,$link);
          while ($row = mysql_fetch_row($result)) {
                   list($classdate,$weekday,$onedayorder,$class,$teacher,$subject,$whobook)=$row;
                   $emptset[$weekday][$onedayorder]= "$subject<br>$class<br>$teacher";   //�w�Q�w��
          }
     }
?>


<form metohd="post" action="delete_reserve.php">
<div align="center">

<table border="0" width="80%" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" cellspacing="5">
<tr>
<td>
<p align="left"><font color="#345998"><b><font size="2">�����w���ɡA�U���Ҫ����ܥ��H���w�����ΡC</font>
<br>
</p>
</td>
<td>
<?
  if ($nextfirst<>""){                                 // ��ܥ��g�B�U�@�g���s��
?>
    �m<a href="delete_reserve.php?classroom=<?echo $classroom;?>"><font color="#000080">���g</font></a>�n
<?}
  else{
?>
    �m<a href="delete_reserve.php?classroom=<?echo $classroom;?>&nextfirst=<?echo date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+7,$tok[0]))?>"><font color="#000080">�U�@�g</font></a>�n
<?}
?>

</td>
</tr>
</table>

</p>
  <center>
  <table border="3" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#000080" width="80%" id="AutoNumber1" height="555">
    <tr>
      <td width="5%" align="center" bgcolor="#97DDFF" height="20">�@</td>
      <td width="14%" bgcolor="#97DDFF" height="20">
      <p align="center"><b><font color="#000080">�ɶ�</font></b></td>
      <?
          include ("config.php");
          for ($i=0;$i<$numofday; $i++) {         //��ܬP���@~�P��xx
      ?>
                  <td width="<?echo floor(80/$numofday);?>%" align="center" bgcolor="#97DDFF" height="20"><b><font color="#000080">
                  <?echo $weekname[$i];?><br>(<?echo date("n/j",mktime(0,0,0,$tok[1],$tok[2]+$i,$tok[0]));?>)</font></b></td>
      <?
          }
      ?>
    </tr>

<?
    include ("config.php");
    for ($j=1 ; $j<=$numofclass; $j++) {         //��ܽҪ��C(�`)
?>
    <tr>
      <td width="5%" align="center" bgcolor="#97DDFF" height="60"><b>
      <font color="#000080"><?echo $j;?></font></b></td>
      <td width="14%" height="60">

      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
        <tr>
          <td width="100%" align="center">
          <b>
          <font color="#345998"><?echo $classbegin[$j-1];?></font></b></td>
        </tr>
        <tr>
          <td width="100%" align="center">
          <b>
          <font color="#345998">��</font></b></td>
        </tr>
        <tr>
          <td width="100%" align="center">
          <b>
          <font color="#345998"><?echo $classend[$j-1];?></font></b></td>
        </tr>
      </table>

      </td>
      <?  for ($i=1;$i<=$numofday;$i++) {           //��ܽҪ���(��)
                if ($emptset[$i][$j]==-1){          //�S���Q�w��
      ?>
                     <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="center"></td>
      <?       }
               else                                //�w�Q�w��
               {
      ?>
                    <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="top">
                    <table border="0">
                    <tr>
                     <td align="center">
                         <? echo $emptset[$i][$j];?>
                     </td>
                     <td align="center">
                          <input type=checkbox name=delete_item[] value="<?echo $i."@".$j."@".date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+$i-1,$tok[0]));?>">
                     </td>
                    </tr>
                    </table>
                    </td>
      <?       }
         }
      ?>

    </tr>
    <?  if ($j==4) {                               //�ȶ��ť�
    ?>
    <tr>
      <td width="102%" align="center" height="6" colspan="6"></td>
    </tr>
    <? }
}?>

    </table>
  </center>
</div>
<br>
<p align="center">
<input type=hidden name='work' value='delete_classroom'>
<input type=hidden name='classroom' value='<?echo $classroom; ?>'>
<input type=hidden name='weekfirst' value='<?echo $weekfirst; ?>'>
<input type=hidden name='nextfirst' value='<?echo $nextfirst; ?>'>
<input type="submit" value="�����w��" name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="�M���]�w" name="B2"></p>
</form>

</body>
</html>