<?
namespace TaskManager\Model;

use TaskManager\Error\ErrorDataBase;

abstract class Entity {

    // Type
    const NUMBER = 1;
    const STRING = 2;

    // Additional Requirements
    const REQUIRED = 'REQUIRED';

    abstract public function getMap(): array;
    abstract public function getTableName(): string;

    public function getList(array $filter = array(), array $sort = array(), int $page = 1, int $countOnPage = 3): array {
        global $DB;

        $filter = array_filter($filter, function ($fieldName) {
            return array_key_exists($fieldName, $this->getMap());
        }, ARRAY_FILTER_USE_KEY);

        $sort = array_filter($sort, function ($fieldName) {
            return array_key_exists($fieldName, $this->getMap());
        }, ARRAY_FILTER_USE_KEY);

        $strFilter = (count($filter) ?
            " WHERE ".implode(' AND ', array_map(function ($key, $value){
                return $key." = '".$value."'";
            }, array_keys($filter), $filter))
            : '');

        $strSort = (count($sort) ?
            " ORDER BY ".implode(', ', array_map(function ($key, $value){
                return $key." ".$value;
            }, array_keys($sort), $sort))
            : '');

        $result["page"]  =  $DB->query("SELECT ID,". implode(", ", array_keys($this->getMap())).
                                      " FROM ".$this->getTableName().
                                       $strFilter.
                                       $strSort.
                                       " LIMIT ".($page > 1 ? ($page - 1) * $countOnPage.", " : '').$countOnPage.
                                      ";");

        $sql =  "SELECT COUNT(ID) as COUNT".
                " FROM ".$this->getTableName().
                $strFilter.
                ";";

        $countAllTask = $DB->query($sql);

        if(count($countAllTask))
            $result["count"] = (int)$countAllTask[0]["COUNT"];

        return $result;
    }

    public function get(int $id): array
    {
        global $DB;

        return  $DB->query("SELECT ID, ". implode(", ",array_keys($this->getMap()))." FROM ".$this->getTableName()." WHERE ID =".$id.";");
    }

    public function set(array $fields = array()): bool
    {
        global $DB;

        if(!count($fields))
            return false;

        $arName = array();
        $arValue = array();

        $fieldMap = $this->getMap();

        foreach ($fieldMap as $name => $requirement) {

            if($this->testValue($fields[$name], $requirement)){
                $arName[] = $name;
                $arValue[] = $fields[$name];
            }
        }

        return $DB->query("INSERT INTO ".$this->getTableName()." (".implode(', ', $arName).") VALUES ('".implode("', '", $arValue)."');");
    }

    public function update(int $id, array $fields):bool {
        global $DB;

        $arName = array();
        $arValue = array();

        $fieldMap = $this->getMap();

        foreach ($fieldMap as $name => $requirement) {

            if($this->testValue($fields[$name], $requirement)){
                $arName[] = $name;
                $arValue[] = $fields[$name];
            }
        }

        return $DB->query("UPDATE ".$this->getTableName().
                           " SET ".implode(", ", array_map(function ($name, $value){
                                    return $name." = '".$value."'";
                                }, $arName, $arValue)).
                           " WHERE ID = ". $id.";");
    }

    public function delete(int $id): bool {
        global $DB;

        return $DB->query("DELETE FROM ".$this->getTableName()." WHERE ID=".$id.";");

    }

    private function testValue($value, $requirement){
        $result = true;

        switch ($requirement['type']){
            case $this::NUMBER:
                if(!is_numeric($value))
                    $result = false;
                break;
            case $this::STRING:
                if(!is_string($value))
                    $result = false;
        }

        foreach ($requirement['requirement'] as $name){
            switch ($name) {
                case $this::REQUIRED:
                    if(is_null($value))
                        throw new ErrorDataBase("Don't include requirement param in table ".__CLASS__.".");
            }
        }

        return $result;
    }


}



















