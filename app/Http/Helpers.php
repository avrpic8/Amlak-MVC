<?php

function sideBarActive($url, $contain = true){

    if ($contain){
        return (strpos(currentUrl(), $url) === 0) ? 'active' : '';
    }else{
        return currentUrl() === $url ? 'active' : '';
    }
}