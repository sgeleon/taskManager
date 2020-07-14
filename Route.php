<?
namespace TaskManager;

class Route {

    private $pathDirPage;

    function __construct(){
        $this->pathDirPage = $_SERVER['DOCUMENT_ROOT'].'/page/';
    }

    function run(){
        $url = $_SERVER['REQUEST_URI'];

       if($this->match('/login/', $url)){
            require $this->pathDirPage . 'login.php';

       } else if($this->match('/addTask/', $url)){
           require $this->pathDirPage . 'addTask.php';

       } else if($this->match('/taskDetail/', $url)){
           require $this->pathDirPage . 'taskDetail.php';

       } else if($this->match('/', $url)) {
           require $this->pathDirPage . 'main.php';

       } else  {
           $this->page404();
       }
    }

    function page404(){
        if(file_exists($this->pathDirPage.'404.php'))
            require $this->pathDirPage.'404.php';
        else
            require $_SERVER['DOCUMENT_ROOT'].'/404.php';
    }

    private function match($match, $url){
        return preg_match('#^'.preg_quote($match, '#').'(?:\?.*)?$#', $url);
    }
}