<?php

function getArrayFromUrl($url) {
    $json = file_get_contents("ListIt:3456/" + $url);
    return json_decode($json);     
}

?>