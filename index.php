<?
namespace TaskManager;

use TaskManager\Setting;

spl_autoload_register(function ($classNameSpace){
    if(strpos($classNameSpace,'TaskManager\\') === 0)
        $classNameSpace = str_replace('TaskManager\\', '', $classNameSpace);

    $classNameSpace = preg_replace('#\\\\#', '/', $classNameSpace);

    $file = $_SERVER['DOCUMENT_ROOT'].'/'.$classNameSpace.'.php';

    if(file_exists($file))
        include_once $file;
    else
        throw new Error\ErrorClass('Class '.$classNameSpace.' don\'t exists.');
});

$GLOBALS['DB'] = new DB();
$GLOBALS['CONTROLLER'] = new Controller();

session_start();

try {
    $router = new Route();
    $router->run();
} catch (\Error $e) {
    //TODO make Logging
    require $_SERVER['DOCUMENT_ROOT'].'\404.php';
}


