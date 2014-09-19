<?php
$con = mysql_connect("localhost","root","") or die("Unable to connect because :".mysql_error());
mysql_select_db("resumes",$con);
?>