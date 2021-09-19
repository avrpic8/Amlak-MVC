<?php

function sideBarActive($url, $contain = true){

    if ($contain){
        return (strpos(currentUrl(), $url) === 0) ? 'active' : '';
    }else{
        return currentUrl() === $url ? 'active' : '';
    }
}

function errorClass($name){

    return errorExist($name) ? 'is-invalid' : '';
}

function errorText($name){

    return errorExist($name) ? '<div><small class="text-danger">' .     error($name) . '</small></div>' : '';
}

function oldOrValue($name, $value){

    return empty(old($name)) ? $value : old($name);
}