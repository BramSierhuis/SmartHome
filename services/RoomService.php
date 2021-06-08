<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/DAL/Room_DAO.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Room.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Component.php");
include_once("ServiceUtils.php");
class RoomService extends ServiceUtils
{
    private $dao;

    public function __construct()
    {
        $this->dao = new Room_DAO();
    }

    public function getComponents(int $roomId): ?array
    {
        $stmt = $this->dao->getComponents($roomId);
        $num = $stmt->rowCount();

        if($num > 0){
            $components = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($components, $this->rowToComponent($row));
            }

            return $components;
        }

        return null;
    }

    public function read_all(): ?array
    {
        // query rooms
        $stmt = $this->dao->read_all();
        $num = $stmt->rowCount();

        if($num > 0){
            $rooms = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($rooms, $this->rowToRoom($row));
            }

            return $rooms;
        }

        return null;
    }

    public function read_one(int $id): ?Room{
        $stmt = $this->dao->read_one($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToRoom($row);
        }

        return null;
    }

    public function create(Room $room): bool{
        if($this->dao->create($room))
            return true;

        return false;
    }

    public function update(Room $room): bool{
        if($this->dao->update($room))
            return true;

        return false;
    }

    public function delete(int $id): bool{
        if($this->dao->delete($id))
            return true;

        return false;
    }
}