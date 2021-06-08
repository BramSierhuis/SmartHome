<?php
include_once("../../models/Type.php");
include_once("../../services/TypeService.php");

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
// make sure data is not empty
if(
    !empty($_POST["name"]) &&
    !empty($_POST["description"]) &&
    !empty($_POST["is_input"])
){
    $type = new Type();
    $typeService = new TypeService();

    // set type property values
    $type->name = $_POST["name"];
    $type->description = $_POST["description"];
    $type->is_input = $_POST["is_input"];

    // create the type
    if($typeService->create($type)){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Type was created."));
    }

    // if unable to create the type, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create type."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create type. Data is incomplete."));
}