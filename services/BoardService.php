<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/DAL/Board_DAO.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Board.php");
include_once("ServiceUtils.php");
class BoardService extends ServiceUtils
{
    private $dao;

    public function __construct()
    {
        $this->dao = new Board_DAO();
    }

    // Get component at pin
    public function getComponent(int $id): ?Component{
        $stmt = $this->dao->getComponent($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToComponent($row);
        }

        return null;
    }

    public function read_all(): ?array
    {
        // query products
        $stmt = $this->dao->read_all();
        $num = $stmt->rowCount();

        if($num > 0){
            $boards = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($boards, $this->rowToBoard($row));
            }

            return $boards;
        }

        return null;
    }

    public function read_mac(int $mac): ?Board{
        $stmt = $this->dao->read_mac($mac);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToBoard($row);
        }

        return null;
    }

    public function read_one(int $id): ?Board{
        $stmt = $this->dao->read_one($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToBoard($row);
        }

        return null;
    }

    public function create(Board $board): bool{
        $board->last_update = date('Y-m-d H:i:s');

        if($this->dao->create($board))
            return true;

        return false;
    }

    public function update(Board $board): bool{
        $board->last_update = date('Y-m-d H:i:s');

        if($this->dao->update($board))
            return true;

        return false;
    }

    public function delete(int $id): bool{
        if($this->dao->delete($id))
            return true;

        return false;
    }
}