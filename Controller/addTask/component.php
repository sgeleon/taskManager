<?

namespace TaskManager\Controller;

use TaskManager\Model\TaskTable;

class AddTask extends Component
{
    function __construct(array $params)
    {

    }

    function run()
    {
        $arResult['error'] = array();
        $arResult['field'] = array();

        if (array_key_exists('userName', $_POST)
            || array_key_exists('email', $_POST)
            || array_key_exists('message', $_POST)
        ) {
            $userName = trim($_POST['userName']);
            $email = trim($_POST['email']);
            $massage = trim($_POST['message']);

            if (!$userName)
                $arResult['error'][] = 'Enter user name in the field.';

            if (!$email)
                $arResult['error'][] = 'Enter email in the field.';

            $isEmailValid = preg_match('#.*@.*\..{2,}#', $email);

            if($email && !$isEmailValid)
                $arResult['error'][] = 'The field of email is invalid.';

            if (!$massage)
                $arResult['error'][] = 'Enter massage in the field.';

            if ($userName && $email && $isEmailValid && $massage) {
                $taskTable = new TaskTable();
                $arResult["success"] = $taskTable->set(array(
                    "USER_NAME" => htmlspecialchars($userName),
                    "EMAIL" => htmlspecialchars($email),
                    "MASSAGE" => htmlspecialchars($massage),
                    "STATUS" => "N",
                    "EDITED" => "N"
                ));
                if($arResult["success"])
                    $_SESSION['MASSAGE'] = 'Task added successfully.';
            } else {
                $arResult['field'] = array(
                    "NAME" => $userName,
                    "EMAIL" => $email,
                    "MASSAGE" => $massage
                );
            }
        }

        $this->loadTemplate($arResult);
    }
}