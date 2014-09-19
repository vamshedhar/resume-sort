<?php
include("dbconnect.php");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Comments</title>
</head>
<?php
if(isset($_POST['Submit']))
{
	for($j=1;$j<=$_POST['count'];$j++)
	{
		$comment ="comment".$j;
		$dept ="dept".$j;
		$manager ="manager".$j;
		$status ="status".$j;
		if($_POST[$comment] != '')
		{
			$text = "UPDATE details SET comments='$_POST[$comment]', commentuser='$_COOKIE[username]'";
			if($_POST[$dept] != '')
			{
				$text .= ", dept='$_POST[$dept]', deptuser='$_COOKIE[username]'";
			}
			if($_POST[$manager] != '')
			{
				$text .= ", manager='$_POST[$manager]', manageruser='$_COOKIE[username]'";
			}
			if($_POST[$status] != '')
			{
				$text .= ", status='$_POST[$status]', statususer='$_COOKIE[username]'";
			}
			
			$email = 'hidden'.$j;
			$text .= "WHERE email='$_POST[$email]'";
			//echo $text."<br>";
			mysql_query($text);
		}
		
		
	}
}
?>
          <td align="center"><div id='campus'>
          <form action="addcomments.php?min=<?php echo $_GET['min'];?>&max=<?php echo $_GET['max'];?>&sort=<?php echo $_GET['sort'];?>" method="post">
          <br /><br />
          <table border="1" cellpadding="7" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="addcomments.php?min=1&max=10&sort=name">Name</a></td>
<td><a href="addcomments.php?min=1&max=10&sort=gender">Gender</a></td>
<td><a href="addcomments.php?min=1&max=10&sort=email">Email</a></td>
<td><a href="addcomments.php?min=1&max=10&sort=source">Source</a></td>
<td><a href="addcomments.php?min=1&max=10&sort=timestamp">Forwarded on</a></td>
<td>Resume</td><td>Add Comments</td><td>Add Dept.</td><td>Add Manager</td><td>Status</td></tr>
<?php
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details WHERE comments ='No Comments Yet'");
}
else
{
	$query = mysql_query("SELECT * FROM details WHERE comments ='No Comments Yet' ORDER BY $_GET[sort] ASC");
}
$i = 1;
while($qarray = mysql_fetch_array($query))
{
	if($i<$_GET['min'] || $i>$_GET['max']){$i++;continue;}
?>
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><textarea name="comment<?php echo $i;?>" rows="3" cols="15"></textarea><input type="hidden" name="hidden<?php echo $i;?>" value="<?php echo $qarray['email'];?>" />
</td>
<td>
<select name="dept<?php echo $i;?>" style="width:120px;">
<option value=""></option>
<?php 
$d = mysql_query("SELECT * FROM dept");
while($da = mysql_fetch_array($d))
{
?>
<option value="<?php echo $da['dept'];?>"><?php echo $da['dept'];?></option>	
<?php
}
?>
</select>

<td>
<select name="manager<?php echo $i;?>" style="width:120px;">
<option value=""></option>
<?php 
$m = mysql_query("SELECT * FROM manager");
while($ma = mysql_fetch_array($m))
{
?>
<option value="<?php echo $ma['manager'];?>"><?php echo $ma['manager'];?></option>	
<?php
}
?>
</select>
</td>
<td><input type="radio" name="status<?php echo $i;?>" value="hired" />Hired<br /><input type="radio" name="status<?php echo $i;?>" value="reject" />Reject<br />
<input type="radio" name="status<?php echo $i;?>" value="interview" />Interview<br /><input type="radio" name="status<?php echo $i;?>" value="kiv" />KIV
<br />
<input type="submit" name="Submit" />
</td></tr>
<?php $i++;}?>
<input type="hidden" name="count" value="<?php echo $i;?>" />
<tr><td colspan="12" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="addcomments.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="addcomments.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
