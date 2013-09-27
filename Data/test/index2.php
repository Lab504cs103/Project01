<?php session_start();?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">

</style>
</head>

<body background="texture/bg.jpg">
<?php
	if($_SESSION['username'] != null)
	{
		echo 
		'<div class="btn-group">
		<button type="button" class="btn-default"><a href="member.php" target=right>使用者資訊</a></button>
		<button type="button" class="btn-default"><a href="GClab/index.html" target=right>預約</a></button>
		<button type="button" class="btn-default"><a href="list.php" target=right>實驗</a></button>
		
		<button type="button" class="btn-default"><a href="logout.php">登出</a></button>
		</div>';
	}
?>
</body>
</html>