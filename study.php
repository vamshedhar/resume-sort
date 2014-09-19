<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function check()
{
	return confirm("Are you Sure You want to delete!!");

}
</script>
<title>Untitled Document</title>
</head>

<body>
<?php



/*$filename = "C:\\wamp\\www\\ProjectResumes\\resumes\\Candidate D_new.docx";
echo $filename."<br>";
			$TXTfilename = "C:/wamp/www/ProjectResumes/resumes_txt/new2.txt";
			$word = new COM("word.application") or die("Unable to instantiate Word object");
			$word->Documents->Open($filename);
			// the '2' parameter specifies saving in txt format
			$word->Documents[1]->SaveAs($TXTfilename ,2);
			$word->Documents[1]->Close(false);
			$word->Quit();
			*/

/*$file = fopen("resumes_txt/Resume5.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
  {
	  //$line = strtoupper(fgets($file));
	  echo fgets($file)."<br>";
	  if(str_word_count(strstr($line,"EDUCATIONAL QUALIFICATION")) != 0)
	  {
		$i = 1;
	  }
	  //echo strstr(strtoupper(fgets($file)),"EDUCATIONAL QUALIFICATION")."<br>";
  //echo trim(substr(strstr(strtoupper(fgets($file)),"NAME"),4),":")."<br>";
  }
fclose($file);*/




?>
<?php
   /* function parseWord($userDoc) {

      $fileHandle = fopen($userDoc, "r");

      $line = @fread($fileHandle, filesize($userDoc));

      $lines = explode(chr(0x0D),$line); $outtext = "";

      foreach($lines as $thisline) {

        $pos = strpos($thisline, chr(0x00));

        if (($pos !== FALSE)||(strlen($thisline)==0)) { }
        else {
            $outtext .= $thisline." ";
         }
      }

      $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);

      return $outtext;
    }
	echo parseWord("resumes/5634Candidate E.docx");*/
/*    $word = new COM("word.application") or die ("Could not initialise MS Word object.");
$word->Documents->Open(realpath("resumes/5634Candidate E.docx"));
 
// Extract content.
$content = (string) $word->ActiveDocument->Content;
 
echo $content;
 
$word->ActiveDocument->Close(false);
 
$word->Quit();
$word = NULL;
unset($word);*/
	
	
			/*$filename = "C:\\wamp\\www\\ProjectResumes\\resumes\\Candidate E.docx";
			$TXTfilename = "C:\\wamp\\www\\ProjectResumes\\resumes_txt\\New.txt";
			$word = new COM("word.application") or die("Unable to instantiate Word object");
			$word->Documents->Open($filename);
			// the '2' parameter specifies saving in txt format
			$word->Documents[1]->SaveAs($TXTfilename ,2);
			$word->Documents[1]->Close(false);
			$word->Quit();*/
	/*$file = "Resumes/sample.docx";
	
	if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }*/
	$array = array(1,2,3,4);
	if(isset($_POST['submit']))
	{
		//print_r($_POST['hidden']);
		
		 //while($_POST['hidden'])
		 {
			// echo "test";
		 }
		 
		 $a = array($_POST['hidden']);
		for($i=0;$i<count($a);$i++)
		{
			
			echo $a[$i];
		}
		
	}
	?>
<!--<a href="resumes/5634Candidate E.docx" target="_new">click here</a>-->
<form action="study.php?array[0]=1&array[1]=2&array[2]=4&array[3]=5" method="post" onsubmit="">
<textarea name="test"></textarea>
<input type="hidden" name="hidden" value="<?php print_r($array);?>" />

<input type="submit" name="submit" onclick="" />
</form><br />

</body>
</html>