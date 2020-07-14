<div class="row">
    <a href="/">Return to a list of task.</a>
</div>

<div class="row">
    <h1 style="width: 100%; text-align: center;">Add Task</h1>
</div>

<?if(array_key_exists('success', $arResult) && $arResult['success']):?>
    <script>
        window.location = '/';
    </script>
<?endif;?>


<div class="row">
    <?if(array_key_exists('success', $arResult)):?>
        <?if($arResult["success"]):?>
            <span style="width: 100%; color: green; text-align: center;">Task added successfully.</span>
        <?else:?>
            <span style="width: 100%; color: green; text-align: center;">Task don't added. Server error. </span>
        <?endif;?>
    <?endif;?>
</div>

<div class="row">
    <?if(count($arResult['error'])):?>
        <?foreach ($arResult['error'] as $massage):?>
            <span style="width: 100%; color: red; text-align: center;"><?=$massage?></span>
        <?endforeach;?>
    <?endif;?>
</div>
<?$field = $arResult['field'];?>
<div class="row">
    <form action="/addTask/" method="post" style="width: 100%;">
        <div class="form-group">
            <label for="userName">Name*</label>
            <input name="userName" id="userName" class="form-control" type="text" value="<?=(array_key_exists('NAME', $field) ? $field['NAME'] : '')?>"/>

            <label for="email">E-mail*</label>
            <input name="email" id="email" class="form-control" type="email"  value="<?=(array_key_exists('EMAIL', $field) ? $field['EMAIL'] : '')?>"/>

            <label for="message">Message*</label>
            <input name="message" id="message" class="form-control" type="text" value="<?=(array_key_exists('MASSAGE', $field) ? $field['MASSAGE'] : '')?>"/>
        </div>
            <input type="submit" class="btn btn-outline-success" value="Add Task">

    </form>
</div>


