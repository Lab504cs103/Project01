<?php
	session_start();
	ini_set('display_errors', 'On');
	include('config.inc.php');
		
	$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
	$client = Zend_Gdata_ClientLogin::getHttpClient($googleAccount, $googlePassword, $service);
	$gdataCal = new Zend_Gdata_Calendar($client);
	
	//Title and when are necessary
	if($_POST['title'] != ''&& $_POST['startDate'] != ''&& $_POST['startTime'] != ''&& $_POST['endDate'] != '' && $_POST['endTime'] != ''){
		$title = $_POST['title'].'|'.$_SESSION['username'];
		$where = $_POST['where'];
		$content = $_POST['content'];
		$startDate = $_POST['startDate'];
		$startTime = $_POST['startTime'];
		$endDate = $_POST['endDate'];
		$endTime = $_POST['endTime'];
	}else{
		die("[<a href=\"./index.php\">back</a>]<hr /><b>Warning</b>: Too few arguments.");
	}
	$calendarURL="http://www.google.com/calendar/feeds/".urlencode($calendarID)."/private/full";
	
	$newEvent = $gdataCal->newEventEntry();
	$newEvent->title = $gdataCal->newTitle($title);
	$newEvent->where = array($gdataCal->newWhere($where));
	$newEvent->content = $gdataCal->newContent($content);
	
	$when = $gdataCal->newWhen();
	$when->startTime = "{$startDate}T{$startTime}:00.000"+08:00";
	$when->endTime = "{$endDate}T{$endTime}:00.000"+08:00";
	$newEvent->when = array($when);
	
	//when updating, google will return same event, we know the id of event
	$createdEvent = $gdataCal->insertEvent($newEvent, $calendarURL);
	/*test*/
	
?>
<html>
<meta http-equiv="refresh""Content-Type" content="text/html; charset=utf-8">
<head>
<title>Load Google calendar :: <?=$createdEvent->title->text?></title>
</head>
<body>
[<a href="./index.php">Back</a>] [<a href="delete.php?id=<?php
echo basename($eventEntry->id->text)
?>">Delete</a>]
<ht />
<h1>Event created!</h1>
<?php
echo "<h2>" . $createdEvent->title->text . "</h2>\n";
echo "<ul>\n";
echo "\t<li><b>Content:</b>".$createdEvent->content->text."</li>\n";
foreach ($createdEvent->where as $where) {
	echo "\t<li><b>Where:</b>" . $where->valueString . "</li>\n";
}
foreach ($createdEvent->when as $when) {
	echo "\t<li><b>Start Time:</b>" . $when->startTime . "</li>\n";
	echo "\t<li><b>End Time:</b>" . $when->endTime . "</li>\n";
}
echo "\t<li><b>Event ID:</b>".basename($createdEvent->id->text)."</li>\n";
echo "</ul>\n";
//echo '<script>parent.window.location.reload(true);</script>';
?>
</body>
</html>