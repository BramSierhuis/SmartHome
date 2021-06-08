<?php
include_once("../../models/Board.php");
include_once("../../services/ServiceUtils.php");
include_once("../../services/BoardService.php");

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
// make sure data is not empty
if(
    !empty($_POST["ip"]) &&
    !empty($_POST["mac"]) &&
    !empty($_POST["name"]) &&
    !empty($_POST["description"]) &&
    !empty($_POST["room_id"])
){
    $board = new Board();
    $boardService = new BoardService();

    // set board property values
    $board->ip = $boardService->ip2int($_POST["ip"]);
    $board->mac = $boardService->mac2int($_POST["mac"]);
    $board->name = $_POST["name"];
    $board->description = $_POST["description"];
    $board->room_id = $_POST["room_id"];

    // create the board
    if($boardService->create($board)){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Board was created."));
    }

    // if unable to create the board, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create board."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create api. Data is incomplete."));
}