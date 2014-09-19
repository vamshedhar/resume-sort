<?php
include("dbconnect.php");
include('functions.php');
checkright("conflicts");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conflicts</title>
</head>
<?php 
if(isset($_POST['submit']))
	{
		for($x=1;$x<=$_POST['count'];$x++)
		{
			$action = "action".$x;
			$locationold = "locationold".$x;
			$location = "location".$x;
			
				if($_POST[$action] == 'replace')
				{
					$check = mysql_query("SELECT * FROM details WHERE email='$_POST[$locationold]'");
					$checkarray = mysql_fetch_array($check);
					echo $_POST[$resume];
					$del = mysql_query("SELECT * FROM links WHERE text='$checkarray[location]'");
					if(!$del){echo mysql_error();}
					$delquery = mysql_fetch_array($del);
					$file1 = "Resumes/".$delquery['word'];
					$file2 = "Resumes_txt/".$checkarray['location'];
					@unlink($file1);
					@unlink($file2);
					//echo $checkarray['location'];
					mysql_query("DELETE FROM links WHERE text='$checkarray[location]'");
					mysql_query("DELETE FROM details WHERE email='$_POST[$locationold]'");
					$check2 = mysql_query("SELECT * FROM detailstemp WHERE location='$_POST[$location]'");
					$checkarray2 = mysql_fetch_array($check2);
					mysql_query("INSERT INTO details SET name='$checkarray2[name]', nric='$checkarray2[nric]', timestamp='$checkarray2[timestamp]', nationality='$checkarray2[nationality]', gender='$checkarray2[gender]', dob='$checkarray2[dob]',  address='$checkarray2[address]', mobile='$checkarray2[mobile]', email='$checkarray2[email]', location='$checkarray2[location]', source='$checkarray2[source]', user='$_COOKIE[username]'");
					mysql_query("DELETE FROM detailstemp WHERE location='$_POST[$location]'");
				}
				elseif($_POST[$action] == 'filter')
				{
					
					$del = mysql_query("SELECT * FROM links WHERE text='$_POST[$location]'");
					
					$delquery = mysql_fetch_array($del);
					$file1 = "Resumes/".$delquery['word'];
					$file2 = "Resumes_txt/".$_POST[$location];
					@unlink($file1);
					@unlink($file2);
					mysql_query("DELETE FROM links WHERE text='$_POST[$location]'");
					mysql_query("DELETE FROM detailstemp WHERE location='$_POST[$location]'");
				}
				elseif($_POST[$action] == 'both')
				{
					$check2 = mysql_query("SELECT * FROM detailstemp WHERE location='$_POST[$location]'");
					$checkarray2 = mysql_fetch_array($check2);
					mysql_query("INSERT INTO details SET name='$checkarray2[name]', nric='$checkarray2[nric]', timestamp='$checkarray2[timestamp]', nationality='$checkarray2[nationality]', gender='$checkarray2[gender]', dob='$checkarray2[dob]',  address='$checkarray2[address]', mobile='$checkarray2[mobile]', email='$checkarray2[email]', location='$checkarray2[location]', source='$checkarray2[source]', user='$_COOKIE[username]'");
					mysql_query("DELETE FROM detailstemp WHERE location='$_POST[$location]'");
				}
				//echo $_POST[$email];
				//echo $_POST[$location];
			
		}
	}
?>
<td align="center"><div id='campus'>
<br /><br />
<form action="conflicts.php" method="post">
<?php
$query = mysql_query("SELECT * FROM detailstemp");
if(mysql_num_rows($query) != 0)
{
	?>
    <table border="2" width="800" cellpadding="10" cellspacing="0">
    <tr><td align="center">Old Details</td><td align="center">New Details</td><td>Action</td></tr>
    <?php
	$i = 1;
while($qarray = mysql_fetch_array($query))
{?>

<tr>
<td align="center">
<?php
$query2 = mysql_query("SELECT * FROM details WHERE email='$qarray[email]'");
$qarray2 = mysql_fetch_array($query2);
	echo "Name : ".$qarray2['name']."<br>";
	echo "NRIC : ".$qarray2['nric']."<br>";
	echo "Gender : ".$qarray2['gender']."<br>";
	echo "Date of Birth : ".$qarray2['dob']."<br>";
	echo "Address : ".$qarray2['address']."<br>";
	echo "Nationality : ".$qarray2['nationality']."<br>";
	echo "Mobile : ".$qarray2['mobile']."<br>";
	echo "Email : ".$qarray2['email']."<br>";
	echo "Source : ".$qarray2['source']."<br>";
	echo "Forwarded on : ".$qarray2['timestamp']."<br>";
?>
<input type="hidden" name="locationold<?php echo $i;?>" value="<?php echo $qarray2['location'];?>" />
</td>

<td align="center">

<?php
	echo "Name : ".$qarray['name']."<br>";
	echo "NRIC : ".$qarray['nric']."<br>";
	echo "Gender : ".$qarray['gender']."<br>";
	echo "Date of Birth : ".$qarray['dob']."<br>";
	echo "Address : ".$qarray['address']."<br>";
	echo "Nationality : ".$qarray['nationality']."<br>";
	echo "Mobile : ".$qarray['mobile']."<br>";
	echo "Email : ".$qarray['email']."<br>";
	echo "Source : ".$qarray['source']."<br>";
	echo "Forwarded on : ".$qarray['timestamp']."<br>";
?>
<input type="hidden" name="location<?php echo $i;?>" value="<?php echo $qarray['location'];?>" />
</td><td>
<input type="radio" name="action<?php echo $i;?>" value="replace" /> Replace<br /><br />
<input type="radio" name="action<?php echo $i;?>" value="filter" /> Retain Old<br /><br />
<input type="radio" name="action<?php echo $i;?>" value="both" /> Keep Both<br /><br />
</td></tr>	
<?php $i++; }

?>
<input type="hidden" name="count" value="<?php echo $i;?>" />
<tr><td colspan="3" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
</table>
<?php
}
else
{
echo "<h3>No conflicts Found!!</h3>";	
}
?>
</form>
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
