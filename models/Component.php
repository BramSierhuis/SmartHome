<?php
class Component
{
    public $id;
    public $name;
    public $description;
    public $pin;
    public $state;
    public $last_update;
    public $board_id;
    public $room_id;
    public $type_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getPin(): int
    {
        return $this->pin;
    }

    public function setPin($pin): void
    {
        $this->pin = $pin;
    }

    public function getLastUpdate(): string
    {
        return $this->last_update;
    }

    public function setLastUpdate($last_update): void
    {
        $this->last_update = $last_update;
    }

    public function getBoardId(): int
    {
        return $this->board_id;
    }

    public function setBoardId($board_id): void
    {
        $this->board_id = $board_id;
    }

    public function getRoomId(): int
    {
        return $this->room_id;
    }

    public function setRoomId($room_id): void
    {
        $this->room_id = $room_id;
    }

    public function getTypeId(): int
    {
        return $this->type_id;
    }

    public function setTypeId($type_id): void
    {
        $this->type_id = $type_id;
    }
}