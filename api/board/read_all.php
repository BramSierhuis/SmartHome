<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../services/BoardService.php';
include_once '../../models/Board.php';

$boardService = new BoardService();
$boards = $boardService->read_all();

// check if more than 0 record found
if($boards != null){
    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($boards);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No boards found.")
    );
}