<?php
class Database
{
    private $_connection = null; //stores the connection to the database.
    private static $_instance = null; // stores an instance of the class

    public function __construct()  // called when an object of the class is created
    {
        $this->Connection(); //calls connection to establish the connection
    }

    private function Connection() 
    {
        $this->_connection = new PDO('mysql:host=127.0.0.1;dbname=digital_assignment', 'root', '');
        $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //error mode


    }

    public static function Instance()
    {
        if (!isset(self::$_instance)) {
            return self::$_instance = new Database();
        } else {
            return self::$_instance;
        }

    }


    public function Insert($tableName = '', $data = array()) // inserts data into a table
    {
        if (empty($tableName) || empty($data)) throw new PDOException('Table name and data is required');

        $columns = implode(',', array_keys($data));
        $setColumns = '';
        $increment = 1;
        foreach ($data as $value) {
            $setColumns .= '?';
            if ($increment < count($data)) {
                $setColumns .= ",";
            }
            $increment++;
        }
        $query = "INSERT INTO {$tableName}($columns) VALUES($setColumns)";
        $preStatement = $this->_connection->prepare($query);
        try {
           $preStatement->execute(array_values($data));
            return $this->_connection->lastInsertId();
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function Update($tableName = '', $data = array(), $criteria = '', $bindValue = array())
    {
        $setKey = '';
        $increment = 1;
        foreach ($data as $key => $value) {
            $setKey .= $key . '=?';
            if ($increment < count($data)) {
                $setKey .= ',';
            }
            $increment++;
        }
        $query = "UPDATE {$tableName} SET $setKey WHERE $criteria=?";
        
        $preStatement = $this->_connection->prepare($query);
        $mergeData = array_merge(array_values($data), $bindValue);
        try {
            return $preStatement->execute($mergeData);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function Delete($tableName = '', $criteria = '', $bindValue = array())
    {
        $query = "DELETE FROM {$tableName} WHERE {$criteria}=?";
        $preStatement = $this->_connection->prepare($query);
        try {
            return $preStatement->execute($bindValue);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }
    public function Select($tableName = '', $column = '*', $criteria = '', $bindValue = array(), $clause = '')
    {
       
        if (empty($column)) {
            $column .= "*";
        }

        $query = "SELECT {$column} FROM {$tableName}";
        if (!empty($criteria)) {
            $query .= " WHERE {$criteria}=?";
        }

        if (!empty($clause)) {
            $query .= " {$clause}";
        }
        
// echo $query;
// print_r($bindValue);
        $preStatement = $this->_connection->prepare($query);
        try {
            $preStatement->execute($bindValue);
            
            return $preStatement->fetchAll(PDO::FETCH_ASSOC);
            

        } catch (PDOException $exception) {
            die($exception->getMessage());
        }


    }
      public function Query($query)
    {
      
        // echo $query;
        $preStatement = $this->_connection->prepare($query);
        try {
            $preStatement->execute([]);
            return $preStatement->fetchAll(PDO::FETCH_CLASS);


        } catch (PDOException $exception) {
            die($exception->getMessage());
        }


    }
    
}
$obj=Database::Instance();