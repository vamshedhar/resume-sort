<?php
include("dbconnect.php");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Feilds</title>
</head>

<td align="center"><div id='campus'>

<?php
if(isset($_POST['addfeild']))
{
	mysql_query("INSERT INTO feilds SET feild='$_POST[feild]'");
	if(mysql_error() == "Duplicate entry '$_POST[feild]' for key 'feild'")
	{
		echo "Feild :".$_POST['feild']." Already exists";
	}
	else
	{
	mysql_query("ALTER TABLE  `details` ADD  `$_POST[feild]` VARCHAR( 225 ) NOT NULL DEFAULT  'NothingAssigned'");
	mysql_query("ALTER TABLE  `details` ADD  `$_POST[feild]user` VARCHAR( 225 ) NOT NULL");
	mysql_query("INSERT INTO feilds SET feild='$_POST[feild]'");
	echo "<h3>Feild Added Sucessfully</h3>";
	}
}

?>

<form action="addfeilds.php" method="post">
<table border="0" cellpadding="10" cellspacing="0">
<tr><td colspan="2" align="center"><b>Enter feild Name </b>(without spaces)</td></tr>
<tr><td>Feild Name :</td><td><input type="text" name="feild"  /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="addfeild" value="AddFeild" /></td></tr>
</table>
</form>
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
