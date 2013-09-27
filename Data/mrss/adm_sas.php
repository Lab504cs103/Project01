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
include('languages/padrao.inc.php');
?>
<html>
<head>

	<link rel="stylesheet" href="compose/css/css.css" type="text/css" media="screen" />


 <!-- ----------------------------------------------------- -->


	<title>SAS Adm Usuarios</title>

	<style type="text/css">
		<!--
		.form {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #333333;
			border: 1px solid #999999;
		}
		.txt {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #333333;
		}
		.txt11 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #333333;
		}
		.botao {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #333333;
			background-color: #CCCCCC;
			border: 1px solid #999999;
		}
		-->
		.bordas {
			border: 1px solid #999999;
		}
		-->
		<!--
		.bordas1 {
			border: 1px solid #F5F5F5;
		}
		-->
	</style>

</head>

<body class="body" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"  onload="initEditor()" >
<a name="top"></a>
		<?php 

			$adm_diaLL=$_GET["adm_dia"];
			$adm_ilhaLL=$_GET["adm_ilha"];
			$adm_supLL=$_GET["adm_sup"];
			$adm_naookLL=$_GET["adm_naook"];
			$adm_mensagensLL=$_GET["adm_mensagens"];
			$adm_usuariosLL=$_GET["adm_usuarios"];
			$edmensLL=$_GET["edmens"];
			if($adm_diaLL){ echo("Pesquisa <img src='img/arrow.gif'> Data"); }
			if($adm_ilhaLL){ echo("Pesquisa <img src='img/arrow.gif'> Ilha"); }
			if($adm_supLL){ echo("Pesquisa <img src='img/arrow.gif'> Supervisor"); }
			if($adm_naookLL){ echo("Pesquisa <img src='img/arrow.gif'> Ilha não ok"); }
			if($adm_mensagensLL){ echo("Mensagens"); }
			if($edmensLL){ echo("Mensagens <img src='img/arrow.gif'> Editar/Adicionar"); }
			if($adm_usuariosLL){ echo(" "); }

			
		?>
			<br>
					<img src="img/arrow.gif" border="0">
					<BUTTON border="0" class="bordas1" STYLE="text-align:left; background-color:#F5F5F5; height:15px; font-family:Verdana,Arial; font-size=10; width:140px;" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&usuarios5=sim','_self');" OnMouseOver="javascript: this.style.backgroundColor='#dcdcdc';" OnMouseOut="javascript: this.style.backgroundColor='#f5f5f5';">
					<?php echo $L_USUARIOS; ?>
					</BUTTON> &nbsp;
					<img src="img/arrow.gif" border="0">
					<BUTTON border="0" class="bordas1" STYLE="text-align:left; background-color:#F5F5F5; height:15px; font-family:Verdana,Arial; font-size=10; width:140px;" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&admins5=sim','_self');" OnMouseOver="javascript: this.style.backgroundColor='#dcdcdc';" OnMouseOut="javascript: this.style.backgroundColor='#f5f5f5';">
					<?php echo $L_ADMIN; ?>
					</BUTTON> &nbsp;
					<BUTTON border="0" class="bordas1" STYLE="text-align:left; background-color:#F5F5F5; height:15px; font-family:Verdana,Arial; font-size=10; width:140px;" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?sam=hjk','_self');" OnMouseOver="javascript: this.style.backgroundColor='#dcdcdc';" OnMouseOut="javascript: this.style.backgroundColor='#f5f5f5';">
					<?php echo $L_VOLTAR; ?>
					</BUTTON>
			<br>	

		<?php

$sup=$_GET["sup"];
$ilha=$_GET["ilha"];
$matsup=$_GET["user"];
$data=date("Y-m-d");

$admpi=$_POST["admpi"];
$adm=$_GET["adm"];

// $est=$_GET["est"];

if($adm!=sim){ $est="sim"; }

// if($est){ include('est.inc.php'); }

