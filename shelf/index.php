<!DOCTYPE html>
<html>
<head><title>shelf</title></head>
<body>
FILES:
<ul>
<?php
foreach (glob("*") as $file) {
    echo "<li><a href='$file'>" . $file . "</a></li><br>";
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
            echo 'Uploaded';
        }

    } else {
	echo 'please choose a file';
    }
}
?>

<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
