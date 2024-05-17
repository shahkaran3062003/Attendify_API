<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Acess-Control-Allow-Metho,Content-Type,Authorization,X-Requested-With");
// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize classes class;
$classes = new Classes($DB);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get raw input;


    $data = json_decode(file_get_contents("php://input"));
    $classes->id = $data->id;
    // reading classess data;
    $result = $classes->readAllStudent();
    $totalRow = $result->rowCount();

    if ($totalRow > 0) {
        $classes_arr = array();
        $classes_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $classes_item = array(
                "id" => $id,
                "profilePic" => $profilePic,
                'name' => $name,
                "rollNo" => $rollNo,
                'email' => $email,
                'contact' => $contact,
            );
            array_push($classes_arr['data'], $classes_item);
        }

        // convert to JSON to respond;
        echo json_encode($classes_arr);
    } else {
        echo json_encode(array("message" => "No Student Found."));
    }
} else {
    echo json_encode(array('message' => 'Invalid'));
}
