<?php
include_once("Base.php");
class Board_DAO extends Base {

    // database connection and table name
    private $table_name = "boards";

    // get component at pin
    function getComponent(int $pin){
        $query = "SELECT
                id, name, description, pin, last_update, board_id, room_id, type_id
            FROM components WHERE pin = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $pin);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read boards
    function read_all(){

        // select all query
        $query = "SELECT
                id, ip, mac, name, description, room_id, last_update
            FROM
                " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read a single entry
    function read_one(int $id): PDOStatement{

        // query to read single record
        $query = "SELECT
                id, ip, mac, name, description, room_id, last_update
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

    // create api
    function create(Board $board): bool{

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                ip=:ip, mac=:mac, name=:name, description=:description, room_id=:room_id, last_update=:last_update";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":ip", $board->ip);
        $stmt->bindParam(":mac", $board->mac);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":description", $board->description);
        $stmt->bindParam(":room_id", $board->room_id);
        $stmt->bindParam(":last_update", $board->last_update);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // update the api
    function update(Board $board): bool{

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                ip=:ip, mac=:mac, name=:name, description=:description, room_id=:room_id, last_update=:last_update
            WHERE
                id =:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        // bind values
        $stmt->bindParam(":ip", $board->ip);
        $stmt->bindParam(":mac", $board->mac);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":description", $board->description);
        $stmt->bindParam(":room_id", $board->room_id);
        $stmt->bindParam(":last_update", $board->last_update);
        $stmt->bindParam(':id', $board->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        echo json_encode($stmt->errorInfo());
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