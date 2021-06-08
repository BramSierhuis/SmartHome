<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../../services/BoardService.php';
include_once '../../models/Board.php';

if(isset($_GET["id"]) && $_GET["id"] != ""){
    $boardService = new BoardService();
    $id = $_GET["id"];

    $board = $boardService->read_one($id);

    // delete the board
    if ($board != null){
        echo json_encode($board);
    }
    else{
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Board does not exist"));
    }
}
// if unable to delete the api
else{
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Please specify an id to update"));
}