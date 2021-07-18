<?php

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser()
    {
        return auth()->guard('accounts')->user();
    }
}

if (!function_exists('getAccountInfo')) {
    function getAccountInfo()
    {
        return getLoggedInUser()->accountable;
    }
}

if (!function_exists('getLoginRole')) {
    function getLoginRole()
    {
        $accType = getLoggedInUser()->accountable_type;
        return strtolower(substr_replace($accType, '', 0, strrpos($accType, '\\') + 1));
    }
}
