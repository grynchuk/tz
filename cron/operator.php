<?php
/**
 * Тут все происходит по крону
 * Для того чтоб выполнялись банковские операции 
 * Нужно в  крон добавить 
 * crontab -e
 * 0 0 * * * php  ПутьГдеТестовоеЗадание/cron/operator.php '\cron' 'makeOps'
 * 
 * также  через єтот файлик можно сгенерить все движения или все удалить 
 * пример:
 * 
 * $ php operator.php '\tools\dataMaker\genOps' 'makeDeposit' 
 * $ php operator.php '\cron' 'makeMyOps' 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \Phalcon\Loader;
use \tools\dbConn;
use Phalcon\Di\FactoryDefault;

define('ROOT', dirname(__DIR__));
include_once ROOT.'/tools/constants.php';

//инициализируем загрузчик
$loader = new Loader();
//Укажим директории для загрузки
$loader->registerDirs(
    [
        ROOT . '/models/',
        ROOT . '/interfaces/'
    ]
);

$loader->registerNamespaces(
    [        
        "tools"          => ROOT . '/tools/'
    ]
);

$loader->register();


$di = new FactoryDefault();
$di->set(
    'db',
        // ленивая инициализация
    function () {
        return dbConn::getConn();
    }
);

$class=$argv[1];
$method=$argv[2];

try{
    
if(class_exists($class)
   and 
   method_exists($class, $method)     
        ){
    
           
            $inst= new $class();
            $inst->$method();
            
        }else{
            throw new Exception(  " Not found $class  $method  ");
            
        }
}catch(Exception $e){
      tools\useful::logMess($e->getMessage());                    
}