<?php
include_once("../../models/Component.php");
include_once("../../services/ComponentService.php");

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
    !empty($_POST["pin"]) &&
    !empty($_POST["board_id"]) &&
    !empty($_POST["room_id"]) &&
    !empty($_POST["type_id"])
){
    $component = new Component();
    $componentService = new ComponentService();

    // set component property values
    $component->name = $_POST["name"];
    $component->description = $_POST["description"];
    $component->pin = $_POST["pin"];
    $component->board_id = $_POST["board_id"];
    $component->room_id = $_POST["room_id"];
    $component->type_id = $_POST["type_id"];

    // create the component
    if($componentService->create($component)){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Component was created."));
    }

    // if unable to create the component, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create component."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create component. Data is incomplete."));
}