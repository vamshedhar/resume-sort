<?php
include("dbconnect.php");
include('i_header.php');
include('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Done</title>
</head>
<td align="center"><div id='campus'>
<?php
if(isset($_POST['upload']))
{
	if(count($_FILES['resume']['name']))
		{
			$i = 0;
			foreach ($_FILES['resume']['tmp_name'] as $file) 
				{
					$name = $_FILES['resume']['name'][$i];
					if(@file_exists("resumes/".$name))
					  {
						  for($j=1;$j>0;$j++)
						  {
							  $rand = rand();
							  if(@file_exists("resumes/".$rand.$name))
							  {
								  continue;
							  }
							  else
							  {
								  @move_uploaded_file($file,"resumes/".$rand.$name);
								  $namelink = "C:/wamp/www/ProjectResumes/resumes/".$rand.$name;
								mysql_query("INSERT INTO links SET word = '$rand$name', source='$_POST[source]'");
								
								  break;
							  }
						  }
					  }
					  else
					  {
							@move_uploaded_file($file,"resumes/".$name);
							$namelink = "C:/wamp/www/ProjectResumes/resumes/".$name;
							mysql_query("INSERT INTO links SET word = '$name', source='$_POST[source]'");
							
							
					  }
					
				//print_r($file);
			
				$i++;}
		}
$repeat = 0;
$query = mysql_query("SELECT * FROM links WHERE text='no'");
while($qarray = mysql_fetch_array($query))
{
	
	for($k=1;$k>0;$k++)
	{
		$name2 = "Resume".$k;
		if(@file_exists("resumes_txt/".$name2.".txt"))
		{
			continue;
		}
		else
		{
			$txtname = $name2.".txt";
			/*$filename = "C:\\wamp\\www\\ProjectResumes\\resumes\\".$qarray['word'];
			$TXTfilename = "C:\\wamp\\www\\ProjectResumes\\resumes_txt\\".$name2.".txt";
			$word = new COM("word.application") or die("Unable to instantiate Word object");
			$word->Documents->Open($filename);
			// the '2' parameter specifies saving in txt format
			$word->Documents[1]->SaveAs($TXTfilename ,2);
			$word->Documents[1]->Close(false);
			$word->Quit();*/
			$t = @read("Resumes/".$qarray['word']);
			$file = @fopen("resumes_txt/".$name2.".txt","w");
			$t2 = str_replace("<br />","\r\n",$t);
			@fwrite($file,$t2);
			mysql_query("UPDATE links SET text='$txtname' WHERE word='$qarray[word]'");
			$t = trim($t);
			//echo $t;
			$tr = preg_split('<br>',$t);
			
			for($i =0;$i<sizeof($tr);$i++)
			{
			
			$tr[$i] = str_replace("/>"," ",$tr[$i]);
			$tr[$i] = str_replace("<"," ",$tr[$i]);
			$tr[$i] = trim($tr[$i]);
			//$te[$i] = explode("  ",$te[$i]);
			//echo"<br>";
			//print_r($te[$i]);
			}
			//print_r($tr);
			$ty = implode("  ",$tr);
			$te = explode(":", $ty);
			for($i =0;$i<sizeof($te);$i++)
			{
			//echo $te[$i]."------------";
			//$te[$i] = str_replace("%"," ",$te[$i]);
			//$te[$i] = preg_replace("[%]","  ",$te[$i]);
			$te[$i] = trim($te[$i]);
			$te[$i] = explode("  ",$te[$i]);
			//echo"<br>";
			//print_r($te[$i]);
			}
			for($i =0;$i<(sizeof($te) - 1);$i++)
			{
			$s = $i + 1;
			$rt[$te[$i][sizeof($te[$i]) - 1]] = $te[$s][0] ;
			}
			$xe = array();
			for($i =0;$i<(sizeof($te) - 1);$i++)
			{
			$s = $i + 1;
			$glue = '###';
			
			$te[$s][0] = preg_replace('/([a-z])([A-Z])/',"$1$glue$2",$te[$s][0]);
			$te[$i][sizeof($te[$i]) - 1] = preg_replace('/([a-z])([A-Z])/',"$1$glue$2",$te[$i][sizeof($te[$i]) - 1]);
			$tv = preg_split('/([###])/',$te[$s][0]);
			$tk = preg_split('/([###])/',$te[$i][sizeof($te[$i]) - 1]);
			$xe[$tk[sizeof($tk) - 1]] = $tv[0];
			
			}
			//print_r($rt);
		
			//print_r($xe);
			
			/*
			for($i=0;$i<sizeof($xe);$i++)
			{
			if(
			preg_
			
			
			}
			
			
			$tert = "uheeuOPPjkkk";
			$glue = '###';
			$tert = preg_replace('/([a-z0-9])([A-Z])/',"$1$glue$2", $tert);
			$r = preg_split('/(###)/',$tert);
			echo $tert;
			print_r($r);
					*/
			$keys = array_keys($xe);
			$values = array_values($xe);
			//
			//print_r($values);
			//echo "<br>";
			//print_r($keys);
			$variables = array("name","date of birth","nationality","gender","sex","nric","mobile","phone","address","email","e-mail","contact");
			//$name = '';$dob = '';$nat ='';$gen = ''; $nric = '' ;$phn = ''; $add ='' ; $email = '';
			//print_r($vn);echo "<br>";
			$vn = array('','','','','','','','','','','','');
			//print_r($vn);echo "<br>";
			for($j = 0;$j <sizeof($keys);$j++)
			{
			for($i = 0;$i<sizeof($variables);$i++)
			{
			if((preg_match('['.$variables[$i].']',strtolower($keys[$j])) == 1) && ($vn[$i] == ''))
			   {$vn[$i] = $values[$j];}
			}
			}
			//print_r($vn);
			
			
			$nameX = $vn[0];
			$dob = $vn[1];
			$nat = $vn[2];
			$sex = $vn[3];
			$nric = $vn[5];
			$phn = $vn[6];
			$add = $vn[8];
			$email = $vn[10];
			if($sex == ''){$sex = $vn[4]; }
			if($phn == ''){$phn = $vn[7];}if($phn == ''){$phn = $vn[11];} 
			if($email == ''){$email = $vn[9];}
			if($nameX == '')
			{
				$file2 = fopen("resumes_txt/".$name2.".txt",'r');
				while(!@feof($file2))
				{
					if(str_word_count($nameX)>0)
					{
					 $nameX = substr($nameX,0,10);
						break;
					}
			$nameX = @fgets($file2);
				}
			}
			$time = mysql_query("SELECT * FROM links WHERE text='$txtname'");
			$timearray = mysql_fetch_array($time);
			$conflicts = mysql_query("SELECT * FROM details WHERE email='$email'");
			if(mysql_num_rows($conflicts)>0)
			{
				mysql_query("INSERT INTO detailstemp SET name='$nameX', nric='$nric', timestamp='$timearray[time]', nationality='$nat', gender='$sex', dob='$dob',  address='$add', mobile='$phn', email='$email', location='$txtname', source='$_POST[source]', user='$_COOKIE[username]'");
					  $repeat++;
			}
			else
			{
				$test = mysql_query("INSERT INTO details SET name='$nameX', nric='$nric', timestamp='$timearray[time]', nationality='$nat', gender='$sex', dob='$dob',  address='$add', mobile='$phn', email='$email', location='$txtname', source='$_POST[source]', user='$_COOKIE[username]'");
				echo "<h3>Following details were Entered!!</h3>";
					  echo "Name : ".$nameX."<br>";
					  echo "NRIC : ".$nric."<br>";
					  echo "Gender : ".$sex."<br>";
					  echo "Date of Birth : ".$dob."<br>";
					  echo "Address : ".$add."<br>";
					  echo "Nationality : ".$nat."<br>";
					  echo "Mobile : ".$phn."<br>";
					  echo "Email : ".$email."<br>";
					  echo "<br><br><br><br>";
					    $nameX = '';
						$dob = '';
						$nat = '';
						$sex = '';
						$nric = '';
						$phn = '';
						$add = '';
						$email = '';
				
			}
			
				
			
			
			break;
		}
	}
	
}

/*$query2 = mysql_query("SELECT * FROM links WHERE text!='no'");

while($qarray2 = mysql_fetch_array($query2))
{
	
	$check = mysql_query("SELECT * FROM details WHERE location='$qarray2[text]'");
	if(!$check){echo mysql_error();}
	if(mysql_num_rows($check) == 0)
	{
		$file = fopen("resumes_txt/".$qarray2['text'], "r") or exit("Unable to open file!");
					//Output a line of the file until the end is reached
					while(!feof($file))
					  {
						  $line = strtoupper(fgets($file));
						  if(str_word_count(strstr($line,"NAME")) != 0)
						  {
					  		$name = trim(trim(substr(strstr($line,"NAME"),4),":"));
						  }
						  if(str_word_count(strstr($line,"NRIC")) != 0)
						  {
					  		$nric = trim(trim(substr(strstr($line,"NRIC"),4),":"));
						  }
						  if(str_word_count(strstr($line,"GENDER")) != 0)
						  {
					  		$gender = trim(trim(substr(strstr($line,"GENDER"),6),":"));
						  }*/
						  /*if(str_word_count(strstr($line,"DATE OF BIRTH")) != 0)
						  {
					  		$dob = trim(trim(substr(strstr($line,"DATE OF BIRTH"),13),":"));
						  }
						  if(str_word_count(strstr($line,"NATIONALITY")) != 0)
						  {
					  		$nat = trim(trim(substr(strstr($line,"NATIONALITY"),11),":"));
						  }
						  if(str_word_count(strstr($line,"ADDRESS")) != 0)
						  {
					  		$add = trim(trim(substr(strstr($line,"ADDRESS"),7),":"));
						  }*/
						  /*if(str_word_count(strstr($line,"MOBILE")) != 0)
						  {
					  		$num = trim(trim(substr(strstr($line,"MOBILE"),6),":"));
						  }
						  if(str_word_count(strstr($line,"EMAIL")) != 0)
						  {
					  		$email = strtolower(trim(trim(substr(strstr($line,"EMAIL"),5),":")));
						  }
					  }
					fclose($file);
				  
				  $test = mysql_query("INSERT INTO details SET name='$name', nric='$nric', gender='$gender', mobile='$num', email='$email', location='$qarray2[text]'");
				  if(!$test){echo mysql_error();}
				  if(mysql_error() != "Duplicate entry '$email' for key 'email'")
				  {
					  echo "<h3>Following details were Entered!!</h3>";
					  echo "Name : ".$name."<br>";
					  echo "NRIC : ".$nric."<br>";
					  echo "Gender : ".$gender."<br>";
					  //echo "Date of Birth : ".$dob."<br>";
					  //echo "Nationality : ".$nat."<br>";
					  //echo "Address : ".$add."<br>";
					  echo "Mobile : ".$num."<br>";
					  echo "Email : ".$email."<br>";
					  echo "<br><br><br><br>";
				  }
		
		
		
		
		
		
	}
}
*/





}
if($repeat != 0)
{
	echo $repeat." Conflicts found. <a href='conflicts.php'>Click Here</a> to see them.";
	
	}
?>         
         
         
         
         
</div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
