<?
namespace TaskManager\Controller;

use TaskManager\Model\TaskTable;

class TaskDetail extends Component {
    function __construct(array $params)
    {

    }

    function run()
    {
        $arResult['error'] = array();

        if($_SESSION["USER"]["AUTHORIZE"] == "Y") {

            $taskTable = new TaskTable();

            if($_GET['ID'] && !array_key_exists('add', $_POST)){
                $id = (int)$_GET['ID'];

                $task = $taskTable->get($id);

                $arResult['field'] = $task[0];
            }

            if(array_key_exists('add', $_POST)){
                $id = (int)$_POST['id'];
                $userName = htmlspecialchars(trim($_POST['userName']));
                $email = htmlspecialchars(trim($_POST['email']));
                $massage = htmlspecialchars(trim($_POST['massage']));
                $status = htmlspecialchars(($_POST['status'] == 'on' ? 'Y' : 'N'));

                $task = $taskTable->get($id);

                $edited = ($massage === $task[0]['MASSAGE'] ? "N" : "Y");

                $arResult['field'] = array(
                    'ID' => $id,
                    'USER_NAME' => $userName,
                    'EMAIL' => $email,
                    'MASSAGE' => $massage,
                    'STATUS' => $status
                );

                if(!$userName)
                    $arResult['error'][] = "Don't enter user Name.";

                if(!$email)
                    $arResult['error'][] = "Don't enter email.";

                if(!$massage)
                    $arResult['error'][] = "Don't enter massage.";

                if($userName && $email && $massage){
                    $arResult['success'] = $taskTable->update($id, array(
                        "USER_NAME" => $userName,
                        "EMAIL" => $email,
                        "MASSAGE" => $massage,
                        "STATUS" => $status,
                        "EDITED" => $edited
                    ));

                    if($arResult["success"])
                        $_SESSION['MASSAGE'] = 'Task updated successfully.';
                }
            }
        } else {
            $arResult['redirectOnLogin'] = true;
        }

        $this->loadTemplate($arResult);
    }
}