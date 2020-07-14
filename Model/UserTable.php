<?
namespace TaskManager\Model;

class UserTable extends Entity {

    public function getTableName(): string {
        return "user";
    }

    public function getMap(): array
    {
        return array(
            "NAME" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED)),
            "PASSWORD" => array('type' => Entity::STRING, 'requirement' => array(Entity::REQUIRED))
        );
    }
}