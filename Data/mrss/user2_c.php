<?php
// +----------------------------------------------------------------------+
// | Meeting Room Scheduler System - (English)                            |
// | SAS Sistema de Agendamento de Salas - (Portuguese)                   |
// | Copyright (C) 2005/2006  Ighor Toth (igtoth@gmail.com)               |
// |                                                                      |
// | This program is free software; you can redistribute it and/or        |
// | modify it under the terms of the GNU General Public License          |
// | as published by the Free Software Foundation; either version 2       |
// | of the License, or (at your option) any later version.               |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor,                   |
// | Boston, MA  02110-1301, USA.                                         |
// +----------------------------------------------------------------------+
// | RSS - Room Scheduler System (English Version)                        |
// | SAS - Sistema de Agendamento de Sala (Portuguese Version)            |
// +----------------------------------------------------------------------+
// | Autor: Ighor Toth (igtoth@gmail.com) - http://www.ighor.com          |
// | Web-site: http://sourceforge.net/projects/rss                        |
// | DEVELOPED IN BRAZIL !!!                                              |
// +----------------------------------------------------------------------+
// | UPDATES:-                                                            |
// | Please read README.txt                                               |
// +----------------------------------------------------------------------+
// | Pages:                                                               |
// |         Room Scheduler     = http://www.your-site.com/index.php      |
// |             Demo           = http://mrss.ighor.com/index.php         |
// |             User           = 999995                                  |
// |             Password       = 123456                                  |
// |         Administrator page = http://www.your-site.com/adm.php        |
// |             Demo           = "Not available yet"                     |
// |             User           = admin                                   |
// |             Password       = abc123                                  |
// +----------------------------------------------------------------------+
// | Configuration file: conf.inc.php                                     |
// | DB structure: rss.sql                                                |
// | Bugs, translations or issues, write to: igtoth@gmail.com             |
// | ATTENTION: OLD VERSION: RSS - Room Scheduler System -- DISCONTINUED  |
// +----------------------------------------------------------------------+

