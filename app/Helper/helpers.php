<?php

if(!function_exists("notify")){
    function notify($type, $msg){
        return array(
            "alert-type" => $type,
            "message" => $msg,
        );
    }
}