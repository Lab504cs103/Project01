<?php
	$googleAccount = 'lab504cs103@gmail.com';
	$googlePassword = 'Lab504CS';
	$calendarID = 'lab504cs103@gmail.com';
	
	$slash = (strstr(ini_get('extension_dir'),'/'))?"/":"\\";//slash of windows or unix
	$includePath = dirname(__FILE__).$slash.'library';
	ini_set('include_path', $includePath); // dynamic setting php.ini
	//set progran to load zend gdata library
	require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Gdata');
	Zend_Loader::loadClass('Zend_Gdata_AuthSub');
	Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
	Zend_Loader::loadClass('Zend_Gdata_Calendar');
?>