<?
namespace TaskManager\Controller;

use TaskManager\Model\TaskTable;

class TaskList extends Component {
    function __construct(array $params)
    {

    }

    function run()
    {
        $page = (array_key_exists('page', $_GET) ? (int)$_GET['page'] : 1);
        $countOnPage = 3;

        $userTaskTable = new TaskTable();

        $fieldOrder = (array_key_exists('fieldOrder', $_GET) ? $_GET['fieldOrder'] : '');
        $order = (array_key_exists('order', $_GET) ? $_GET['order'] : '');

        if(!($fieldOrder && in_array(strtoupper($fieldOrder), array_keys($userTaskTable->getMap()))))
            $fieldOrder = "User_Name";

        if(!in_array($order, array('desc', 'asc')))
            $order = 'asc';

        $arOrder = array();

        if($fieldOrder && $order)
            $arOrder[strtoupper($fieldOrder)] = $order;

        $task = $userTaskTable->getList(array(), $arOrder, $page, $countOnPage);

        if(array_key_exists('MASSAGE', $_SESSION)){
            $massage = $_SESSION['MASSAGE'];
            unset($_SESSION['MASSAGE']);
        } else {
            $massage = false;
        }

        $arResult = array(
            'task' => $task,
            'page' => $page,
            'countOnPage' => $countOnPage,
            'countPage' => (int)ceil($task['count'] / $countOnPage),
            'fieldOrder' => $fieldOrder,
            'order' => $order,
            'isEdit' => ((array_key_exists("USER", $_SESSION) && $_SESSION["USER"]["AUTHORIZE"] == "Y") ? true : false),
            'massage' => $massage
        );

        $this->loadTemplate($arResult);
    }
}