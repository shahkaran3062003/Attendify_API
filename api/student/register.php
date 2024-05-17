<?php
// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: multipart/form-data");
header("Acess-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Acess-Control-Allow-Metho,Content-Type,Authorization,X-Requested-With");

// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize student class;
$student = new Student($DB);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get raw input;
    // $data = file_get_contents("php://input");

    if (!empty($_FILES['profilePic']['name'])) {
        $filename = basename($_FILES['profilePic']['name']);
        $tmpname = basename($_FILES['profilePic']['tmp_name']);
        $fileType = pathinfo($filename, PATHINFO_EXTENSION);
        $uploadFilePath = PROFILEPIC_DIR_PATH . '/' . $tmpname . '.' . $fileType;


        $allowExtention = array('jpg', 'jpeg', 'png');

        if (in_array($fileType, $allowExtention)) {
            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFilePath)) {
                $student->profilePic = $uploadFilePath;
            } else {
                echo json_encode(array('message' => 'fail'));
                die();
            }
        } else {
            echo json_encode(array('message' => 'Invalid extension.'));
            die();
        }
    } else {
        echo json_encode(array('message' => 'profile image not found.'));
        die();
    }

    $student->name = $_POST['name'];
    $student->rollNo =  $_POST['rollNo'];
    $student->email =  $_POST['email'];
    $student->contact =  $_POST['contact'];
    $student->password =  $_POST['password'];
    $student->mac =  $_POST['mac'];
    $student->imei =  $_POST['imei'];
    $student->classId =  $_POST['classId'];

    if (!$student->checkEmail()) {

        if ($student->create()) {
            echo json_encode(array("message" => "success"));
        } else {
            echo json_encode(array("message" => "fail"));
        }
    } else {
        echo json_encode(array('message' => "email exist"));
    }
} else {
    echo json_encode(array('message' => "Invalid"));
}
