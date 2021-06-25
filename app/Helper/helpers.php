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

if (!function_exists('FileUnlink')) {
    function FileUnlink($path, $file)
    {
        if ($file != null && file_exists($path . $file) && $file != 'default.png') {
            return unlink($path . $file);
        }
    }
}

if(!function_exists("getTime")){
    function getTime($time){
        return date("h:i a", strtotime($time));
    }
}