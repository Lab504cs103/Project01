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
include('languages/padrao.inc.php');
?>
<HTML>
<HEAD>

	<TITLE><?php echo $L_TITULO; ?></TITLE>

	<LINK href="img/main.css" type=text/css rel=stylesheet>
	<SCRIPT language=Javascript src="img/jsfunctions.js" type=text/javascript></SCRIPT>

</HEAD>

<BODY bgColor=white leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">

	<br>

	<!-- INICIO -->

      <TABLE cellSpacing=0 cellPadding=0 width=600 border=0>
        <TBODY>
        <TR>
          <TD>
            <IMG height=34 alt="" src="img/BL-Templates.gif" width=315><BR>
          </TD>
          <TD align=right width="100%" background="img/bg15.gif">
	    <IMG height=34 alt="" src="img/tr7.gif" width=136><BR>
          </TD>
        </TR>
        </TBODY>
      </TABLE>

	<!-- /INICIO -->

	<!-- MEIO -->

      <TABLE cellSpacing=0 cellPadding=0 width=600 border=0>
        <TBODY>
        <TR vAlign=top>
          <TD background="img/bg17.gif">
            <IMG height=1 alt="" src="img/spacer.gif" width=37><BR>
          </TD>
          <TD align=middle width="100%" background="img/bg38.gif">
            <IMG height=7 src="img/spacer.gif" width=1><BR>

	<!-- CONTEÚDO -->


		<?php

			$nome=$_POST["nome"];
			$sup=$_POST["sup"];
			$nome1=$_GET["nome1"];
			$ver=$_POST["ver"];
			$datatempo=$_GET["datatempo"];
			$sam=$_GET["sam"];

			$USUARIOS_NOVOS=$_GET["novosusuarios"];

			if($USUARIOS_NOVOS==sim){

				include('adm_sas.php');

			} else {			

				if(($ver)||($nome)||($nome1)||($sup)||($datatempo)||($sam=="hjk")){
					include('adm2.php');
				} else {
						include('core_adm.php');
				}
			}

		?>


	<!-- /CONTEÚDO -->

 	    <IMG height=7 src="img/spacer.gif" width=1>
          </TD>
          <TD background="img/bg18.gif"><IMG height=66 alt="" src="img/tr10.gif" width=37>
            <BR>
          </TD>
        </TR>
        </TBODY>
      </TABLE>

	<!-- /MEIO -->

	<!-- FIM -->

      <TABLE cellSpacing=0 cellPadding=0 width=600 border=0>
        <TBODY>
        <TR>
          <TD><IMG height=35 src="img/tr8.gif" width=37><BR></TD>
          <TD align=right width="100%" background="img/bg16.gif"><IMG height=35 alt="" src="img/tr9.gif" width=37 border=0><BR></TD>
        </TR>
        </TBODY>
      </TABLE>

	<!-- /FIM -->

