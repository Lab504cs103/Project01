<?
include ("config.php");

$whobook=$PHP_AUTH_USER;

if ($work=="reserve_fix" && !empty($PHP_AUTH_USER))
{
     if (empty($teacher)) {
        echo "教師姓名欄空白，請回上一頁重新輸入";
        exit;
     }

     if (empty($subject)) {
         echo "科目名稱欄空白，請回上一頁重新輸入";
         exit;
     }

     if (!checkdate($b_m,$b_d,$b_y) || !checkdate($e_m,$e_d,$e_y) ){
         echo "開始或結束日期錯誤，請回上一頁重新檢查輸入";
         exit;
     }

     $begin_date=date("Y-m-d",mktime(0,0,0,$b_m,$b_d,$b_y));
     $end_date=date("Y-m-d",mktime(0,0,0,$e_m,$e_d,$e_y));

     if ($begin_date > $end_date){
         echo "開始日期不可大於結束日期，請回上一頁重新檢查輸入";
         exit;
     }

     $begin_weekday=date("w",mktime(0,0,0,$b_m,$b_d,$b_y));         //開始日為星期幾
     $end_weekday=date("w",mktime(0,0,0,$e_m,$e_d,$e_y));           //結束日為星期幾

     if ($begin_weekday==0)                                         //開始或結束日為星期日
          $begin_weekday=7;
     if ($end_weekday==0)
          $end_weekday==7;

     $begin_monday=date("Y-m-d",mktime(0,0,0,$b_m,$b_d+1-$begin_weekday,$b_y)); //開始星期的這週星期一
     $begin_sunday=date("Y-m-d",mktime(0,0,0,$b_m,$b_d+7-$begin_weekday,$b_y)); //開始星期的這週星期日

     $start_weekday=$begin_weekday;
     $this_sunday=$begin_sunday;
     $this_firstday=$begin_date;

     while($end_date>=$this_sunday||($end_date<$this_sunday&&$end_date>=$this_firstday) )
     {

        $tok=split("-",$this_firstday);   //分離每週第一天之年，月，日

        if ($end_date<$this_sunday)
          $stop_weekday=$end_weekday;
        else
          $stop_weekday=$numofday;

        for($i=$start_weekday;$i<=$stop_weekday;$i++)      //$start_weekday 從星期幾開始,預約到星期幾$stop_weekday
        {
          $cname="c".$i;                                  //$cname為文字方塊之名字"c-天"
          $classdate=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+$i-$start_weekday,$tok[0]));

          for ($j=1;$j<=$numofclass;$j++)
          {
                $classname=$cname.$j;                     //$classname為文字方塊之名字"c-天-節"
                $classname=$$classname;                   //取$clasname的值
                if (!empty($classname))                   //如果被預約，則記錄
                {
                  $query_insert="insert into $classroom (classdate,weekday,onedayorder,class,teacher,subject,whobook) values ('$classdate','$i','$j','$classname','$teacher','$subject','$whobook')";
                  $result = mysql_query($query_insert,$link) or die ("Invalid Insert query");
                }

          }
        }

        $this_firstday=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+8-$start_weekday,$tok[0]));   //下星期一
        $this_sunday=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+14-$start_weekday,$tok[0]));    //下星期五
        $start_weekday=1;      //第二週後由星期一開始
     }
     header("Location:show_fix_reserve.php?classroom=$classroom&weekfirst=$begin_monday");
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
      <td width="30%" align="left" valign="top"><b><font color="red">1. </font>
      </b>&nbsp;<select name="classroom" onchange="location.href=this.options[this.selectedIndex].value;">
      <option >請選擇要預約的教室</option>
        <?
          include ("config.php");
          $str = "select room from $roomtable";
          $result = mysql_query($str,$link);

          while ($row = mysql_fetch_row($result)) {
                    list($room) = $row;
                    echo "<option value=\"reserve_fix_schedule.php?classroom=$room\">
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

<form metohd="post" action="reserve_fix_schedule.php">
<div align="center">
<table border="0" width="80%" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" cellspacing="5">
<tr>
<td colspan="2"><font color="#FF0000"><b>2. </b></font><font color="#345998"><font size="2"><b>教師姓名：</b></font><b><input type="text" name="teacher" size="7"><font size="2">
科目：</font><input type="text" name="subject" size="7"><font size="2"> (請先輸入教師姓名及任教科目)</font></b></font></td>
</tr>

<tr>
<td>
<font color="#FF0000"><b>3. </font><font color="#345998" size="2">固定課程開始日期</font></b>
<font size="1">(西元)&nbsp;&nbsp;</font><input type2="text" name="b_y" size="4">
<font size="2">年&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="b_m" size="4"> <font size="2">月&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="b_d" size="4"><font size="2">日</font>
</td>
</tr>

<tr>
<td><b><font color="#FF0000">4. </font><font color="#345998" size="2">固定課程結束日期</font></b>
<font size="1">(西元)&nbsp;&nbsp;</font><input type="text" name="e_y" size="4">
<font size="2">年&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="e_m" size="4"> <font size="2">月&nbsp;&nbsp;&nbsp;&nbsp;</font><input type="text" name="e_d" size="4"><font size="2">日</font>
</td>
</tr>

<tr>
<td colspan="2">
<b><font color="#FF0000">5. </font><font size="2" color="#345998">預約方式：</font><font color="#000080" size="2">在空堂填入班級 </font>
<font size="2" color="#345998">(例如：101「一年一班」)後按最下方之『預約教室』鈕。</font></b></td>
</tr>


<tr>
<td colspan="2">

<p align="left"><b><font color="#FF0000" size="1">
<font face="新細明體">※&nbsp; </font>固定課程預約前，請先確定教室空堂情況。若有衝堂將導至資料庫錯誤。</font></b></p>
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
                  <?echo $weekname[$i];?></font></b></td>
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
      ?>
                     <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="center">
      <?             if (!empty($classroom)) {
      ?>
                            <input type="text" name="<?echo "c".$i.$j;?>" size="7"></td>
      <?              }
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
<input type=hidden name='work' value='reserve_fix'>
<input type=hidden name='classroom' value='<?echo $classroom; ?>'>
<input type="submit" value="預約教室" name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="清除設定" name="B2"></p>
</form>

</body>
</html>