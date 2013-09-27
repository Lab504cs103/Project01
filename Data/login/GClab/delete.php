<?php
include('config.inc.php');
$eventId = $_GET['id'];

$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($googleAccount, $googlePassword, $service);
$gdataCal = new Zend_Gdata_Calendar($client);

//method to load event
$query = $gdataCal->newEventQuery();
$query->setUser($calendarID);
$query->setVisibility('private');
$query->setProjection('full');
$query->setEvent($eventId);
$eventEntry = $gdataCal->getCalendarEventEntry($query);
$title = $eventEntry->title->text;
$eventEntry->delete();
echo '<script>parent.window.location.reload(true);</script>';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Load Google calendar <?=$title?> deleted</title>
</head>
<body>
[<a href = "./index.php">Back</a>]
<hr />
<h1><font color = "red">event <?php echo $title ?> Deleted!</font></h1>
</body>
</html>