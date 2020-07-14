<?
namespace TaskManager;

use TaskManager\DataBaseType\InterfaceDatabase;
use TaskManager\Setting;
use TaskManager\Error;

class DB {

    private $class = 'TaskManager\DataBaseType\Mysql';

    private $instance;

    function __construct()
    {
        if(!($this->instance instanceof InterfaceDatabase))
            $this->instance =  new $this->class(Setting::DATABASE_HOST, Setting::DATABASE_USER, Setting::DATABASE_PASSWORD, Setting::DATABASE_NAME);
    }

    function query(string $sql) {
        return $this->instance->query($sql);
    }

}
