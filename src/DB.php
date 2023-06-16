<?php

final class DB
{
    private static $instance = null;
    private static $connection;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function connect($host, $dbName, $user, $password)
    {
        try {
            $dsn = "mysql:dbname=$dbName;host=$host";
            self::$connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function getConnection()
    {
        return self::$connection;
    }

    private function __construct()
    {
        //empty
    }

    private function __clone()
    {
        //empty
    }

    public function __wakeup()
    {
        //empty
    }

}