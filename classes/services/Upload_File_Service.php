<?php
$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//print_r($_FILES);
$_SESSION['filename'] = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "xml") {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  } else {
  }
}

header('Location: ../../resources/views/produktionsProgramm.php');
die();
