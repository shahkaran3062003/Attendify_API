<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Acess-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Acess-Control-Allow-Metho,Content-Type,Authorization,X-Requested-With");
// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize attendance class;
$attendance = new Attendance($DB);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get raw input;


    $data = json_decode(file_get_contents("php://input"));
    $attendance->classId = $data->classId;
    $attendance->date = $data->date;
    // reading attendances data;
    $result = $attendance->readClassAttendanceByDate();
    $totalRow = $result->rowCount();

    if ($totalRow > 0) {
        $attendance_arr = array();
        $attendance_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $attendance_item = array(
                "rollNo" => $rollNo,
                "name" => $name,
                "date" => $date,
                "status" => $status
            );
            array_push($attendance_arr['data'], $attendance_item);
        }

        // convert to JSON to respond;
        echo json_encode($attendance_arr);
    } else {
        echo json_encode(array("message" => "No Attendance Found."));
    }
} else {
    echo json_encode(array('message' => 'Invalid'));
}
