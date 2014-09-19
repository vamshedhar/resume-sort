<?php
include("dbconnect.php");
include('functions.php');
checkright("wordsearch");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Word Search</title>
<script type="text/javascript">
function check()
{
	return confirm("Are you Sure You want to delete!!");

}
</script>
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

<form action="<?php if($_POST['newsearch'] == "exists"  || $_GET['newsearch'] == 'exists'){echo "wordsearch.php?min=".$_GET['min']."&max=".$_GET['max']."&sort=".$_GET['sort'];}else{ echo "wordsearch.php?min=1&max=10&sort=no";}?>" method="post">
<table align="center" cellpadding="5" cellspacing="0">
<tr><td>Key Words</td><td colspan="2">Compulsary</td></tr>
<tr><td><input type="text" name="key1" /></td><td><input type="radio" name="con1" value="yes" />Yes</td><td><input type="radio" name="con1" value="no" checked="checked" />No</td></tr>
<tr><td><input type="text" name="key2" /></td><td><input type="radio" name="con2" value="yes" />Yes</td><td><input type="radio" name="con2" value="no" checked="checked" />No</td></tr>
<tr><td><input type="text" name="key3" /></td><td><input type="radio" name="con3" value="yes" />Yes</td><td><input type="radio" name="con3" value="no" checked="checked" />No</td></tr>
<tr><td colspan="3" align="center"><input type="submit" name="search" value="Search" /></td></tr>
</table>


