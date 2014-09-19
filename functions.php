<?php function read($FilePath)
{
    

    $Data = docx2text($FilePath);
	
    $Data = str_replace("<", "&lt;", $Data);
    $Data = str_replace(">", "&gt;", $Data);
	
    $Breaks = array("\r\n", "\n", "\r");
    $Data = str_replace($Breaks, '<br />', $Data);
	
    return $Data;
}

function docx2text($filename) {
    return XML($filename, "word/document.xml");
}

function XML($archiveFile, $dataFile)
{
   
    $zip = new ZipArchive;

    // Open received archive file
    if (true === $zip->open($archiveFile))
    {
		
        // If done, search for the data file in the archive
        if (($index = $zip->locateName($dataFile)) !== false)
        {
            // If found, read it to the string
            $data = $zip->getFromIndex($index);
         //  return $data;
              // Close archive file
         
            $zip->close();

           
          $xml = DOMDocument::loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

            $xmldata = $xml->saveXML();
            $xmldata = str_replace("</w:p>", "\r\n", $xmldata);
            
          return strip_tags($xmldata);
  }        

        $zip->close();
    }

    
    return "";
} 

function checkright($string)
{
	$dabba = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_COOKIE[username]'"));
	//echo $dabba[$string];
	if($dabba[$string] != 'yes')
	{
		die("You are not allowed to acess this page. Please <a href = \"home.php\">Click Here</a> to go back");
	}
	return "";
}


?>