<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Acess-Control-Allow-Metho,Content-Type,Authorization,X-Requested-With");
// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize student class;
$student = new Student($DB);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get raw input;


    $data = json_decode(file_get_contents("php://input"));
    $student->id = $data->id;
    // reading students data;
    $result = $student->readAllStudentOfClass();
    $totalRow = $result->rowCount();

    if ($totalRow > 0) {
        $student_arr = array();
        $student_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $student_item = array(
                "id" => $id,
                "profilePic" => $profilePic,
                'name' => $name,
                "rollNo" => $rollNo,
                'email' => $email,
                'contact' => $contact,
            );
            array_push($student_arr['data'], $student_item);
        }

        // convert to JSON to respond;
        echo json_encode($student_arr);
    } else {
        echo json_encode(array("message" => "No Student Found."));
    }
} else {
    echo json_encode(array('message' => 'Invalid'));
}
