<?
  if (!isset($PHP_AUTH_USER)) {
     include ("config.php");
     header("WWW-Authenticate:Basic realm=\"�K�X�O�@\"");
     header("HTTP/1.0 401 Unauthorized");
     echo '�п�J�b���K�X�C';
     exit();
  }
  else {                 //  ���ұK�X�O�_���T
    include ("config.php");
    if ($type==3)
        $query = "select * from $managertable where name = '$PHP_AUTH_USER'and passwd = '$PHP_AUTH_PW' ";
    else
        $query = "select * from $userstable where name = '$PHP_AUTH_USER'and passwd = '$PHP_AUTH_PW' ";
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    if ($numRows != 1) {      //  ���ҥ��ѭ��s�n�D����
      header("WWW-Authenticate:Basic realm=\"�K�X�O�@\"");
      header("HTTP/1.0 401 Unauthorized");
      echo '���ҥ��ѡA�Э��s��J�b���K�X�C';
      exit();
    }
    else {
      if ($type==1)  header("Location:reserve.php");
      if ($type==2)  header("Location:delete_reserve.php");
      if ($type==3)  header("Location:manager.htm");
    }
 }

?>


