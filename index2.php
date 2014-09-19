<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payroll Management</title>
<style type="text/css">
body
{
	font:Verdana, Geneva, sans-serif;
	font-size:16px;
}
</style>
</head>

<body>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td colspan="2" height="1" background="Images/topShadow.jpg" />&nbsp;</td></tr>
<tr>
          <td width="300" height="300" rowspan="2">
          <table width="300" height="300" border="0" cellpadding="3" cellspacing="3" class="normal">
          <tr>
            <td rowspan="6" width="1" background="Images/leftShadow.jpg">&nbsp;</td>
          <td height="100" colspan="4" width="298"></td><td rowspan="6" width="1" background="Images/rightShadow.jpg">&nbsp;</td></tr>
              <tr>
                <td width="30" height="30"></td>
                <td colspan="2" align="center"><h3>Login</h3></td>
                <td width="30"></td>
              </tr>
              <form action="login.php" method="post" id="login" onsubmit="MM_validateForm('username','','R','password','','R');return document.MM_returnValue">
                <tr>
                  <td class="small"></td>
                  <td align="center">Username</td>
                  <td align="center"><input name="username" type="text" size="20" maxlength="30"  /></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="small"></td>
                  <td align="center">Password</td>
                  <td align="center"><input name="password" type="password" size="20" maxlength="20"  /></td>
                  <td></td>
                </tr>
                <tr>
                  <td height="30"></td>
                  <td colspan="2" align="center"><input name="submit" type="submit" value="Login" /></td>
                  <td></td>
                </tr>
                <tr><td height="100" colspan="4"></td></tr>
                <input type="hidden" name="hid" value="login" />
              </form>
              </table></td>
              
              <td><br /><br /><img src="Images/logo.png" alt="Global Foundries" /></td>
        </tr>
  <tr><td><img src="Images/pms3.png" alt="PMS      |    Payroll Management System" /></td></tr>
</table>
</body>
</html>