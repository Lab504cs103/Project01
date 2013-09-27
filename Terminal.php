<?php
session_start();
//$handle = fopen("C:\\Apache\\htdocs\\test.txt", "w+");
/* シリアルポートを開きます */
$com = $_GET[com];
$port = new SerialPort($com);
echo '<title>'.$com.'</title>';

/* ボーレートを 9600 に設定します */
$port->setBaudRate(SerialPort::BAUD_RATE_9600);

/* フロー制御は行いません */
$port->setFlowControl(SerialPort::FLOW_CONTROL_NONE);

/* 
 * データの読み込みにカノニカル入力モードを用いません。
 * この設定では SerialPort::read() は
 * 最低1バイト読み込むまで呼び出し元に制御を戻しません。
 */
$port->setCanonical(false)
        ->setVTime(0)->setVMin(1);

/* データを送信します。 */
$written = $port->write($_POST[msg]);
$written = $port->write("\r");

/* 
 * 最大256バイトまでデータを読み込みます。
 * 上で行った読み込みタイムアウトの設定と合わせると、
 * SerialPort::read() は次のように振る舞います。
 * 
 * - 最低1バイト読み込むまでブロックする
 * - 最大256バイト読み込む
 * 
 * 実際に読み込まれたデータのサイズは 
 * strlen($data) 
 * などとして求められます。
 */
	$data = $port->read(8192);
	str_replace("\r\n","<br>", $data);

	$_SESSION[$com] = $_SESSION[$com].str_replace("\r\n","<br>", $data);
	echo $_SESSION[$com];

//$dataSize = strlen($data);
//var_dump($data);

//fwrite($handle, $_SESSION["message"]);
/* ポートを閉じます */
if ($port->isOpen()) {
    /*
     * SerialPort::close() でシリアルポートとのストリームを閉じます。
     */
    $port->close();
}
//fclose($handle);
?>
<script type="text/javascript">
window.onbeforeunload = exit(){
if (!confirm('您的郵件尚未寄出，\n您要捨棄此郵件嗎？')) {
        return '按一下「取消」停留在此頁。';
    }

}
</script>
<html>
<head>

</head>

<body onload=msg.focus()>
><form method="POST" action="Terminal.php?com=<?php echo $com; ?>#jumphere">
   <input type="text" id = "msg" name="msg" value = '' style="background-color:   transparent;   border:   0px">
   <a name="jumphere"></a>
   <!--<input type="submit" value="Enter">onclick="setDIV();"-->
   
</form>
<br>
<div>  
</div> 
</body>

</html>