if(($adm==sim)||($admpi==sim)){  // MODULO ADMINISTRAÇÃO


		$adm_usuarios=$_GET["adm_usuarios"];

		if($adm_usuarios==sim){ // INICIO ADM_USERS


			$usuarios5=$_GET["usuarios5"];
	
			if($usuarios5==sim){

			?>
				<br>
				<font size=3 face="verdana,arial" color="#000000"><b>&nbsp; <?php echo $L_USUARIOS; ?>
				<table width="100%" align="center">
					<tr align="center">	
						<td align="center" >

							<table width="100%" align="center">
								<tr align="center">	
									<td align="left">   

									</td>
									<td align="right">
										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&eduser=sim&novo=sim','_self');">
										<?php echo $L_NOVO_USUARIO; ?>
										</BUTTON>
									</td>
								</tr>
							</table>

							<table border="0" width="100%">

								<tr bgcolor="#1F6AB1">

									<td width="15%" ><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_MATRICULA; ?>
									</td>
									<td width="65%"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_NOME; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_EDITAR; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_APAGAR; ?>
									</td>
								</tr>

								<?php
				
										$sqlus = "SELECT * from sups ORDER BY nome_sup";
										$resultado = mysql_query($sqlus) or die(mysql_error());
										$ci=0;
										while($linha_us=mysql_fetch_array($resultado)) { // INICIO WHILE_US

								?>

								<tr bgcolor="#<?php if($ci==0){ echo("FFFFFF"); $ci=1; } else { echo("F5F5F5"); $ci=0; } ?>">
									<td><font size=2 face="arial">
										<center><?php echo $linha_us["matsup"]; ?>
									</td>
									<td><font size=2 face="arial">
										<?php echo $linha_us["nome_sup"]; ?>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="?novosusuarios=sim&adm=sim&adm_usuarios=sim&eduser=<?php echo $linha_us["matsup"]; ?>"><img src="img/editar.gif" border="0" alt="Ediar dados de: <?php echo $linha_us["nome_sup"]; ?>"></a>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="?novosusuarios=sim&adm=sim&adm_usuarios=sim&apauser=<?php echo $linha_us["matsup"]; ?>&usu=<?php echo $linha_us["nome_sup"]; ?>"><img src="img/apagar.gif" border="0" alt="Ediar dados de: <?php echo $linha_us["nome_sup"]; ?>"></a>
									</td>

								</tr>

								<?php

										} // FIM WHILE_US
								
								?>

							</table>
						</td>
					</tr>
				</table>

			<?php

			} // FIM USUARIOS5


		}


			$admins5=$_GET["admins5"];
	
			if($admins5==sim){

			?>
				<br>
				<font size=3 face="verdana,arial" color="#000000"><b>&nbsp;<?php echo $L_MENSAGEM_35; ?>
				<table width="100%" align="center">
					<tr align="center">	
						<td align="center" >

							<table width="100%" align="center" >
								<tr align="center">	
									<td align="left">   

									</td>
									<td align="right">
										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&edadm=sim&novo=sim','_self');">
										<?php echo $L_NOVO_ADMIN; ?>
										</BUTTON>
									</td>
								</tr>
							</table>

							<table border="0" width="100%">

								<tr bgcolor="#1F6AB1">

									<td width="25%" ><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_USUARIO; ?>
									</td>
									<td width="65%"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_NOME; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_EDITAR; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><?php echo $L_APAGAR; ?>
									</td>
								</tr>

								<?php
				
								$sqladm = "SELECT * from adms ORDER BY nome";
								$resultadoadm = mysql_query($sqladm) or die(mysql_error());
								$ci=0;
								while($linha_adm=mysql_fetch_array($resultadoadm)) { // INICIO WHILE_US

								?>

								<tr bgcolor="#<?php if($ci==0){ echo("FFFFFF"); $ci=1; } else { echo("F5F5F5"); $ci=0; } ?>">
									<td><font size=2 face="arial">
										<?php echo $linha_adm["matsup"]; ?>
									</td>
									<td><font size=2 face="arial">
										<?php echo $linha_adm["nome"]; ?>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="?novosusuarios=sim&adm=sim&adm_usuarios=sim&edadm=<?php echo $linha_adm["matsup"]; ?>"><img src="img/editar.gif" border="0" alt="Ediar dados de: <?php echo $linha_adm["nome"]; ?>"></a>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="?novosusuarios=sim&adm=sim&apaadm=<?php echo $linha_adm["matsup"]; ?>"><img src="img/apagar.gif" border="0" alt="Apagar dados de: <?php echo $linha_adm["nome"]; ?>"></a>
									</td>

								</tr>

								<?php

								} // FIM WHILE_US
								
								?>

							</table>
						</td>
					</tr>
				</table>
		
			<?php

			} // FIM ADMINS5








			$edadm=$_GET["edadm"];

			if($edadm){ // INICIO ADM_EDUSER

				$novo=$_GET["novo"];

				if($novo=="sim"){

					echo("");

				} else {

				$sql = "SELECT * from adms WHERE matsup = '$edadm'";
				$result = mysql_query($sql) or die(mysql_error());
				$linha=mysql_fetch_array($result);

				}
	
			?>

					<SCRIPT LANGUAGE="JavaScript">
					
					function tela2(){
						
						form = document.edadmformgg
						senha = form.senha.value
						senha1 = form.senha1.value

						if(senha == senha1){
							form.action = '?adm=sim&edadm_nova=sim&adm_usuarios=sim'
							form.submit();							
						} else {
							alert("<?php echo $L_MENSAGEM_11; ?>")
							form.senha.focus()
							return;
						}
	
					}

					function tela3(){
						
						form = document.edadmformgg
						senha = form.senha.value
						senha1 = form.senha1.value

						if(senha == senha1){
							form.action = '?adm=sim&edadm_env=sim&adm_usuarios=sim'
							form.submit();							
						} else {
							alert("<?php echo $L_MENSAGEM_11; ?>")
							form.senha.focus()
							return;
						}
	
					}
						
					</SCRIPT>

				<br>
				<table width="100%" align="center">
					<tr align="center">	
						<td align="center">
	
							<table width="100%" align="center">
								<tr align="center">	
									<td align="left">
										<font size=3 face="verdana,arial" color="#000000"><b><?php if($novo){ echo $L_MENSAGEM_36; } else { echo $L_MENSAGEM_37; } ?>

									</td>
								</tr>
							</table>
							<br>					
							<table width="100%" align="center">
								<tr>	
									<td  align="right">
										<form name="edadmformgg" method="post" action="?novosusuarios=sim&adm=sim&adm_usuarios=sim">
										<font face="arial,verdana" size="2"><?php echo $L_USUARIO; ?>: </font><br>
									</td>
									<td align="left">
										<input class="bordas" type=text size="15" name="matricula" value="<?php if($novo){ echo(""); } else { echo $linha["matsup"]; } ?>"><br>
									</td>
								</tr>
									<td align="right">
										<font face="arial,verdana" size="2"><?php echo $L_NOME; ?>: </font><br>
									</td>
									<td align="left">	
										
										<input class="bordas" type=text size="40" name="nome" value="<?php if($novo){ echo(""); } else { echo $linha["nome"]; } ?>"><br>
										

									</td>
								</tr>
								<tr>
									<td align="right">
										<font face="arial,verdana" size="2"><?php echo $L_SENHA; ?> </font><br>
									</td>
									<td align="left">
										<input class="bordas" type=password size="20" name="senha" value="<?php if($novo){ echo(""); } else { echo $linha["senha"]; } ?>"><br>
									</td>
								</tr>
								<tr>
									<td align="right">
										<font face="arial,verdana" size="2"><?php echo $L_CONFIRM_SENHA; ?> </font><br>
									</td>
									<td align="left">
										<input class="bordas" type=password size="20" name="senha1" value="<?php if($novo){ echo(""); } else { echo $linha["senha"]; } ?>"><br>
									</td>
								</tr>
							</table>
							<table border="0">
								<tr>
									<td align="center">
										<center>
											<?php

											if($novo){
	
											?>
												<br>
												<input border="0" class="bordas" type="button" name="edadm_nova" value="<?php echo $L_ADICIONAR; ?>" onClick="javascript:tela2();">
												<br>
	
											<?php
	
											} else {
	
											?>
												<br>
												<input border="0" class="bordas" type="button" name="edadm_env" value="<?php echo $L_ALTERAR; ?>" onClick="javascript:tela3();">
												<br>
										
											<?php

											}	

											?>

										</form>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

			<?php
	
			} // FIM ADM_NOVO_ADMIN	



			$eduser=$_GET["eduser"];

			if($eduser){ // INICIO ADM_EDUSER

				$novo=$_GET["novo"];

				if($novo=="sim"){

					echo("");

				} else {

				$sql = "SELECT * from sups WHERE matsup = $eduser";
				$result = mysql_query($sql) or die(mysql_error());
				$linha=mysql_fetch_array($result);

				}
	
			?>
				<br>
				<table width="100%" align="center">
					<tr align="center">	
						<td align="center">
	
							<table width="100%" align="center">
								<tr align="center">	
									<td align="left">
										<font size=3 face="verdana,arial" color="#000000"><b><?php if($novo){ echo $L_NOVO_USUARIO; } else { echo $L_EDITAR; } ?>

									</td>
								</tr>
							</table>
							<br>					
							<table width="100%" align="center">
								<tr>	
									<td  align="right">
										<form name="edusersform" method="post" action="?novosusuarios=sim&adm=sim&adm_usuarios=sim">
										<font face="arial,verdana" size="2"><?php echo $L_MATRICULA; ?>: </font><br>
									</td>
									<td align="left">
										<input class="bordas" type=text size="15" name="matricula" value="<?php if($novo){ echo(""); } else { echo $linha["matsup"]; } ?>"><br>
									</td>
								</tr>
									<td align="right">
										<font face="arial,verdana" size="2"><?php echo $L_NOME; ?>: </font><br>
									</td>
									<td align="left">	
										
										<input class="bordas" type=text size="40" name="nome" value="<?php if($novo){ echo(""); } else { echo $linha["nome_sup"]; } ?>"><br>
										

									</td>
								</tr>
								<tr>
									<td align="right">
										
									</td>
									<td align="left">
										<input class="bordas" type="hidden" size="10" name="ilha" value="10"><br>
									</td>
								</tr>
							</table>
							<table border="0">
								<tr>
									<td align="center">
										<center>
											<?php

											if($novo){
	
											?>
												<input type=hidden name="pri" value="0">
												<input border="0" class="bordas" type="Submit" name="eduser_nova" border=0 value="<?php echo $L_ADICIONAR; ?>">
												<br><br> 
												<font size=2 face="arial" color="#000000"><?php echo $L_MENSAGEM_22; ?> <br>
	
											<?php
	
											} else {
	
											?>
						
												<input type=hidden name="pri" value="0">
												<input border="0" class="bordas" type="Submit" name="eduser_env" border=0 value="<?php echo $L_ALTERAR; ?>">
												<input border="0" class="bordas" type="Submit" name="eduser_env" border=0 value="<?php echo $L_RESET_SENHA; ?>">
												<br><br>
												<font size=2 face="arial" color="#000000"><?php echo $L_MENSAGEM_23; ?>
										
											<?php

											}	

											?>

										</form>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

			<?php
	
			} // FIM ADM_NOVO_USER	



		// } // FIM ADM_USERS



		// ----------------------------------------------------------- USUÁRIOS

		$eduser_env=$_POST["eduser_env"];

		if($eduser_env){ // INICIO ADM_USER_ENV

			$matricula=$_POST["matricula"];
			$nome=$_POST["nome"];
			$ilha=$_POST["ilha"];
			$pri=$_POST["pri"];

			$sql = "UPDATE sups SET matsup='$matricula',nome_sup='$nome',ilha='$ilha',pri='$pri',senha='$matricula' WHERE matsup = $matricula";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_38 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&usuarios5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_24 </i><br> MySQL ERROR:</b> ". mysql_error());
			}

		} // FIM ADM_USER_ENV	

		// CONTINUAR AQUI


		// ----------------------------------------------------------- USUÁRIOS

		$eduser_nova=$_POST["eduser_nova"];

		if($eduser_nova){ // INICIO ADM_EDMENS_NOVA

			$matricula=$_POST["matricula"];
			$nome=$_POST["nome"];
			$ilha=$_POST["ilha"];
			$pri=$_POST["pri"];

			$sql = "INSERT INTO sups (matsup,nome_sup,ilha,pri,senha) VALUES ('$matricula','$nome','$ilha','$pri','$matricula')";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_39 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&usuarios5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_25 </i><br> MySQL ERROR:</b> ". mysql_error());
			}

		} // FIM ADM_USER_NOVA	


		// ----------------------------------------------------------- USUÁRIOS


		$apauser=$_GET["apauser"];

		if($apauser){ // INICIO ADM_APAUSER

			$confirmado=$_GET["confirmado"];

			$usu=$_GET["usu"];

			if($confirmado!="ok"){

				?>

				<table bgcolor="#ffffff" align="center" width="100%" class="bordas">
					<tr>
						<td width="90%" align="center">
							<font face="arial" size="2"><center>
							<?php echo $L_MENSAGEM_26; ?>
							
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&apauser=<?php echo $apauser; ?>&confirmado=ok','_self');">
							<?php echo $L_SIM; ?>
							</BUTTON>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&usuarios5=sim','_self');">
							<?php echo $L_NAO; ?>
							</BUTTON>

						</td>
					</tr>
				</table>

				<?php

			} else {

				$sql1 = "DELETE FROM reservas WHERE matricula = $apauser";
			
				if(!mysql_query($sql1)){
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_27 </i><br> MySQL ERROR:</b> ". mysql_error());
					exit();
				}

				$sql = "DELETE FROM sups WHERE matsup = $apauser";
			
				if(mysql_query($sql)){

					echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_40 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&usuarios5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
				} else {
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_27 </i><br> MySQL ERROR:</b> ". mysql_error());
				}
	
			}

		} // FIM ADM_APAUSER


		// -----------------------------------------------------------
