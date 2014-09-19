<?php include("dbconnect.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<link rel="stylesheet" href="style_01_index.css" type="text/css" rev="stylesheet" />
<title>GFS</title>
</head>

<?php
if(isset($_POST['submit']))
{
$user = $_POST['username'];

$pass = md5(hash(sha512,$_POST['password']));
$user1=mysql_query("SELECT * FROM users where username='$user'");
if($user1)
{
$userarray1 = mysql_fetch_array($user1);
}
	if($userarray1['password'] == $pass)
	{
		echo "yes";
	setcookie("username", $user, time() + 3600);
	header("Location:home.php");
	}
else
{
	$err = 1;
}
}

?>
<body>
<div id="wrap" style="height:600px">
<div id="indexHeader">
    <h1> GFS
    </h1>    
</div>

    <p id="campus">GFS</p>

          <table border="0" cellpadding="0" cellspacing="0" class="normal" align="center" id="loginBox">
              <tr >
                  <td colspan="2" align="center" class="big" valign="top" id="login">Login</td>
              </tr>
              <form action="index.php" method="post">
              <tr height="40px" >
                  <td align="center" class="normal" width="50%" >Username</td>
                  <td align="center"><input name="username" type="text"/></td>
              </tr>
              <tr>
                  <td align="center">Password</td>
                  <td align="center"><input name="password" type="password"/></td>
              </tr>
              <tr>
                  <td colspan="2" align="center"><input name="submit" type="submit" value="Login" /></td>
              </tr>
              <tr><td colspan="2" align="center"><?php if($err == 1){ echo "Wrong Login Details!!";}?></td></tr>
              </form>
         </table>
         <?php include("i_footer.php"); ?> 
</div>
</body>
</html>
