<?php

function dateBackup($date)
{
    $vart = explode('-', $date['filename']);

    return $vart[2] . '/' . $vart[1] . '/' . $vart[0] . ' ' . $vart[3] . ':' . $vart[4] . ':' . $vart[5];
}
