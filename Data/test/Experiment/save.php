<?php
//session_start();//open session for account info

$port = new SerialPort(com5);// open serial port

$port->setBaudRate(SerialPort::BAUD_RATE_9600);//baud rate=9600

$port->setFlowControl(SerialPort::FLOW_CONTROL_NONE);//doesn't perform flow control

$port->setCanonical(false)
	->setVTime(0)->setVMin(1);
$handle = fopen("C:\\Apache\\htdocs\\save.txt", "w+");//open the file to save
	
$written = $port->write("en
show run");

$data = $port->read(8192);// read the response of com
$last = substr($data, -1);
while($last!='#')
{
	$written = $port->write(" \r");
	$data2 = $port->read(8192);
	$data = $date.$data2;
	$last = substr($data, -1);
	echo $data;
fwrite($handle, $data);
}

$port->close();
?>