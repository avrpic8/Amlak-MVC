<?php

namespace System\Database\DBConnection;

use PDO;
use PDOException;
use System\Config\Config;

class DBConnection{

    private static $dbConnectionInstance = null;

    private function __construct(){}

    public static function getDBConnectionInstance(){

        if(self::$dbConnectionInstance == null){
            $dBConnection = new DBConnection();
            self::$dbConnectionInstance = $dBConnection->dbConnection();
        }

        return self::$dbConnectionInstance;
    }

    private function dbConnection(){

        $option = array(
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            return new PDO(
                "mysql:host=" . Config::get("database.DBHOST") . ";dbname=" . Config::get("database.DBNAME"),
                Config::get("database.DBUSERNAME"), Config::get("database.DBPASSWORD"), $option
            );
        }catch (PDOException $e){
            echo "Error in database connection " . $e->getMessage();
            return false;
        }
    }

    public static function newInsertId(): string{
        return self::getDBConnectionInstance()->lastInsertId();
    }
}