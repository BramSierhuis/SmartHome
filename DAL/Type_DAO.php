<?php
include_once("Base.php");
class Type_DAO extends Base {

    // database connection and table name
    private $table_name = "types";

    // read types
    function read_all(){

        // select all query
        $query = "SELECT
                id, name, description, is_input
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
                id, name, description, is_input
            FROM
                " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of type to be retreived
        $stmt->bindParam(1, $id);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create Type
    function create(Type $types): bool{

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, description=:description, is_input=:is_input";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":name", $types->name);
        $stmt->bindParam(":description", $types->description);
        $stmt->bindParam(":is_input", $types->is_input);

        // execute query
        if($stmt->execute()){
            return true;
        }
        echo json_encode($stmt->errorInfo());

        return false;
    }

    // update the Type
    function update(Type $type): bool{

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name, description=:description, is_input=:is_input
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        // bind values
        $stmt->bindParam(":name", $type->name);
        $stmt->bindParam(":description", $type->description);
        $stmt->bindParam(":is_input", $type->is_input);
        $stmt->bindParam(':id', $type->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the Type
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