<?php 
if(isset($_POST['search']))
{
	
?>
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="wordsearch.php?min=1&max=10&sort=name&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Name</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=nric&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">NRIC</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=gender&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Gender</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=mobile&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Mobile</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=email&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Email</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=source&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Source</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>

<td>User :: <a href="wordsearch.php?min=1&max=10&sort=comments&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Comment</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=dept&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Dept.</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=manager&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Manager</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=status&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists">Status</a></td>
<td>Delete</td></tr>

<?php
$s = 1;
$query = mysql_query("SELECT * FROM details");
while($qarray = mysql_fetch_array($query))
	{
		
		
		$title = $qarray['location'];
		$name = "resumes_txt/".$qarray['location'];
		if($s<1 || $s>10){$s++;continue;}
		if(@file_exists($name))
		{//File Exists
			$file = @fopen($name,'r');
			
			
			//Search variables-Starts
			
			$search1 = strtoupper($_POST['key1']);
			$search2 = strtoupper($_POST['key2']);
			$search3 = strtoupper($_POST['key3']);
			$found1 = strstr(strtoupper(@file_get_contents($name)),$search1);
			$found2 = strstr(strtoupper(@file_get_contents($name)),$search2);
			$found3 = strstr(strtoupper(@file_get_contents($name)),$search3);
			//echo $found."<br>";
			//echo $search1;
			
			//Search Variables-Ends
			
			
			if(str_word_count($found1) != 0)
			{
			//first E
				if(str_word_count($found2) != 0)
				{
				//second E
					if(str_word_count($found3) != 0)
					{
					//third E
						?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
					//third E	
					}
					else
					{
					//third DE
						if($_POST['con3'] == 'no')
						{
							?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
						}
					//third DE	
					}
				//second E
				}
				else
				{
				//second DE	
					if($_POST['con2'] == 'no')
					{
					//second not C DE
						if(str_word_count($found3) != 0)
							{
							//third E
								?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
							//third E	
							}
							else
							{
							//third DE
								if($_POST['con3'] == 'no')
								{
									?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
								}
							//third DE	
							}
					//second not C DE	
					}
				//second DE	
				}
				
			//first E	
			}
			else
			{
			//first DE
				if($_POST['con1'] == "no")
				{
				//first not C - DE
					if(str_word_count($found2) != 0)
						{
						//second E
							if(str_word_count($found3) != 0)
							{
							//third E
								?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
							//third E	
							}
							else
							{
							//third DE
								if($_POST['con3'] == 'no')
								{
									?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
								}
							//third DE	
							}
						//second E	
						}
						else
						{
						//second DE	
							if($_POST['con2'] == "no")
							{
							//second not C DE
								if(str_word_count($found3) != 0)
									{
									//third E
										?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $_POST['key1'];?>&line2=<?php echo $_POST['key2'];?>&line3=<?php echo $_POST['key3'];?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
									//third E	
									}
									
							//second not C DE	
							}
						//second DE	
						}
				//first not C - DE
				}
			
			//first DE	
			}
			
			
			
			
			
			
			
		}
		else
		{//File dosenot Exist
			break;
		}
	}
	
?>
<input type="hidden" name="count" value="<?php echo $s;?>" />
<input type="hidden" name="newkey1" value="<?php echo $_POST['key1'];?>" />
<input type="hidden" name="newkey2" value="<?php echo $_POST['key2'];?>" />
<input type="hidden" name="newkey3" value="<?php echo $_POST['key3'];?>" />
<input type="hidden" name="newcon3" value="<?php echo $_POST['con3'];?>" />
<input type="hidden" name="newcon2" value="<?php echo $_POST['con2'];?>" />
<input type="hidden" name="newcon1" value="<?php echo $_POST['con1'];?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="14" align="right">
<?php 
$min = 1;
for($j=1;$j<$s;$j++)
{
	if($j == $s-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="wordsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="wordsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $_POST['key1'];?>&newkey2=<?php echo $_POST['key2'];?>&newkey3=<?php echo $_POST['key3'];?>&newcon1=<?php echo $_POST['con1'];?>&newcon2=<?php echo $_POST['con2'];?>&newcon3=<?php echo $_POST['con3'];?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
			if(isset($_POST['newkey2']))
			{
			$newkey2 = $_POST['newkey2'];
			}
			else
			{$newkey2 = $_GET['newkey2'];}
			if(isset($_POST['newkey3']))
			{
			$newkey3 = $_POST['newkey3'];
			}
			else
			{$newkey3 = $_GET['newkey3'];}
			if(isset($_POST['newcon3']))
			{
			$newcon3 = $_POST['newcon3'];
			}
			else
			{$newcon3 = $_GET['newcon3'];}
			if(isset($_POST['newcon2']))
			{
			$newcon2 = $_POST['newcon2'];
			}
			else
			{$newcon2 = $_GET['newcon2'];}
			if(isset($_POST['newcon1']))
			{
			$newcon1 = $_POST['newcon1'];
			}
			else
			{$newcon1 = $_GET['newcon1'];}
?>
<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td>
<td><a href="wordsearch.php?min=1&max=10&sort=name&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Name</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=nric&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">NRIC</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=gender&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Gender</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=mobile&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Mobile</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=email&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Email</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=source&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Source</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=timestamp&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Forwarded on</a></td>
<td>Resume</td>
<td>User :: <a href="wordsearch.php?min=1&max=10&sort=comments&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Comment</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=dept&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Dept.</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=manager&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Manager</a></td>
<td><a href="wordsearch.php?min=1&max=10&sort=status&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists">Status</a></td>
<td>Delete</td></tr>


<?php
$s = 1;
if($_GET['sort'] == 'no')
{
$query = mysql_query("SELECT * FROM details");
}
else
{
	
	$query = mysql_query("SELECT * FROM details ORDER BY $_GET[sort] ASC");
}
while($qarray = mysql_fetch_array($query))
	{
		
		$title = $qarray['location'];
		$name = "resumes_txt/".$qarray['location'];
		if($s<$_GET['min'] || $s>$_GET['max']){$s++;continue;}
		
		if(@file_exists($name))
		{//File Exists
			$file = @fopen($name,'r');
			
			
			
			//Search variables-Starts
			
			$search1 = strtoupper($newkey1);
			$search2 = strtoupper($newkey2);
			$search3 = strtoupper($newkey3);
			$found1 = strstr(strtoupper(@file_get_contents($name)),$search1);
			$found2 = strstr(strtoupper(@file_get_contents($name)),$search2);
			$found3 = strstr(strtoupper(@file_get_contents($name)),$search3);
			//echo $found."<br>";
			//echo $search1;
			
			//Search Variables-Ends
			
			
			if(str_word_count($found1) != 0)
			{
			//first E
				if(str_word_count($found2) != 0)
				{
				//second E
					if(str_word_count($found3) != 0)
					{
					//third E
						?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
					//third E	
					}
					else
					{
					//third DE
						if($newcon3 == 'no')
						{
							?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
						}
					//third DE	
					}
				//second E
				}
				else
				{
				//second DE	
					if($newcon2 == 'no')
					{
					//second not C DE
						if(str_word_count($found3) != 0)
							{
							//third E
								?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
							//third E	
							}
							else
							{
							//third DE
								if($newcon3 == 'no')
								{
									?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
								}
							//third DE	
							}
					//second not C DE	
					}
				//second DE	
				}
				
			//first E	
			}
			else
			{
			//first DE
				if($newcon1 == "no")
				{
				//first not C - DE
					if(str_word_count($found2) != 0)
						{
						//second E
							if(str_word_count($found3) != 0)
							{
							//third E
								?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
							//third E	
							}
							else
							{
							//third DE
								if($newcon3 == 'no')
								{
									?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
								}
							//third DE	
							}
						//second E	
						}
						else
						{
						//second DE	
							if($newcon2 == "no")
							{
							//second not C DE
								if(str_word_count($found3) != 0)
									{
									//third E
										?>
		<tr><td><?php echo $s;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['nric'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['mobile'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>&line=<?php echo $newkey1;?>&line2=<?php echo $newkey2;?>&line3=<?php echo $newkey3;?>" target="_new">Click Here</a></td><td><?php if($qarray['commentuser'] != ''){echo  "<b>".$qarray['commentuser']." :: </b>";}?><?php echo $qarray['comments'];?></td>
<td><?php echo $qarray['dept'];?></td><td><?php echo $qarray['manager'];?></td><td><?php if($qarray['status'] != ''){echo $qarray['status'];}else{echo "None";}?></td><td><input type="submit" name="delete<?php echo $s;?>" onclick="return check()" value="Delete"  /><input type="hidden" name="email<?php echo $s;?>" value="<?php echo $qarray['email'];?>" /><input type="hidden" name="resume<?php echo $s;?>" value="<?php echo $qarray['location'];?>" /></tr>
		
		<?php $s++;continue;
									//third E	
									}
									
							//second not C DE	
							}
						//second DE	
						}
				//first not C - DE
				}
			
			//first DE	
			}
			
			
			
			
			
			
			
		}
		else
		{//File dosenot Exist
			break;
		}
	}
	
?>
<input type="hidden" name="count" value="<?php echo $s;?>" />
<input type="hidden" name="newkey1" value="<?php echo $newkey1;?>" />
<input type="hidden" name="newkey2" value="<?php echo $newkey2;?>" />
<input type="hidden" name="newkey3" value="<?php echo $newkey3;?>" />
<input type="hidden" name="newcon3" value="<?php echo $newcon3;?>" />
<input type="hidden" name="newcon2" value="<?php echo $newcon2;?>" />
<input type="hidden" name="newcon1" value="<?php echo $newcon1;?>" />
<input type="hidden" name="newsearch" value="exists" />
<tr><td colspan="14" align="right">
<?php 
$min = 1;
for($j=1;$j<$s;$j++)
{
	if($j == $s-1 && $j%10 != 0)
	{
		$max = $j;
		?>
		<a href="wordsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
		<?php
	}
	if($j%10 == 0)
	{
		$max = $j;
		?>
		<a href="wordsearch.php?min=<?php echo $min;?>&max=<?php echo $max;?>&sort=<?php echo $_GET['sort'];?>&newkey1=<?php echo $newkey1;?>&newkey2=<?php echo $newkey2;?>&newkey3=<?php echo $newkey3;?>&newcon1=<?php echo $newcon1;?>&newcon2=<?php echo $newcon2;?>&newcon3=<?php echo $newcon3;?>&newsearch=exists"><?php echo $min;?> - <?php echo $max;?></a>&nbsp;&nbsp;&nbsp;
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
