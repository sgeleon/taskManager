<?if($arResult['showForm']):?>
<div class="row">
    <a href="/">Return to a list of task.</a>
</div>
<div class="row">
    <h1 style="width: 100%; text-align: center;">Log in</h1>
</div>
<div class="row">
    <?if(count($arResult['error'])):?>
        <?foreach ($arResult['error'] as $massage):?>
            <span style="width: 100%; color: red; text-align: center;"><?=$massage?></span>
        <?endforeach;?>
    <?endif;?>
</div>
<div class="row">
    <form action="/login/" method="post" style="width: 100%;">
        <?$fields = $arResult['field'];?>
        <div class="form-group">
            <label for="userName">Name*</label>
            <input class="form-control" name="userName" id="userName" type="text" value="<?=(array_key_exists('userName', $fields) ? $fields['userName'] : '')?>"/>

            <label for="userName">Password*</label>
            <input class="form-control" name="password" id="password" type="password" value="<?=(array_key_exists('password', $fields) ? $fields['password'] : '')?>"/>
        </div>

        <input type="submit" class="btn btn-outline-success" value="login">
    </form>
</div>
<?endif;?>

<?if(array_key_exists('redirectOnMainPage', $arResult) && $arResult['redirectOnMainPage']):?>
 <script>
     window.location = '/';
 </script>
<?endif;?>