$destruir=$_GET["destruir"];
if($destruir){
	session_destroy();
	echo("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ /* window.navigate('index.php'); */ window.close(); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
	exit();
}

?>

		<TITLE><?php echo $L_TITULO; ?></TITLE>

			<style type="text/css">
			<!--
			.bordas {
				border: 1px solid #999999;
			}
			-->
			</style>





<SCRIPT LANGUAGE="JavaScript">
<!-- 
function save(iIndx)
{	
 	var f=document.forms[0]; var of=opener.document.forms[0];

	of.MyProfileSelectedNO.value=0;
	of.MyProfileEditRowNO.value=iIndx;
    	of.DataFlagsTX.value=f.dDataFlagsTX.value;
    	var str="MyProfileDataTX";

    	for (var i=0; i<a.length; i++)
    	{   
    		var strTargetField=str + (i=="0" ? "" : "_" + i);
    		var strField=str + (a[i]=="0" ? "" : "_" + a[i]);
    		if ( f[strField].type.indexOf("select")>-1 ) var s=f[strField].options[f[strField].selectedIndex].text;
    		else s=f[strField].value;
    		of[strTargetField].value=s;
    		//var iPos=strField.indexOf("_");
    		//if (iPos==-1) strField=strField + "_" + i;
    		//else strField = strField.substr(0,iPos+1) + i;
    	}

	of.submit();
	window.close();	
}
// -->
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!-- 
document._domino_target = "_self";
function _doClick(v, o, t, h) {
  var form = document._frmAddEdit;
  if (form.onsubmit) {
     var retVal = form.onsubmit();
     if (typeof retVal == "boolean" && retVal == false)
       return false;
  }
  var target = document._domino_target;
  if (o.href != null) {
    if (o.target != null)
       target = o.target;
  } else {
    if (t != null)
      target = t;
  }
  form.target = target;
  form.__Click.value = v;
  if (h != null)
    form.action += h;
  form.submit();
  return false;
}
// -->
</SCRIPT>
</HEAD>

<BODY TEXT="000000" BGCOLOR="FFFFFF">

<FORM METHOD=post ACTION="" NAME="_frmAddEdit">
<INPUT TYPE=hidden NAME="__Click" VALUE="0"><FONT SIZE=2 COLOR="0000ff">
<INPUT NAME="dDataFlagsTX" VALUE="PE" type=hidden></FONT>

<SCRIPT LANGUAGE="JavaScript">

<!--

//global variables
var month; var day; var year;
var monthArray = new Array(0,31,29,31,30,31,30,31,31,30,31,30,31);
var strCalWinOptions = "width=230,height=190,resizable=no";

// **************************
//Validate the date string
function vd(frm,fieldName) {
	var dtString1 = eval("frm." + fieldName + ".value");

	//Trim date string: Remove spaces
	dtString = "";
	for (var i=0; i < dtString1.length; i++)
		if (dtString1.charAt(i) != " ")
			dtString = dtString + dtString1.charAt(i);

	//Initialize variables
	startPos = 0; pos = 0;

	//Check year
	pos = dtString.indexOf("-", startPos);
	if (pos == -1){
		return false;
	}
	year = parseInt(dtString.substring(startPos,pos),10);
	if ((year < 1900) || (year > 3000))
		return false;

	//Check month
	startPos = pos + 1;
	pos = dtString.indexOf("-", startPos);
	if (pos == -1){
		return false;
	}
	month = parseInt(dtString.substring(startPos,pos),10);
	if ((month < 1) || (month > 12)) 
		return false;

	//Check day
	startPos = pos + 1;
	day = parseInt(dtString.substring(startPos,dtString.length),10)
	if ((day < 1) || (day > monthArray[month])) 
		return false;

	//Check for leap year
	if ((month == 2) && (day == 29))
		if ((((year % 4) == 0) && ((year % 100) != 0)) == false){ 
			return false; 
		}

	//if we've gotten this far, return true
	return true;

}


// **************************
//Validate the date field givin in parameter
function validateDate(frm,fieldName,fieldLabel){
	 if (!vd(frm,fieldName)) {
		alert(fieldLabel + " does not have a valid date");
		return false;
	}
}


// **************************
//Calculates the current year, month and date
function getToday(){
	 today = new Date();
	 day = today.getDate();
	 month = today.getMonth();
	 month++;
	 year = today.getYear();
	 year = (year < 100) ? 1900 + year : year;
	 if (year.toString().length < 4) {
	 	year = 1900 + year;
	}
 }


// **************************
//Get the current date value in parameter field
//If no date is given or date format is not YYYY-MM-DD gets today
function getMonth_and_Date(form,fieldName){

	dtString1 = eval("form." + fieldName + ".value");

	// trim date string: Remove spaces
	dtString = "";
	for (var i=0; i < dtString1.length; i++)
		if (dtString1.charAt(i) != " ")
			dtString = dtString + dtString1.charAt(i);

	//get date components
	startPos = 0; pos = 0;

	//get year
	pos = dtString.indexOf("-", startPos);
	if (pos == -1){      //there's no date delimiter
		getToday(); 
		return;
	}
	year = parseInt(dtString.substring(startPos,pos),10);
	startPos = pos + 1;

	// get month
	pos = dtString.indexOf("-", startPos);
	if (pos == -1){
		getToday();
		return;
	}
	month = parseInt(dtString.substring(startPos,pos),10);	
	startPos = pos + 1;

	//get day
	day = parseInt(dtString.substring(startPos,dtString.length),10)

	//check month
	if ((month < 1) || (month > 12)){ //no valid month
		getToday();
		return;
	}

	//check day
	if ((day < 1) || (day > monthArray[month])){
		getToday();
		return;
	}
	
	year = (year < 100) ? 1900 + year : year;

}


// **************************
//Open the new date picking window
function putcal(form, dateFieldName) {
	var version = navigator.appVersion;
	if (navigator.appVersion.indexOf("Mac") != -1) {
		calwin = open("","calwin","alwaysRaised=yes,width=300,height=285,resizable=yes");
	} else {
		calwin = open("","calwin", strCalWinOptions);
	}
	calccal(calwin,form,dateFieldName);
 }


// **************************
//Create and show the date picker window
 function calccal(targetwin,form,dateFieldName) { 
	//Define the month names
	 var monthname = new Array(12);
	 monthname[0] = "<?php echo $L_JANEIRO; ?>";
	 monthname[1] = "<?php echo $L_FEVEREIRO; ?>";
	 monthname[2] = "<?php echo $L_MARCO; ?>";
	 monthname[3] = "<?php echo $L_ABRIL; ?>";
	 monthname[4] = "<?php echo $L_MAIO; ?>";
	 monthname[5] = "<?php echo $L_JUNHO; ?>";
	 monthname[6] = "<?php echo $L_JULHO; ?>";
	 monthname[7] = "<?php echo $L_AGOSTO; ?>";
	 monthname[8] = "<?php echo $L_SETEMBRO; ?>";
	 monthname[9] = "<?php echo $L_OUTUBRO; ?>";
	 monthname[10] = "<?php echo $L_NOVEMBRO; ?>";
	 monthname[11] = "<?php echo $L_DEZEMBRO; ?>";


	//Calculate the first and last day in the month
	 var endday = calclastday(eval(month),eval(year));
	 mydate = new Date(month + "/01/" + year);
	 firstday = mydate.getDay();
	
	//Define the day table: 6 rows * 7 columns
	 var cnt = 0;
	 var day = new Array(6);
	 for (var i=0; i<6; i++)
		 day[i] = new Array(7);

	//Fill the day table with right day numbers
	 for (var r=0; r<6; r++) {
		 for (var c=0; c<7; c++) {
			 if ((cnt==0) && (c!=firstday)) continue;
			 cnt++;
			 day[r][c] = cnt;
			 if (cnt==endday) break;
		 }
		 if (cnt==endday) break;
	 }

	//Create the date selection page in HTML format
	targetwin.document.open()
	targetwin.document.writeln("<HTML>\n<HEAD>\n<TITLE><?php echo $L_ESCOLHA_DATA; ?></TITLE>\n<STYLE TYPE=\"text/css\">");
	targetwin.document.writeln("\tA {COLOR: black; TEXT-DECORATION: none}\n\tA:hover {COLOR: red; TEXT-DECORATION: underline}")
	targetwin.document.writeln("\tTH {font-family: arial, helv, times roman; font-size:10pt; color:#FFFFFF; text-align: center; BACKGROUND-COLOR: 0033CC}");
	targetwin.document.writeln("\tTD {font-family: arial, helv, times roman; font-size:10pt; text-align: center}\n\t.weekend {BACKGROUND-COLOR: #E1E1E1}");
	targetwin.document.writeln("\t.today {BACKGROUND-COLOR: #FF9F9F}\n</STYLE>\n</HEAD>\n");
	targetwin.document.writeln("<BODY onBlur=\"setTimeout('self.focus()',1000);\">");
	targetwin.document.writeln("<FORM>\n<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>\n<TR VALIGN=TOP>");

	var prevyear = eval(year) - 1;

	//Add previous year button
	targetwin.document.writeln("<TD><INPUT TYPE=BUTTON NAME=prevyearbutton VALUE='<<'"+
	" onclick='opener.month = " + month + "; opener.year = " + prevyear +
	";document.clear();opener.calccal(opener.calwin,opener.document." + form.name + ",\"" + dateFieldName + "\")'></TD>");

	var prevmonth = (month == 1) ? 12 : month - 1;
	var prevmonthyear = (month == 1) ? year - 1 : year;

	//Add previous month button
	targetwin.document.writeln("<TD><INPUT TYPE=BUTTON NAME=prevmonthbutton VALUE='&nbsp;<&nbsp;'"+
	" onclick='opener.month = " + prevmonth + "; opener.year = " + prevmonthyear +
	";document.clear();opener.calccal(opener.calwin,opener.document." + form.name + ",\"" + dateFieldName + "\")'></TD>");

	//Add month name
	targetwin.document.writeln("<TD COLSPAN=3 ALIGN=CENTER>");
	var index = eval(month) - 1;
	targetwin.document.writeln("<B><Font Face=Arial>" + monthname[index] + " " + year + "</B></TD>");

	var nextyear = eval(year) + 1; 
	var nextmonth = (month == 12) ? 1 : month + 1;
	var nextmonthyear = (month == 12) ? year + 1 : year;

	//Add next month button
	targetwin.document.writeln("<TD><INPUT TYPE=BUTTON NAME=nextmonthbutton VALUE='&nbsp;>&nbsp;'"+
	" onclick='opener.month = " + nextmonth + "; opener.year = " + nextmonthyear +
	";document.clear();opener.calccal(opener.calwin,opener.document." + form.name + ",\"" + dateFieldName + "\")'></TD>");

	//Add next year button
	targetwin.document.writeln("<TD><INPUT TYPE=BUTTON NAME=nextyearbutton VALUE='>>'"+
	" onclick='opener.month = " + month + "; opener.year = " + nextyear +
	";document.clear();opener.calccal(opener.calwin,opener.document." + form.name + ",\"" + dateFieldName + "\")'></TD><TR>");
	targetwin.document.writeln("<TR><TD COLSPAN=7>&nbsp;</TD></TR>");

	targetwin.document.writeln("<TR><TD COLSPAN=7>\n\n<table width=\"100%\" border=1 cellspacing=0 cellpadding=0>");

	//Add the day names
	targetwin.document.writeln("<TR>");
	targetwin.document.writeln("<TH><?php echo $L_DOMINGO2;       ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_SEGUNDA_FEIRA2; ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_TERCA_FEIRA2;   ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_QUARTA_FEIRA2;  ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_QUINTA_FEIRA2;  ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_SEXTA_FEIRA2;   ?></TH>");
	targetwin.document.writeln("<TH><?php echo $L_SABADO2;        ?></TH>");
	targetwin.document.writeln("</TR>");


	//Initialize variables
	var selectedmonth = eval(month) - 1;
	var today = new Date();
	var thisyear = today.getYear();
	var thisday = today.getDate();
	var thismonth = today.getMonth() + 1;
	var selectedyear = eval(year) - thisyear + 4;
	var conditionalpadder = "";
	var ISODay = "";
	var ISOMonth = "";

	//Create the month string in 2 digits
	 if (month < 10) ISOMonth = "0" + month;
	 else ISOMonth = month;

	//Create the date table in HTML format and fill each cell in table
	 for(r=0; r<6; r++) {
		 targetwin.document.writeln("<TR>");
		 for(c=0; c<7; c++) {
			if (day[r][c] == thisday && thismonth == month && thisyear == year) {
				targetwin.document.writeln("<TD class=today>");
			} else {
				if (c == 0 || c == 6) targetwin.document.writeln("<TD class=weekend>");
				else targetwin.document.writeln("<TD>");
			}
			if(day[r][c] != null) {
				//Create the day string in 2 digits
				if (day[r][c] < 10) {
					conditionalpadder = "&nbsp;"
					ISODay = "0" + day[r][c];
				} else {
					conditionalpadder = "";
					ISODay = day[r][c];
				}
				//Add the HTML and JavaScript to each cell in date table that will close the window and return the date clicked
				targetwin.document.writeln("<a href=\"javascript:window.close();" + 
				"opener.document." + form.name + "." + dateFieldName + ".value = '" + year + "-" + ISOMonth + "-" + ISODay + "'" + 
				"\">" + conditionalpadder + day[r][c] + conditionalpadder + "</a>")
			 }
			 targetwin.document.writeln("</TD>");
		 }
		 targetwin.document.writeln("</TR>");
	 }

	 targetwin.document.writeln("</TABLE></TABLE></FORM></BODY></HTML>");
	 targetwin.document.close()
}

// **************************
//Calculates the last day in the month
function calclastday(month,year) {
	if ((month==2) && ((year%4)==0))
		return 29;

	if ((month==2) && ((year%4)!=0))
		return 28;
	
	if ((month==1) || (month == 3) || (month == 5) || (month == 7) || (month==8) || (month == 10) || (month ==12))
		return 31;

	return 30;
}

// -->
</SCRIPT>


<!-- *********************************************************************************************************** -->

		<body topmargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0">

</form>

<?php

include('conecta.php');
include('languages/padrao.inc.php');

$LINGUAPOST=$_POST["lingua"];

if($LINGUAPOST!=""){ $_SESSION["lingua"]=$LINGUAPOST; }


function mostrarsemana($data,$cod_sala,$qual_semana,$prox_semana,$dia_atual){ // INICIO_FUNCTION_MOSTRARSEMANA

	//	echo $data; echo("--"); echo $prox_semana; echo("--"); echo("$dia_atual");

	include('languages/padrao.inc.php');
	include('conecta.php');

	?>

	<script Language="JavaScript">

		function enviardata(){
			
			data_dia1 = document.data_dia.data_dia1.value;

			if(data_dia1 == ''){
				alert("Por favor escolha uma Data!")
				document.data_dia.data_dia1.focus()
				return;
			} 
			form = document.data_dia
			form.action = ''
			form.submit();	
	
		}


	</script>



<script Language="JavaScript">

		function checkna() {
			if(document.sas.na.checked == true){
				document.sas.ticket.value = "<?php echo $L_SEM_ADICIONAIS; ?>"
				document.sas.ticket.disabled = true
			}
			if(document.sas.na.checked == false){
				document.sas.ticket.value = ""
				document.sas.ticket.disabled = false
			}
		}

		function valida(){
		form = document.sas

		reservar = form.reservar
		tempo = form.tempo.value
		ticket = form.ticket.value

			marcado = -1

			for (i=0; i<form.reservar.length; i++) {
				if (document.sas.reservar[i].checked) {
					marcado = i
				}
			}
	
			if (marcado == -1) {
				alert("<?php echo $L_ALERTA_01; ?>");
				form.reservar[0].focus();
				return;
			}

			marcado2 = -1

			for (i=0; i<form.tempo.length; i++) {
				if (document.sas.tempo[i].checked) {
					marcado2 = i
				}
			}
	
			if (marcado2 == -1) {
				alert("<?php echo $L_ALERTA_02; ?>");
				form.tempo[0].focus();
				return;
			}

			if(ticket == ''){
				alert("<?php echo $L_MENSAGEM_01; ?>")
				form.ticket.focus()
				return;
			} 

			if(tempo == ''){
				alert("<?php echo $L_ALERTA_03; ?>")
				form.tempo.focus()
				return;
			} 

		
			form.action = '?enviar=sim'
			form.submit();	
	
		}


	</script>



	<div id="overDiv" style="position:absolute; visibility:hide; z-index:1;"></div>

	<script language="JavaScript" src="overlib.js" type="text/javascript">
	</script>

	<?php


	$data1=$data;
	$data_prox=$data;
	$data2=$data;
	$data=explode("-",$data);

	// $fgh=explode("-",$dia_atual);
	$fgh=explode("-",date("Y-m-d"));
	$mesfgh=$fgh[1];
	$anofgh1=$fgh[0];

	$dia=$data[2];  
	$dia2=$dia;
	$mes=$data[1]; 
	$mesd=$data[1];
	$ano=$data[0];

	$data_sem=$ano."-".$mes."-".$dia;

	$ano2=$ano;
	$mes2=$mes;

	$novomes=0;
	$novomes2=0;

	$tempo = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

	$dia_da_semana2=$tempo;

	if($dia_da_semana2==1){ $dia_da_semana=$L_SEGUNDA_FEIRA;   $inicio=0;  $inicio2=0;  $iniciok=1;  															$inicio_prox=7; }
	if($dia_da_semana2==2){ $dia_da_semana=$L_TERCA_FEIRA;     $inicio=-1; $inicio2=-1; $iniciok=2; if($dia==1){ $inicio6=0; } 												$inicio_prox=8; }
	if($dia_da_semana2==3){ $dia_da_semana=$L_QUARTA_FEIRA;    $inicio=-2; $inicio2=-2; $iniciok=3; if($dia==1){ $inicio6=-1; } if($dia==2){ $inicio6=0; } 								$inicio_prox=9; }
	if($dia_da_semana2==4){ $dia_da_semana=$L_QUINTA_FEIRA;    $inicio=-3; $inicio2=-3; $iniciok=4; if($dia==1){ $inicio6=-2; } if($dia==2){ $inicio6=-1; } if($dia==3){ $inicio6=0; }  					$inicio_prox=10; }
	if($dia_da_semana2==5){ $dia_da_semana=$L_SEXTA_FEIRA;     $inicio=-4; $inicio2=-4; $iniciok=5; if($dia==1){ $inicio6=-3; } if($dia==2){ $inicio6=-2; } if($dia==3){ $inicio6=-1; } if($dia==4){ $inicio6=0; } 	$inicio_prox=11; }
	if($dia_da_semana2==6){ $dia_da_semana=$L_SABADO;          $inicio=-5; $inicio2=-5; $iniciok=6; if($dia==1){ $inicio6=-4; } if($dia==2){ $inicio6=-3; } if($dia==3){ $inicio6=-2; } if($dia==4){ $inicio6=-1; } 	$inicio_prox=12; }
	if($dia_da_semana2==7){ $dia_da_semana=$L_DOMINGO;          $inicio=-6; $inicio2=-6; $iniciok=7; if($dia==1){ $inicio6=-5; } if($dia==2){ $inicio6=-4; } if($dia==3){ $inicio6=-3; } if($dia==4){ $inicio6=-2; } if($dia==5){ $inicio6=-1; } 	$inicio_prox=12; }
	if($dia_da_semana2==0){ $dia_da_semana=$L_DOMINGO; $dia++; $inicio=0;  $inicio2=0;  $iniciok=1; 															$inicio_prox=13; } //CASO SEJA DOMINGO


	$nomes_meses["01"]=$L_JANEIRO;
	$nomes_meses["02"]=$L_FEVEREIRO;
	$nomes_meses["03"]=$L_MARCO;
	$nomes_meses["04"]=$L_ABRIL;
	$nomes_meses["05"]=$L_MAIO;
	$nomes_meses["06"]=$L_JUNHO;
	$nomes_meses["07"]=$L_JULHO;
	$nomes_meses["08"]=$L_AGOSTO;
	$nomes_meses["09"]=$L_SETEMBRO;
	$nomes_meses["10"]=$L_OUTUBRO;
	$nomes_meses["11"]=$L_NOVEMBRO;
	$nomes_meses["12"]=$L_DEZEMBRO;

	$data_atual78=explode("-",$dia_atual);

	$dia78=$data_atual78[2];  
	$mes78=$data_atual78[1]; 
	$ano78=$data_atual78[0];

	$tempo78 = date("D", mktime(0, 0, 0, $mes78, $dia78, $ano78));

	if($tempo78=="Mon"){ $tempo78=$L_SEGUNDA_FEIRA;  }
	if($tempo78=="Tue"){ $tempo78=$L_TERCA_FEIRA;   }
	if($tempo78=="Wed"){ $tempo78=$L_QUARTA_FEIRA;  }
	if($tempo78=="Thu"){ $tempo78=$L_QUINTA_FEIRA;  }
	if($tempo78=="Fri"){ $tempo78=$L_SEXTA_FEIRA;   }
	if($tempo78=="Sat"){ $tempo78=$L_SABADO;        }
	if($tempo78=="Sun"){ $tempo78=$L_DOMINGO;       }

	$horaagora05=date("H");


	$inicio3=$inicio;
	$inicio4=$inicio;

	$nome_semana[1]=$L_SEGUNDA;
	$nome_semana[2]=$L_TERCA;
	$nome_semana[3]=$L_QUARTA;
	$nome_semana[4]=$L_QUINTA;
	$nome_semana[5]=$L_SEXTA;
	$nome_semana[6]=$L_SABADO;
	$nome_semana[7]=$L_DOMINGO;

	$fonte[1]="<font face='arial' size='1'>";
	$fonte[2]="<font face='arial' size='2'><center>";
	$fonte[3]="<font face='arial' size='3'><center>";
	$cor_fonte["azulescura"]="<font color='#4682B4'>";
	$cor_fonte["azul"]="<font color='#4682B4'>";
	$cor_fonte["branca"]="<font color='#ffffff'>";
	$cor_fonte["preta"]="<font color='#000000'>";
	//$cor_celula["preta"]="BGCOLOR='#000000'";
	$cor_celula["preta"]="BGCOLOR='#B0B0B0'";
	$cor_celula["branca"]="BGCOLOR='#ffffff'";
	$cor_celula["azulescura"]="BGCOLOR='#4682B4'";
	$cor_celula["azulclara"]="BGCOLOR='#B0C4DE'";
	$cor_celula["cinza"]="BGCOLOR='#BEBEBE'";
	$cor_celula["cinzaclaro"]="BGCOLOR='#BfBfBf'";
	$cor_celula["marrom"]="BGCOLOR='#A52A2A'";
	$cor_celula["vermelha"]="BGCOLOR='#F08080'";
	$cor_celula["azul"]="BGCOLOR='#00BFFF'";
	//$cor_celula["azulnao"]="BGCOLOR='#104E8B'";
	$cor_celula["azulnao"]="BGCOLOR='#BfBfBf'";

	//$_SESSION["hora_inicio"] = $CONFIG_STHR;
	//$_SESSION["hora_final"]  = $CONFIG_EDHR;

	//$hora_inicio=8; // HORA INICIAL 
	//$hora_tab=8; // HORA INICIAL
	//$hora_final=21; // HORA FINAL
	//$total_horas=14; // TOTAL HORAS + 1

	$hora_inicio = $_SESSION["hora_inicio"]; 	// HORA INICIAL 
	$hora_tab    = $_SESSION["hora_inicio"]; 	// HORA INICIAL
	$hora_final  = $_SESSION["hora_final"]; 	// HORA FINAL
	$total_horas = ($hora_final-$hora_inicio)+1;	// TOTAL HORAS + 1

	$tamanho_celula=70; // LARGURA CELULAS
	$altura_celula=""; // ALTURA CELULAS


	?>



	<TABLE width="520" border="0" cellpadding="0" cellspacing="0">
		<TR>
			<TD width="60%" align="left">
			<?php

				if(($horaagora05>=00)&&($horaagora05<=11)){ echo("<b>$L_BOM_DIA</b> "); }
				if(($horaagora05>=12)&&($horaagora05<=17)){ echo("<b>$L_BOA_TARDE</b> "); }
				if(($horaagora05>=18)&&($horaagora05<=23)){ echo("<b>$L_BOA_NOITE</b> "); }

				echo $_SESSION["nome"];

				if($sistema1==0){

					echo(".<br> "); echo $L_MENSAGEM_41; echo $dia78; echo(" $L_DE "); echo $nomes_meses["$mes78"]; echo(" $L_DE "); echo $ano78; echo(" ($tempo78)");

				} else {

					echo(".<br> "); echo $L_MENSAGEM_41; echo $nomes_meses["$mes78"]; echo(" "); echo $dia78; echo(", "); echo $ano78; echo(" ($tempo78)");

				}

			?>
			<TD>
			<TD width="40%" align="right">
				<FORM NAME="linguatroca" method="POST" action="">
				<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?>
				<b><?php echo $L_LINGUA; ?>: &nbsp;</b>
				
				<input type="hidden" name="env_cod_sala" border=0 value="Alterar Sala">
					<input border="0" type="hidden" name="cod_sala" value="<?php echo $linha5["cod_sala"]; ?>">
					<input border="0" type="hidden" name="inicio1" border=0 value="<?php echo $inicio; ?>">
					<input border="0" type="hidden" name="prox_semana" border=0 value="<?php echo $prox_semana; ?>">
					<input border="0" type="hidden" name="dia_atual" border=0 value="<?php echo $dia_atual; ?>">
				<select name="lingua" OnChange="javascript: document.linguatroca.submit();" >
						<option value="2" <?php if($_SESSION["lingua"]==2){ echo ("selected=\"\""); } ?> >Catalan</option>
						<option value="1" <?php if($_SESSION["lingua"]==1){ echo ("selected=\"\""); } ?> >English</option>
						<option value="3" <?php if($_SESSION["lingua"]==3){ echo ("selected=\"\""); } ?> >German</option>
						<option value="0" <?php if($_SESSION["lingua"]==0){ echo ("selected=\"\""); } ?> >Portuguese</option>
						<option value="4" <?php if($_SESSION["lingua"]==4){ echo ("selected=\"\""); } ?> >Spanish</option>
				</select>
				</form>
			</TD>	
		</TR>
	</TABLE>

	<TABLE border="0" cellpadding="0" cellspacing="0">	
	<TR><TD>

	<TABLE width="508" height="30" border="0" cellpadding="0" cellspacing="0" >
		<TR>
			<TD >
				<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?>
				<b><img src="img/arrow3.gif" width="14" height="11" alt="">
				<?php echo $L_SALA; ?>
				</b>


			</TD>
				<FORM NAME="salatroca" method="POST" action="">
			<TD >   
				
				<input type="hidden" name="env_cod_sala" border=0 value="Alterar Sala">
					<input border="0" type="hidden" name="inicio1" border=0 value="<?php echo $inicio; ?>">
					<input border="0" type="hidden" name="prox_semana" border=0 value="<?php echo $prox_semana; ?>">
					<input border="0" type="hidden" name="dia_atual" border=0 value="<?php echo $dia_atual; ?>">
				<select name="cod_sala" OnChange="javascript: document.salatroca.submit();" >
					<?php
						mysql_select_db ($banco);
						$sql5 = "SELECT * from salas ORDER BY nome_sala";
						$result5 = mysql_query($sql5) or die(mysql_error());
		
						while($linha5=mysql_fetch_array($result5)) { 
					?>
						<option value="<?php echo $linha5["cod_sala"]; ?>" <?php if($cod_sala==$linha5["cod_sala"]){ echo ("selected=\"\""); } ?> ><?php echo $linha5["nome_sala"]; ?></option>
					<?php
						}
					?>
				</select>

			</TD>
				</form>
			<TD width="55"> 
				<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?>
				<b><?php echo $L_DATE; ?>: </b>&nbsp;
			</TD>

			
				<FORM method="POST" NAME="data_dia">
			<TD  width="90" align="center">

					
				
					<input name="data_dia1" class="bordas" size="10" value="" OnClick="JavaScript:getMonth_and_Date(this.document.data_dia,'data_dia1');putcal(this.document.data_dia,'data_dia1');">
				
				
			</TD >
			<TD width="25">
					<?php
						if($qual_semana==1){ // INICIO_IF_X

					 ?>
								<!-- <input  class="bordas" type="Submit" name="anterior" border=0 value=" >> "> -->
								<INPUT TYPE="image" src="img/submit.gif" name="anterior" border=0 hspace=7 vspace=4 alt="<?php echo $L_IR; ?> &gt;&gt;&gt;">
								<input border="0" type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input border="0" type="hidden" name="data1" border=0 value="<?php echo $data1; ?>">
								<input border="0" type="hidden" name="inicio1" border=0 value="<?php echo $iniciok; ?>">
								<input border="0" type="hidden" name="inicio_prox" border=0 value="<?php echo $inicio_prox; ?>">
								<input border="0" type="hidden" name="prox_semana" border=0 value="<?php echo $prox_semana; ?>">
								<!-- <input border="0" type="hidden" name="dia_atual" border=0 value="<?php echo $dia_atual; ?>"> -->
								
							
					<?php
						} // FIM IF_X
					?>

			</TD>
				</form>			
		</TR>
	</TABLE>

	<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td background="" bgcolor="#9EC8FF"><img src="img/spacer.gif" width="1" height="1" alt=""><br></td></tr></table>

	<br>
	<TABLE BORDER='0' background="" BGCOLOR='#9EC8FF'>
		<form method="POST" action="" name="sas">
		<?php
		
		for($x=0;$x<=$total_horas;$x++){ // INICIO_FOR_LINHA

		?>

		<TR>

			<?php
			
			if($SUNDAYES==1){ $n_dias_da_semana = 8; } else { $n_dias_da_semana = 7; }

			for($y=0;$y<$n_dias_da_semana;$y++){ // INICIO_FOR_COLUNA



			?>

			<!-- <TD WIDTH='<?php echo $tamanho_celula; ?>' -->

			<?php

					if(($x>=1)&&($y==0)){  } 

			?>

				

				<?php

				if(($x==0)&&($y==0)){
					?> <TD WIDTH='<?php echo $tamanho_celula; ?>' HEIGHT='<?php echo $altura_celula; ?>' <?php
					echo(" bgcolor='#4682B4' ");
					?> BORDER='0'> <?php
					echo $fonte[2]; echo $cor_fonte["branca"]; 

					echo("<b> $L_HORARIO_INICIAL </b>");
				}
				if(($x==0)&&($y>=1)){ // IMPRIMIR SEMANA 1a LINHA
					?> <TD colspan=2  WIDTH='<?php echo $tamanho_celula; ?>' HEIGHT='<?php echo $altura_celula; ?>' <?php
					echo ("bgcolor='#EDF5FF'");
					?> BORDER='0' > <?php


					if($qual_semana==1){

						$fgh1234=explode("-",$dia_atual);

						if($dia_da_semana2==0){ $inicioacbd=$inicio+1; } else { $inicioacbd=$inicio;  } 
  
						$rt = date("d",mktime (0, 0, 0, $fgh1234[1], $fgh1234[2]+$inicioacbd, $fgh1234[0]));
						$mes = date("m",mktime (0, 0, 0, $fgh1234[1], $fgh1234[2]+$inicioacbd, $fgh1234[0]));
						$ano = date("Y",mktime (0, 0, 0, $fgh1234[1], $fgh1234[2]+$inicioacbd, $fgh1234[0]));

					}
						echo $fonte[2]; echo $cor_fonte["azul"];
					
						echo("<b>"); echo $nome_semana[$y]; echo("</b>");
						echo ("<br>");

						// if($rt<10){ $rt="0".$rt; }

						if($sistema1==0){
							echo $fonte[1]; echo $rt; echo ("-"); echo $mes; echo ("-"); echo $ano;
						} else {
							echo $fonte[1]; echo $mes; echo ("-"); echo $rt; echo ("-"); echo $ano;
						}

									
				} 



				if(($x>=1)&&($y==0)){ // IMPRIMIR HORA 1a COLUNA E DEFINIR HORA
					?> <TD WIDTH='<?php echo $tamanho_celula; ?>' HEIGHT='<?php echo $altura_celula; ?>' <?php
					echo ("bgcolor='#4F94CD'"); 
					?> BORDER='0' > <?php

					if($sistema1==0){

						echo $fonte[2]; echo $cor_fonte["branca"];
							if($hora_inicio<=9){
								echo("<b>");echo("0");
							}
						echo("<b>"); echo $hora_inicio; 
						echo(":00"); echo("</b>");
						$hora_inicio++;

						if($hora_tab<=9){
							$hora="0".$hora_tab;
						} else {
							$hora=$hora_tab;
						}
						$hora_tab++;

					} else {

						echo $fonte[2]; echo $cor_fonte["branca"];
							if($hora_inicio<=9){
								echo("<b>");echo("0");
							}
						echo("<b>"); 
			
						if($hora_inicio==13){
							$hora_inicioFGH=1;

						}

						if($hora_inicio>=13){

							if($hora_inicioFGH<=9){
								echo("<b>");echo("0");
							}

							echo ("$hora_inicioFGH");
							$hora_inicioFGH++;

						} else {
							echo $hora_inicio; 
						}

						echo(":00"); 
						
						if($hora_inicio>=13){
							echo("$fonte[1] pm");
						} else {
							echo("$fonte[1] am");
						}

						echo("</b>");
						$hora_inicio++;

						if($hora_tab<=9){
							$hora="0".$hora_tab;
						} else {
							$hora=$hora_tab;
						}
						$hora_tab++;

					}

				}

				
				
				if(($x>=1)&&($y>=1)){ // PREENCHER CELULAS DE RESERVA

					if($qual_semana==1){

						$fgh12345=explode("-",$dia_atual);

						if($dia_da_semana2==0){ $inicio2acbd=$inicio2+1; } else {  $inicio2acbd=$inicio2; } 

						$rt2 = date("d",mktime (0, 0, 0, $fgh12345[1], $fgh12345[2]+$inicio2acbd, $fgh12345[0]));
						$mes2 = date("m",mktime (0, 0, 0, $fgh12345[1], $fgh12345[2]+$inicio2acbd, $fgh12345[0]));
						$ano2 = date("Y",mktime (0, 0, 0, $fgh12345[1], $fgh12345[2]+$inicio2acbd, $fgh12345[0]));

					}


					// if($rt2<10){ $rt2="0".$rt2; }

					$datatempo=$ano2."-".$mes2."-".$rt2." ".$hora.":00:00";   /* echo $datatempo; echo ("MES: $mes"); echo ("- MES2: $mes2"); */

					$dataso=$ano2."-".$mes2."-".$rt2;

					$tempof=date($dia_atual);
				
					$diaso=explode("-",$tempof);

					$diaso1=$diaso[2];

					$horaso=date("H");

					if($diaso1<=9){ $diaso1="0".$diaso1; }

					if($horaso<=9){ $horaso="0".$horaso; }

					mysql_select_db ($banco);

					$sql = "SELECT * FROM reservas WHERE datatempo='$datatempo' AND cod_sala='$cod_sala'";
					$resultado = mysql_query($sql) or die(mysql_error());
	
					$linha=mysql_fetch_array($resultado);					


						$dia_atual1=date("d");

						$hora_atual=date("H");

						$min_atual1=date("i");

						$ano_atual=date("Y");

						$mes_atual=date("m");


					

						echo $fonte[1];
						echo $cor_fonte["preta"];


					if($linha["cod_sala"]==""){
	
						echo("<TD  bgcolor='#C6E2FF'><center>");

							?>

							<input type="radio" name="reservar" value="<?php echo $datatempo; ?>"

								<?php
									if($ano2<=$anofgh1){
									
										if($mes2<$mesfgh){ echo(" disabled "); } 
										if($mes2==$mesfgh){ 
											if($rt2<$dia_atual1){ echo(" disabled "); $gh=1; } else { $gh=2; } 
											if($rt2==$dia_atual1){ 
												if($hora<$hora_atual){ echo(" disabled"); $gh=1; } else { $gh=2; } 
											} 
										}

									} 

									?> OnClick="javascript: alert('<?php echo $L_HORARIO_INICIO; ?> <?php if($sistema1==0){ echo $hora; } else { if($hora>=13){  echo $hora-12; echo(":00 pm");  } else { echo $hora; echo(":00 am"); }  }  ?>');">

							<?php

						echo("</TD>");

					} else {

						echo("<TD bgcolor='#9FB6CD'><center>");

							$matricula=$linha["matricula"];

							mysql_select_db ($banco);

							$sql1 = "SELECT * FROM sups WHERE matsup='$matricula'";
							$resultado1 = mysql_query($sql1) or die(mysql_error());
							$linha1=mysql_fetch_array($resultado1);
							$supervisor=$linha1["nome_sup"];
							$ticket=$linha["ticket"];
	
							echo("<a href=\"javascript:\" onMouseOver=\"return overlib('<html><table class=bordas bgcolor=#ffffff><tr><td><font face=arial color=#000000 size=2><b>$L_POR:</b> $supervisor<br><b> $L_COMENTARIO </b> $ticket</td></tr></table></html>',STATUS,'RESERVADO',FULLHTML)\" onMouseOut=\"nd()\"><b>R</b></a>");

						echo("</TD>");
	
					}


					

					mysql_select_db ($banco);

					$datatempo=$ano2."-".$mes2."-".$rt2." ".$hora.":30:00";

					$sql = "SELECT * FROM reservas WHERE datatempo='$datatempo' AND cod_sala='$cod_sala'";
					$resultado = mysql_query($sql) or die(mysql_error());
	
					$linha=mysql_fetch_array($resultado);

					if($linha["cod_sala"]==""){

						echo("<TD bgcolor='#B9D3FF'><center>");

	
							?> <input type="radio" name="reservar" value="<?php echo $datatempo; ?>"

									<?php
										
									if($ano2<=$anofgh1){

										if($mes2<$mesfgh){ echo(" disabled "); } if($mes2==$mesfgh){ if($rt2<$dia_atual1){ echo(" disabled "); $gh=1; } else { $gh=2; } if($rt2==$dia_atual1){ if($hora<$hora_atual){ echo(" disabled"); } if($min_atual>=30){ echo(" disabled"); $gh=1; } else { $gh=2; } } } 

									}

									?> 

									OnClick="javascript: alert('<?php echo $L_HORARIO_INICIO; ?> <?php if($sistema1==0){ echo $hora; } else { if($hora>=13){  echo $hora-12; echo(":30 pm");  } else { echo $hora; echo(":30 am"); }  }  ?>');">
							

							<?php

						echo("</TD>");

					} else {


						echo("<TD bgcolor='#9FB6CD'><center>");

							$matricula=$linha["matricula"];

							mysql_select_db ($banco);

							$sql1 = "SELECT * FROM sups WHERE matsup='$matricula'";
							$resultado1 = mysql_query($sql1) or die(mysql_error());
							$linha1=mysql_fetch_array($resultado1);
							$supervisor=$linha1["nome_sup"];
							$ticket=$linha["ticket"];
		
							echo("<a href=\"javascript:\" onMouseOver=\"return overlib('<html><table class=bordas bgcolor=#ffffff><tr><td><font face=arial color=#000000 size=2><b>$L_POR:</b> $supervisor<br><b>Comment:</b> $ticket</td></tr></table></html>',STATUS,'RESERVADO',FULLHTML)\" onMouseOut=\"nd()\"><b>R</b></a>");

						echo("</TD>");

					}
		
				}
			
				mysql_select_db ($banco);

				?>

			</TD>

			<?php

			if(($x==0)&&($y>=1)){ $inicio++; }
			if(($x>=1)&&($y>=1)){ $inicio2++; }

			

			} // FINAL_FOR_COLUNA

			$inicio2=$inicio3;
			$novomes2=0;
			$mes2=$mesd;
			// $marc2=0; ANTIGO
			?>

		</TR>

		<?php

		} // FINAL_FOR_LINHA

		?>

	</TABLE>
	<TABLE width="520" >
		<tr>
			<td >
				<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?> <b><?php echo $L_MENSAGEM_02; ?> <a href="apagar.php"><?php echo $L_AQUI; ?></a>.</b><br>
				<?php echo $L_MENSAGEM_03; ?>
			</td>
		</TD>
	</table>

	<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td background="" bgcolor="#9EC8FF"><img src="img/spacer.gif" width="1" height="1" alt=""><br></td></tr></table>

	<TABLE width="520" width="522" >
		<TR>
			<TD ><center>

				<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?><b><?php echo $L_DURACAO; ?>: (<?php echo $L_HORAS; ?>)<br>
				<input type="radio" name="tempo" value="0" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: ½ <?php echo $L_HORA; ?>');">  ½ &nbsp;&nbsp;
				<input type="radio" name="tempo" value="1" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 1 <?php echo $L_HORA; ?>');"> 01 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="2" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 2 <?php echo $L_HORAS; ?>');"> 02 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="3" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 3 <?php echo $L_HORAS; ?>');"> 03 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="4" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 4 <?php echo $L_HORAS; ?>');"> 04 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="5" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 5 <?php echo $L_HORAS; ?>');"> 05 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="6" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 6 <?php echo $L_HORAS; ?>');"> 06 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="11" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 11 <?php echo $L_HORAS; ?>');"> 11 &nbsp;&nbsp;
				<input type="radio" name="tempo" value="14" OnClick="javascript: alert('<?php echo $L_DURACAO; ?>: 14 <?php echo $L_HORAS; ?>');"> 14 &nbsp;&nbsp;

			</TD>
		</TR>
	</TABLE>
	<TABLE BORDER="0" WIDTH="100%">
		<TR>
			<TD ALIGN="LEFT" WIDTH="50%">
				<Table>
					<tr>
	
						<TD>
							<?php echo $fonte[2]; echo $cor_fonte["azul"]; ?>
							<b><?php echo $L_COMENTARIO; ?> <br>
						</tD>
						<TD>
							<input type="text" name="ticket" class="bordas" border="0" size="15" value="">
							<input type="checkbox" name="na" OnClick="javascript: checkna();" ><b><?php echo $fonte[1]; echo $cor_fonte["azul"]; ?><?php echo $L_SA; ?>
							
							
						</TD>
					</tr>
				</TABLE>
			</TD>
			<TD ALIGN="CENTER" WIDTH="20%">
				<?php echo $fonte[1]; echo $cor_fonte["branca"]; ?>
				<input border="0" class="bordas" type="hidden" name="cod_sala"  value="<?php echo $cod_sala; ?>">
				<input border="0" class="bordas" type="hidden" name="prox_semana"  value="<?php echo $prox_semana; ?>">
				<!-- <input border="0" class="bordas" type="hidden" name="dia_atual"  value="<?php echo $dia_atual; ?>"> -->
				<input border="0" class="bordas" type="hidden" name="qualsemana1"  value="<?php echo $qual_semana; ?>">
				<BUTTON border="0" class="bordas" OnClick="AAA=window.open('user2.php?destruir=sim','_self');"><?php echo $L_SAIR; ?></BUTTON>
			</TD>
			<TD>
				<!-- <BUTTON border="0" class="bordas" OnClick="AAA=window.open('http://svrrederjo07/arsys/servlet/ViewFormServlet?server=10.5.9.22&form=HPD%3aHelpDesk&view=Aplicacao%20Web3&app=AplicacaoWeb3&mode=CREATE','_blank');">Remedy</BUTTON> -->

			</TD>
			<TD ALIGN="RIGHT" WIDTH="33%">
				<input border="0" class="bordas" type="button" name="enviar"  value="<?php echo $L_RESERVAR; ?> >>" onClick="javascript:valida();">
			</TD>
		</TR>
	</form>
	</TABLE>


	</TD></TR>
	</TABLE>
	<center><font face="verdana,arial" size="1" color="#4682B4"><?php echo $L_TITULO; ?> v.<?php include('versao.inc.php'); echo $versao; ?> www.ighor.com

	<?php


} // FINAL_FUNCTION_MOSTRARSEMANA


