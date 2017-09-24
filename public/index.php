
<?php
//echo $_GET['_url'];

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use tools\dbConn;


define('ROOT', dirname(__DIR__));
include_once ROOT.'/tools/constants.php';


//инициализируем загрузчик
$loader = new Loader();
//Укажим директории для загрузки
$loader->registerDirs(
    [
        ROOT . '/controllers/',
        ROOT . '/models/',
        ROOT . '/tools/'
    ]
);

$loader->registerNamespaces(
    [      
        "tools"          => ROOT . '/tools/'
    ]
);

$loader->register();



// Инъекция зависимостей
$di = new FactoryDefault();

//db
$di->set(
    'db',
        // ленивая инициализация
    function () {
        return dbConn::getConn();
    }
);

// в частности вьюшек какую вьюшку смотрть опредлет
// так директорияВьюшек/ИмяКонтролера/имяДействия
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(ROOT . '/views/');
        return $view;
    }
);
// создаем экземпляр  приложения с указанными зависимостями  
$application = new Application($di);

try {
   
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}



