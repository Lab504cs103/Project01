<?
$hostname = "localhost";        /* MySQL的主機名稱 */
$dbuser = "root";          /* MySQL的使用者名稱 */
$dbpass = "Lab504";           /* MySQL的使用者密碼 */
$dbName = "booking";            /*資料庫名稱*/
$roomtable = "classroom";       /* 教室資料表名稱 */
$userstable = "users";          /* 使用者資料表名稱 */
$managertable = "manager";      /* 管理者資料表名稱 */

$classbegin=array("0810","0910","1010","1110","1320","1420","1520","1620");       //課堂開始及結束時間
$classend=array("0900","1000","1100","1200","1410","1510","1610","1710");
$weekname=array("星期一","星期二","星期三","星期四","星期五","星期六","星期日");
$numofclass=8;          //一天有幾堂
$numofday=5;            //一星期上幾天
$limit=4;               //限制一天只能預約幾節空堂，0代表不設限制
$from_tomorrow=0;       //設為『0』表示今日可預約，設為『1』表示今日不可預約，預約日從明日開始。


$link=MYSQL_CONNECT($hostname, $dbuser, $dbpass) OR DIE("Unable to connect to database");
mysql_select_db($dbName,$link);
?>