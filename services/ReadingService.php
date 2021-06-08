<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/DAL/Reading_DAO.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Reading.php");
include_once("ServiceUtils.php");
class ReadingService extends ServiceUtils
{
    private $dao;

    public function __construct()
    {
        $this->dao = new Reading_DAO();
    }

    public function read_all(): ?array
    {
        // query readings
        $stmt = $this->dao->read_all();
        $num = $stmt->rowCount();

        if($num > 0){
            $readings = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($readings, $this->rowToReading($row));
            }

            return $readings;
        }

        return null;
    }

    public function read_one(int $id): ?Reading{
        $stmt = $this->dao->read_one($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToReading($row);
        }

        return null;
    }

    public function create(Reading $reading): bool{
        $reading->read_time = date('Y-m-d H:i:s');

        if($this->dao->create($reading))
            return true;

        return false;
    }

    public function update(Reading $reading): bool{
        if($this->dao->update($reading))
            return true;

        return false;
    }

    public function delete(int $id): bool{
        if($this->dao->delete($id))
            return true;

        return false;
    }
}