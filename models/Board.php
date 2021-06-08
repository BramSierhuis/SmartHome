<?php
class Board
{
    public $id;
    public $ip;
    public $mac;
    public $name;
    public $description;
    public $room_id;
    public $last_update;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    public function getMac()
    {
        return $this->mac;
    }

    public function setMac($mac): void
    {
        $this->mac = $mac;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getRoomId()
    {
        return $this->room_id;
    }

    public function setRoomId($room_id): void
    {
        $this->room_id = $room_id;
    }

    public function getLastUpdate()
    {
        return $this->last_update;
    }

    public function setLastUpdate($last_update): void
    {
        $this->last_update = $last_update;
    }
}