<?php 
	$left = mysql_query("SELECT * FROM users WHERE username='$_COOKIE[username]'");
	$larray = mysql_fetch_array($left);
?>

<div id="leftBar">
<?php if($larray['uploadresume'] == 'yes' || $larray['conflicts'] == 'yes' || $larray['addsource'] == 'yes' || $larray['adddetails'] == 'yes' || $larray['deldetails'] == 'yes'){?>
<h3>Upload</h3><?php }?>
<ul id="leftBarStoreMedicines">
	<?php if($larray['uploadresume'] == 'yes'){?><li><a class="hyperlink" href="upload.php">Upload Resumes</a></li><?php }?>
    <?php if($larray['conflicts'] == 'yes'){?><li><a class="hyperlink" href="conflicts.php">Conflicts</a></li><?php }?>
     <?php if($larray['addsource'] == 'yes'){?><li><a class="hyperlink" href="addsource.php">Add Source</a></li><?php }?>
      <?php if($larray['adddetails'] == 'yes'){?><li><a class="hyperlink" href="adddept.php">Add Dept./Manager</a></li><?php }?>
      <?php if($larray['deldetails'] == 'yes'){?><li><a class="hyperlink" href="delete.php">Delete Source/Dept./Manager</a></li><?php }?>
</ul>
<?php if($larray['wordsearch'] == 'yes' || $larray['phrasesearch'] == 'yes' || $larray['bysource'] == 'yes' || $larray['totallist'] == 'yes' || $larray['bydetails'] == 'yes'){?>
<h3>Search</h3><?php }?>
<ul id="leftBarStoreStockRegister">
    <?php if($larray['wordsearch'] == 'yes'){?><li><a class="hyperlink" href="wordsearch.php?min=1&max=10&sort=no">Word Search</a></li><?php }?>
    <?php if($larray['phrasesearch'] == 'yes'){?><li><a class="hyperlink" href="phrasesearch.php?min=1&max=10&sort=no">Phrase Search</a></li><?php }?>
    <?php if($larray['bysource'] == 'yes'){?><li><a class="hyperlink" href="source.php">By Source</a></li><?php }?>
    <?php if($larray['bydetails'] == 'yes'){?><li><a class="hyperlink" href="detailsearch.php?min=1&max=10&sort=no">By Details</a></li><?php }?>
    <?php if($larray['totallist'] == 'yes'){?><li><a class="hyperlink" href="totallist.php?min=1&max=10&sort=no">Total List</a></li><?php }?>
</ul>
<?php if($larray['addcomments'] == 'yes' || $larray['modifycomments'] == 'yes'){?>
<h3>Comments</h3><?php }?>
<ul id="leftBarStoreStockRegister">
	<!--<?php if($larray['addcomments'] == 'yes'){?><li><a class="hyperlink" href="addcomments.php?min=1&max=10&sort=no">Add Comments</a></li><?php }?>-->
    <?php if($larray['addcomments'] == 'yes'){?><li><a class="hyperlink" href="details.php?min=1&max=10&sort=no">Add Details</a></li><?php }?>
    <!--<?php if($larray['modifycomments'] == 'yes'){?><li><a class="hyperlink" href="modifycomments.php?min=1&max=10&sort=no">Modify Comments</a></li><?php }?>-->
    <?php if($larray['modifycomments'] == 'yes'){?><li><a class="hyperlink" href="modifydetails.php?min=1&max=10&sort=no">Modify Details</a></li><?php }?>
</ul>
<!--<ul id="leftBarStoreTools">
<li><a class="hyperlink" href="settings_disp.php">Groups</a></li>
</ul>-->

<!--<h3>Groups</h3>
<ul id="leftBarStoreInventory">
    <li><a class="hyperlink" href="groupevent.php">Form Groups</a></li>
    <li><a class="hyperlink" href="displaygroups.php">Display Groups</a></li>
</ul>-->
<h3>Settings</h3>
<ul id="leftBarStoreInventory">
   <li><a class="hyperlink" href="changepass.php">Change Password</a></li>
   <li><a class="hyperlink" href="addfeilds.php">Add Feilds</a></li>
    <?php if($larray['createusers'] == 'yes'){?><li><a class="hyperlink" href="createusers.php">Create Users</a></li><?php }?>
    <?php if($larray['updateusers'] == 'yes'){?><li><a class="hyperlink" href="updateusers.php">Update/Delete Users</a></li><?php }?>
</ul>
</div>
