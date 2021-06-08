<?php
include_once("../../models/Room.php");
include_once("../../services/RoomService.php");

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
    !empty($_POST["description"])
){
    $room = new Room();
    $roomService = new RoomService();

    // set room property values
    $room->name = $_POST["name"];
    $room->description = $_POST["description"];

    // create the room
    if($roomService->create($room)){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Room was created."));
    }

    // if unable to create the room, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create room."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create room. Data is incomplete."));
}