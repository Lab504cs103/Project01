<?php session_start();
ini_set('display_errors', 'on') ?>
<!-- 設定網頁編碼為UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
</style>
<body background="texture/bg.jpg">
  <?php
	echo "<b>Welcome, ".$_SESSION['username']."</b>";?>
 </body>
</form>
