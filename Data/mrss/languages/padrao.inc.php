<?php
session_start();

$real_path = realpath("../conf.inc.php");

include($real_path . "conf.inc.php");

if($_SESSION["lingua"]!=""){
	$LINGUA=$_SESSION["lingua"];
} else {
	$LINGUA=$CONFIG_LANG;
}

switch ($LINGUA) {
   case 0:
       include('pt_BR.inc.php');
       break;
   case 1:
       include('en_US.inc.php');
       break;
   case 2:
       include('ca_ES.inc.php');
       break;
   case 3:
       include('ge_DE.inc.php');
       break;
   case 4:
       include('es_ES.inc.php');
       break;
}


?>
