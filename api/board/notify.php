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
    !empty($_POST["room_id"]) &&
    !empty($_POST["components"])
){
    $board = new Board();
    $components = json_decode($_POST["components"]);
    $boardService = new BoardService();
    $componentService = new ComponentService();

    // set board property values
    $board->ip = $boardService->ip2int($_POST["ip"]);
    $board->mac = $boardService->mac2int($_POST["mac"]);
    $board->name = $_POST["name"];
    $board->description = $_POST["description"];
    $board->room_id = $_POST["room_id"];

    // check if board exists
    if($boardService->read_mac($board->mac)){
        //Update the board and components
        if(!$boardService->update($board)){
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update values of this board."));
        }
        if(!$componentService->updateComponents($components)){
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update components of this board."));
        }
    }
    //First time this board is seen
    else if(TRUE){ //IDE Was trying to merge statements, making it true avoids it
        if($boardService->create($board)){
            $hasError = FALSE;

            foreach($components as $component){
                if(!$componentService->create($component))
                    $hasError = TRUE;
            }

            if($hasError){
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create this board."));
            }
        }
        else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create this board."));
        }
    }
}
// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create api. Data is incomplete."));
}