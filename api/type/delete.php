<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../../services/TypeService.php';
include_once '../../models/Type.php';

if(isset($_POST["id"]) && $_POST["id"] != ""){
    $typeService = new TypeService();
    $id = $_POST["id"];

    $type = $typeService->read_one($id);

    // delete the type
    if ($type != null){
        if($typeService->delete($id)) {

            // set response code - 200 ok
            http_response_code(200);

            // tell the user
            echo json_encode(array("message" => "Type was deleted."));
        }
        else{
            // set response code - 500 internal server error
            http_response_code(500);

            // tell the user
            echo json_encode(array("message" => "Unable to delete type..."));
        }
    }
    else{
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "type does not exist"));
    }
}
// if unable to delete the type
else{
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Please specify an id to delete"));
}