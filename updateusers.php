<?php
include("dbconnect.php");
include('functions.php');
checkright("updateusers");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<script type="text/javascript">
function check()
{
	return confirm("Are you Sure You want to delete the User!!");

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Users</title>
</head>

<td align="center"><div id='campus'>
<?php
if(isset($_POST['updateUser']))
{
	$confirm = mysql_query("SELECT * FROM users WHERE username='$_COOKIE[username]'");
	$carray = mysql_fetch_array($confirm);
	$pass = md5(hash(sha512,$_POST['password']));
	if($pass == $carray['password'])
	{
	$q = mysql_query("UPDATE users SET uploadresume='$_POST[feild1]', conflicts='$_POST[feild2]', addsource='$_POST[feild3]', wordsearch='$_POST[feild4]', phrasesearch='$_POST[feild5]', bysource='$_POST[feild6]', totallist='$_POST[feild7]', addcomments='$_POST[feild8]', modifycomments='$_POST[feild9]', createusers='$_POST[feild10]', updateusers='$_POST[feild14]', adddetails='$_POST[feild11]', deldetails='$_POST[feild12]', bydetails='$_POST[feild13]' WHERE username='$_POST[username]'");
		if(!$q)
		{
			echo mysql_error();
		}
		else
		{
			echo "<h3 align='center'>User Details Updated Sucessfully.</h3>";
		}
	}
	else
	{
		echo "<h3 align='center'>User Password did not Match.</h3>";
	}
}

?>
<?php
if(isset($_POST['deleteUser']))
{
	$confirm = mysql_query("SELECT * FROM users WHERE username='$_COOKIE[username]'");
	$carray = mysql_fetch_array($confirm);
	$pass = md5(hash(sha512,$_POST['password']));
	if($pass == $carray['password'])
	{
	$q = mysql_query("DELETE FROM users WHERE username='$_POST[username]'");
		if(!$q)
		{
			echo mysql_error();
		}
		else
		{
			echo "<h3 align='center'>User Details Deleted Sucessfully.</h3>";
		}
	}
	else
	{
		echo "<h3 align='center'>User Password did not Match.</h3>";
	}
}

?>
<form action="updateusers.php" method="post">


<table border="0" cellpadding="5" cellspacing="0">
<tr><td colspan="2"><h2>Select User to Update OR Delete</h2></td></tr>
<tr><td align="center">Select User :</td>
<td>
<select name="user">
<option value="">Select User</option>
<?php 
$user = mysql_query("SELECT * FROM users");
$uarray = mysql_fetch_array($user);
while($uarray = mysql_fetch_array($user))
{?>
<option value="<?php echo $uarray['username'];?>"><?php echo $uarray['username'];?></option>
<?php }?>
</select>
</td></tr>
<tr align="center"><td colspan="2"><input type="submit" name="update" value="Update" /> <input type="submit" name="delete" value="Delete" onclick="return check()" /></td></tr>
</table>
<?php
if(isset($_POST['update']) && $_POST['user'] != '')
{
	$update = mysql_query("SELECT * FROM users WHERE username='$_POST[user]'");
	$updatearr = mysql_fetch_array($update);
?>	
<table border="0" cellpadding="10" cellspacing="0">
    <tr><td colspan="2" align="center"><h3>Creat User</h3></td></tr>
	<tr><td>Username :</td><td><input name="username" type="text" id="username" value="<?php echo $updatearr[1];?>" readonly="readonly"  /></td></tr>
    <tr><td>Upload Resumes :</td>
    <td><input type="radio" name="feild1" value="yes" <?php if($updatearr[3] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild1" value="no" <?php if($updatearr[3] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Filter or Replace Conflicts :</td>
    <td><input type="radio" name="feild2" value="yes" <?php if($updatearr[4] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild2" value="no" <?php if($updatearr[4] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Add Source :</td>
    <td><input type="radio" name="feild3" value="yes" <?php if($updatearr[5] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild3" value="no" <?php if($updatearr[5] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Add Department/Manager :</td>
    <td><input type="radio" name="feild11" value="yes" <?php if($updatearr[13] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild11" value="no" <?php if($updatearr[13] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Delete Source/Department/Manager :</td>
    <td><input type="radio" name="feild12" value="yes" <?php if($updatearr[14] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild12" value="no" <?php if($updatearr[14] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Word Search(includes delete) :</td>
    <td><input type="radio" name="feild4" value="yes" <?php if($updatearr[6] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild4" value="no" <?php if($updatearr[6] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Phrase Search(includes delete) :</td>
    <td><input type="radio" name="feild5" value="yes" <?php if($updatearr[7] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild5" value="no" <?php if($updatearr[7] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Search By Source(includes delete) :</td>
    <td><input type="radio" name="feild6" value="yes" <?php if($updatearr[8] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild6" value="no" <?php if($updatearr[8] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Search By Details(No Delete Option) :</td>
    <td><input type="radio" name="feild13" value="yes" <?php if($updatearr[15] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild13" value="no" <?php if($updatearr[15] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Total list View(includes delete) :</td>
    <td><input type="radio" name="feild7" value="yes" <?php if($updatearr[9] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild7" value="no" <?php if($updatearr[9] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Add Comments :</td>
    <td><input type="radio" name="feild8" value="yes" <?php if($updatearr[10] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild8" value="no" <?php if($updatearr[10] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Modify Comments :</td>
    <td><input type="radio" name="feild9" value="yes" <?php if($updatearr[11] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild9" value="no" <?php if($updatearr[11] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    
    <tr><td>Rights to Create Users</td>
    <td><input type="radio" name="feild10" value="yes" <?php if($updatearr[12] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild10" value="no"  <?php if($updatearr[12] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    <tr><td>Rights to Update Users</td>
    <td><input type="radio" name="feild14" value="yes" <?php if($updatearr[16] == 'yes'){ echo "checked='checked'";}?> /> Yes <input type="radio" name="feild14" value="no"  <?php if($updatearr[16] == 'no'){ echo "checked='checked'";}?> /> No</td></tr>
    <tr><td>Enter Your Password :</td><td><input type="password" name="password" /></td></tr>
    <tr><td colspan="2" align="center"><input type="submit" value="Update Details" name="updateUser" /></td></tr>
	</table>


<?php
}
?>
<br /><br />
<?php
if(isset($_POST['delete']) && $_POST['user'] != '')
{
	?>
    <table border="0" cellpadding="5" cellspacing="0">
    <tr><td>
    User to Delete : </td><td><input name="username" type="text" id="username" value="<?php echo $_POST['user'];?>" readonly="readonly"  /></td></tr>
     <tr><td>Enter Your Password : </td><td><input type="password" name="password"  /><input type="submit" name="deleteUser" value="Delete User" /></td></tr>
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
