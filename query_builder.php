<?php

class QueryBuilder{

    public $pdo;

    function __construct(){
        $dbConfig = [
            'dsn' => "mysql:dbname=derged;host=localhost;charset=UTF8",
            'user' => "derged",
            'pwd' => "derged",
        ];
        try {
            $this->pdo = new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pwd']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        
    }

    function getAllFromTable($table){
        $statement = $this->pdo->prepare("SELECT * FROM `{$table}`");
        $result = $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function searchByCol($table, $col, $like){
        $statement = $this->pdo->prepare("SELECT * FROM `{$table}` WHERE `{$col}`LIKE '{$like}'");
        $result = $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert($table, $data){
        $strKeys = '';
        $strValues = '';
        foreach ($data as $key=>$value){
            $strKeys .= '`' . $key . '`,';
            $strValues .= "'" . $value . "',";
        }
        $strKeys = trim($strKeys, '\,');
        $strValues = trim($strValues, '\,');
        $sql = "INSERT INTO `{$table}` ({$strKeys}) VALUES ({$strValues})";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute();
        return $result;
        
    }

    function delete($table, $data){
        $str = '';
        foreach ($data as $key=>$value){
            $str .= '`' . $key . "` = '" . $value . "',";
        }
        $str = trim($str, '\,');
        $sql = " DELETE FROM `{$table}` WHERE {$str} ";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute();
        return $result;
        
    }  
}
