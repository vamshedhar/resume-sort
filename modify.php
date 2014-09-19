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
</head>
     
          <td align="center"><div id='campus'>
          <form action="modifydetails.php?min=<?php echo $_GET['min'];?>&max=<?php echo $_GET['max'];?>&sort=<?php echo $_GET['sort'];?>" method="post">
          <?php
          	for($j=1;$j<=$_POST['count'];$j++)
			{
				$submit = "Submit".$j;
				$location = "hidden".$j;
				if(isset($_POST[$submit]))
				{
					$query = mysql_query("SELECT * FROM details WHERE location='$_POST[$location]'");
					$qarray = mysql_fetch_array($query)
					?>
				<table border="2" cellpadding="10" cellspacing="0">
<tr><td>SNo.</td><td>Name</td><td>Gender</td><td>Email</td><td>Source</td><td>Forwarded on</td><td>Resume</td><td>Modify Comments</td><td>Modify Dept.</td><td>Modify Manager</td><td>Modify Status</td></tr>	
                    
<tr><td><?php echo 1;?></td><td><?php echo $qarray['name'];?></td><td><?php echo $qarray['gender'];?></td><td><?php echo $qarray['email'];?></td><td><?php echo $qarray['source'];?></td><td><?php echo $qarray['timestamp'];?></td><td><a href="resume.php?fname=<?php echo $qarray['location'];?>" target="_new">Click Here</a></td><td><textarea name="comment" rows="3" cols="20"><?php echo $qarray['comments'];?></textarea><input type="hidden" name="location" value="<?php echo $qarray['location'];?>" />

</td>
<td>
<select name="dept" style="width:120px;">
<option value=""></option>
<?php 
$d = mysql_query("SELECT * FROM dept");
while($da = mysql_fetch_array($d))
{
?>
<option <?php if($qarray['dept'] == $da['dept']) { echo "selected='selected'";}?>  value="<?php echo $da['dept'];?>"><?php echo $da['dept'];?></option>	
<?php
}
?>
</select>

<td>
<select name="manager" style="width:120px;">
<option value=""></option>
<?php 
$m = mysql_query("SELECT * FROM manager");
while($ma = mysql_fetch_array($m))
{
?>
<option <?php if($qarray['manager'] == $ma['manager']) { echo "selected='selected'";}?> value="<?php echo $ma['manager'];?>"><?php echo $ma['manager'];?></option>	
<?php
}
?>
</select>
</td>
<td><input type="radio" name="status"  <?php if($qarray['status'] == 'hired'){ echo "checked='checked'";}?> value="hired" />Hired<br />
<input type="radio" name="status"  <?php if($qarray['status'] == 'reject'){ echo "checked='checked'";}?> value="reject" />Reject<br />
<input type="radio" name="status"  <?php if($qarray['status'] == 'interview'){ echo "checked='checked'";}?> value="interview" />Interview<br />
<input type="radio" name="status"  <?php if($qarray['status'] == 'kiv'){ echo "checked='checked'";}?> value="kiv" />KIV
<br />
<input type="submit" name="Submit" value="Modify" />
</td>
</tr>                    
                    
                    </table>
				<?php
                }
				
			}
		  
		  
		  
		  ?>
          
          
          </form>
          
          </div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
