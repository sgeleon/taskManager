<?
namespace TaskManager\Controller;

use TaskManager\Model\UserTable;

class Admin extends Component {
    function __construct(array $params)
    {

    }

    function run()
    {
        $arResult['error'] = array();
        $arResult['field'] = array();

        if(array_key_exists("USER", $_SESSION) && $_SESSION["USER"]["AUTHORIZE"] == "Y" && array_key_exists('logout', $_GET)) {
            $_SESSION["USER"]["AUTHORIZE"] = "N";
            $_SESSION["USER"]["NAME"] = "";
            $_SESSION["USER"]["ID"] = "";
        }
        if(  array_key_exists('userName', $_POST)
          || array_key_exists('password', $_POST)
        ){
            $userName = trim($_POST['userName']);
            $password = trim($_POST['password']);

            if(!$userName)
                $arResult['error'][] = "Don't enter login.";

            if(!$password)
                $arResult['error'][] = "Don't enter password.";

            if($userName && $password){
                $userTable = new UserTable();
                $user = $userTable->getList(array("NAME" => $userName, "PASSWORD" => $password));

                if(count($user['page'])){
                    $_SESSION["USER"] = array("ID" => $user["page"][0]["ID"], "AUTHORIZE" => "Y", "NAME" => $user["page"][0]["NAME"]);
                } else {
                    $arResult['error'][] = "Incorrect Login or Password.";
                }
            }
        }

        if(array_key_exists("USER", $_SESSION) && $_SESSION["USER"]["AUTHORIZE"] === "Y"){
            $arResult['showForm'] = false;
            $arResult['redirectOnMainPage'] = true;
        } else {
            $arResult['showForm'] = true;

            if(isset($userName))
                $arResult['field']['userName'] = $userName;

            if(isset($password))
                $arResult['field']['password'] = $password;
        }

        $this->loadTemplate($arResult);
    }
}