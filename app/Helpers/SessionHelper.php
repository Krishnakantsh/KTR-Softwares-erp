<?php

if (!function_exists('activeSession')) {

    function activeSession()
    {
        return app()->bound('active_session')
            ? app('active_session')
            : null;
    }
}