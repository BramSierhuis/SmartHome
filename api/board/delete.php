<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../../services/BoardService.php';
include_once '../../models/Board.php';

if(isset($_POST["id"]) && $_POST["id"] != ""){
    $boardService = new BoardService();
    $id = $_POST["id"];
    echo $id;
    echo var_dump($_REQUEST);
    $board = $boardService->read_one($id);

    // delete the board
    if ($board != null){
        if($boardService->delete($id)) {

            // set response code - 200 ok
            http_response_code(200);

            // tell the user
            echo json_encode(array("message" => "Board was deleted."));
        }
        else{
            // set response code - 500 internal server error
            http_response_code(500);

            // tell the user
            echo json_encode(array("message" => "Unable to delete board..."));
        }
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
    echo json_encode(array("message" => "Please specify an id to delete"));
}