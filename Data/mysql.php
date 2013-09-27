<?php
    $dbhost = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = 'Lab504';
    $dbname = 'student';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    $sql = "SELECT COUNT(*) as total FROM `FileList` WHERE `class` = 0;";
    $result = mysql_query($sql) or die('MySQL query error');
    while($row = mysql_fetch_array($result)){
        echo $row['name'];
    }
?>