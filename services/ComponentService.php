<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/DAL/Component_DAO.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Board.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/models/Component.php");
include_once("ServiceUtils.php");
class ComponentService extends ServiceUtils
{
    private $dao;

    public function __construct()
    {
        $this->dao = new Component_DAO();
    }

    public function getBoard(Component $component): ?Board{
        $stmt = $this->dao->getBoard($component);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToBoard($row);
        }

        return null;
    }

    public function read_all(): ?array
    {
        // query products
        $stmt = $this->dao->read_all();
        $num = $stmt->rowCount();

        if($num > 0){
            $components = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($components, $this->rowToComponent($row));
            }

            return $components;
        }
        echo $num;
        return null;
    }

    public function read_one(int $id): ?Component{
        $stmt = $this->dao->read_one($id);
        $num = $stmt->rowCount();

        if($num > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->rowToComponent($row);
        }

        return null;
    }

    public function create(Component $component): bool{
        $component->last_update = date('Y-m-d H:i:s');

        if($this->dao->create($component))
            return true;

        return false;
    }

    public function update(Component $component): bool{
        $component->last_update = date('Y-m-d H:i:s');

        if($this->dao->update($component))
            return true;

        return false;
    }

    public function updateComponents(array $components): bool{
        $hasError = FALSE;
        foreach($components as $component){
            if($this->dao->read_one($component->id)){
                if($this->dao->update($component)){
                    echo "Component succesfully updated";
                } else{
                    echo "Component not found but not updated either. SHIT";
                    $hasError = TRUE;
                }
            }
            else{
                if($this->dao->create($component)){
                    echo "Component succesfully created";
                } else {
                    echo "Component not found but not created either. SHIT";
                    $hasError = TRUE;
                }
            }
        }

        if($hasError)
            return false;
        return true;
    }

    public function delete(int $id): bool{
        if($this->dao->delete($id))
            return true;

        return false;
    }
}