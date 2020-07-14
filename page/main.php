<?include $_SERVER["DOCUMENT_ROOT"]."/page/header.php"?>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a href="/addTask/" class="btn btn-outline-success">Add Task</a>

    <?if(array_key_exists("USER", $_SESSION) && $_SESSION["USER"]["AUTHORIZE"] == "Y"):?>
        <span>Hello, <?=$_SESSION["USER"]["NAME"]?>!</span>
        <a href="/login/?logout" class="btn btn-outline-success">Log out</a>
    <?else:?>
        <a href="/login/" class="btn btn-outline-success">Log in</a>
    <?endif;?>
</nav>

<?$GLOBALS['CONTROLLER']->load('taskList');?>

<?include $_SERVER["DOCUMENT_ROOT"]."/page/footer.php"?>
