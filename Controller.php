<?
namespace TaskManager;

use TaskManager\Error\ErrorComponent;

class Controller {
    public function load (string $name, array $params = array()){

       $file = $_SERVER['DOCUMENT_ROOT']."/Controller/".$name."/component.php";

       if(!file_exists($file))
            throw new ErrorComponent("Component ".$name." don't exists.");

       include $file;

       $class = "TaskManager\Controller\\".$name;

       if(class_exists(ucfirst($class))) {
           $component = new $class($params);
           $component->run();
       } else
           throw new ErrorComponent("Component's class don't load.");
    }
}