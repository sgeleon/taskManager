<?
namespace TaskManager\Controller;

abstract class Component {
    abstract function __construct(array $params);
    abstract function run();
    function loadTemplate(array $arResult) {

        $componentName = substr(get_class($this),  strrpos(get_class($this), '\\') + 1);

        $file = $_SERVER['DOCUMENT_ROOT']."/Controller/".lcfirst($componentName)."/template.php";

        if(!file_exists($file))
                throw new ErrorComponent("Component ".$file."'s file template.php don't exists.");

        $func = function ($file) use ($arResult) {
            include $file;
        };
        $func($file);
    }
}