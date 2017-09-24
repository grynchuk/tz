<?php
namespace tools;
use \Phalcon\Db\Adapter\Pdo\Mysql;
use \Phalcon\Config\Adapter\Ini;
/**
 * Сингл тон для БД 
 */
class dbConn {
    
    private static $conn=null; 
    
    private function __construct() { }
    private function __clone() { }
    
    final public static function getConn(){
        $config = new Ini(
         "../config.ini"
        );
        $configDb=$config->conn;
        
        if(!self::$conn){
        self::$conn=new Mysql(
            [
                'host'     => $configDb->host,
                'username' => $configDb->user,
                'password' => $configDb->password,
                'dbname'   => $configDb->db ,
                'charset'  => 'utf8'
            ]
        );
        }     
        return self::$conn;
    } 
}