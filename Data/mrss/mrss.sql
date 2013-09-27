# MySQL-Front Dump 2.5
#
# Database: rss
#
# INSTRUCTIONS:
#
# 1st: *** CREATE MySQL DATABASE CALLED: "mrss" 
# 2nd: *** UPDATE MySQL structure of "mrss" database with this file "mrss.sql"
# --------------------------------------------------------


#
# Table structure for table 'reservas'
#

CREATE TABLE reservas (
  cod_sala int(20) unsigned default '0',
  matricula int(20) unsigned default '0',
  datatempo datetime default NULL,
  ticket varchar(255) default '0'
) TYPE=MyISAM;



#
# Dumping data for table 'reservas'
#

INSERT INTO reservas VALUES("1", "999995", "2005-04-06 09:00:00", "");


#
# Table structure for table 'salas'
#

CREATE TABLE salas (
  cod_sala int(3) unsigned NOT NULL auto_increment,
  nome_sala varchar(255) default NULL,
  KEY cod_sala (cod_sala)
) TYPE=MyISAM;



#
# Dumping data for table 'salas'
#

INSERT INTO salas VALUES("1", "São Paulo");
INSERT INTO salas VALUES("2", "Ribeirão Preto");
INSERT INTO salas VALUES("3", "Blue Room");
INSERT INTO salas VALUES("4", "Video Conference");



#
# Table structure for table 'adms'
#

CREATE TABLE adms (
  matsup varchar(10) default '0',
  nome varchar(20) default NULL,
  senha varchar(10) default '0'
) TYPE=MyISAM;



#
# Dumping data for table 'adms'
#

INSERT INTO adms VALUES("admin", "Administrador", "abc123");



CREATE TABLE sups (
  matsup int(10) default NULL,
  nome_sup varchar(255) default NULL,
  senha varchar(16) default NULL,
  ilha int(10) default NULL,
  pri int(2) default NULL
) TYPE=MyISAM;



#
# Dumping data for table 'sups'
#

INSERT INTO sups VALUES("999995", "Usuário de Teste", "999995", "99", "0");
