<?php
        session_start();
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <script type="text/javascript">
            function MM_openBrWindow(theURL,winName,features) { //v2.0
            window.open(theURL,winName,features);
            }
        </script>
    </head>
    <body>
        <div align="center"><span style="text-align: center"></span><img src="/Data/test/教材/CH1.PNG"  alt="" width="662" height="337" usemap="#Map" align="middle"/>
  <map name="Map">
   <area shape="rect" coords="305,47,367,90" href="#" onClick="MM_openBrWindow('/Terminal.php?com=com4','SW1','scrollbars=yes,width=600,height=600')"/>
    <area shape="rect" coords="505,260,568,305" href="#" onClick="MM_openBrWindow('../test2.php?com=com5','','scrollbars=yes,width=600,height=600') "/>
    <area shape="rect" coords="100,255,158,304" href="#" onClick="MM_openBrWindow('../index_test.html','','scrollbars=yes,width=600,height=600')">
    <area shape="circle" coords="444,278,37" href="#" onClick="MM_openBrWindow('../index_test.html','','scrollbars=yes,width=600,height=600')">
    <area shape="circle" coords="335,131,35" href="#" onClick="MM_openBrWindow('../index_test.html','<title>CH01-Experiment</title>','scrollbars=yes,width=600,height=600')">
    <area shape="circle" coords="225,278,36" href="#" onClick="MM_openBrWindow('../index_test.html','','scrollbars=yes,width=600,height=600')">
  </map>
  <span style="color: #FFF"></span></div>
        
    </body>
</html>
