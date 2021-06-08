<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Board.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Component.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/services/BoardService.php");

class RelayController
{
    public function changeState(Component $component, int $state){
        $boardService = new BoardService();
        $board = $boardService->read_one($component->board_id);

        $url = "http://". $board->ip ."/?pin=". $component->pin ."&state=". $state;
        $url = "http://192.168.178.63/?pin=". $component->pin ."&state=". $state;
        $data = array('key1' => 'value1', 'key2' => 'value2');

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) { /* Handle error */ }

        var_dump($result);
    }
}