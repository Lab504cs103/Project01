<?php
//$PC1com=$_GET[PC1];
//$PC2com=$_GET[PC2];
//$PC3com=$_GET[PC3];
$PC1 = new SerialPort('com4');//$PC1com);
$PC2 = new SerialPort('com5');//$PC1com);
$PC3 = new SerialPort('com6');//$PC1com);
$port->setBaudRate(SerialPort::BAUD_RATE_9600);//baud rate=9600
$port->setFlowControl(SerialPort::FLOW_CONTROL_NONE);//doesn't perform flow control
$port->setCanonical(false)
	->setVTime(0)->setVMin(1);
	
$written = $PC1->write("ping 192.168.1.190");
$data = $PC1->read(8192);
echo substr($data, -11);
$written = $PC1->write("ping 192.168.1.222");
$written = $PC3->write("ping 192.168.1.190");

$data = $port->read(8192);
?>