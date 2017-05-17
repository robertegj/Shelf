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

<form action="test.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br><br>
    <input type="submit" value="Submit">
</form>
