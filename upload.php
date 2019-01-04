<?php
$base_url = "http://128.199.218.150/";
$target_dir = "images/";
$error = array();
$status = "failure";
foreach ($_FILES as $name => $f) {
    if (isset($f["name"]) && $f['name'] != '') {
        $target_file = $target_dir . basename($f["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($f["tmp_name"]);
            if ($check !== false) {
                $error[] = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $error[] = "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        //    if (file_exists($target_file)) {
        //        $error[] = "Sorry, file already exists.";
        //        $uploadOk = 0;
        //    }
        // Check file size
        //    if ($f["size"] > 500000) {
        //        $error[] = "Sorry, your file is too large.";
        //        $uploadOk = 0;
        //    }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            $now = strtotime(DATE("Y-m-d H:i:s"));
            $name = trim(str_replace(" ", "", $f["name"]));
            $file_name = $target_dir . rand(99999, 999999) . $now . $name;
            if (move_uploaded_file($f["tmp_name"], $file_name)) {
                $error[] = $file_name;
                $status = "success";
            } else {
                $error[] = "Sorry, there was an error uploading your file.#" . $_FILES["file"]["error"];
            }
        }
    } else {
        $error[] = "please upload file";
    }
}
echo json_encode(array("status" => $status, "data" => $error));
