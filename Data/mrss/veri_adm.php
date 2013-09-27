<?php
session_start();
$matricula=$_POST["matricula"];
$senha=$_POST["senha"];
include('conf.inc.php');
include('languages/padrao.inc.php');

function merro(){
	echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_06 '); window.navigate('adm.php'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
}

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



if($matricula){

	include('conecta.php');

	$db=mysql_connect ($servidor, $usuario, $senhadb)
	or die ('Impossível conectar no bando de dados: ' . mysql_error());

	mysql_select_db($banco);

	$query = "SELECT * FROM adms WHERE matsup = '$matricula'"; 

	$result = mysql_query($query) or die(mysql_error());

	while($linha=mysql_fetch_array($result)) { 

		if($linha["matsup"]==$matricula){
			if($linha["senha"]==$senha){
				?>
				<HTML>
				<HEAD>
					<SCRIPT LANGUAGE="JavaScript">
					
					function tela(){
		
						form = document.verifica
						form.action = 'adm.php'
						form.submit();	
					}
						
					</SCRIPT>
				<HEAD>
				<BODY>
					
						<form name="verifica" method="post" action="adm.php">
							<input type="hidden" name="matricula" border=0 value="<?php echo $matricula; ?>">
							<input type="hidden" name="nome" border=0 value="<?php echo $linha["nome"] ?>">
						</form>

					<SCRIPT LANGUAGE="JavaScript">
					tela();
					</SCRIPT>
				</BODY>
				</HTML>				
				<?php

				exit();
			} else {
				echo("Error 1");
				merro();
				exit();
			}
		} else {
			echo("Error 2");
			merro();
			exit();
		}
	}

} else {
	echo("Error 3");
	merro();
	exit();

}

echo("Error 4");
merro();
exit();

?>
