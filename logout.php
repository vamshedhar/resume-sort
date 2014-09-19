<?php
                     
                       
			setcookie("username", "", time() - 36000);
                       
			?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style_01.css" rel="stylesheet" type="text/css" />
<link href="style_01_index.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logout</title>
</head>

<body>
<div id="wrap">
<div id="indexHeader">
    <h1> GFS
    </h1>    
</div>
<p id="campus">GFS</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" height="300px">
<tr><td align="center" class="normal">
Thanks for using our services. Have a Good Day....!!<br />
<a href = "index.php">Click here</a> to login again.</td></tr>
<tr height="100px"></tr>
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
