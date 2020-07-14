<?
namespace TaskManager\DataBaseType;

Interface InterfaceDatabase {
    function __construct(string $host, string $name, string $password, string $databaseName);
    public function query(string $sql) ;
}