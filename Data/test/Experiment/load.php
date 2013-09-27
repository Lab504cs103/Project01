<?php
session_start();//open session for account info

$port = new SerialPort(com5);// open serial port

$port->setBaudRate(SerialPort::BAUD_RATE_9600);//baud rate=9600

$port->setFlowControl(SerialPort::FLOW_CONTROL_NONE);//doesn't perform flow control

$port->setCanonical(false)
	->setVTime(0)->setVMin(1);
	
$written = $port->write("en
config t
 
Building configuration...

Current configuration : 984 bytes
!
version 12.4
service timestamps debug datetime msec
service timestamps log datetime msec
no service password-encryption
!
hostname com4
!
boot-start-marker
boot-end-marker
!
logging message-counter syslog
!
no aaa new-model
!
dot11 syslog
ip source-route
!
!
ip cef
!
 --More--         !
no ipv6 cef
!
multilink bundle-name authenticated
!
!
!
!
!
!



!
!
!
!
!
!
!
!
!
!
!
!
!
 --More--         !
 --More--         !
!
!
!
voice-card 0
!
!
!
!
!
archive
 log config
  hidekeys
! 
!
!
!
!
!
!
!
!
interface FastEthernet0/0
 --More--          no ip address
 --More--          shutdown
 duplex auto
 speed auto
!
interface FastEthernet0/1
 no ip address
 shutdown
 duplex auto
 speed auto
!
interface Serial0/3/0
 no ip address
 shutdown
 clock rate 2000000
!
interface Serial0/3/1
 no ip address
 shutdown
 clock rate 2000000
!
ip forward-protocol nd
no ip http server
no ip http secure-server
 --More--         !
 --More--         !
!
!
!
!
!
!
!
!
control-plane
!
!
!
ccm-manager fax protocol cisco
!
mgcp fax t38 ecm
!
!
!
!
!
!
line con 0
 --More--         line aux 0
 --More--         line vty 0 4
 login
!
scheduler allocate 20000 1000
end

com4#
com4#");
$written = $port->write("\r");

$data = $port->read(8192);// read the response of com
echo $data;

$port->close();
?>