<?php
include("dbconnect.php");
include('functions.php');
checkright("totallist");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function check()
{
	return confirm("Are you Sure You want to delete!!");

}
</script>
<title>Total List</title>
</head>
<?php
for($x=1;$x<$_POST['count'];$x++)
{
	$delete = "delete".$x;
	$email = "email".$x;
	$resume = "resume".$x;
	if(isset($_POST[$delete]))
	{
		//echo $_POST[$resume];
		$del = mysql_query("SELECT * FROM links WHERE text='$_POST[$resume]'");
		//if(!$del){echo mysql_error();}
		$delquery = mysql_fetch_array($del);
		$file1 = "Resumes/".$delquery['word'];
		$file2 = "Resumes_txt/".$_POST[$resume];
		unlink($file1);
		unlink($file2);
		mysql_query("DELETE FROM links WHERE text='$_POST[$resume]'");
		mysql_query("DELETE FROM details WHERE location='$_POST[$resume]'");
	}
}

?>
<td align="center"><div id='campus'>
<form action="totallist.php?min=<?php echo $_GET['min'];?>&max=<?php echo $_GET['max'];?>&sort=<?php echo $_GET['sort'];?>" method="post">
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="totallist.php?min=1&max=10&sort=name">Name</a></td>
<td><a href="totallist.php?min=1&max=10&sort=nric">NRIC</a></td>
<td><a href="totallist.php?min=1&max=10&sort=gender">Gender</a></td>
<td><a href="totallist.php?min=1&max=10&sort=mobile">Mobile</a></td>
<td><a href="totallist.php?min=1&max=10&sort=email">Email</a></td>
<td><a href="totallist.php?min=1&max=10&sort=source">Source</a></td>
<td><a href="totallist.php?min=1&max=10&sort=timestamp">Forwarded on</a></td>
<td>Resume</td>
<td>User :: <a href="totallist.php?min=1&max=10&sort=comments">Comment</a></td>
<td><a href="totallist.php?min=1&max=10&sort=dept">Dept.</a></td>
<td><a href="totallist.php?min=1&max=10&sort=manager">Manager</a></td>
<td><a href="totallist.php?min=1&max=10&sort=status">Status</a></td>
<td>Delete</td></tr>
<?php
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details");
}
else
{
	$query = mysql_query("SELECT * FROM details ORDER BY $_GET[sort] ASC");
}
$i = 1;
while($qarray = mysql_fetch_array($query))
{
	if($i<$_GET['min'] || $i>$_GET['max']){$i++;continue;}
	
?>
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $i;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $i;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $i;?>" value="<?php echo $qarray['location'];?>" /></td></tr>
<?php 

$i++;

}?>
<input type="hidden" name="count" value="<?php echo $i;?>" />
<tr><td colspan="14" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="totallist.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="totallist.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	$min = $max +1;
	
	}
	
}

?>

</td></tr>
</table>
</form>
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
