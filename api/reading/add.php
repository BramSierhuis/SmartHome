<?php
include_once("../../models/Reading.php");
include_once("../../models/Component.php");
include_once("../../services/ReadingService.php");

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
// make sure data is not empty
if(
    !empty($_POST["component_id"]) &&
    !empty($_POST["reading"])
){
    $reading = new Reading();
    $readingService = new ReadingService();
    // set reading property values
    $reading->component_id = $_POST["component_id"];
    $reading->reading = $_POST["reading"];

    // add the reading
    if($readingService->create($reading)){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Reading was added."));
    }

    // if unable to add the reading, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);


        // tell the user
        echo json_encode(array("message" => "Unable to add reading."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create reading. Data is incomplete."));
}