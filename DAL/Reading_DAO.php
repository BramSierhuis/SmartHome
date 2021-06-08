<?php
include_once("Base.php");
class Reading_DAO extends Base {

    // database connection and table name
    private $table_name = "readings";

    // read components
    function read_all(){

        // select all query
        $query = "SELECT
                id, component_id, reading, read_time
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
                id, component_id, reading, read_time
            FROM
                " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of reading to be read
        $stmt->bindParam(1, $id);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create component
    function create(Reading $reading): bool{

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                component_id=:component_id, reading=:reading, read_time=:read_time";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":component_id", $reading->component_id);
        $stmt->bindParam(":reading", $reading->reading);
        $stmt->bindParam(":read_time", $reading->read_time);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // update the api
    function update(Reading $reading): bool{

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                component_id=:component_id, reading=:reading, read_time=:read_time
            WHERE id=:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":id", $reading->id);
        $stmt->bindParam(":component_id", $reading->component_id);
        $stmt->bindParam(":reading", $reading->reading);
        $stmt->bindParam(":read_time", $reading->read_time);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the reading
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