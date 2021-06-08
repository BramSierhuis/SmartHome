<?php
include_once("services/ComponentService.php");
include_once("models/Component.php");

$componentService = new ComponentService();

echo json_encode($componentService->read_all());
