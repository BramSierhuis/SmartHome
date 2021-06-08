<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../../services/BoardService.php';
include_once '../../models/Board.php';

// set ID property of api to be edited
if(isset($_POST["id"]) && $_POST["id"] != ""){
    if(
        !empty($_POST["ip"]) &&
        !empty($_POST["mac"]) &&
        !empty($_POST["name"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["room_id"])
    ){
        $boardService = new BoardService();
        $id = $_POST["id"];

        // update the api
        if ($boardService->read_one($id) != null) {
            $board = new Board();
            $board->id = $id;
            $board->ip = $boardService->ip2int($_POST["ip"]);
            $board->mac = $boardService->mac2int($_POST["mac"]);
            $board->name = $_POST["name"];
            $board->description = $_POST["description"];
            $board->room_id = $_POST["room_id"];

            if ($boardService->update($board)) {

                // set response code - 200 ok
                http_response_code(200);

                // tell the user
                echo json_encode(array("message" => "Board was updated."));
            }
            else{
                // set response code - 500 internal server error
                http_response_code(500);

                // tell the user
                echo json_encode(array("message" => "Unable to update board..."));
            }
        }
        else{
            // set response code - 400 bad request
            http_response_code(400);

            // tell the user
            echo json_encode(array("message" => "Board does not exist"));
        }
    }
    else{
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Please specify all required parameters"));
    }
}
// if unable to update the api, tell the user
else{
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Please specify an id to update"));
}