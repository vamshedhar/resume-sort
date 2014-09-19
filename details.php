<?php
include("dbconnect.php");
include('functions.php');
checkright("addcomments");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<script type="text/javascript">
function check()
{
	return confirm("Are you Sure You want to delete!!");

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Details</title>
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
			
			$location = 'hidden'.$j;
			$text .= "WHERE location='$_POST[$location]'";
			//echo $text."<br>";
			mysql_query($text);
		}
		
		
	}
}
?>
<td align="center"><div id='campus'>

<form action="<?php if($_POST['newsearch'] == "exists"  || $_GET['newsearch'] == 'exists'){echo "details.php?min=".$_GET['min']."&max=".$_GET['max']."&sort=".$_GET['sort'];}else{ echo "details.php?min=1&max=10&sort=no";}?>" method="post">
<table align="center" cellpadding="5" cellspacing="0">
<tr><td>Enter Details to Search : </td><td><input type="text" name="key1" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
</table>

<?php
if(isset($_POST['search']))
{
	?>
	
    
    
<table border="1" cellpadding="7" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="details.php?min=1&max=10&sort=name&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Name</a></td>
<td><a href="details.php?min=1&max=10&sort=gender&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Gender</a></td>
<td><a href="details.php?min=1&max=10&sort=email&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Email</a></td>
<td><a href="details.php?min=1&max=10&sort=source&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Source</a></td>
<td><a href="details.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td>User :: Comment</td>
<td>Dept.</td><td>Manager</td><td>Status</td></tr>

	<?php
	$query = mysql_query("SELECT * FROM details WHERE comments ='No Comments Yet'");
	$i=1;
	while($qarray = mysql_fetch_array($query))
	{
		if($i<1 || $i>10){$i++;continue;}
		$title = $qarray['location'];
		
		$name = "resumes_txt/".$qarray['location'];
		if(@file_exists($name))
		{//File Exists
			$file = @fopen($name,'r');
			$s = 1;
			while(!@feof($file))
			{
				$line = @fgets($file);
				$search1 = strtoupper($_POST['key1']);
				$found1 = strstr(strtoupper($line),$search1);
				if(str_word_count($found1) != 0)
				{
					
					
					?>
		<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>" target="_new">Click Here</a></td>
        <td><textarea name="comment<?php echo $i;?>" rows="3" cols="15"></textarea><input type="hidden" name="hidden<?php echo $i;?>" value="<?php echo $qarray['location'];?>" />
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
		
		<?php $i++;break;
				}
			$s++;	
			}
			@fclose($file);
		}
		
	
	}
?>
<input type="hidden" name="count" value="<?php echo $i;?>" />
<input type="hidden" name="newkey1" value="<?php echo $_POST['key1'];?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="11" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
if(($_POST['newsearch'] == "exists"  || $_GET['newsearch'] == 'exists') && !isset($_POST['search']))
{
	if(isset($_POST['newkey1']))
			{
			$newkey1 = $_POST['newkey1'];
			}
			else
			{$newkey1 = $_GET['newkey1'];}
	?>

    
    
<table border="1" cellpadding="7" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="details.php?min=1&max=10&sort=name&newkey1=<?php echo $newkey1;?>&newsearch=exists">Name</a></td>
<td><a href="details.php?min=1&max=10&sort=gender&newkey1=<?php echo $newkey1;?>&newsearch=exists">Gender</a></td>
<td><a href="details.php?min=1&max=10&sort=email&newkey1=<?php echo $newkey1;?>&newsearch=exists">Email</a></td>
<td><a href="details.php?min=1&max=10&sort=source&newkey1=<?php echo $newkey1;?>&newsearch=exists">Source</a></td>
<td><a href="details.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $newkey1;?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td>User :: Comment</td>
<td>Dept.</td><td>Manager</td><td>Status</td>
</tr>

	<?php
	
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details WHERE comments ='No Comments Yet'");
}
else
{
	$query = mysql_query("SELECT * FROM details WHERE comments ='No Comments Yet' ORDER BY $_GET[sort] ASC");
}
	
	
	$i=1;
	while($qarray = mysql_fetch_array($query))
	{
		if($i<$_GET['min'] || $i>$_GET['max']){$i++;continue;}
		$title = $qarray['location'];
		
		$name = "resumes_txt/".$qarray['location'];
		if(@file_exists($name))
		{//File Exists
			$s = 1;
			$file = @fopen($name,'r');
			while(!@feof($file))
			{
				$line = @fgets($file);
				$search1 = strtoupper($newkey1);
				$found1 = strstr(strtoupper($line),$search1);
				if(str_word_count($found1) != 0)
				{
					
					
					?>
		<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>" target="_new">Click Here</a></td>
        <td><textarea name="comment<?php echo $i;?>" rows="3" cols="15"></textarea><input type="hidden" name="hidden<?php echo $i;?>" value="<?php echo $qarray['location'];?>" />
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
		
		<?php $i++;break;
				}
				
			$s++;}
			@fclose($file);
		}
		
	
	}
?>
<input type="hidden" name="count" value="<?php echo $i;?>" />
<input type="hidden" name="newkey1" value="<?php echo $newkey1;?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="11" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
if(($_POST['newsearch'] != "exists"  && $_GET['newsearch'] != 'exists') && !isset($_POST['search']))
{
	?>
	
	
    
     <table border="1" cellpadding="7" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="details.php?min=1&max=10&sort=name">Name</a></td>
<td><a href="details.php?min=1&max=10&sort=gender">Gender</a></td>
<td><a href="details.php?min=1&max=10&sort=email">Email</a></td>
<td><a href="details.php?min=1&max=10&sort=source">Source</a></td>
<td><a href="details.php?min=1&max=10&sort=timestamp">Forwarded on</a></td>
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
<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><textarea name="comment<?php echo $i;?>" rows="3" cols="15"></textarea><input type="hidden" name="hidden<?php echo $i;?>" value="<?php echo $qarray['location'];?>" />
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
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="details.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
