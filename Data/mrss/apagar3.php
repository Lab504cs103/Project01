<?php
include('languages/padrao.inc.php');
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
		
							alert('<?php echo $L_MENSAGEM_48; ?>')
							form = document.verifica
							form.action = 'apagar.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="apagar.php">
								<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>">
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

		$sql = "DELETE FROM reservas WHERE datatempo = '$v' AND matricula = '$matricula' AND cod_sala = $cod_sala";

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
		
							alert('<?php echo $L_MENSAGEM_49; ?>')
							form = document.verifica
							form.action = 'apagar.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="apagar.php">
								<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
								<input type="hidden" name="cod_sala" border=0 value="<?php echo $cod_sala; ?>">
								<input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>">
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();


	} else {

		echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_50 </i><br><br> MySQL ERROR:</b> ". mysql_error());

	}


	/*
	foreach($apagar1 as $apa) { 

		echo $apa; echo("<br>");

	} 
	*/

?>
