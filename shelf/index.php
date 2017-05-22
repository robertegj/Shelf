<!DOCTYPE html>
<html>
<head><title>shelf</title></head>
<body>
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
 $write_text=$_POST['edit_text'];
 $folder="";
 $ext="";
 $file_name=$folder."".$file_name."".$ext;
 $edit_file = fopen($file_name, 'w');
	
 fwrite($edit_file, $write_text);
 fclose($edit_file);
}

if(isset($_POST['delete_file']))
{
 $file_name=$_POST['file_name'];
 $folder="";
 $ext="";
 $file_name=$folder."".$file_name."".$ext;
 unlink($file_name);
 echo "You have deleted the file: '" . $file_name . "'.<br>";
}

if(isset($_GET['d']))
{
 $file_name=$_GET['d'];
 unlink($file_name);
 echo "You have deleted the file: '" . $file_name . "'.<br>";
}
?>


FILES:
<ul>
<!-- Your directory below. Replace * with /path/to/files in quotes, OR leave it to display all adjacent files. -->
<?php
foreach (glob("*") as $file) {
    echo "<li><a href='$file'>" . $file . "</a>  <a href='index.php?d=$file'><button>delete</button></a></li><br>";
}
?>
</ul>

UPLOAD:
<?php
if (isset($_FILES["file"]["name"])) {

    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    if (!empty($name)) {
        $location = '';

        if  (move_uploaded_file($tmp_name, $location.$name)){
            echo '<meta http-equiv="refresh" content="0">';
        }

    } else {
	echo 'please choose a file';
    }
}
?>

<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Submit">
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
EDIT:
<form method="post" action="index.php" id="edit_form">
 <input type="text" name="file_name" placeholder="File name and Extention">
 <input type="text" name="edit_text" placeholder="Content (overwrite existing)">
 <input type="submit" value="Edit" name="edit_file">
</form><br>
<a href="index.php"><button>Refresh</button></a>
<button onclick="document.body.style.background = 'black';document.body.style.color = 'pink'">Night Mode</button>
<noscript>No Night Mode Available</noscript>
</body>
</html>
