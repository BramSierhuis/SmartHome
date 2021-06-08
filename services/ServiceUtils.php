<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Board.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Component.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Type.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Room.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Reading.php");

class ServiceUtils
{
    public function mac2int($mac): string {
        return base_convert($mac, 16, 10);
    }

    public function int2mac($int): string {
        $hex = base_convert($int, 10, 16);
        while (strlen($hex) < 12)
            $hex = '0'.$hex;
        return strtoupper(implode(':', str_split($hex,2)));
    }

    public function ip2int($ip): string {
        $ip = trim($ip);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) return 0;
        return sprintf("%u", ip2long($ip));
    }

    public function int2ip($num): string {
        $num = trim($num);
        if ($num == "0") return "0.0.0.0";
        return long2ip(-(4294967295 - ($num - 1)));
    }

    public function rowToBoard($row): Board{
        $board = new Board();
        $board->id = $row["id"];
        $board->ip = $this->int2ip($row["ip"]);
        $board->mac = $this->int2mac($row["mac"]);
        $board->name = $row["name"];
        $board->description = html_entity_decode($row["description"]);
        $board->room_id = $row["room_id"];
        $board->last_update = $row["last_update"];

        return $board;
    }

    public function rowToComponent($row): Component{
        $component = new Component();
        $component->id = $row["id"];
        $component->name = $row["name"];
        $component->description = html_entity_decode($row["description"]);
        $component->pin = $row["pin"];
        $component->last_update = $row["last_update"];
        $component->board_id = $row["board_id"];
        $component->room_id = $row["room_id"];
        $component->type_id = $row["type_id"];

        return $component;
    }

    public function rowToType($row): Type{
        $type = new Type();
        $type->id = $row["id"];
        $type->name = $row["name"];
        $type->description = html_entity_decode($row["description"]);
        $type->is_input = $row["is_input"];

        return $type;
    }

    public function rowToRoom($row): Room{
        $room = new Room();
        $room->id = $row["id"];
        $room->name = $row["name"];
        $room->description = $row["description"];

        return $room;
    }

    public function rowToReading($row): Reading{
        $reading = new Reading();
        $reading->id = $row["id"];
        $reading->component_id = $row["component_id"];
        $reading->reading = $row["reading"];
        $reading->read_time = $row["read_time"];

        return $reading;
    }
}