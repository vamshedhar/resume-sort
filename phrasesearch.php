<?php
include("dbconnect.php");
include('functions.php');
checkright("phrasesearch");
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
<title>Phrase Search</title>
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
		@unlink($file1);
		@unlink($file2);
		mysql_query("DELETE FROM links WHERE text='$_POST[$resume]'");
		mysql_query("DELETE FROM details WHERE location='$_POST[$resume]'");
	}
}

?>
<td align="center"><div id='campus'>

<form action="<?php if($_POST['newsearch'] == "exists"  || $_GET['newsearch'] == 'exists'){echo "phrasesearch.php?min=".$_GET['min']."&max=".$_GET['max']."&sort=".$_GET['sort'];}else{ echo "phrasesearch.php?min=1&max=10&sort=no";}?>" method="post">
<table align="center" cellpadding="5" cellspacing="0">
<tr><td>Enter Phrase You want to Search : </td><td><textarea name="key1" cols="40" rows="5"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
</table>

<?php
if(isset($_POST['search']))
{
	?>
	
    
    
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="phrasesearch.php?min=1&max=10&sort=name&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Name</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=gender&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Gender</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=mobile&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Mobile</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=email&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Email</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=source&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Source</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Forwarded on</a></td>
<td>Found As </td>
<td>Resume</td>
<td>User :: <a href="phrasesearch.php?min=1&max=10&sort=comments&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Comment</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=dept&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Dept.</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=manager&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Manager</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=status&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists">Status</a></td>
<td>Delete</td></tr>

	<?php
	$query = mysql_query("SELECT * FROM details");
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
		<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><?php echo $line;?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $i;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $i;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $i;?>" value="<?php echo $qarray['location'];?>" /></td></tr>
		
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
<tr><td colspan="14" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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

    
    
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="phrasesearch.php?min=1&max=10&sort=name&newkey1=<?php echo $newkey1;?>&newsearch=exists">Name</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=gender&newkey1=<?php echo $newkey1;?>&newsearch=exists">Gender</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=mobile&newkey1=<?php echo $newkey1;?>&newsearch=exists">Mobile</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=email&newkey1=<?php echo $newkey1;?>&newsearch=exists">Email</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=source&newkey1=<?php echo $newkey1;?>&newsearch=exists">Source</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $newkey1;?>&newsearch=exists">Forwarded on</a></td>
<td>Found As </td><td>Resume</td>
<td>User :: <a href="phrasesearch.php?min=1&max=10&sort=comments&newkey1=<?php echo $newkey1;?>&newsearch=exists">Comment</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=dept&newkey1=<?php echo $newkey1;?>&newsearch=exists">Dept.</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=manager&newkey1=<?php echo $newkey1;?>&newsearch=exists">Manager</a></td>
<td><a href="phrasesearch.php?min=1&max=10&sort=status&newkey1=<?php echo $newkey1;?>&newsearch=exists">Status</a></td>
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
		<tr><td><?php echo $i;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><?php echo $line;?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $i;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $i;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $i;?>" value="<?php echo $qarray['location'];?>" /></td></tr>
		
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
<tr><td colspan="14" align="right">
<?php 
$min = 1;
for($j=1;$j<$i;$j++)
{
	if($j == $i-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
