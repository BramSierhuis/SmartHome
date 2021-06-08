<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../../services/ComponentService.php';
include_once '../../models/Component.php';

if(isset($_GET["id"]) && $_GET["id"] != ""){
    $componentService = new ComponentService();
    $id = $_GET["id"];

    $component = $componentService->read_one($id);

    // delete the component
    if ($component != null){
        echo json_encode($component);
    }
    else{
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "component does not exist"));
    }
}
// if unable to delete the api
else{
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Please specify an id to update"));
}