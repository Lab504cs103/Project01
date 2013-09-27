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
?>
		<TITLE><?php echo $L_TITULO; ?></TITLE>

			<style type="text/css">
			<!--
			.bordas {
				border: 1px solid #999999;
			}
			-->
			</style>

<?php

		include('conecta.php');

			$salas=$_GET["salas"];
	
			if($salas==sim){ // INICIO SALAS

			?>

				<table width="500" align="center">
					<tr align="center">	
						<td align="center" >

							<table width="100%" align="center" >
								<tr align="center">	
									<td align="left">    <font size=3 face="arial"><b><?php echo $L_SALAS; ?>

									</td>
									<td align="right">
										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?edsala=sim&nova=sim','_self');">
										<?php echo $L_NOVA_SALA; ?>
										</BUTTON>
									</td>
								</tr>
							</table>

							<table border="0" width="100%" bgcolor="#9EC8FF" >

								<tr bgcolor="#EDF5FF">

									<td width="15%" ><font size=2 face="arial" color="#ffffff">
										<b><font color='#4682B4'><?php echo $L_SALA; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><font color='#4682B4'><?php echo $L_EDITAR; ?>
									</td>
									<td  width="10%" align="left"><font size=2 face="arial" color="#ffffff">
										<b><font color='#4682B4'><?php echo $L_APAGAR; ?>
									</td>
								</tr>

								<?php
								
								
								$sqlus = "SELECT * from salas ORDER BY nome_sala";
								$resultado = mysql_query($sqlus) or die(mysql_error());
								$ci=0;
								while($linha_us=mysql_fetch_array($resultado)) { // INICIO WHILE_US

								?>

								<tr bgcolor="#<?php if($ci==0){ echo("FFFFFF"); $ci=1; } else { echo("F5F5F5"); $ci=0; } ?>">
									<td><font size=2 face="arial">
										<center><?php echo $linha_us["nome_sala"]; ?>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="salas.php?edsala=<?php echo $linha_us["cod_sala"]; ?>&nome=<?php echo $linha_us["nome_sala"]; ?>"><img src="img/editar.gif" border="0" alt="<?php echo $L_EDITAR_DADOS_DA_SALA; ?> <?php echo $linha_us["nome_sala"]; ?>"></a>
									</td>
									<td align="left"><font size=1 face="arial">
										<center><a href="salas.php?apasala=<?php echo $linha_us["cod_sala"]; ?>&nome=<?php echo $linha_us["nome_sala"]; ?>"><img src="img/apagar.gif" border="0" alt="<?php echo $L_APAGAR_DADOS_DA_SALA; ?> <?php echo $linha_us["nome_sala"]; ?>"></a>
									</td>

								</tr>

								<?php

								} // FIM WHILE_US
								
								?>

							</table>
						</td>
					</tr>
				</table>
							<table width="100%" align="center"  >
								<tr align="center">	
									<td align="left">

										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('adm.php?sam=hjk','_self');">
											<?php echo $L_VOLTAR; ?>
										</BUTTON>
									</td>
								</tr>
							</table>


			<?php

			} // FIM SALAS


			// -------------------------------------------------------------------------------


			$edsala=$_GET["edsala"];

			if($edsala){ // INICIO ED_SALA

				$nova=$_GET["nova"];

				if($nova=="sim"){

					echo("");

				} else {

				$sql = "SELECT * from salas WHERE cod_sala = $edsala";
				$result = mysql_query($sql) or die(mysql_error());
				$linha=mysql_fetch_array($result);

				}
	
			?>

				<table width="100%" align="center">
					<tr align="center">	
						<td align="center" class="bordas" bgcolor="#ffffff">
	
							<table width="100%" align="center" class="bordas" bgcolor="#483D8B">
								<tr align="center">	
									<td align="left">
										<font size=4 face="arial" color="#ffffff"><b><?php if($nova){ echo $L_NOVA_SALA; } else { echo $L_EDITAR_SALA; } ?>
									</td>
								</tr>
							</table>
							
							<table width="100%" align="center">
								<tr>	
									<td  align="right">
										<form name="edusersform" method="post" action="salas.php">
										<font face="arial,verdana" size="2"><?php echo $L_NOME; ?>: </font><br>
									</td>
									<td>

										
										<input type=text size="40" name="nome" value="<?php if($nova){ echo(""); } else { echo $linha["nome_sala"]; } ?>">

									</td>
								</tr>
							</table>
							<table border="0">
								<tr>
									<td align="center">
										<center>
											<?php

											if($nova){
	
											?>
												<input border="0" class="bordas" type="Submit" name="edsala_nova" border=0 value="<?php echo $L_ADICIONAR; ?>"> 
	
											<?php
	
											} else {
	
											?>

												<input type="Hidden" name="cod_sala" border=0 value="<?php echo $edsala; ?>">
						
												<input border="0" class="bordas" type="Submit" name="edsala_env" border=0 value="<?php echo $L_ALTERAR; ?>">
												<br><br>
												
										
											<?php

											}	

											?>

										</form>
																				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<BUTTON border="0" class="bordas" OnClick="AAA=window.open('adm.php?sam=hjk','_self');">
												<?php echo $L_VOLTAR; ?>
											</BUTTON>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

			<?php
	
			} // FIM NOVO_SALA


			// ------------------------------------------------------------

	// ----------------------------------------------------------- 

		$edsala_env=$_POST["edsala_env"];

		if($edsala_env){ // INICIO SALA_ENV

			$nome=$_POST["nome"];
			$cod_sala=$_POST["cod_sala"];

			$sql = "UPDATE salas SET nome_sala='$nome',cod_sala='$cod_sala' WHERE cod_sala = $cod_sala";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('$L_MENSAGEM_47'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO ATUALIZADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} // FIM SALA_ENV	

		// CONTINUAR AQUI


		// -----------------------------------------------------------

		$edsala_nova=$_POST["edsala_nova"];

		if($edsala_nova){ // INICIO SALA_NOVA

			$nome=$_POST["nome"];

			$sql = "INSERT INTO salas (nome_sala) VALUES ('$nome')";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('$L_MENSAGEM_46'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_45 </i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} // FIM SALA_NOVA	


		// ----------------------------------------------------------- USUÁRIOS


		$apasala=$_GET["apasala"];

		if($apasala){ // INICIO APA_SALA

			$confirmado=$_GET["confirmado"];

			$nome=$_GET["nome"];

			if($confirmado!="ok"){

				?>

				<table bgcolor="#ffffff" align="center" width="100%" class="bordas">
					<tr>
						<td width="90%" align="center">
							<font face="arial" size="2"><center>
							<?php echo $L_MENSAGEM_42; ?>.<br><br><font size="3"><b> <?php echo $L_MENSAGEM_21; ?></b> <br><br>
							
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?apasala=<?php echo $apasala; ?>&confirmado=ok','_self');">
							<?php echo $L_SIM; ?>
							</BUTTON>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?salas=sim','_self');">
							<?php echo $L_NAO; ?>
							</BUTTON>

						</td>
					</tr>
				</table>

				<?php

			} else {

				$sql1 = "DELETE FROM reservas WHERE cod_sala = $apasala";
			
				if(!mysql_query($sql1)){
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_43 </i><br>MySQL ERROR:</b> ". mysql_error());
					exit();
				}

				$sql = "DELETE FROM salas WHERE cod_sala = $apasala";
			
				if(mysql_query($sql)){

					echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('$L_MENSAGEM_44'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
				} else {
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\"> $L_MENSAGEM_43 </i><br> ERRO MySQL:</b> ". mysql_error());
				}
	
			}

		} // FIM ADM_APAUSER
