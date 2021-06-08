<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/DAL/Type_DAO.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Type.php");
include_once("ServiceUtils.php");
class TypeService extends ServiceUtils
{
    private $dao;

    public function __construct()
    {
        $this->dao = new Type_DAO();
    }

    public function read_all(): ?array
    {
        $stmt = $this->dao->read_all();
        $num = $stmt->rowCount();

        if($num > 0){
            $types = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($types, $this->rowToType($row));
            }

            return $types;
        }

        return null;
    }

    public function read_one(int $id): ?Type{
        $stmt = $this->dao->read_one($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToType($row);
        }

        return null;
    }

    public function create(Type $type): bool{
        if($this->dao->create($type))
            return true;

        return false;
    }

    public function update(Type $type): bool{
        if($this->dao->update($type))
            return true;

        return false;
    }

    public function delete(int $id): bool{
        if($this->dao->delete($id))
            return true;

        return false;
    }
}