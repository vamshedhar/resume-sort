<?php
include("dbconnect.php");
include('functions.php');
checkright("createusers");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Users</title>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<td align="center"><div id='campus'>
<?php 
	if(isset($_POST['adduser']))
	{
		if($_POST['pass'] == $_POST['cpass'])
		{
			$hash = md5(hash(sha512,$_POST['cpass']));
		$q = mysql_query("INSERT INTO users SET username='$_POST[username]', password='$hash', uploadresume='$_POST[feild1]', conflicts='$_POST[feild2]', addsource='$_POST[feild3]', wordsearch='$_POST[feild4]', phrasesearch='$_POST[feild5]', bysource='$_POST[feild6]', totallist='$_POST[feild7]', addcomments='$_POST[feild8]', modifycomments='$_POST[feild9]', createusers='$_POST[feild10]', updateusers='$_POST[feild14]', adddetails='$_POST[feild11]', deldetails='$_POST[feild12]', bydetails='$_POST[feild13]'");
		if(!$q)
		{
			echo mysql_error();
		}
		else
		{
			echo "<h3 align='center'>User added Sucessfully.</h3>";
		}
		}
		else
		{
			echo "<h3 align='center'>Passwords dosent match.</h3>";
		}
		
	}
	
?>
<form action="createusers.php" method="post" onsubmit="MM_validateForm('username','','R','pass','','R','cpass','','R');return document.MM_returnValue">
	<table border="0" cellpadding="10" cellspacing="0">
    <tr><td colspan="2" align="center"><h3>Creat User</h3></td></tr>
	<tr><td>Enter Username :</td><td><input name="username" type="text" id="username"  /></td></tr>
    <tr><td>Enter Password :</td><td><input name="pass" type="password" id="pass"  /></td></tr>
    <tr><td>Confirm Password :</td><td><input name="cpass" type="password" id="cpass"  /></td></tr>
    <tr><td>Upload Resumes :</td><td><input type="radio" name="feild1" value="yes" /> Yes <input type="radio" name="feild1" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Filter or Replace Conflicts :</td><td><input type="radio" name="feild2" value="yes" /> Yes <input type="radio" name="feild2" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Add Source :</td><td><input type="radio" name="feild3" value="yes" /> Yes <input type="radio" name="feild3" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Add Department/Manager :</td><td><input type="radio" name="feild11" value="yes" /> Yes <input type="radio" name="feild11" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Delete Source/Department/Manager :</td><td><input type="radio" name="feild12" value="yes" /> Yes <input type="radio" name="feild12" value="no" checked="checked" /> No</td></tr>
    <tr><td>Word Search(includes delete) :</td><td><input type="radio" name="feild4" value="yes" /> Yes <input type="radio" name="feild4" value="no" checked="checked" /> No</td></tr>
    <tr><td>Phrase Search(includes delete) :</td><td><input type="radio" name="feild5" value="yes" /> Yes <input type="radio" name="feild5" value="no" checked="checked" /> No</td></tr>
    <tr><td>Search By Source(includes delete) :</td><td><input type="radio" name="feild6" value="yes" /> Yes <input type="radio" name="feild6" value="no" checked="checked" /> No</td></tr>
    <tr><td>Search By Details(No Delete Option) :</td><td><input type="radio" name="feild13" value="yes" /> Yes <input type="radio" name="feild13" value="no" checked="checked" /> No</td></tr>
    <tr><td>Total list View(includes delete) :</td><td><input type="radio" name="feild7" value="yes" /> Yes <input type="radio" name="feild7" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Add Comments &amp; Details :</td><td><input type="radio" name="feild8" value="yes" /> Yes <input type="radio" name="feild8" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Modify Comments&amp; Details :</td><td><input type="radio" name="feild9" value="yes" /> Yes <input type="radio" name="feild9" value="no" checked="checked" /> No</td></tr>
    <tr><td>Rights to Create Users</td><td><input type="radio" name="feild10" value="yes" /> Yes <input type="radio" name="feild10" value="no"  checked="checked" /> No</td></tr>
    <tr><td>Rights to Update Users</td><td><input type="radio" name="feild14" value="yes" /> Yes <input type="radio" name="feild14" value="no"  checked="checked" /> No</td></tr>
    <tr><td colspan="2" align="center"><input type="submit" value="Submit" name="adduser" /></td></tr>
	</table>
</form>
</div></td></tr>
      
          
</table>

<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
