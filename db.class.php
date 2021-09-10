<?php
class DB extends PDO{ //

    public PDO $pdo;

    public function __construct(
        private string $host = "localhost",
        private string $dbName = "posts",
        private string $username = "root",
        private string $password = "",
    ){
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName","$username","$password");
    }

    public function CRUD(
        string $table, 
        string $CrudType, 
        ?string $insertColumns = null ,
        ?string $insertValues = null, 
        ?string $updateSet = null,
        ?string $where = null)
    {
        $query = "";
        switch ($CrudType){
            case "INSERT";
                $query = "INSERT INTO $table ($insertColumns) VALUES ($insertValues)";
            break;
            case "UPDATE";
                $query = "UPDATE $table SET $updateSet WHERE $where";
            break;
            case "DELETE";
                $query = "DELETE FROM $table WHERE $where";
            break;
            case "SELECT";
                $whereGroup = ($where) ? "WHERE $where" : "";
                $query = "SELECT * FROM $table $whereGroup";
            break;
        }

        try {
            $statement = $this->pdo->prepare("$query");
            return $statement;
        }catch (PDOException $exception){
            return $exception;
        }
    }
}
