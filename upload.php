<?php
// if (isset($_FILES['image'])) {
//     $errors = array();
//     $file_name = $_FILES['image']['name'];
//     // $file_size = $_FILES['image']['size'];
//     $file_tmp = $_FILES['image']['tmp_name'];
//     $file_type = $_FILES['image']['type'];
//     $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

//     $extensions = array("jpeg", "jpg", "png", "svg", "gif");

//     if (in_array($file_ext, $extensions) === false) {
//         $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
//     }

//     // if ($file_size > 2097152) {
//     //     $errors[] = 'File size must be excately 2 MB';
//     // }

//     if (empty($errors) == true) {
//         move_uploaded_file($file_tmp, "images/" . $file_name);
//         echo "Success";
//         $result = array('result' => 'success', 'msg' => 'Success', 'data' => array());
//     } else {
//         print_r($errors);
//         $result = array('result' => 'failure', 'msg' => 'Failed', 'data' => $errors);
//     }
// }
if (isset($file_ori_name)) {
    $errors = array();
    // $file_name = $_FILES['image']['name'];
    // $file_size = $_FILES['image']['size'];
    // $file_tmp = $_FILES['image']['tmp_name'];
    // $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $file_ori_name)));

    $extensions = array("jpeg", "jpg", "png", "svg", "gif");
    $source = $temp_file;
    $destination = "images/" . $file_ori_name;
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    // if ($file_size > 2097152) {
    //     $errors[] = 'File size must be excately 2 MB';
    // }

    if (empty($errors) == true) {
        if (move_uploaded_file($source, $destination)) {
            return $destination;
        } else {
            return "File upload error";
        }
        // $result = array('result' => 'success', 'msg' => 'Success', 'data' => array());
    } else {
        return $errors;
        // print_r($errors);
        // $result = array('result' => 'failure', 'msg' => 'Failed', 'data' => $errors);
    }
}

// echo json_encode($result);
