<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize teacher class;
$teacher = new Teacher($DB);


if (isset($_GET['id'])) {

    $teacher->id = $_GET['id'];
    // reading teachers data;
    $result = $teacher->read_single();

    if ($result) {
        $teacher_arr = array(
            'id' => $teacher->id,
            'name' => $teacher->name,
            'email' => $teacher->email,
            'contact' => $teacher->contact,
            'password' => $teacher->password
        );

        echo json_encode($teacher_arr);
    } else {
        echo json_encode(array("message" => "Invalid Id."));
    }
} else {
    echo json_encode(array("message" => "No Teacher Id passed."));
}
