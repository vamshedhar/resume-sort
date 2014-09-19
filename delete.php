<?php
include("dbconnect.php");
include('functions.php');
checkright("deldetails");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Source/Dept./Manager</title>
</head>
     
<td align="center"><div id='campus'>
<?php
if(isset($_POST['sourcedel']))
{
	mysql_query("DELETE FROM source WHERE source='$_POST[source]'");
	mysql_query("UPDATE details SET source='Source Deleted' WHERE source='$_POST[source]'");
	echo "<h3>Source Deleted Sucessfully</h3>";
}
if(isset($_POST['deptdel']))
{
	mysql_query("DELETE FROM dept WHERE dept='$_POST[dept]'");
	mysql_query("UPDATE details SET dept='None Yet' WHERE dept='$_POST[dept]'");
	echo "<h3>Department Deleted Sucessfully</h3>";
}
if(isset($_POST['managerdel']))
{
	mysql_query("DELETE FROM manager WHERE manager='$_POST[manager]'");
	mysql_query("UPDATE details SET manager='None Yet' WHERE manager='$_POST[manager]'");
	echo "<h3>Manager Deleted Sucessfully</h3>";
}

?>



<form action="delete.php" method="post">
<table cellpadding="10" border="0" cellspacing="0">
<tr><td>Select Source to Delete</td>
<td>
: <select name="source" style="width:200px;">
<option value="">-SELECT-</option>
<?php
$source = mysql_query("SELECT * FROM source");
while($sarr = mysql_fetch_array($source))
{
?>
<option value="<?php echo $sarr['source'];?>"><?php echo $sarr['source'];?></option>
<?php }?>
</select>
</td><td><input type="submit" name="sourcedel" value="Delete Source" /></td>
</tr>
<tr><td>Select Dept. to Delete</td>
<td>
: <select name="dept" style="width:200px;">
<option value="">-SELECT-</option>
<?php
$dept = mysql_query("SELECT * FROM dept");
while($darr = mysql_fetch_array($dept))
{
?>
<option value="<?php echo $darr['dept'];?>"><?php echo $darr['dept'];?></option>
<?php }?>
</select>
</td>
<td><input type="submit" name="deptdel" value="Delete Dept." /></td>
</tr>
<tr><td>Select Manager to Delete</td>
<td>
: <select name="manager" style="width:200px;">
<option value="">-SELECT-</option>
<?php
$manager = mysql_query("SELECT * FROM manager");
while($marr = mysql_fetch_array($manager))
{
?>
<option value="<?php echo $marr['manager'];?>"><?php echo $marr['manager'];?></option>
<?php }?>
</select>
</td>
<td><input type="submit" name="managerdel" value="Delete Manager" /></td>
</tr>

<tr><td colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
</table>
</form>

</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
