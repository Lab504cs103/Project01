<?php
	ini_set('display_errors', 'On');
	ini_set('extension', 'php_openssl.so');
	include('config.inc.php');
	$eventId = $_GET['id'];
	
	$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
	$client = Zend_Gdata_ClientLogin::getHttpClient($googleAccount, $googlePassword, $service);
	$gdataCal = new Zend_Gdata_Calendar($client);
	
	
	$query = $gdataCal->newEventQuery();
	$query->setUser($calendarID);
	$query->setVisibility('private');
	$query->setProjection('full');
	$query->setEvent($eventId);
	
	try{
		$eventEntry = $gdataCal->getCalendarEventEntry($query);
	}catch(Zend_Gdata_App_Exception $e){
		die($e);
	}
?>
<html>
<head>
<meta http-equiv = " content="text/html; charset=utf-8">
<title>Load Google Calendar::<?=$eventEntry->title->text?></title>
</head>
<body>
[<a href="./index.php">Back</a>]  [<a href="delete.php?id=<?php
echo basename($eventEntry->id->text)
?>">Delete</a>]
<hr />
<?php
	echo "<h2>" . $eventEntry->title->text . "</h2>\n";
	echo "<ul>\n";
	foreach($eventEntry->where as $where){
		echo "\t<li><b>Where</b>" . $where->valueString . "</li>\n";
	}
	foreach($eventEntry->when as $when){
		echo "\t<li><b>Start Time</b>" . $when->startTime . "</li>\n";
		echo "\t<li><b>End Time</b>" . $when->endTime . "</li>\n";
	}
	echo "\t<li><b>Event ID:</b>".basename($eventEntry->id->text)."</li>\n";
	echo "<ul>\n";
?>
</body>