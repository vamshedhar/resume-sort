<?php
include("dbconnect.php");
include('functions.php');
checkright("addsource");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GFS</title>
</head>

<td align="center"><div id='campus'>

<?php 
if(isset($_POST['addsource']))
{
	$q = mysql_query("INSERT INTO source SET source='$_POST[source]'");
	if(!$q)
	{
		echo mysql_error();
	}
	else
	{
		echo "<h3>Source : ".$_POST['source']." added sucessfully.</h3>";
	}
}

?>
<form action="addsource.php" method="post">
  Enter Source Name : <input type="text" name="source" /><input type="submit" name="addsource" value="Add Source" />
</form>
<br /><br />
<table width="400" border="2" cellpadding="10" cellspacing="0">
<tr><td colspan="3" align="center">List of Added Sources:</td></tr>
<tr><td>SNo.</td><td>Source</td><td>Total Entries</td></tr>
<?php 
$source = mysql_query("SELECT * FROM source");
$s =1;
while($sourcearray = mysql_fetch_array($source))
{
	?>
    <tr><td><?php echo $s;?></td><td><?php echo $sourcearray['source'];?></td>
    
    <td>
    <?php 
	$query = mysql_query("SELECT * FROM details WHERE source='$sourcearray[source]'");
	echo mysql_num_rows($query);
	?>
    </td></tr>
<?php	
$s++;}
?>
</table>
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
