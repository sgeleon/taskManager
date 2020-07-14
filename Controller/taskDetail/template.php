<div class="row">
    <a href="/">Return to a list of task.</a>
</div>
<?if(array_key_exists('field', $arResult)):?>
<div class="row">
    <h1 style="width: 100%; text-align: center;">Edit Task</h1>
</div>
<div class="row">
    <?if(count($arResult['error'])):?>
        <?foreach ($arResult['error'] as $massage):?>
            <span style="width: 100%; color: red; text-align: center;"><?=$massage?></span>
        <?endforeach;?>
    <?endif;?>
</div>
<div class="row">
    <form action="/taskDetail/?ID=<?=$arResult['field']['ID']?>" method="post" style="width: 100%;">
        <div class="form-group">
            <input name="id" type="hidden" value="<?=$arResult['field']['ID']?>">

            <label for="userName">Name*</label>
            <input name="userName" id="userName" class="form-control" type="text" value="<?=$arResult['field']['USER_NAME']?>"/>

            <label for="email">E-mail*</label>
            <input name="email" id="email" class="form-control" type="email" value="<?=$arResult['field']['EMAIL']?>"/>

            <label for="massage">Massage*</label>
            <input name="massage" id="massage" class="form-control" type="text" value="<?=$arResult['field']['MASSAGE']?>"/>

            <label for="status">Status</label>
            <input name="status" id="status" type="checkbox" <?=($arResult['field']['STATUS'] === "Y" ? "checked" : '')?>>

        </div>

        <input type="submit" class="btn btn-outline-success" name="add" value="Save">

    </form>
</div>
<?endif;?>
<?if(array_key_exists('success', $arResult) && $arResult['success']):?>
    <script>
        window.location = '/';
    </script>
<?endif;?>

<?if(array_key_exists('redirectOnLogin', $arResult) && $arResult['redirectOnLogin']):?>
    <script>
        window.location = '/login/';
    </script>
<?endif;?>
