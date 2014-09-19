<?php
include("dbconnect.php");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
</head>
     
<td align="center"><div id='campus'>
<?php
if(isset($_POST['change']))
{
$old =  md5(hash(sha512,$_POST['old']));
$new =   md5(hash(sha512,$_POST['new']));
$conf =  md5(hash(sha512,$_POST['conf']));
$user = mysql_query("SELECT * FROM users WHERE username='$_COOKIE[username]'");
$uarray = mysql_fetch_array($user);
if($uarray['password'] == $old)
{
	if($new == $conf)
	{
		mysql_query("UPDATE users SET password='$conf' WHERE username='$_COOKIE[username]'");
		echo "<h3 align='center'>Password changed Sucessfully.</h3>";
	}
	else
	{
		echo "<h3 align='center'>New Password and Confirm Password did not match.</h3>";
	}
}
else
{
	echo "<h3 align='center'>Old Password did not match.</h3>";
}

}
?>
<form action="changepass.php" method="post">
<table border="0" cellpadding="10" cellspacing="10">
<tr><td>Enter old Password :</td><td><input type="password" name="old" /></td></tr>
<tr><td>Enter New Password :</td><td><input type="password" name="new" /></td></tr>
<tr><td>Confirm New Password :</td><td><input type="password" name="conf" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="change" value="Change Password" /></td></tr>
</table>

</form>
  

</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
