<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Acess-Control-Allow-Metho,Content-Type,Authorization,X-Requested-With");

// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize teacher class;
$teacher = new Teacher($DB);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get raw input;
    $data = json_decode(file_get_contents("php://input"));

    $teacher->email = $data->email;
    $teacher->password = $data->password;

    if ($teacher->authenticate()) {
        echo json_encode(array('message' => 'success'));
    } else {
        echo json_encode(array('message' => "fail"));
    }
} else {
    echo json_encode(array('message' => "Invalid"));
}
