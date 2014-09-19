<?php
include("dbconnect.php");
include('functions.php');
checkright("uploadresume");
include('i_header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style_01.css" type="text/css" rev="stylesheet" />
<script type="text/javascript">
function makeFileList() {
			var input = document.getElementById("filesToUpload");
			var ul = document.getElementById("fileList");
			while (ul.hasChildNodes()) {
				ul.removeChild(ul.firstChild);
			}
			for (var i = 0; i < input.files.length; i++) {
				var li = document.createElement("li");
				li.innerHTML = input.files[i].name;
				ul.appendChild(li);
			}
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
		}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Files</title>
</head>
     
          <td align="center"><div id='campus'>
          <form action="uploaddone.php" method="post" enctype="multipart/form-data">
          <table align="center" border="0" cellpadding="5" cellspacing="0">
          <tr><td>Select Files : </td><td><input type="file" id="filesToUpload" name="resume[]" multiple="" onChange="makeFileList();" /></td></tr>
          <tr><td>Select Source for following files : </td>
          <td>
          <?php 
$source = mysql_query("SELECT * FROM source");
$s =1;
while($sourcearray = mysql_fetch_array($source))
{
	?>
    <input type="radio" name="source" value="<?php echo $sourcearray['source'];?>" <?php if($s==1){echo "checked='checked'";}?>  /> <?php echo $sourcearray['source']; if($s%2==0){echo "<br>";}?>
<?php	
$s++;}
?>
          </td></tr>
          <tr><td colspan="2" align="center"><input type="submit" name="upload" value="Upload" /></td></tr>
          <tr height="20"><td colspan="2">List of selected Files : <br />
          <ul id="fileList" style="list-style:none; float:left;"><li>No Files Selected</li></ul></td></tr>
</table>
</form>

          
          
          
          
          
          
          
          
          
          </div></td></tr>
      
          
</table>
<?php include("i_footer.php"); ?> 
</div>
</body>
</html>
