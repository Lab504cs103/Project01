<?php
session_start();
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
// | DB structure: mrss.sql                                               |
// | Bugs, translations or issues, write to: igtoth@gmail.com             |
// | ATTENTION: OLD VERSION: RSS - Room Scheduler System -- DISCONTINUED  |
// +----------------------------------------------------------------------+

# LINES THAT YOU MUST CHANGE:

# SET YOUR MYSQL DATABASE NAME (*** CHANGE ONLY IF NECESSARY ***)
$CONFIG_DBNM 	= "mrss";

# SET YOUR MySQL DATABASE USER
$CONFIG_DBUS 	= "root";  	

# SET YOUR MySQL DATABASE USER PASSWORD
$CONFIG_DBPW 	= "Lab504"; 	

# YOUR IP OR HOSTNAME SERVER
$CONFIG_DBHT 	= "localhost"; 		

# SET HOUR CONFIGURATION
#      0 (zero)  - FOR MILITARY-HOURS 1-23
#      1 (one)   - FOR AM-PM HOURS 1-12am/1-12pm (DEFAULT)
$CONFIG_HOUR	= "1"; 	

# SET START TIME (SHOULD BE SET ON MILITARY HOURS 1-23)
#      8 - (DEFAULT)
$CONFIG_STHR	= "8"; 	

# SET END TIME (SHOULD BE SET ON MILITARY HOURS 1-23)
#      21 - (DEFAULT)
$CONFIG_EDHR	= "21"; 			

# SET TO SHOW SUNDAYS
# If a room is booked for sunday, it automaticly shows the next week
#      0 = NO - (DEFAULT)
#      1 = YES
$SUNDAYES	= "0"; 	
						
# SET YOUR LOGO IMAGE PATH ON PRIMARY LOGON SCREEN
# EXAMPLE: $CONFIG_LOGO = "<img src=\"/img/porta.gif\">";
$CONFIG_LOGO	= "YOUR LOGO (CHANGE FILE: conf.inc.php)";
						
# SET DEFAULT LANGUAGE
#      0 (zero)  - Brazilian Portuguese
#      1 (one)   - US English (DEFAULT)
#      2 (two)   - Catalan ES
#      3 (three) - German Deutsch
#      4 (four)  - Spanish ES
$CONFIG_LANG	= "1";

# SET ADDITIONAL MESSAGE ON MAIN SCHEDULE SCREEN
# ADICIONAR MENSAGEM ADICIONAL DO ADMIN PARA USUÁRIOS FINAIS
# WEITERE MELDUNGE DES VERWALTERS AN BENUTZER HIER
$CONFIG_AMSG	= "Additional message from Admin to end users (CHANGE FILE: config.inc.php)";


// +----------------------------------------------------------------------+
// *** DONT CHANGE:

$CONFIG_LOCK 	= "1"; 	
$sistema  = $CONFIG_LOCK;
$sistema1 = $CONFIG_HOUR;
$banco 	  = $CONFIG_DBNM;
$usuario  = $CONFIG_DBUS;
$senhadb  = $CONFIG_DBPW;
$servidor = $CONFIG_DBHT;
if($_SESSION["lingua"]==""){ $_SESSION["lingua"] = $CONFIG_LANG; }
$_SESSION["hora_inicio"] = $CONFIG_STHR;
$_SESSION["hora_final"]  = $CONFIG_EDHR;

?>
