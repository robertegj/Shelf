<!DOCTYPE html>
<html>
<head><title>shelf</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="style.css"></head>
<body>
<h1>shelf</h1>
<p> Use descriptive file names. To delete, first sort by filetype. Don't delete what you didn't upload <br>
<mark>
<!-- BACKGROUND TASKS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   -->
<?php
if(isset($_POST['create_file']))
{
 $file_name=$_POST['file_name'];
 $folder="";
 $ext="";
 $file_name=$folder."".$file_name."".$ext;
 $create_file = fopen($file_name, 'w');
 fclose($create_file);
}

if(isset($_POST['edit_file']))
{
 $file_name=$_POST['file_name'];
 $new_name=$_POST['edit_text'];
 $folder="";
 $ext="";
 $file_name=$folder."".$file_name."".$ext;
 rename("$file_name","$new_name");
}

if(isset($_POST['delete_file']))
{
 $file_name=$_POST['file_name'];
 $folder="";
 $ext="";
 $file_name=$folder."".$file_name."".$ext;
 unlink($file_name);
 echo "'" . $file_name . "' has been deleted. <br>";
}

if(isset($_GET['d']))
{
 $file_name=$_GET['d'];
 unlink($file_name);
 echo "'" . $file_name . "' has been deleted. <br>";
}
?>
</p></mark>













<!-- LIST OF FILES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   -->
<div class="stuff">
FILES:
<br>
<?php
if(isset($_GET['s']))
{
 $file_type=$_GET['s'];
 echo "listing '." . $file_type . "' files. press Reload to return.";
 foreach (glob("*.$file_type") as $specific_file) {
    echo "<div class='item'><a href='$specific_file'>" . $specific_file . "</a><a href='index.php?d=$specific_file'><button>delete</button></a></div>";
}
}
if(!isset($_GET['s'])){
foreach (glob("*") as $file) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    echo "<div class='item'><a href='$file'>" . $file . "</a>  <a href='index.php?s=$ext'><button>sort by</button></a></div>";
}
}
?>

</div>














<!-- TOOLS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   -->

UPLOAD:
<?php
//remove valid formats
$max_file_size = 1024*10000000; //a lot of kb
$path = ""; // Upload directory
$count = 0;
	
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
	echo "<META HTTP-EQUIV='refresh' CONTENT='0'>";
}
?>
	<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
  <input type="submit" value="Upload" /></form>
</form><br>
DELETE:
<form method="post" action="index.php" id="delete_form">
 <input type="text" name="file_name">
 <input type="submit" value="Delete" name="delete_file">
</form><br>
CREATE:
<form method="post" action="index.php" id="create_form">
 <input type="text" name="file_name">
 <input type="submit" value="Create" name="create_file">
</form><br>
RENAME:
<form method="post" action="index.php" id="edit_form">
 <input type="text" name="file_name" placeholder="File name and Extention">
 <input type="text" name="edit_text" placeholder="New file name and Ext...">
 <input type="submit" value="Rename" name="edit_file">
</form><br>
<a href="index.php"><button>Reload</button></a>
<a href="/landing/"><button>Home</button></a>
<button onclick="document.body.style.background = 'black';document.body.style.color = 'pink'">Night Mode</button>
<noscript>No Night Mode Available</noscript>
<br>
<!--
<?php echo "<br>Space (max, current, free):<br>". shell_exec('df -h | grep vda'); ?>
<aside>
<a href="">Image Gallery</a><br>
<a href="">Status</a><br>
<a href="">Ebin</a><br>
</aside>
-->
<!-- <footer>Thanks for contributing, and keeping the place clean!</footer> -->
</body>
</html>
