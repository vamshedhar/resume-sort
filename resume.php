<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
#found
{
	background-color:#FF6;
}
</style>
<title>GFS</title>
</head>

<body>
<?php

$file = @fopen("resumes_txt/".$_GET['fname'], "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached

$search1 = strtoupper($_GET['line']);
$search2 = strtoupper($_GET['line2']);
$search3 = strtoupper($_GET['line3']);
while(!@feof($file))
  {
		$line = @fgets($file);
		if(isset($_GET['line']))
		{
			$found1 = strstr(strtoupper($line),$search1);
		}
		if(isset($_GET['line2']))
		{
			$found2 = strstr(strtoupper($line),$search2);
		}
		if(isset($_GET['line3']))
		{
			$found3 = strstr(strtoupper($line),$search3);
		}
	  //$line = strtoupper(fgets($file));
		if(str_word_count($found1) != 0 && isset($_GET['line']))
		{
		  echo "<b id='found'>";
		}
		if(str_word_count($found2) != 0 && isset($_GET['line2']))
		{
		  echo "<b id='found'>";
		}
		if(str_word_count($found3) != 0 && isset($_GET['line3']))
		{
		  echo "<b id='found'>";
		}
	  echo $line."<br>";
	  if(str_word_count($found1) != 0 && isset($_GET['line']))
	  {
		  echo "</b>";
		  }
		  if(str_word_count($found2) != 0 && isset($_GET['line2']))
	  {
		  echo "</b>";
		  }
		  if(str_word_count($found3) != 0 && isset($_GET['line3']))
	  {
		  echo "</b>";
		  }
	  

  }
@fclose($file);

?>
</body>
</html>