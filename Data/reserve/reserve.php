<?
include ("config.php");

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

if ($work=="reserve_classroom" && !empty($PHP_AUTH_USER))
{
     if (empty($teacher)) {
        echo "�Юv�m�W��ťաA�Ц^�W�@�����s��J";
        exit;
     }

     if (empty($subject)) {
         echo "��ئW����ťաA�Ц^�W�@�����s��J";
         exit;
     }

     //check�O�_�W�L�C�ѹw�����
     if ($limit>0)
     {
          for($i=1;$i<=$numofday;$i++)
          {
               $cname="c".$i;                                  //$cname����r������W�r"c-��"
               $classdate=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+$i-1,$tok[0]));
               $total_reserved=0;
               for ($j=1;$j<=$numofclass;$j++)
               {
                     $classname=$cname.$j;                     //$classname����r������W�r"c-��-�`"
                     $classname=$$classname;                   //��$clasname����
                     if (!empty($classname))                   //�p�G�Q�w���A�h�O��
                          $total_reserved++;                   //�p��o�Ѥw�w���X�`
               }
               if ($total_reserved>$limit)                     //�W�L���w�w����
               {
                    echo $classdate." �W�L�w������I�C�ѥi�w���Ű�ƤW���� ".$limit." �A�Э��s�w���C";
                    exit;
               }
          }
     }
     //�w���Ы�
     for($i=1;$i<=$numofday;$i++)
     {
          $cname="c".$i;                                  //$cname����r������W�r"c-��"
          $classdate=date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+$i-1,$tok[0]));
          for ($j=1;$j<=$numofclass;$j++)
          {
                $classname=$cname.$j;                     //$classname����r������W�r"c-��-�`"
                $classname=$$classname;                   //��$clasname����
                if (!empty($classname))                   //�p�G�Q�w���A�h�O��
                {
                   $whobook=$PHP_AUTH_USER;
                   $query_insert="insert into $classroom (classdate,weekday,onedayorder,class,teacher,subject,whobook) values ('$classdate','$i','$j','$classname','$teacher','$subject','$whobook')";
                   $result = mysql_query($query_insert,$link) or die ("Invalid insert query");
                }

          }
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
      <td width="30%" align="left" valign="top"><font color="#FF0000"><b>1. </b>
      </font>&nbsp;<select name="classroom" onchange="location.href=this.options[this.selectedIndex].value;">
      <option >�п�ܭn�w�����Ы�</option>
        <?
          include ("config.php");
          $str = "select room from $roomtable";
          $result = mysql_query($str,$link);

          while ($row = mysql_fetch_row($result)) {
                    list($room) = $row;
                    echo "<option value=\"reserve.php?classroom=$room&nextfirst=$nextfirst\">
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
     for ($i=1;$i<=$numofday;$i++)
           for ($j=1;$j<=$numofclass;$j++)
                     $emptset[$i][$j] = -1 ;                                      // �����]���Ű�

     if (!empty($classroom))
     {
          $str="select * from $classroom where classdate >= '$weekfirst' and classdate<='$weeklast'";
          $result=mysql_query($str,$link);
          while ($row = mysql_fetch_row($result)) {
                   list($classdate,$weekday,$onedayorder,$class,$teacher,$subject,$whobook)=$row;
                   $emptset[$weekday][$onedayorder]= "$subject<br>$class<br>$teacher";   //�w�Q�w��
          }
     }
?>


<form metohd="post" action="reserve.php">
<div align="center">
<table border="0" width="80%" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" cellspacing="5">
<tr>
<td>
<p align="left"><b><font color="#FF0000">2. </font>
<font color="#345998" size="2">�Юv�m�W�G</font><font color="#345998"><input type="text" name="teacher" size="7"><font size="2">
��ءG</font><input type="text" name="subject" size="7"><font size="2"> (�Х���J�Юv�m�W�Υ��Ь��)</font></font></b><br>
</p>
</td>
<td>
<?
  if ($nextfirst<>""){                                 // ��ܥ��g�B�U�@�g���s��
?>
    �m<a href="reserve.php?classroom=<?echo $classroom;?>"><font color="#000080">���g</font></a>�n
<?}
  else{
?>
    �m<a href="reserve.php?classroom=<?echo $classroom;?>&nextfirst=<?echo date("Y-m-d",mktime(0,0,0,$tok[1],$tok[2]+7,$tok[0]))?>"><font color="#000080">�U�@�g</font></a>�n
<?}
?>

</td>
</tr>

<tr>
<td colspan="2">
<b><font color="#FF0000">3. </font><font size="2" color="#345998">�w���覡�G</font><font color="#000080" size="2">�b�Ű��J�Z�� </font>
<font size="2" color="#345998">(�Ҧp�G101�u�@�~�@�Z�v)����̤U�褧�y�w���Ыǡz�s�C</font></b></td>
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
                     <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="center">
      <?             if (!empty($classroom) && (mktime(0,0,0,$tok[1],$tok[2]+$i,$tok[0])-mktime(0,0,0,$month,$day+$from_tomorrow,$year))>0 ) { //����ЫǥB�����ѥH��
      ?>
                            <input type="text" name="<?echo "c".$i.$j;?>" size="7"></td>
      <?              }
      ?>
      <?       }
               else                                //�w�Q�w��
               {
      ?>
                    <td width="<?echo floor(80/$numofday);?>%" align="center" height="60" valign="top"><? echo $emptset[$i][$j];?></td>
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
<input type=hidden name='work' value='reserve_classroom'>
<input type=hidden name='classroom' value='<?echo $classroom; ?>'>
<input type=hidden name='weekfirst' value='<?echo $weekfirst; ?>'>
<input type=hidden name='nextfirst' value='<?echo $nextfirst; ?>'>
<input type="submit" value="�w���Ы�" name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="�M���]�w" name="B2"></p>
</form>

</body>
</html>