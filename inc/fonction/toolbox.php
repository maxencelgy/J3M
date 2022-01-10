<?php
function debug(array $tableau)
{
    echo '<pre style="height:300px;overflow-y: scroll;font-size: .7rem;padding: .6rem;font-family: Verdana;background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}
function dump($value)
{
    echo '<pre style="height:150px;overflow-y: scroll;font-size: 1rem;padding: .5rem;font-family: Verdana;background-color: #111;color:#eee;">';
    var_dump($value);
    echo '</pre>';
}


