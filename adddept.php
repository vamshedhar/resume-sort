<?php
include("dbconnect.php");
include('functions.php');
checkright("adddetails");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Dept./Manager</title>
</head>
     
<td align="center"><div id='campus'>


<?php 
if(isset($_POST['adddept']))
{
	$q = mysql_query("INSERT INTO dept SET dept='$_POST[dept]'");
	if(!$q)
	{
		echo mysql_error();
	}
	else
	{
		echo "<h3>Dept. : ".$_POST['dept']." added sucessfully.</h3>";
	}
}

?>
<?php 
if(isset($_POST['addmanager']))
{
	$q = mysql_query("INSERT INTO manager SET manager='$_POST[manager]'");
	if(!$q)
	{
		echo mysql_error();
	}
	else
	{
		echo "<h3>Manager : ".$_POST['manager']." added sucessfully.</h3>";
	}
}

?>
<table border="0" style="float:left; position:relative; left:120px;" cellpadding="5" cellspacing="0">
<tr><td>
<form action="adddept.php" method="post">
  Enter Dept. Name : <input type="text" name="dept" /><input type="submit" name="adddept" value="Add Dept." />
</form></td></tr>
<tr><td>
<table width="400" border="2" cellpadding="10" cellspacing="0">
<tr><td colspan="3" align="center">List of Added Departments:</td></tr>
<tr><td>SNo.</td><td>Departments</td><td>Total Entries</td></tr>
<?php 
$dept = mysql_query("SELECT * FROM dept");
$s =1;
while($deptarray = mysql_fetch_array($dept))
{
	?>
    <tr><td><?php echo $s;?></td><td><?php echo $deptarray['dept'];?></td>
    
    <td>
    <?php 
	$query = mysql_query("SELECT * FROM details WHERE dept='$deptarray[dept]'");
	echo mysql_num_rows($query);
	?>
    </td></tr>
<?php	
$s++;}
?>
</table>
</td></tr></table>


<table border="0" style="float:left; position:relative; left:140px;" cellpadding="5" cellspacing="0">
<tr><td>
<form action="adddept.php" method="post">
  Enter Dept. Name : <input type="text" name="manager" /><input type="submit" name="addmanager" value="Add Manager" />
</form></td></tr>
<tr><td>
<table width="400" border="2" cellpadding="10" cellspacing="0">
<tr><td colspan="3" align="center">List of Added Managers:</td></tr>
<tr><td>SNo.</td><td>Manager</td><td>Total Entries</td></tr>
<?php 
$manager = mysql_query("SELECT * FROM manager");
$s =1;
while($managerarray = mysql_fetch_array($manager))
{
	?>
    <tr><td><?php echo $s;?></td><td><?php echo $managerarray['manager'];?></td>
    
    <td>
    <?php 
	$query = mysql_query("SELECT * FROM details WHERE manager='$managerarray[manager]'");
	echo mysql_num_rows($query);
	?>
    </td></tr>
<?php	
$s++;}
?>
</table>
</td></tr></table>




</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
