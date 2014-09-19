<?php 
        
	if(!isset($_COOKIE['username'])){
		die("You are not logged in. Please <a href = \"index.php\">login</a> to continue");
	}
 else {
?>

<body>
<br>
<div id="wrap">
<table width="100%" cellspacing="0" cellpadding="0"  align="center">
<tr>
<td colspan=2>

<div id="header">

    <h1>GFS 
    </h1>
    
    <ul>
    <li><?php echo $_COOKIE['username'];?></li>
    <li><a href="home.php" class="hyperlinktop">Home</a></li>
    <li><a href="logout.php" class="hyperlinktop">Logout</a></li>
    </ul>
    
</div>
<td></tr>
<tr><td colspan=2>
    <p id="campus">GFS</p>
</td></tr>

<?php
}
?>
<tr>
<td valign="top" width="180px">
<?php
	include("i_leftbar.php");
?>
</td>
