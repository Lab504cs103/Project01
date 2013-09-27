<?
  if (!isset($PHP_AUTH_USER)) {
     include ("config.php");
     header("WWW-Authenticate:Basic realm=\"密碼保護\"");
     header("HTTP/1.0 401 Unauthorized");
     echo '請輸入帳號密碼。';
     exit();
  }
  else {                 //  驗證密碼是否正確
    include ("config.php");
    if ($type==3)
        $query = "select * from $managertable where name = '$PHP_AUTH_USER'and passwd = '$PHP_AUTH_PW' ";
    else
        $query = "select * from $userstable where name = '$PHP_AUTH_USER'and passwd = '$PHP_AUTH_PW' ";
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    if ($numRows != 1) {      //  驗證失敗重新要求驗證
      header("WWW-Authenticate:Basic realm=\"密碼保護\"");
      header("HTTP/1.0 401 Unauthorized");
      echo '驗證失敗，請重新輸入帳號密碼。';
      exit();
    }
    else {
      if ($type==1)  header("Location:reserve.php");
      if ($type==2)  header("Location:delete_reserve.php");
      if ($type==3)  header("Location:manager.htm");
    }
 }

?>


