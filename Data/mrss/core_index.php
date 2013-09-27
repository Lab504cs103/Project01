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

include('conf.inc.php');
?>

		<form method="POST" action="veri_index.php">
		<TABLE aling="center" WIDTH="326"  CELLPADDING="0" CELLSPACING="0" >
			<TR>
				<TD ALIGN="center" VALIGN="middle">
					<TABLE aling="center" CELLPADDING="0" WIDTH="100%" HEIGHT="100%" BACKGROUND="">
						<TR>
							<TD ALIGN="center" COLSPAN="0">
								<br><?php echo $CONFIG_LOGO; ?><br><br>
								<B><font face="arial,verdana" size="3"><br><?php echo $L_TITULO; ?></font></B><br><br><br>
							</TD>
						</TR>
						<TR>
							<td ALIGN="center" VALIGN="middle">
								<table cellpadding=3 cellspacing=0 BACKGROUND="">
									<tr>
										<td>
											<B><FONT FACE="Arial,Helvetica,sans-serif" SIZE="-1"><?php echo $L_MATRICULA; ?>: </FONT></B>
										</td>
										<td>
											<input border="0" size="10" class="bordas" type="txt" name="matricula" STYLE="font-size: 9pt;" TABINDEX="1">
										</td>
									</tr>
									<tr>
										<td>
											<B><FONT FACE="Arial,Helvetica,sans-serif" SIZE="-1"><?php echo $L_SENHA; ?> </FONT></B>
										</td>
										<td>
											<input border="0" size="10" class="bordas" type="password" name="senha" STYLE="font-size: 9pt;" TABINDEX="1">
										</td>
									</tr>
								</table>
								<table width="190" cellpadding=0 cellspacing=0 BACKGROUND="">
									<tr>
										<td align="left">
											<A HREF="javascript: window.close();" TABINDEX="2">
												 <IMG SRC="img/cancel.gif" ALIGN="left" WIDTH="22" HEIGHT="23" ALT="<?php echo $L_CANCELAR; ?>" BORDER=0 hspace=10 vspace=4> 
											</A>
										</td>
										<td align="right">
											<INPUT TYPE=image src="img/enter.gif" WIDTH="26" HEIGHT="23" border=0 hspace=7 vspace=4 alt="<?php echo $L_ENTRAR; ?> &gt;&gt;&gt;" TABINDEX="1">
										</td>
									</tr>
								</table>
								<br><center><font face="arial,verdada" size="2"><a href="http://sourceforge.net/projects/rss" target="_blank"><?php echo $L_TITULO; ?></a> v.<?php include('versao.inc.php'); echo $versao; ?> <br>&copy; 2005/2006 <a href="http://www.ighor.com" target="_blank">Ighor Toth</a> </font><br>GNU General Public License<br>
							</td>
						</tr>
					</table>
					<center><font face="arial,verdada" size="1"> </font>
				</TD>
			</TR>
		</TABLE>
		</form>
