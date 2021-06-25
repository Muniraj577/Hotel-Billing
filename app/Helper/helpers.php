<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists("notify")){
    function notify($type, $msg){
        return array(
            "alert-type" => $type,
            "message" => $msg,
        );
    }
}

if(!function_exists("getUser")){
    function getUser()
    {
        return Auth::user();
    }
}