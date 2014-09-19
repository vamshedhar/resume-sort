<?php
include("dbconnect.php");
include('functions.php');
checkright("bydetails");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search By Details</title>
</head>
     
<td align="center"><div id='campus'>
<form action="detailsearch.php?min=1&max=10&sort=no" method="post">
<table cellpadding="10" border="0" cellspacing="0">
<tr><td>Select Source</td>
<td>
: <select name="source" style="width:200px;">
<option value="">ALL</option>
<?php
$source = mysql_query("SELECT * FROM source");
while($sarr = mysql_fetch_array($source))
{
?>
<option value="<?php echo $sarr['source'];?>"><?php echo $sarr['source'];?></option>
<?php }?>
</select>
</td>
</tr>
<tr><td>Select Dept.</td>
<td>
: <select name="dept" style="width:200px;">
<option value="">ALL</option>
<?php
$dept = mysql_query("SELECT * FROM dept");
while($darr = mysql_fetch_array($dept))
{
?>
<option value="<?php echo $darr['dept'];?>"><?php echo $darr['dept'];?></option>
<?php }?>
</select>
</td>
</tr>
<tr><td>Select Manager</td>
<td>
: <select name="manager" style="width:200px;">
<option value="">ALL</option>
<?php
$manager = mysql_query("SELECT * FROM manager");
while($marr = mysql_fetch_array($manager))
{
?>
<option value="<?php echo $marr['manager'];?>"><?php echo $marr['manager'];?></option>
<?php }?>
</select>
</td>
</tr>
<tr><td>Select Status</td>
<td>
: <select name="status" style="width:200px;">
<option value="">ALL</option>
<option value="hired">Hired</option>
<option value="reject">Reject</option>
<option value="interview">Interview</option>
<option value="kiv">KIV</option>
</select>
</td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
</table>

<?php
if(isset($_POST['search']))
{
	$text = "SELECT * FROM details WHERE 1 = 1 ";
	if($_POST['dept'] != '')
	{
		$text .="AND dept='$_POST[dept]' ";
	}
	else
	{
		$text .=" ";
	}
	if($_POST['source'] != '')
	{
		$text .="AND source='$_POST[source]' ";
	}
	else
	{
		$text .=" ";
	}
	if($_POST['manager'] != '')
	{
		$text .="AND manager='$_POST[manager]' ";
	}
	else
	{
		$text .=" ";
	}
	if($_POST['status'] != '')
	{
		$text .="AND status='$_POST[status]' ";
	}
	else
	{
		$text .=" ";
	}
	//echo $text."<br>";
	?>
	          <table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="detailsearch.php?min=1&max=10&sort=name&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Name</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=gender&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Gender</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=email&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Email</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=source&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Source</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=timestamp&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td><a href="detailsearch.php?min=1&max=10&sort=comments&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Comments</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=dept&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Dept.</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=manager&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Manager</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=status&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists">Status</a></td></tr>
	<?php
	$query = mysql_query($text);
	$i=1;
	while($qarray = mysql_fetch_array($query))
	{
		?>
		
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td>
<td><?php echo $qarray['status'];?>
</td>

</tr>
        
        
	<?php	
	$i++;}
	?>
    <tr><td colspan="11" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="detailsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="detailsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&dept=<?php echo $_POST['dept']?>&manager=<?php echo $_POST['manager']?>&status=<?php echo $_POST['status']?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	$min = $max +1;
	
	}
	
}

?>

</td></tr>
    </table>
    <?php
}
?>


<?php
if($_GET['newsearch'] == 'exists' && !isset($_POST['search']))
{
	$text = "SELECT * FROM details WHERE 1 = 1 ";
	if($_GET['dept'] != '')
	{
		$text .="AND dept='$_GET[dept]' ";
	}
	else
	{
		$text .=" ";
	}
	if($_GET['manager'] != '')
	{
		$text .="AND manager='$_GET[manager]' ";
	}
	else
	{
		$text .=" ";
	}
	if($_GET['status'] != '')
	{
		$text .="AND status='$_GET[status]' ";
	}
	else
	{
		$text .=" ";
	}
	
	?>
	          <table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="detailsearch.php?min=1&max=10&sort=name&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Name</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=gender&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Gender</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=email&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Email</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=source&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Source</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=timestamp&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td><a href="detailsearch.php?min=1&max=10&sort=comments&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Comments</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=dept&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Dept.</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=manager&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Manager</a></td>
<td><a href="detailsearch.php?min=1&max=10&sort=status&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists">Status</a></td></tr>
	<?php
	if($_GET['sort'] == 'no')
	{
		$text .= " ";
	}
	else
	{
		$text .= "ORDER BY $_GET[sort] ASC";
	}
	//echo $text."<br>";
	$query = mysql_query($text);
	$i=1;
	while($qarray = mysql_fetch_array($query))
	{
		if($i<$_GET['min'] || $i>$_GET['max']){$i++;continue;}
		?>
		
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td>
<td><?php echo $qarray['status'];?>
</td>

</tr>
        
        
	<?php	
	$i++;}
	?>
    <tr><td colspan="11" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="detailsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="detailsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&dept=<?php echo $_GET['dept']?>&manager=<?php echo $_GET['manager']?>&status=<?php echo $_GET['status']?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	$min = $max +1;
	
	}
	
}

?>

</td></tr>
    </table>
    <?php
}
?>


</form>
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
