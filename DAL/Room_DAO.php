<?php
include_once("Base.php");
class Room_DAO extends Base {

    // database connection and table name
    private $table_name = "rooms";

    // get components in room
    function getComponents(int $roomId){
        $query = "SELECT
                id, name, description, pin, last_update, board_id, room_id, type_id
            FROM components WHERE room_id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $roomId);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read rooms
    function read_all(){

        // select all query
        $query = "SELECT
                id, name, description
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
                id, name, description
            FROM
                " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of room to be retreived
        $stmt->bindParam(1, $id);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create Type
    function create(Room $room): bool{

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, description=:description";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $room->name);
        $stmt->bindParam(":description", $room->description);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // update the Type
    function update(Room $room): bool{

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name, description=:description
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        // bind values
        $stmt->bindParam(":name", $room->name);
        $stmt->bindParam(":description", $room->description);
        $stmt->bindParam(':id', $room->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the Room
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