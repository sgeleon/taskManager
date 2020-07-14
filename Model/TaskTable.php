<?
namespace TaskManager\Model;

class TaskTable extends Entity{

    public function getTableName(): string {
        return "task";
    }

    public function getMap(): array
    {
        return array(
            "USER_NAME" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            "EMAIL" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            "MASSAGE" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            "STATUS" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            "EDITED" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            );
    }
}