<?
namespace TaskManager\DataBaseType;

use TaskManager\Error;

class Mysql implements InterfaceDatabase {

    private $instance;

    public function __construct(string $host, string $name, string $password, string $databaseName)
    {
        $this->instance = new \mysqli($host, $name, $password, $databaseName);

        if ($this->instance->connect_error)
            throw new Error\ErrorDataBase("Error connect. Number error:". $this->instance->connect_errno ." Message error: ". $this->instance->connect_error);
    }

    public function query(string $sql)
    {
        if(!$this->instance->ping())
            throw new Error\ErrorDataBase("Error connect. Number error:". $this->instance->connect_errno ." Message error: ". $this->instance->connect_error);

        $result = $this->instance->query($sql);

        if($this->instance->error)
            throw new Error\ErrorDataBase("Error database. Number error: ". $this->instance->errno ." Message error: ".$this->instance->error);

        if($result instanceof  \mysqli_result) {

            if($result->num_rows)
                return $result->fetch_all (MYSQLI_ASSOC);
            else
                return array();
        }
        else
            return $result;
    }

    function __destruct()
    {
        $this->instance->close();
    }
}