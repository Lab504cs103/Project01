<?
$hostname = "localhost";        /* MySQL���D���W�� */
$dbuser = "root";          /* MySQL���ϥΪ̦W�� */
$dbpass = "Lab504";           /* MySQL���ϥΪ̱K�X */
$dbName = "booking";            /*��Ʈw�W��*/
$roomtable = "classroom";       /* �ЫǸ�ƪ�W�� */
$userstable = "users";          /* �ϥΪ̸�ƪ�W�� */
$managertable = "manager";      /* �޲z�̸�ƪ�W�� */

$classbegin=array("0810","0910","1010","1110","1320","1420","1520","1620");       //�Ұ�}�l�ε����ɶ�
$classend=array("0900","1000","1100","1200","1410","1510","1610","1710");
$weekname=array("�P���@","�P���G","�P���T","�P���|","�P����","�P����","�P����");
$numofclass=8;          //�@�Ѧ��X��
$numofday=5;            //�@�P���W�X��
$limit=4;               //����@�ѥu��w���X�`�Ű�A0�N���]����
$from_tomorrow=0;       //�]���y0�z��ܤ���i�w���A�]���y1�z��ܤ��餣�i�w���A�w����q����}�l�C


$link=MYSQL_CONNECT($hostname, $dbuser, $dbpass) OR DIE("Unable to connect to database");
mysql_select_db($dbName,$link);
?>