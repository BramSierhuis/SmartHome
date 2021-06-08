<?php
include_once("Base.php");
class Component_DAO extends Base {

    // database connection and table name
    private $table_name = "components";

    function getBoard(Component $component){
        $query = "SELECT
                id, ip, mac, name, description, room_id, last_update
            FROM boards WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of component to be updated
        $boardId = $component->getBoardId();
        $stmt->bindParam(1, $boardId);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read components
    function read_all(){

        // select all query
        $query = "SELECT
                id, name, description, pin, state, last_update, board_id, room_id, type_id
            FROM
                " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read components on a board
    function read_all_for_board(int $board_id){

        // select all query
        $query = "SELECT
                id, name, description, pin, state, last_update, board_id, room_id, type_id
            FROM
                " . $this->table_name . " WHERE board_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $board_id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read a single entry
    function read_one(int $id): PDOStatement{

        // query to read single record
        $query = "SELECT
                id, name, description, pin, state, last_update, board_id, room_id, type_id
            FROM
                " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of component to be updated
        $stmt->bindParam(1, $id);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create component
    function create(Component $component): bool{

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, description=:description, pin=:pin, state=:state, last_update=:last_update, 
                board_id=:board_id, room_id=:room_id, type_id=:type_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $component->name);
        $stmt->bindParam(":description", $component->description);
        $stmt->bindParam(":pin", $component->pin);
        $stmt->bindParam(":state", $component->state);
        $stmt->bindParam(":last_update", $component->last_update);
        $stmt->bindParam(":board_id", $component->board_id);
        $stmt->bindParam(":room_id", $component->room_id);
        $stmt->bindParam(":type_id", $component->type_id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        echo json_encode($stmt->errorInfo());
        return false;
    }

    // update the api
    function update(Component $component): bool{

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name, description=:description, pin=:pin, state=:state, last_update=:last_update, 
                board_id=:board_id, room_id=:room_id, type_id=:type_id
            WHERE id=:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":id", $component->id);
        $stmt->bindParam(":name", $component->name);
        $stmt->bindParam(":description", $component->description);
        $stmt->bindParam(":pin", $component->pin);
        $stmt->bindParam(":state", $component->state);
        $stmt->bindParam(":last_update", $component->last_update);
        $stmt->bindParam(":board_id", $component->board_id);
        $stmt->bindParam(":room_id", $component->room_id);
        $stmt->bindParam(":type_id", $component->type_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the api
    function delete(int $id): bool{

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}