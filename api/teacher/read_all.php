<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize teacher class;
$teacher = new Teacher($DB);
// reading teachers data;
$result = $teacher->read_all();
$totalRow = $result->rowCount();

if ($totalRow > 0) {
    $teacher_arr = array();
    $teacher_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $teacher_item = array(
            "id" => $id,
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
        );
        array_push($teacher_arr['data'], $teacher_item);
    }

    // convert to JSON to respond;
    echo json_encode($teacher_arr);
} else {
    echo json_encode(array("message" => "No Teacher Found."));
}
