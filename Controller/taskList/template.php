<?if($arResult['massage']):?>
    <div class="row">
        <span style="width: 100%; color: green; text-align: center;"><?=$arResult['massage']?></span>
    </div>
<?endif;?>
<?if(count($arResult['task']['page'])):?>
    <style>
        .button_sort > th > span {
            margin-right: 10px;
        }
        .icon_top {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: url("/image/icon/caret-top.svg") no-repeat;
        }
        .icon_bottom {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: url("/image/icon/caret-bottom.svg") no-repeat;
        }
        .icon_minus {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: url("/image/icon/minus.svg") no-repeat;
        }
    </style>
    <table class="table">
        <thead>
            <tr class="button_sort">
                <th scope="col">
                    <span>User</span>
                    <a class="<?=($arResult['fieldOrder'] == 'User_Name' ?
                                    ($arResult['order'] == 'asc' ? 'icon_bottom' :
                                        ($arResult['order'] == 'desc' ? 'icon_top': 'icon_minus')
                                ): 'icon_minus')?>"
                       href="/?fieldOrder=User_Name&order=<?=($arResult['fieldOrder'] == 'User_Name' ?
                                                                ($arResult['order'] == 'desc' ? 'asc' : 'desc')
                                                            : 'asc').
                                                            "&page=".$arResult['page']?>">
                    </a>
                </th>
                <th scope="col">
                    <span>Email</span>
                    <a class="<?=($arResult['fieldOrder'] == 'Email' ?
                                    ($arResult['order'] == 'asc' ? 'icon_bottom' :
                                        ($arResult['order'] == 'desc' ? 'icon_top': 'icon_minus')
                               ): 'icon_minus')?>"
                       href="/?fieldOrder=Email&order=<?=($arResult['fieldOrder'] == 'Email' ?
                                                                ($arResult['order'] == 'desc' ? 'asc' : 'desc')
                                                        : 'asc').
                                                        "&page=".$arResult['page']?>">
                    </a>
                </th>
                <th scope="col">
                    <span>Massage</span>
                    <a class="<?=($arResult['fieldOrder'] == 'Massage' ?
                                    ($arResult['order'] == 'asc' ? 'icon_bottom' :
                                        ($arResult['order'] == 'desc' ? 'icon_top': 'icon_minus')
                                ): 'icon_minus')?>"
                       href="/?fieldOrder=Massage&order=<?=($arResult['fieldOrder'] == 'Massage' ?
                                                            ($arResult['order'] == 'desc' ? 'asc' : 'desc')
                                                        : 'asc').
                                                        "&page=".$arResult['page']?>">
                    </a>
                </th>
                <th scope="col">
                    <span>Status</span>
                    <a class="<?=($arResult['fieldOrder'] == 'Status' ?
                                    ($arResult['order'] == 'asc' ? 'icon_bottom' :
                                        ($arResult['order'] == 'desc' ? 'icon_top': 'icon_minus')
                                ): 'icon_minus')?>"
                       href="/?fieldOrder=Status&order=<?=($arResult['fieldOrder'] == 'Status' ?
                                                            ($arResult['order'] == 'desc' ? 'asc' : 'desc')
                                                        : 'asc').
                                                        "&page=".$arResult['page']?>">
                    </a>
                </th>
                <th scope="col">
                    <span>Edited by administration</span>
                </th>
                <?if($arResult['isEdit']):?>
                    <th scope="col"></th>
                <?endif;?>
            </tr>
        </thead>
        <tbody>
        <?foreach ($arResult['task']['page'] as $item):?>
            <tr>
                <td><?=$item["USER_NAME"]?></td>
                <td><?=$item["EMAIL"]?></td>
                <td><?=$item["MASSAGE"]?></td>
                <td><?=($item["STATUS"] == "N" ? "New" : ($item["STATUS"] == "Y" ? "Done" : ""))?></td>
                <td><?=($item["EDITED"] == "Y" ? "Yes" : "No")?></td>

                <?if($arResult['isEdit']):?>
                    <td><a href="/taskDetail/?ID=<?=$item["ID"]?>">Edit</a> </td>
                <?endif;?>
            </tr>
        <?endforeach;?>
        </tbody>
    </table>

    <?if($arResult['task']['count'] > $arResult['countOnPage']):?>
        <nav aria-label="Page navigation">
            <ul class="pagination">

                <?$order = "fieldOrder=".$arResult['fieldOrder'].'&order='.$arResult['order']?>

                <?if($arResult['page'] != 1):?>
                    <li class="page-item"><a class="page-link" href="/?<?=$order?>&page="<?=$arResult['page'] - 1?>">Previous</a></li>
                <?endif;?>

                <?for($i = 1; $i <= $arResult['countPage']; $i++):?>
                    <li class="page-item <?=($arResult['page'] == $i ? 'active disabled' : '')?>"><a class="page-link" href="/?<?=$order?>&page=<?=$i?>"><?=$i?></a></li>
                <?endfor;?>

                <?if($arResult['page'] != $arResult['countPage']):?>
                    <li class="page-item"><a class="page-link" href="/?<?=$order?>&page=<?=$arResult['page'] + 1?>">Next</a></li>
                <?endif;?>
            </ul>
        </nav>
    <?endif;?>

<?endif;?>

