<?php
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");  
?>

<!DOCTYPE html>
<style>
table, td, th
{
border:1px solid green;
}
th
{
background-color:green;
color:white;
}
</style>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>
        <table width="500" border="1" align="center">
  <tr>
    <td colspan="4" align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;" scope="row"><div align="center"><strong style="color: #00F">Routing Protocols</strong></div></td>
  </tr>
  <tr>
    <td width="55" align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH01</div></td>
    <td width="79" align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH1sol.pdf" target="new">Handout</a></div></td>
    <td width="107" align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="exp3-1.php">Experiment</a></div></td>
    <td width="93" align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH02</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH2sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">Experiment</div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH03</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH3sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-3.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH04</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH4sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-4.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH05</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH5sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-5.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH06</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH6sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-6.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH07</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH7sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-7.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH08</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH8sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-8.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH09</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH9sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-9.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH10</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH10sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-10.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
  <tr>
    <td height="26" align="center" bgcolor="#B5DAFF" style="font-style: normal" scope="row"><div align="center">CH11</div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/sol/CH11sol.pdf" target="new">Handout</a></div></td>
    <td align="center" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center"><a href="/Data/test/exp3-11.php">Experiment</a></div></td>
    <td align="center" valign="middle" bgcolor="#B5DAFF" style="font-family: kreon;font-style: normal;font-weight: 400;"><div align="center">未開放</div></td>
  </tr>
</table>
    </body>
</html>
