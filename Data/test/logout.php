<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['username']);
echo '登出中......';
echo '<script>parent.window.location.reload(true);</script>';
?>