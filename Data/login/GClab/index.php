<?php
	ini_set('display_errors', 'On');
	ini_set('extension', 'php_openssl.so');
	include('config.inc.php');
	
	$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;//serive to serving calendar
	$client = Zend_Gdata_ClientLogin::getHttpClient($googleAccount, $googlePassword, $service);
	$gdataCal = new Zend_Gdata_Calendar($client);
	
	//up to 25?
	$query = $gdataCal->newEventQuery();
	//define User to open not only primary calendar
	$query->setUser($calendarID);
	$query->setVisibility('public');
	$query->setProjection('full');
	$query->setOrderby('starttime');//order by new to older
	$eventFeed = $gdataCal->getCalendarEventFeed($query);
?>
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset = utf-8">
</head>
<body>

<form action = "new.php" method="post" name="GClab" id = "GClab">
	<h2>Add event</h2>
	<p>*Title
		<input name="title" type="text" id="title" size="20">
		<br>
		Content
		<textarea name="content" cols="60" rows="5" id = "content"></textarea>
		<br>
		Where
		<input name = "where" type="text" id="where" size="20">
		<br>
		StartDate
		<input name="startDate" type="text" id ="startDate" value = "2013-07-16" size ="10">
		StartTime
		<input name="startTime" type="text" id ="startTime" value = "09:22" size="10">
		<br>
		EndDate
		<input name="endDate" type="text" id="endDate" value = "2013-07-20" size="10">
		EndTime
		<input name="endTime" type="text" id="endTime" value = "11:08" size="10">
		(like example)<br>
		<input type="submit" name ="Submit" value = "Submit">
	</form>
<hr />
<?php
	foreach($eventFeed as $event){
		echo "<h2><a href=\"event.php?id=".basename($event->id->text)."\">" . $event->title->text .  "</a></h2>\n";
    echo "<ul>\n";
 echo "\t<li><b>內容:</b>".$event->content->text."</li>\n";
 foreach ($event->where as $where) {
        echo "\t<li><b>地點:</b>" . $where->valueString . "</li>\n";
    }
    echo "</ul>\n";
	}
	
?>
</body>
</html>