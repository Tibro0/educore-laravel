<?php


/** Set Sidebar Item Active Backend */
if (!function_exists('adminSidebarActive')) {
    function adminSidebarActive(array $route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'mm-active';
                }
            }
        }
    }
}

/** Set Sidebar Item Active Frontend */
if (!function_exists('setActive')) {
    function setActive(array $route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth('web')->user();
    }
}
