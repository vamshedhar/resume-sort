<?php
include("dbconnect.php");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GFS</title>
<?php
	if(isset($_POST['Submit']))
	{
		$check = mysql_query("SELECT * FROM details WHERE email='$_POST[email]'");
		$charr = mysql_fetch_array($check);
		
		$text = "UPDATE details SET 0=0";
		if($charr['comment'] != $_POST['comment'])
		{
			mysql_query("UPDATE details SET comments='$_POST[comment]', commentuser='$_COOKIE[username]' WHERE email='$_POST[email]'");
		}
			if($_POST['dept'] != '')
			{
				if($charr['dept'] != $_POST['dept'])
				{
					mysql_query("UPDATE details SET dept='$_POST[dept]', deptuser='$_COOKIE[username]' WHERE email='$_POST[email]'");
				}
			}
			if($_POST['manager'] != '')
			{
				if($charr['manager'] != $_POST['manager'])
				{
					mysql_query("UPDATE details SET manager='$_POST[manager]', manageruser='$_COOKIE[username]' WHERE email='$_POST[email]'");
				}
			}
			if($_POST['status'] != '')
			{
				if($charr['status'] != $_POST['status'])
				{
					mysql_query("UPDATE details SET status='$_POST[status]', statususer='$_COOKIE[username]' WHERE email='$_POST[email]'");
				}
			}
			
	}

?>
</head>
     
          <td align="center"><div id='campus'>
          <form action="modify.php?min=<?php echo $_GET['min'];?>&max=<?php echo $_GET['max'];?>&sort=<?php echo $_GET['sort'];?>" method="post">
          <br /><br />
          <table border="2" cellpadding="8" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="modifycomments.php?min=1&max=10&sort=name">Name</a></td>
<td><a href="modifycomments.php?min=1&max=10&sort=gender">Gender</a></td>
<td><a href="modifycomments.php?min=1&max=10&sort=email">Email</a></td>
<td><a href="modifycomments.php?min=1&max=10&sort=source">Source</a></td>
<td><a href="modifycomments.php?min=1&max=10&sort=timestamp">Forwarded on</a></td>
<td>Resume</td><td>User :: Comment</td>
<td>Dept.</td><td>Manager</td><td>Status</td></tr>
<?php
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details WHERE comments !='No Comments Yet'");
}
else
{
	$query = mysql_query("SELECT * FROM details WHERE comments !='No Comments Yet' ORDER BY $_GET[sort] ASC");
}
 
$i = 1;
while($qarray = mysql_fetch_array($query))
{
	if($i<$_GET['min'] || $i>$_GET['max']){$i++;continue;}
?>
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td>
<td><?php echo "<b>".$qarray['commentuser']."</b> :: ";?><input type="hidden" name="comment<?php echo $i;?>"  /><?php echo $qarray['comments'];?><input type="hidden" name="hidden<?php echo $i;?>" value="<?php echo $qarray['email'];?>" />
</td>
<td><input type="text" name="dept<?php echo $i;?>" readonly="readonly" style="width:120px;" value="<?php echo $qarray['dept'];?>" /></td><td><input type="text" readonly="readonly" name="manager<?php echo $i;?>" style="width:120px;" value="<?php echo $qarray['manager'];?>" /></td>
<td><input type="radio" name="status<?php echo $i;?>" disabled="disabled" <?php if($qarray['status'] == 'hired'){ echo "checked='checked'";}?> value="hired" />Hired<br />
<input type="radio" name="status<?php echo $i;?>" disabled="disabled" <?php if($qarray['status'] == 'reject'){ echo "checked='checked'";}?> value="reject" />Reject<br />
<input type="radio" name="status<?php echo $i;?>" disabled="disabled" <?php if($qarray['status'] == 'interview'){ echo "checked='checked'";}?> value="interview" />Interview<br />
<input type="radio" name="status<?php echo $i;?>" disabled="disabled" <?php if($qarray['status'] == 'kiv'){ echo "checked='checked'";}?> value="kiv" />KIV
<br />
<input type="submit" name="Submit<?php echo $i;?>" value="Modify" />
</td>

</tr>
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
		<a href="modifycomments.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="modifycomments.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