// -------------------------------------------------------------------------------------------------- //
// ---------           ENVIAR          -------------------------------------------------------------- //
// -------------------------------------------------------------------------------------------------- //


$enviar=$_GET["enviar"];

if($enviar=="sim"){ // INICIO_ENVIAR_0

	$matricula=$_SESSION["matricula"];
	$prox_semana=$_POST["prox_semana"];
	//$dia_atual=$_POST["dia_atual"];
	$dia_atual=$_POST["data_dia1"];

	$senha=$_SESSION["senha"];
	$cod_sala=$_POST["cod_sala"];
	$qual_semana1=$_POST["qualsemana1"];

	mysql_select_db ($banco);

	$sql1 = "SELECT * FROM sups WHERE matsup='$matricula'";
	$resultado1 = mysql_query($sql1) or die(mysql_error());
	$linha1=mysql_fetch_array($resultado1);

	if(($linha1["matsup"]==$matricula)&&($linha1["senha"]==$senha)){ // REL_000

		$reservar=$_POST["reservar"];
		$tempo=$_POST["tempo"];

		if($tempo==0){ $tempo_meio=1; }

		$dia_hora=explode(" ",$reservar);
		$dia_mes_ano=explode("-",$dia_hora[0]);
		$sas_ver4_1=$dia_hora[0];
		$hora_min_seg=explode(":",$dia_hora[1]);
		$hora_inicio=$hora_min_seg[0];
		$hora_inicio2=$hora_min_seg[0];
		$min_inicio=$hora_min_seg[1];

		$e_ano=$dia_mes_ano[0];
		$e_mes=$dia_mes_ano[1];
		$e_dia=$dia_mes_ano[2];

		$email_data=$e_dia."/".$e_mes."/".$e_ano;
		$email_hora=$dia_hora[1];
		
		$existe=0;

		mysql_select_db ($banco);

		$sql8 = "SELECT * FROM salas WHERE cod_sala='$cod_sala'";
		$resultado8 = mysql_query($sql8) or die(mysql_error());
		$linha8=mysql_fetch_array($resultado8);

		$datan=$dia_hora[0];


		if(($min_inicio==00)&&($tempo==0)){ // REF_001

			$verificar_existe=$datan." ".$hora_inicio.":00:00";
	
			$ticket=$_POST["ticket"];

			mysql_select_db ($banco);

			$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
			$resultado = mysql_query($sql) or die(mysql_error());
	
			$linha=mysql_fetch_array($resultado);

			if($linha["cod_sala"]==$cod_sala){
				$existe++;
				echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *1*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
			}

		} // REF_001


		if(($min_inicio==30)&&($tempo==0)){ // REF_002

			$verificar_existe=$datan." ".$hora_inicio.":30:00";
	
			$ticket=$_POST["ticket"];

			mysql_select_db ($banco);

			$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
			$resultado = mysql_query($sql) or die(mysql_error());
	
			$linha=mysql_fetch_array($resultado);

			if($linha["cod_sala"]==$cod_sala){
				$existe++;
				echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *2*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
			}

		} // REF_002


		if(($min_inicio==00)&&($tempo>=1)){ // REF_003

			for($i=1;$i<=$tempo;$i++){

				$verificar_existe=$datan." ".$hora_inicio.":00:00";

				$ticket=$_POST["ticket"];

				mysql_select_db ($banco);

				$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
				$resultado = mysql_query($sql) or die(mysql_error());
		
				$linha=mysql_fetch_array($resultado);

				if($linha["cod_sala"]==$cod_sala){
					$existe++;
					echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *3*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
				}

				if(($tempo>=1)&&($tempo!=$i)){

					$verificar_existe=$datan." ".$hora_inicio.":30:00";

					$ticket=$_POST["ticket"];

					mysql_select_db ($banco);

					$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
					$resultado = mysql_query($sql) or die(mysql_error());
		
					$linha=mysql_fetch_array($resultado);

					if($linha["cod_sala"]==$cod_sala){
						$existe++;
						echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *4*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
					}

				}

					if($hora_inicio<=9){
						$hora_inicio="0".$hora_inicio+1;
					} else {
						$hora_inicio=$hora_inicio+1;
					}
					
			}


		} // REF_003


		if(($min_inicio==30)&&($tempo>=1)){ // INICIO IF 2

			$verificar_existe=$datan." ".$hora_inicio.":30:00";

			$ticket=$_POST["ticket"];

			mysql_select_db ($banco);
			$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
			$resultado = mysql_query($sql) or die(mysql_error());
		
			$linha=mysql_fetch_array($resultado);

			if($linha["cod_sala"]==$cod_sala){
				$existe++;
				echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('  $L_MENSAGEM_04 *5*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
			}

			if($hora_inicio<=9){
				$hora_inicio="0".$hora_inicio+1;
			} else {
				$hora_inicio=$hora_inicio+1;
			}
				
			for($i=1;$i<=$tempo;$i++){

				$verificar_existe=$datan." ".$hora_inicio.":00:00";

				$ticket=$_POST["ticket"];

				mysql_select_db ($banco);

				$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
				$resultado = mysql_query($sql) or die(mysql_error());
		
				$linha=mysql_fetch_array($resultado);

				if($linha["cod_sala"]==$cod_sala){
					$existe++;
					echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *6*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
				}

				if(($tempo>=2)&&($tempo!=$i)){

					$verificar_existe=$datan." ".$hora_inicio.":30:00";

					$ticket=$_POST["ticket"];

					mysql_select_db ($banco);

					$sql = "SELECT * FROM reservas WHERE datatempo='$verificar_existe' AND cod_sala='$cod_sala'";
					$resultado = mysql_query($sql) or die(mysql_error());
		
					$linha=mysql_fetch_array($resultado);

					if($linha["cod_sala"]==$cod_sala){
						$existe++;
						echo ("<html><SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_04 *7*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body></html>");
					}

				}

					if($hora_inicio<=9){
						$hora_inicio="0".$hora_inicio+1;
					} else {
						$hora_inicio=$hora_inicio+1;
					}
					
			}

		} // FIM IF 2

		mysql_select_db ($banco);	

		$datam=$dia_hora[0];

		if($existe==0){ // REF_004

			if(($min_inicio==00)&&($tempo==0)){

				$salvar_data=$datam." ".$hora_inicio2.":00:00";

				mysql_select_db ($banco);
	
				$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";

					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *8*</i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}

			}


			if(($min_inicio==30)&&($tempo==0)){

				$salvar_data=$datam." ".$hora_inicio2.":30:00";

				mysql_select_db ($banco);
	
				$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";

					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *9*</i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}

			}


			if(($min_inicio==30)&&($tempo>=2)){ // INICIO IF 3

				$salvar_data=$datam." ".$hora_inicio2.":30:00";

				mysql_select_db ($banco);
	
				$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";

					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *10*</i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}

				if($hora_inicio2<=9){
					$hora_inicio2="0".$hora_inicio2+1;
				} else {
					$hora_inicio2=$hora_inicio2+1;
				}

				for($i=1;$i<=$tempo;$i++){

					$salvar_data=$datam." ".$hora_inicio2.":00:00";

					mysql_select_db ($banco);
	
					$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";
	
					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 </i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}


					if($tempo!=$i){

						$salvar_data=$datam." ".$hora_inicio2.":30:00";

						mysql_select_db ($banco);
	
						$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";
		
						if(!mysql_query($sql)){
							echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *11*</i><br> ERRO MySQL:</b> ". mysql_error());
							exit();
						}

					}
				
					if($hora_inicio2<=9){
						$hora_inicio2="0".$hora_inicio2+1;
					} else {
						$hora_inicio2=$hora_inicio2+1;
					}

				}

			} // FIM IF 3


			if(($min_inicio==30)&&($tempo==1)){ // INICIO IF 5

				$salvar_data=$datam." ".$hora_inicio2.":30:00";

				mysql_select_db ($banco);
	
				$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";

					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *12*</i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}

				if($hora_inicio2<=9){
					$hora_inicio2="0".$hora_inicio2+1;
				} else {
					$hora_inicio2=$hora_inicio2+1;
				}


				$salvar_data=$datam." ".$hora_inicio2.":00:00";

				mysql_select_db ($banco);
	
				$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";
	
				if(!mysql_query($sql)){
					echo ("<b><font face=\"arial,verdana\" size=\"-1\">  $L_MENSAGEM_05 *13*</i><br> ERRO MySQL:</b> ". mysql_error());
					exit();
				}

			} // FIM IF 5




			if(($min_inicio==00)&&($tempo>=1)){ // INICIO IF 4

				for($i=1;$i<=$tempo;$i++){

					$salvar_data=$datam." ".$hora_inicio2.":00:00";

					mysql_select_db ($banco);
	
					$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";
	
					if(!mysql_query($sql)){
						echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *14*</i><br> ERRO MySQL:</b> ". mysql_error());
						exit();
					}

					if($tempo>=1){

						$salvar_data=$datam." ".$hora_inicio2.":30:00";

						mysql_select_db ($banco);
	
						$sql = "INSERT INTO reservas (datatempo,cod_sala,matricula,ticket) VALUES ('$salvar_data','$cod_sala','$matricula','$ticket')";
		
						if(!mysql_query($sql)){
							echo ("<b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_05 *15*</i><br> ERRO MySQL:</b> ". mysql_error());
							exit();
						}

					}
				
					if($hora_inicio2<=9){
						$hora_inicio2="0".$hora_inicio2+1;
					} else {
						$hora_inicio2=$hora_inicio2+1;
					}

				}

			} // FIM IF 4




		$para="Ighor Toth <ighor@brasilcenter.com.br>\n"; // ------------ ENVIO DE E-MAIL -------------
		// $de="Return-Path: <sas@yourserver.com>\n";
		$de=$linha1["nome_sup"];
		$sala=$linha8["nome_sala"];
		$titulo="SAS - RESERVA DE SALA - De: ".$de." - Sala: ".$sala." - Data: ".$email_data." - Hora: ".$email_hora." - Duração: ".$tempo;

		// "Return-Path: <$email>\n"

		// $recipient = "$adminName <$adminEmail>";

		$texto="\n------------------------------------------------------------\nVocê acaba de receber um e-mail enviado através do\nSAS - Sistema de Agendamento de Sala (http://sas.seuservidor.com)\nOBS: Não responda esta mensagem.\n------------------------------------------------------------\n\nDe: ".$de."\nSala: ".$sala."\nData: ".$email_data."\nHora: ".$email_hora."\nDuração: ".$tempo." Hora(s)\n\nOBS: NÃO ESQUEÇA DE CONFIRMAR O AGENDAMENTO.";

		// mail ($para, $titulo, $texto, $de);

		?> <SCRIPT LANGUAGE="JavaScript"> function tela(){ alert('<?php echo $L_MENSAGEM_07; ?> *16*'); window.navigate('<?php echo $PHP_SELF; ?>?codsala=<?php echo $cod_sala; ?>&qualsemana=<?php echo $qual_semana1; ?>&prox_semana=<?php echo $prox_semana; ?>&dia_atual=<?php echo $sas_ver4_1; ?>'); } </SCRIPT> <BODY OnLoad="javascript:tela();" > </body> <?php

		} // REF_004
	

	} else {

		echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_06; *17*'); window.navigate('"); echo $PHP_SELF; echo("?codsala=$cod_sala&qualsemana=1&prox_semana=$prox_semana&dia_atual=$sas_ver4_1'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");

	} // REL_000	

} else { // ELSE_ENVIAR_0

	$cod_sala=$_POST["cod_sala"];
	$cod_sala22=$_GET["codsala"];

	$data_dia1=$_POST["data_dia1"];
	$dia_atual22=$_GET["dia_atual"];

	$proxima=$_POST["proxima"];	
	$anterior=$_POST["anterior"];
	$data1=$_POST["data1"];
	$inicio=$_POST["inicio1"];
	$prox_semana=$_POST["prox_semana"];
	$dia_atual=$_POST["dia_atual"];
	
	
		$tempo=date("Y-m-d");

		$tempod=$tempo;

		$tempod=explode("-",$tempod);

			$dia=$tempod[2];
			$mes=$tempod[1];
			$ano=$tempod[0];

			$tempo = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

			$dia_da_semana2=$tempo;

			$tempo="";

			$tempo=date("Y-m-d");

			$tempod=$tempo;

			$tempod=explode("-",$tempod);

			$dia=$tempod[2];
			$dia=$dia+6;
			$mes=$tempod[1];
			$ano=$tempod[0];

			// echo $tempo; echo("lll"); echo $dia; echo(" -- "); echo $mes; echo (" -- "); echo $ano; echo (" KKKK ");

			$temp_ano=$ano."-12-31";

			// echo $dia_da_semana; exit();
	
			if($dia_da_semana2==1){   $dia_da_semana="Segunda"; $inicio=0;  $inicio2=0;  $iniciok=1; $inicio_prox=7; }
			if($dia_da_semana2==2){   $dia_da_semana="Terça";   $inicio=-1; $inicio2=-1; $iniciok=2; $inicio_prox=6; }
			if($dia_da_semana2==3){   $dia_da_semana="Quarta";  $inicio=-2; $inicio2=-2; $iniciok=3; $inicio_prox=5; }
			if($dia_da_semana2==4){   $dia_da_semana="Quinta";  $inicio=-3; $inicio2=-3; $iniciok=4; $inicio_prox=4; }
			if($dia_da_semana2==5){   $dia_da_semana="Sexta";   $inicio=-4; $inicio2=-4; $iniciok=5; $inicio_prox=3; }
			if($dia_da_semana2==6){   $dia_da_semana="Sábado";  $inicio=-5; $inicio2=-5; $iniciok=6; $inicio_prox=2; }
			if($dia_da_semana2==7){   $dia_da_semana="Domingo";  $inicio=-6; $inicio2=-6; $iniciok=7; $inicio_prox=1; }
			if($dia_da_semana2==0){   $dia_da_semana="Domingo"; $dia++; $inicio=0; $inicio2=0; $inicio_prox=1; } //CASO SEJA DOMINGO


			if($dia<10){ $dia="0".$dia; }

			if($cod_sala){

				if($data_dia1){
					mostrarsemana($data_dia1,$cod_sala,"1",$prox_semana,$data_dia1);
					?>  <!-- <script Language="JavaScript"> alert("*** 1 ***") </script> --> <?
	
				} else {
					mostrarsemana($tempo,$cod_sala,"1",$prox_semana,$tempo);
					?>  <!-- <script Language="JavaScript"> alert("*** 2 ***") </script> --> <?
				}


			} else if ($cod_sala22){

				if($dia_atual22){
					mostrarsemana($dia_atual22,$cod_sala22,"1",$prox_semana,$dia_atual22);
					?>  <!-- <script Language="JavaScript"> alert("*** 3 ***") </script> --> <?
	
				} else {
					mostrarsemana($tempo,$cod_sala22,"1",$prox_semana,$tempo);
					?>  <!-- <script Language="JavaScript"> alert("*** 4 ***") </script> --> <?
				}

			} else {


				mysql_select_db ($banco);
		
				$sql8 = "SELECT min(cod_sala) AS minimo FROM salas";
				$resultado8 = mysql_query($sql8) or die(mysql_error());
				$linha8=mysql_fetch_array($resultado8);
				$minimo=$linha8["minimo"];

				if($data_dia1){
					mostrarsemana($data_dia1,$minimo,"1",$prox_semana,$data_dia1);
					?>  <!-- <script Language="JavaScript"> alert("*** 5 ***") </script> --> <?
				} else {
					mostrarsemana($tempo,$minimo,"1",$prox_semana,$tempo);
					?>  <!-- <script Language="JavaScript"> alert("*** 6 ***") </script> --> <?
				}
			}

} // FIM_ENVIAR_0

?>			
