<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	background-image: url(../bg_sora2.gif);
}
</style>
<form name="form" method="post" action="register_finish.php">
學號：<input type="text" name="id" /> 
  <br>
密碼：<input type="password" name="pw" /> <br>
再一次輸入密碼：<input type="password" name="pw2" /> <br>
系所：
<label for="department"></label>
<select name="department" size="1" id="department">
  <option value="CS" selected="selected">資訊科學系</option>
  <option value="MATH">數學系</option>
</select>
<br>
年級： 
<select name="grade" size="1" id="grade">
  <option value="1" selected="selected">大一</option>
  <option value="2">大二</option>
  <option value="3">大三</option>
  <option value="4">大四</option>
</select>
<br>
班級：
<select name="class" size="1" id="class">
  <option value="1" selected="selected">A</option>
  <option value="2">B</option>
</select>
<br>
<input type="submit" name="button" value="確定" />
</form>