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
// | Bugs, translations or issues, write to: igtoth@netsite.com.br        |
// | ATTENTION: OLD VERSION: RSS - Room Scheduler System -- DISCONTINUED  |
// +----------------------------------------------------------------------+

	include('conecta.php');

	mysql_select_db($banco);

	$apagarc=$_POST["apagarc"];
	$matricula=$_POST["matricula"];
	$cod_sala=$_POST["cod_sala"];
	$nome=$_POST["nome"];

	function vazio($matricula,$cod_sala,$nome){

					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
					
						function tela(){
		
							alert('POR FAVOR SELECIONE UM HORÁRIO Á SER APAGADO!')
							form = document.verifica
							form.action = 'adm.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="adm.php">
								<input type="hidden" name="sup" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>">
								<input type="hidden" name="ver" border=0 value="1">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();


	}

	if($apagarc==""){ vazio($matricula,$cod_sala,$nome); }

	foreach ($apagarc as $k => $v) {

		/* echo "\$apagarc[$k] => $v.\n"; */

		$ex1=explode("/",$v);

		$datatempo1=$ex1[0];
		$matricula1=$ex1[1];
		$cod_sala=$ex1[2];

		$sql = "DELETE FROM reservas WHERE datatempo = '$datatempo1' AND matricula = '$matricula1' AND cod_sala = $cod_sala";

		if(mysql_query($sql)){
			$deletado=1;
		} else {
			$deletado=0;
		}

	}





	if($deletado==1){

					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
					
						function tela(){
		
							alert('RESERVA(S) APAGADA(S)!')
							form = document.verifica
							form.action = 'adm.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="adm.php">
								<input type="hidden" name="sup" border=0 value="<?php echo $matricula1; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $matricula1; ?>">
								<input type="hidden" name="ver" border=0 value="1">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();


	} else {

		echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">REGISTROS NÃO APAGADOS. CONTATE O SUPORTE LOCAL!!!</i><br><br> ERRO MySQL:</b> ". mysql_error());

	}


	/*
	foreach($apagar1 as $apa) { 

		echo $apa; echo("<br>");

	} 
	*/

?>
