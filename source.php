<?php
include("dbconnect.php");
include('functions.php');
checkright("bysource");
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
<title>Search By Source</title>
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
<form action="<?php if($_POST['newsearch'] == "exists"  || $_GET['newsearch'] == 'exists'){echo "source.php?min=".$_GET['min']."&max=".$_GET['max']."&sort=".$_GET['sort'];}else{ echo "source.php?min=1&max=10&sort=no";}?>" method="post">
Select Source : <select name="source">
<?php 
$source = mysql_query("SELECT * FROM source");
while($sarray = mysql_fetch_array($source))
{
?>
<option value="<?php echo $sarray['source'];?>"><?php echo $sarray['source'];?></option>
<?php }?>
</select>
<input type="submit" name="search" value="Submit" />

<?php
if(isset($_POST['search']))
{
?>
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="source.php?min=1&max=10&sort=name&source=<?php echo $_POST['source'];?>&newsearch=exists">Name</a></td>
<td><a href="source.php?min=1&max=10&sort=nric&source=<?php echo $_POST['source'];?>&newsearch=exists">NRIC</a></td>
<td><a href="source.php?min=1&max=10&sort=gender&source=<?php echo $_POST['source'];?>&newsearch=exists">Gender</a></td>
<td><a href="source.php?min=1&max=10&sort=mobile&source=<?php echo $_POST['source'];?>&newsearch=exists">Mobile</a></td>
<td><a href="source.php?min=1&max=10&sort=email&source=<?php echo $_POST['source'];?>&newsearch=exists">Email</a></td>
<td><a href="source.php?min=1&max=10&sort=timestamp&source=<?php echo $_POST['source'];?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td>User :: <a href="source.php?min=1&max=10&sort=comments&source=<?php echo $_POST['source'];?>&newsearch=exists">Comment</a></td>
<td><a href="source.php?min=1&max=10&sort=dept&source=<?php echo $_POST['source'];?>&newsearch=exists">Dept.</a></td>
<td><a href="source.php?min=1&max=10&sort=manager&source=<?php echo $_POST['source'];?>&newsearch=exists">Manager</a></td>
<td><a href="source.php?min=1&max=10&sort=status&source=<?php echo $_POST['source'];?>&newsearch=exists">Status</a></td>
<td>Delete</td></tr>
<?php
	$query = mysql_query("SELECT * FROM details WHERE source ='$_POST[source]'");
	$s=1;
	while($qarray = mysql_fetch_array($query))
	{
		if($s<1 || $s>10){$i++;continue;}
	?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></td></tr>
		
		<?php $s++;}
	
?>
<input type="hidden" name="count" value="<?php echo $s;?>" />
<input type="hidden" name="source" value="<?php echo $_POST['source'];?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="13" align="right">
<?php 
$min = 1;
for($j=1;$j<$s;$j++)
{
	if($j == $s-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&source=<?php echo $_POST['source'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&source=<?php echo $_POST['source'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
	if(isset($_POST['source']))
			{
			$source = $_POST['source'];
			}
			else
			{$source = $_GET['source'];}
?>
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="source.php?min=1&max=10&sort=name&source=<?php echo $source;?>&newsearch=exists">Name</a></td>
<td><a href="source.php?min=1&max=10&sort=nric&source=<?php echo $source;?>&newsearch=exists">NRIC</a></td>
<td><a href="source.php?min=1&max=10&sort=gender&source=<?php echo $source;?>&newsearch=exists">Gender</a></td>
<td><a href="source.php?min=1&max=10&sort=mobile&source=<?php echo $source;?>&newsearch=exists">Mobile</a></td>
<td><a href="source.php?min=1&max=10&sort=email&source=<?php echo $source;?>&newsearch=exists">Email</a></td>
<td><a href="source.php?min=1&max=10&sort=timestamp&source=<?php echo $source;?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td>User :: <a href="source.php?min=1&max=10&sort=comments&source=<?php echo $source;?>&newsearch=exists">Comment</a></td>
<td><a href="source.php?min=1&max=10&sort=dept&source=<?php echo $source;?>&newsearch=exists">Dept.</a></td>
<td><a href="source.php?min=1&max=10&sort=manager&source=<?php echo $source;?>&newsearch=exists">Manager</a></td>
<td><a href="source.php?min=1&max=10&sort=status&source=<?php echo $source;?>&newsearch=exists">Status</a></td>
<td>Delete</td></tr>
<?php
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details WHERE source ='$source'");
}
else
{
	$query = mysql_query("SELECT * FROM details WHERE source ='$source' ORDER BY $_GET[sort] ASC");
}



	$s=1;
	while($qarray = mysql_fetch_array($query))
	{
		if($s<$_GET['min'] || $s>$_GET['max']){$s++;continue;}
	?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></td></tr>
		
		<?php $s++;}
	
?>
<input type="hidden" name="count" value="<?php echo $s;?>" />
<input type="hidden" name="source" value="<?php echo $source;?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="13" align="right">
<?php 
$min = 1;
for($j=1;$j<$s;$j++)
{
	if($j == $s-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&source=<?php echo $source;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="phrasesearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&source=<?php echo $source;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
