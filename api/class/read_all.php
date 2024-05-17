<?php

// setting headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// intialize out all files with initialize.php
include_once("../../core/initialize.php");

// initialize classes class;
$classes = new Classes($DB);
// reading classess data;
$result = $classes->read_all();
$totalRow = $result->rowCount();

if ($totalRow > 0) {
    $classes_arr = array();
    $classes_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $classes_item = array(
            "id" => $id,
            'name' => $name,
            'sem' => $sem,
            'branch' => $branch,
            'port' => $port
        );
        array_push($classes_arr['data'], $classes_item);
    }

    // convert to JSON to respond;
    echo json_encode($classes_arr);
} else {
    echo json_encode(array("message" => "No Teacher Found."));
}
