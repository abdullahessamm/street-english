<?php

function errorMsg($msg, $icon = null, $lang = null)
{
    $lang = $lang == null ? config('app.locale') : $lang;
    $icon = $icon == null ? '<i class="fa fa-times text-danger" style="font-size: 100px;"></i>' : $icon;

    $res = '
    <div class="text-center">
        '.$icon.'
        <h3>'.$msg.'</h3>
    </div>
    ';

    return $res;
}