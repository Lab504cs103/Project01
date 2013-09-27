<?php session_start();
 ?>
<!-- 設定網頁編碼為UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
</style>
<body background="texture/bg.jpg">

  <?php
	if($_SESSION['username']==null)
	{
		echo '<form name="form" method="post" action="connect.php">
		<p>帳號：<input name="id" type="text" id="id" /> <br>
		<p>密碼：<input name="pw" type="password" id="pw" /> <br>
		<input name="button" type="submit" value="登入" /> &nbsp;&nbsp;
		<a href="register.php">申請帳號</a></p>';}
	else
	{
		echo "Welcome,".$_SESSION['username'];
		echo '<a href="logout.php">登出</a>';
	}
	?>
 </body>
</form>