// 5

		// ----------------------------------------------------------- ADMINS

		$edadm_env=$_GET["edadm_env"];

		echo $edadm_env;

		if($edadm_env){ // INICIO ADM_ADMIN_ENV

			$matricula=$_POST["matricula"];
			$nome=$_POST["nome"];
			$senha=$_POST["senha"];

			$sql = "UPDATE adms SET matsup='$matricula',nome='$nome',senha='$senha' WHERE matsup = '$matricula'";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_28 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&admins5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_29 </i><br> MySQL ERROR:</b> ". mysql_error());
			}

		} // FIM ADM_ADMIN_ENV	

		// CONTINUAR AQUI


		// ----------------------------------------------------------- ADMINS

		$edadm_nova=$_GET["edadm_nova"];

		if($edadm_nova){ // INICIO ADM_ADMIN_NOVA

			$matricula=$_POST["matricula"];
			$nome=$_POST["nome"];
			$senha=$_POST["senha"];

			$sql = "INSERT INTO adms (matsup,nome,senha) VALUES ('$matricula','$nome','$senha')";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEN_30 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&admins5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_31 </i><br> MySQL ERROR:</b> ". mysql_error());
			}

		} // FIM ADM_ADMIN_NOVA	


		// ----------------------------------------------------------- ADMINS


		$apaadm=$_GET["apaadm"];

		if($apaadm){ // INICIO ADM_APAADMIN

			$confirmado=$_GET["confirmado"];

			if($confirmado!="ok"){

				?>

				<table bgcolor="#ffffff" align="center" width="100%" class="bordas">
					<tr>
						<td width="90%" align="center">
							<font face="arial" size="2"><center>
							<?php echo $L_MENSAGEM_32; ?>
							
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&apaadm=<?php echo $apaadm; ?>&confirmado=ok','_self');">
							<?php echo $L_SIM; ?>
							</BUTTON>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('<?php echo $_PHPSELF; ?>?novosusuarios=sim&adm=sim&adm_usuarios=sim&admins5=sim','_self');">
							<?php echo $L_NAO; ?>
							</BUTTON>

						</td>
					</tr>
				</table>

				<?php

			} else {

				$sql = "DELETE FROM adms WHERE matsup = '$apaadm'";
			
				if(mysql_query($sql)){

					echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert(' $L_MENSAGEM_33 '); window.navigate('?novosusuarios=sim&adm=sim&adm_usuarios=sim&admins5=sim'); } </SCRIPT> <script language=\"javascript\"> tela(); </script>");
				} else {
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_34 </i><br> MySQL ERROR:</b> ". mysql_error());
				}
	
			}

		} // FIM ADM_APAADMIN


		// -----------------------------------------------------------


} // FIM MODULO ADMINISTRAÇÃO

?>

                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr> 
                      <td class="txt">Ighor Toth - http://www.ighor.com<br>
					<?php echo $L_TITULO; ?> <?php include('versao.inc.php'); echo $versao; ?>

			</td>
                    </tr>
                  </table>
</body>
</html>