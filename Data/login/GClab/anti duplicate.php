<?php
ini_set('display_errors', 'On');
	include('config.inc.php');
		
	$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
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
	
	foreach($eventFeed as $event){
		echo "<h2><a href=\"event.php?id=".basename($event->id->text)."\">" . $event->title->text .  "</a></h2>\n";
    echo "<ul>\n";
 
 foreach ($event->when as $when) {
        echo "\t<li><b>地點:</b>" . $when->StartTime . "</li>\n";
    }
    echo "</ul>\n";
	}
?>