<?
include ("config.php");

$whobook=$PHP_AUTH_USER;
$wday = date("w");     //星期幾
$year=date("Y");
$month=date("m");
$day=date("d");

if ($weekfirst=="")            // 從form_post來的已有
     if ($nextfirst=="")
          if ($wday==0) $weekfirst = date("Y-m-d",mktime(0,0,0,$month,$day-6,$year));   //取得星期一日期
               else  $weekfirst = date("Y-m-d",mktime(0,0,0,$month,$day-$wday+1,$year));
     else                     // 從下一週連結而來
          $weekfirst=$nextfirst;

$tok=split("-",$weekfirst);                                     //分離每週第一天之年，月，日
$weeklast=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+6,$tok[0]));//本星期日的日期

if ($work=="delete_classroom" && !empty($PHP_AUTH_USER))
{

     for ($i=0;$i<count($delete_item);$i++){
           $date_tok=split("@",$delete_item[$i]);
           $query_delete="delete from $classroom where classdate='$date_tok[2]' and weekday=$date_tok[0] and onedayorder=$date_tok[1]";   //刪除勾選的教室
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
      <option >選擇要取消預約的教室</option>
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
          echo "$room  設備：</td>";
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
                     $emptset[$i][$j] = -1 ;                                      // 均先設為空堂

     if (!empty($classroom))
     {
          $str="select * from $classroom where classdate >= '$weekfirst' and classdate<='$weeklast' and whobook='$whobook'";
          $result=mysql_query($str,$link);
          while ($row = mysql_fetch_row($result)) {
                   list($classdate,$weekday,$onedayorder,$class,$teacher,$subject,$whobook)=$row;
                   $emptset[$weekday][$onedayorder]= "$subject<br>$class<br>$teacher";   //已被預約
          }
     }
?>


<form metohd="post" action="delete_reserve.php">
<div align="center">

<table border="0" width="80%" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" cellspacing="5">
<tr>
<td>
<p align="left"><font color="#345998"><b><font size="2">取消預約時，下面課表僅顯示本人的預約情形。</font>
<br>
</p>
</td>
<td>
<?
  if ($nextfirst<>""){                                 // 顯示本週、下一週之連結
?>
    《<a href="delete_reserve.php?classroom=<?echo $classroom;?>"><font color="#000080">本週</font></a>》
<?}
  else{
?>
    《<a href="delete_reserve.php?classroom=<?echo $classroom;?>&nextfirst=<?echo date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+7,$tok[0]))?>"><font color="#000080">下一週</font></a>》
<?}
?>

</td>
</tr>
</table>

</p>
  <center>
  <table border="3" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#000080" width="80%" id="AutoNumber1" height="555">
    <tr>
      <td width="5%" align="center" bgcolor="#97DDFF" height="20">　</td>
      <td width="14%" bgcolor="#97DDFF" height="20">
      <p align="center"><b><font color="#000080">時間</font></b></td>
      <?
          include ("config.php");
          for ($i=0;$i<$numofday; $i++) {         //顯示星期一~星期xx
      ?>
                  <td width="<?echo floor(80/$numofday);?>%" align="center" bgcolor="#97DDFF" height="20"><b><font color="#000080">
                  <?echo $weekname[$i];?><br>(<?echo date("n/j",mktime(0,0,0,$tok[1],$tok[2]+$i,$tok[0]));?>)</font></b></td>
      <?
          }
      ?>
    </tr>

<?
    include ("config.php");
    for ($j=1 ; $j<=$numofclass; $j++) {         //顯示課表橫列(節)
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
          <font color="#345998">至</font></b></td>
        </tr>
        <tr>
          <td width="100%" align="center">
          <b>
          <font color="#345998"><?echo $classend[$j-1];?></font></b></td>
        </tr>
      </table>

      </td>
      <?  for ($i=1;$i<=$numofday;$i++) {           //顯示課表直行(天)
                if ($emptset[$i][$j]==-1){          //沒有被預約
      ?>
                     <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="center"></td>
      <?       }
               else                                //已被預約
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
    <?  if ($j==4) {                               //午間空白
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
<input type="submit" value="取消預約" name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="清除設定" name="B2"></p>
</form>

</body>
</html>